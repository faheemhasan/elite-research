<?php

require_once(plugin_dir_path(__FILE__) . 'cetabo-map-list-table.php');
require_once(plugin_dir_path(__FILE__) . 'cetabo-helper.php');
require_once(plugin_dir_path(__FILE__) . 'cetabo-theme-helper.php');
require_once(plugin_dir_path(__FILE__) . 'cetabo-export-helper.php');
require_once(plugin_dir_path(__FILE__) . 'cetabo-import-helper.php');
require_once(plugin_dir_path(__FILE__) . 'cetabo-dataprovider.php');
require_once(plugin_dir_path(__FILE__) . 'cetabo-registry.php');
require_once(plugin_dir_path(__FILE__) . 'cetabo-resource-loader.php');
require_once(plugin_dir_path(__FILE__) . 'cetabo-controller.php');

if (!class_exists("Cetabo_SGMGoogleMapsPlugin")) {
    class Cetabo_SGMGoogleMapsPlugin extends Cetabo_SGMController
    {
        /* --------------------------------------------*
         * Constants
         * -------------------------------------------- */

        /**
         * Constructor
         */
        function __construct()
        {


            //Verify if correct version
            global $wp_version;
            if (!version_compare($wp_version, '3.5', '>=')) {
                return;
            }

            //register an activation hook for the plugin
            register_activation_hook(Cetabo_SGMRegistry::get('__FILE__'), array(&$this, 'install_cetabo_googlemaps'));
            add_action('plugins_loaded', array(&$this, 'migrate_cetabo_googlemaps'));

            //Hook up to the init action
            add_action('init', array(&$this, 'init_cetabo_googlemaps'));

        }

        /**
         * Runs when the plugin is activated
         */
        function install_cetabo_googlemaps()
        {
            Cetabo_SGMDataProvider::instance()->install_database();
        }

        function migrate_cetabo_googlemaps()
        {
            Cetabo_SGMDataProvider::instance()->migrate_database();
        }

        /**
         * Runs when the plugin is initialized
         */
        function init_cetabo_googlemaps()
        {
            // Setup localization
            load_plugin_textdomain(Cetabo_SGMRegistry::get('PLUGIN_SLUG'), false, dirname(plugin_basename(Cetabo_SGMRegistry::get('__FILE__'))) . '/lang');
            // Load JavaScript and stylesheets
            $this->register_scripts_and_styles();

            // Register the shortcode [cetabo_map]
            add_shortcode('cetabo_map', array(&$this, 'render_shortcode'));

            if (is_admin()) {
                //this will run when in the WordPress admin
                add_action('admin_menu', array(&$this, 'prepare_admin_menu'));
                add_action('wp_ajax_persist', array(&$this, 'persist_map'));
                add_action('wp_ajax_clone', array(&$this, 'clone_map'));
                add_action('wp_ajax_delete', array(&$this, 'delete_map'));
                add_action('wp_ajax_themes', array(&$this, 'get_themes'));
                add_action('wp_ajax_persist_theme', array(&$this, 'persist_theme'));
            } else {

            }

            add_action('wp_ajax_load', array(&$this, 'load_map'));
            add_action('wp_ajax_nopriv_load', array(&$this, 'load_map'));
        }

        /**
         * Execute when shortcode is rendered
         */
        function render_shortcode($atts)
        {
            // Extract the attributes
            extract(shortcode_atts(array('id' => ''), $atts));

            if (!Cetabo_SGMDataProvider::instance()->is_valid_map($id)) {
                return; // not reander
            }

            $base_url = Cetabo_SGMRegistry::get('PLUGIN_URL');
            $encoded_load_url = base64_encode(Cetabo_SGMHelper::ajax_action_url('load'));
            Cetabo_SGMResourceLoader::instance()->load_js("view/widget_js.php?id={$id}&url={$encoded_load_url}&base_url={$base_url}");
            return $this->capture('widget', array(
                    'id' => $id,
                    'readonly' => true,
                )
            );
        }

        /**
         * Prepare admin menu
         */
        function prepare_admin_menu()
        {
            //Prepare main menu
            $icon = Cetabo_SGMResourceLoader::instance()->load_img('media/images/menu_inactive.png');
            $title = "Maps";
            $capability = 'manage_options';

            
            $menu_position = '30';
            

            

            add_menu_page(Cetabo_SGMRegistry::get('PLUGIN_SLUG'), $title, $capability, Cetabo_SGMRegistry::get('PLUGIN_SLUG'), array(&$this, 'action_distpatcher'), $icon, $menu_position);
            add_submenu_page(Cetabo_SGMRegistry::get('PLUGIN_SLUG'), $title, 'All Maps', $capability, Cetabo_SGMRegistry::get('PLUGIN_SLUG'), array(&$this, 'action_distpatcher'));
            add_submenu_page(Cetabo_SGMRegistry::get('PLUGIN_SLUG'), $title, 'Add New', $capability, Cetabo_SGMRegistry::get('PLUGIN_SLUG') . '&action=edit', array(&$this, 'add_new_map'));
            
            add_submenu_page(Cetabo_SGMRegistry::get('PLUGIN_SLUG'), $title, 'Import', $capability, Cetabo_SGMRegistry::get('PLUGIN_SLUG') . '&action=import', array(&$this, 'import_map'));
            add_submenu_page(Cetabo_SGMRegistry::get('PLUGIN_SLUG'), $title, 'Settings', $capability, Cetabo_SGMRegistry::get('PLUGIN_SLUG') . '&action=settings', array(&$this, 'configure_settings'));
            
        }

        /**
         * Create new map
         */
        function add_new_map()
        {
            $this->edit_map(null, false);
        }

        /**
         * Handle action
         */
        function action_distpatcher()
        {
            $action = (array_key_exists('action', $_REQUEST)) ? $_REQUEST['action'] : '';
            $id = (array_key_exists('id', $_REQUEST)) ? $_REQUEST['id'] : '';

            switch ($action) {
                case 'edit':
                    $this->edit_map($id, false);
                    break;
                case 'preview':
                    $this->edit_map($id, true);
                    break;
                
                case 'export':
                    $this->export_map($id);
                    break;
                case 'import':
                    $this->import_map();
                    break;
                case 'settings':
                    $this->configure_settings();
                    break;
                
                default :
                    $this->list_maps();
                    break;
            }
        }

        /**
         * Handle global settings
         */
        function configure_settings()
        {

            $language = Cetabo_SGMHelper::arr_get($_REQUEST, 'language', null);

            if ($language != null) {
                Cetabo_SGMDataProvider::instance()->write_preference("language", $language);
            }

            $this->render('settings', array(
                'action' => Cetabo_SGMHelper::action_url('settings'),
                'language' => Cetabo_SGMDataProvider::instance()->read_preference("language", "en"),
                'languages' => Cetabo_SGMHelper::config("languages")
            ));
        }


        /**
         * Handle map export
         * @param $id
         */
        function export_map($id)
        {
            
            $export = Cetabo_SGMExport_Helper::instance()->export($id);
            $this->render('export', array(
                'success' => Cetabo_SGMHelper::arr_get($export, 'success'),
                'url' => Cetabo_SGMHelper::arr_get($export, 'url'),
                'name' => Cetabo_SGMHelper::arr_get($export, 'name'),
            ));
            

        }

        /**
         * Handle map import
         */
        function import_map()
        {
            
            if (Cetabo_SGMImport_Helper::instance()->has_started()) {
                $report = Cetabo_SGMImport_Helper::instance()->import();
            } else {
                $report = null;
            }

            $this->render('import', array(
                'action' => Cetabo_SGMHelper::action_url('import'),
                'report' => $report,
            ));
            
        }

        /**
         * Save map
         */
        function persist_map()
        {
            $success = Cetabo_SGMDataProvider::instance()->persist_map($_POST);
            echo json_encode(array('success' => $success));
            die();
        }


        /**
         * Handle map clone
         */
        function clone_map()
        {
            
            $success = Cetabo_SGMDataProvider::instance()->clone_map($_POST);
            echo json_encode(array('success' => $success));
            die();
            
        }


        /**
         * Get all themes
         */
        function get_themes()
        {
            $themes = Cetabo_SGMTheme_Helper::instance()->get_available_themes();
            echo json_encode(array('themes' => $themes));
            die();
        }


        /**
         * Save theme ajax
         */
        function persist_theme()
        {
            
            $theme_name = 'Theme-' . date('m-d-Y-H') + rand(1, 10000000);
            $file = plugin_dir_path(Cetabo_SGMRegistry::get('__FILE__')) . "theme/{$theme_name}.json";
            $theme_content = Cetabo_SGMHelper::arr_get($_POST, 'theme');
            $success = Cetabo_SGMTheme_Helper::instance()->persist_theme($file, $theme_content);
            echo json_encode(array('success' => $success, 'theme_name' => $theme_name));
            die();
            
        }


        /**
         * Map AJAX load
         */
        function load_map()
        {
            $id = Cetabo_SGMHelper::arr_get($_REQUEST, 'id');
            $data = array(
                'return' => menu_page_url(Cetabo_SGMRegistry::get('PLUGIN_SLUG'), false),
                'map' => Cetabo_SGMDataProvider::instance()->load_map($id),
            );
            echo json_encode($data);
            die();
        }

        /**
         * Delete map
         */
        function delete_map()
        {
            $id = Cetabo_SGMHelper::arr_get($_REQUEST, 'id');
            $success = Cetabo_SGMDataProvider::instance()->delete_map($id);
            echo json_encode(array('success' => $success));
            die();
        }

        /**
         * Edit map
         */
        function edit_map($id, $readonly)
        {
            $map_name = Cetabo_SGMDataProvider::instance()->load_map_name($id);


            $this->render((!$readonly) ? 'edit' : 'view', array(
                'id' => $id,
                'map_name' => $map_name,
                'readonly' => $readonly,
                'url' => array(
                    'save' => Cetabo_SGMHelper::ajax_action_url('persist'),
                    'themes' => Cetabo_SGMHelper::ajax_action_url('themes'),
                    'persist_theme' => Cetabo_SGMHelper::ajax_action_url('persist_theme'),
                    'clone' => Cetabo_SGMHelper::ajax_action_url('clone'),
                    'load' => Cetabo_SGMHelper::ajax_action_url('load'),
                    'back' => Cetabo_SGMHelper::action_url(''),
                    'edit' => Cetabo_SGMHelper::action_url("edit") . "&id={$id}",
                    'export' => Cetabo_SGMHelper::action_url('export&id=' . $id)
                )));
        }

        /**
         * Display map list
         */
        function list_maps()
        {
            $edit_url = Cetabo_SGMHelper::action_url('edit');
            //Create an instance of our package class...
            $map_list_table = new Cetabo_SGMMap_List_Table();
            //Fetch, prepare, sort, and filter our data...
            $map_list_table->prepare_items();
            $this->render('list', array(
                'map_list_table' => $map_list_table
            ));
        }

        /**
         * Register scripts common to admin adn frontend
         */
        private function register_core_scripts_and_styles()
        {
            $language = Cetabo_SGMDataProvider::instance()->read_preference('language');
            Cetabo_SGMResourceLoader::instance()->load_js('https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&language=' . $language, false);
            $lib_bundle = Cetabo_SGMHelper::config('core-lib');
            Cetabo_SGMResourceLoader::instance()->load_js_bundle($lib_bundle);


            //If debug mode use full scripts
            if (Cetabo_SGMRegistry::get('PLUGIN_DEBUG_MODE')) {
                $core_bundle = Cetabo_SGMHelper::config('core');
            } else {
                $core_bundle = array('media/scripts/core.app.min.js');
            }
            Cetabo_SGMResourceLoader::instance()->load_js_bundle($core_bundle);
        }

        private function is_plugin_admin_page()
        {
            return Cetabo_SGMRegistry::get('PLUGIN_SLUG') == Cetabo_SGMHelper::arr_get($_GET, 'page');
        }

        /**
         * Register admin scripts
         */
        private function register_admin_scripts_and_styles()
        {

            if (!$this->is_plugin_admin_page()) {
                return;
            }

            wp_enqueue_media();

            $lib_bundle = Cetabo_SGMHelper::config('admin-lib');
            Cetabo_SGMResourceLoader::instance()->load_js_bundle($lib_bundle);

            //If debug mode use full scripts
            if (Cetabo_SGMRegistry::get('PLUGIN_DEBUG_MODE')) {
                $core_bundle = Cetabo_SGMHelper::config('admin');
            } else {
                $core_bundle = array('media/scripts/admin.app.min.js');
            }
            Cetabo_SGMResourceLoader::instance()->load_js_bundle($core_bundle);


            $css_bundle = Cetabo_SGMHelper::config('admin-css');
            Cetabo_SGMResourceLoader::instance()->load_css_bundle($css_bundle);
        }

        /**
         * Register frontend scripts
         */
        private function register_frontend_scripts_and_styles()
        {
            $css_bundle = Cetabo_SGMHelper::config('core-css');
            Cetabo_SGMResourceLoader::instance()->load_css_bundle($css_bundle);
        }

        /**
         * Registers and enqueues stylesheets for the administration panel and the
         * public facing site.
         */
        private function register_scripts_and_styles()
        {
            if (is_admin()) {
                if (!$this->is_plugin_admin_page()) {
                    return;
                }
                $this->register_core_scripts_and_styles();
                $this->register_admin_scripts_and_styles();

            } else {
                $this->register_core_scripts_and_styles();
                $this->register_frontend_scripts_and_styles();

            }
        }

    }
}

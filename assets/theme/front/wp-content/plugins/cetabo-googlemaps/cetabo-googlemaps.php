<?php
/*
  Plugin Name: Simplified Google Maps
  Plugin URI: http://cmap.cetabo.com
  Description: A plugin to create awesome google maps
  Version: 2.0.1
  Author: cetabo
  Author Email: contact@cetabo.com
  License: Commercial

 */


require_once(plugin_dir_path(__FILE__) . 'class/cetabo-googlemaps-plugin.php');

Cetabo_SGMRegistry::put('PLUGIN_URL', plugin_dir_url(__FILE__));
Cetabo_SGMRegistry::put('PLUGIN_DIR', plugin_dir_path(__FILE__));
Cetabo_SGMRegistry::put('PLUGIN_SLUG', 'cetabo_googlemaps');

Cetabo_SGMRegistry::put('PLUGIN_NAME', 'Simplified Google Maps');
Cetabo_SGMRegistry::put('PLUGIN_PAGE', 'http://cmap.cetabo.com');
Cetabo_SGMRegistry::put('PLUGIN_AUTHOR_NAME', 'cetabo');
Cetabo_SGMRegistry::put('PLUGIN_AUTHOR_URL', 'http://cetabo.com');

Cetabo_SGMRegistry::put('__FILE__', __FILE__);

Cetabo_SGMRegistry::put('PLUGIN_DEBUG_MODE', false);
Cetabo_SGMRegistry::put('PLUGIN_VERSION', '2.0.2');

//Instantiate plugin
new Cetabo_SGMGoogleMapsPlugin();

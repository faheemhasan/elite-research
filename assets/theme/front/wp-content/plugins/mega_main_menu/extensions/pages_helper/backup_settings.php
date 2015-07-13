<?php
/**
 * @package MegaMain
 * @subpackage MegaMain
 * @since mm 1.0
 */
	
	/* 
	 * Functions get array of the all setting from DB and create file to download.
	 */
	global $mega_main_menu;
	if ( isset( $_GET[ $mega_main_menu->constant[ 'MM_WARE_PREFIX' ] . '_page' ] ) && !empty( $_GET[ $mega_main_menu->constant[ 'MM_WARE_PREFIX' ] . '_page' ] ) ) {
		if ( $_GET[ $mega_main_menu->constant[ 'MM_WARE_PREFIX' ] . '_page' ] == 'backup_file' ) {
			// Urge file to download instead of opening in the browser window.
			header('Content-type: application/txt');
			header('Content-Disposition: attachment; filename="mega-main-menu-backup-' . date("Y-m-d-H-i") . '.txt"');
			$enc = json_encode( $mega_main_menu->saved_options );
			echo $enc;
			die();
		}
	}

	/* 
	 * Functions restore backup data.
	 */
	if ( !function_exists( 'mmm_options_backup' ) ) {
		function mmm_options_backup() {
			global $mega_main_menu;
			if ( isset( $_FILES[ $mega_main_menu->constant[ 'MM_OPTIONS_NAME' ] . '_backup' ] ) && $_FILES[ $mega_main_menu->constant[ 'MM_OPTIONS_NAME' ] . '_backup' ]['error'] == 0 ) {
				$backup_file_content = mm_common::get_uri_content( $_FILES[ $mega_main_menu->constant[ 'MM_OPTIONS_NAME' ] . '_backup' ]['tmp_name'] );
				if ( $backup_file_content !== false && ( $options_backup = json_decode( $backup_file_content, true ) ) ) {
					if ( isset( $options_backup['last_modified'] ) ) {
						$options_backup['last_modified'] = time() + 30;
						update_option( $mega_main_menu->constant[ 'MM_OPTIONS_NAME' ], $options_backup );
					}
				}
			}
		}
	}
	add_action( 'updated_option', 'mmm_options_backup', 20 );
?>
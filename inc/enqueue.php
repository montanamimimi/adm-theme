<?php 

namespace MimimiAdm;

class Scripts {

    public static function init() {      
        add_action('wp_enqueue_scripts', [__CLASS__, 'enqueue_assets']);
    }

    public static function enqueue_assets() {
        $themePath = get_template_directory_uri();
        $version = wp_get_theme()->get('Version');

		wp_enqueue_style(
			'mimimiadm__fonts',
			"{$themePath}/fonts/fonts.css",
			[],
			$version
		);
        
        wp_enqueue_style(
			'mimimiadm__styles',
			"{$themePath}/build/index.css",
			['mimimiadm__fonts'],
			$version
		);

		wp_enqueue_script(
			'mimimiadm__scripts',
			"{$themePath}/build/index.js",
			[],
			$version,
			true
		);      
		
		wp_localize_script(
			'mimimiadm__scripts', 'ajax_object', [
			'ajax_url' => admin_url('admin-ajax.php'),
			'root_url' => get_site_url(),
		]);				

    }
}

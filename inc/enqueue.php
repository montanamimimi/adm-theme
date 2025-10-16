<?php 

namespace MyTheme;

class Scripts {

    public static function init() {      
        add_action('wp_enqueue_scripts', [__CLASS__, 'enqueue_assets']);
    }

    public static function enqueue_assets() {
        $themePath = get_template_directory_uri();
        $version = wp_get_theme()->get('Version');

		wp_enqueue_style(
			'mytheme__fonts',
			"{$themePath}/fonts/fonts.css",
			[],
			$version
		);
        
        wp_enqueue_style(
			'mytheme__styles',
			"{$themePath}/build/index.css",
			['mytheme__fonts'],
			$version
		);

		wp_enqueue_script(
			'mytheme__scripts',
			"{$themePath}/build/index.js",
			[],
			$version,
			true
		);        

    }
}

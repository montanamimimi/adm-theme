<?php

namespace MimimiAdm;

class Setup {
    public static function init() {      
        // If you don't neew admin bar on front 
        show_admin_bar(false);
        add_action('admin_init', [__CLASS__, 'redirects']);
        add_action( 'init', [ __CLASS__, 'settingsPage' ] );
    }

    public static function redirects() {
        if (current_user_can('subscriber') && !defined('DOING_AJAX')) {
            global $pagenow;
            if ($pagenow !== 'admin-post.php') {
                wp_redirect(home_url());
                exit;
            }

        }
    }

    public static function settingsPage() {
		if( function_exists('acf_add_options_page')) {
			acf_add_options_page([
				'page_title' => 'Customize',
				'menu_title' => 'Customize',
				'menu_slug' => 'theme-settings',
				'capability' => 'publish_pages',
				'redirect' => false
			]);

			// acf_add_options_sub_page(array(
			// 	'page_title'    => 'Calculator fields',
			// 	'menu_title'    => 'Calculator',
			// 	'parent_slug'   => 'theme-settings',
			// ));
						
		}

    }
}
<?php

namespace MimimiAdm;

class Register {
    public static function init() {      
        add_action('admin_post_nopriv_registeruser', [__CLASS__, 'register_user']);        
        add_action('admin_post_nopriv_loginuser', [__CLASS__, 'login_user']);                 
    }
    
    public static function login_user() {
        if (!isset($_POST['email'], $_POST['password'])) {
            wp_die('Missing fields');
        }

        $email = sanitize_text_field($_POST['email']);

        $creds = [
            'user_login'    => $email,
            'user_password' => $_POST['password'],
            'remember'      => true,
        ];        

        $user = wp_signon($creds, false);

        if (is_wp_error($user)) {
            wp_redirect(home_url('/login/?fail=' . "Что-то определенно пошло не так." . "&email=" . $email));
            exit;
        }

        wp_redirect(home_url()); // redirect after login
        exit;

    }

    public static function register_user() {

        if (!isset($_POST['name'], $_POST['email'], $_POST['password'], $_POST['password_ok'])) {
            wp_die('Missing fields');
        }

        $username = sanitize_user($_POST['name']);
        $email = sanitize_email($_POST['email']);
        $password = $_POST['password'];

        $user = get_user_by('email', $email);

        if ($user) {
            wp_redirect(home_url('/login?email=' . $email));
            exit;
        } else {
            // Create user
            $user_id = wp_create_user($username, $password, $email);
            if (is_wp_error($user_id)) {
                wp_redirect(home_url('/register/?error=' . urlencode($user_id->get_error_message())));
                exit;
            }

            // Optional: log in user automatically
            // wp_set_current_user($user_id);
            // wp_set_auth_cookie($user_id);

            // Redirect after success
            wp_redirect(home_url('/thank-you/'));
            exit;
        }



       
    }


}
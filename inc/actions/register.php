<?php

namespace MimimiAdm;

class Register {
    public static function init() {      
        add_action('admin_post_nopriv_registeruser', [__CLASS__, 'register_user']);        
        add_action('admin_post_nopriv_loginuser', [__CLASS__, 'login_user']);  
        add_action('admin_post_nopriv_forgotpass', [__CLASS__, 'forgot_pass']);       
        add_action('admin_post_nopriv_changepass', [__CLASS__, 'change_pass']);               
        add_action('admin_post_edituser', [__CLASS__, 'edit_user']);        
        add_filter('retrieve_password_message', [__CLASS__, 'retrieve_password'], 10, 4);                  
    }

    public static function change_pass() {
        $login = sanitize_text_field($_POST['login']);
        $key = sanitize_text_field($_POST['key']);

        $user = check_password_reset_key($key, $login);

        if ($user) {
            $password = $_POST['password'];
            reset_password($user, $password);

            wp_set_current_user($user->ID);
            wp_set_auth_cookie($user->ID);
            do_action( 'wp_login', $user->user_login, $user );

            // Redirect after success
            wp_redirect(home_url('/profile/'));
            exit;
        } else {
            wp_redirect(home_url('/login/'));
            exit;
        }
    }

    public static function retrieve_password($message, $key, $user_login, $user_data) {
            $reset_url = site_url('/reset-password/') . '?key=' . $key . '&login=' . rawurlencode($user_login);
            $message = "Hi!\n\nClick the link below to reset your password:\n\n$reset_url\n\nIf you didn’t request it, ignore this email.";
            return $message;
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
            $error_code = $user->get_error_code();

            switch ($error_code) {
                case 'incorrect_password':
                    wp_redirect(home_url('/login/?error=Неверный пароль' . "&email=" . $email));
                    break;
                default:
                    wp_redirect(home_url('/login/?error=' . urlencode($user->get_error_message()) . "&email=" . $email));
                    break;
            }            
            
            exit;
        }

        wp_redirect(home_url()); 
        exit;

    }

    public static function register_user() {

        if (!isset($_POST['name'], $_POST['email'], $_POST['password'], $_POST['password_ok'])) {
            wp_die('Missing fields');
        }

        $name = sanitize_user($_POST['name']);
        $email = sanitize_email($_POST['email']);
        $password = $_POST['password'];

        $username = sanitize_username_cyrillic($name);

        $user = get_user_by('email', $email);

        if ($user) {
            wp_redirect(home_url('/login?email=' . $email . '&message="Такой email уже зарегистрирован, войдите"'));
            exit;
        } else {
           
            $user_id = wp_create_user($username, $password, $email);
            if (is_wp_error($user_id)) {
                wp_redirect(home_url('/register/?error=' . urlencode($user_id->get_error_message())));
                exit;
            }

            mimiadm_assign_random_avatar($user_id);

            wp_update_user([
                'ID' => $user_id,
                'display_name' => $name,                
            ]);    

            update_field('wishlist', " -- !заполните пожелания! -- ", 'user_' . $user_id);

            wp_set_current_user($user_id);
            wp_set_auth_cookie($user_id);
            $user = get_user_by( 'id', $user_id );
            do_action( 'wp_login', $user->user_login, $user );

            // Redirect after success
            wp_redirect(home_url('/profile/'));
            exit;
        }
    }


    public static function edit_user() {        
                
        $name = sanitize_text_field($_POST['name']);
        $wishlist = sanitize_text_field($_POST['wishlist']);
        $avatar = (int) $_POST['image_id'];     
        
        $uid = get_current_user_id();        

        mimiadm_assign_user_avatar($uid, $avatar);

        update_field('wishlist', $wishlist, 'user_' . $uid);
        wp_update_user([
            'ID' => $uid,
            'display_name' => $name,
        ]);                

        wp_redirect(home_url("/profile/")); 
        exit;

    }    

    public static function forgot_pass() {
        $email = sanitize_email($_POST['email']);
        $user = get_user_by_email($email);

     //  var_dump($user);

        if (!$user) {
            wp_redirect(home_url("/forgot-pass/?error=Нет такого пользователя" . "&email=" . $email)); 
        } else {
            retrieve_password($email);
            wp_redirect(home_url("/login/?error=Ждите письма" . "&email=" . $email)); 
        }
    }

}
<?php

namespace MimimiAdm;

class Register {
    public static function init() {      
        add_action('admin_post_nopriv_registeruser', [__CLASS__, 'register_user']);        
        add_action('admin_post_nopriv_loginuser', [__CLASS__, 'login_user']);             
        add_action('admin_post_edituser', [__CLASS__, 'edit_user']);               
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

        wp_redirect(home_url()); 
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
           
            $user_id = wp_create_user($username, $password, $email);
            if (is_wp_error($user_id)) {
                wp_redirect(home_url('/register/?error=' . urlencode($user_id->get_error_message())));
                exit;
            }

            mimiadm_assign_random_avatar($user_id);

            update_field('wishlist', " -- !заполните пожелания! -- ", 'user_' . $user_id);

            wp_set_current_user($user_id);
            wp_set_auth_cookie($user_id);

            // Redirect after success
            wp_redirect(home_url('/profile/'));
            exit;
        }
    }


    public static function edit_user() {        
        
        error_log('TTTTTT');
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


}
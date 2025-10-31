<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset') ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?php echo get_theme_file_uri(); ?>/assets/favicon/favicon.ico" sizes="any">
    <link rel="icon" type="image/png" href="<?php echo get_theme_file_uri(); ?>/assets/favicon/favicon-96x96.png" sizes="96x96">
    <link rel="apple-touch-icon" href="<?php echo get_theme_file_uri(); ?>/assets/favicon/apple-touch-icon.png">
    <title><?php bloginfo('name') ?></title>
    <?php wp_head(); ?> 
</head>
<body <?php body_class(); ?>>
    <header class="header">
        <div class="container header__container">
            <div class="logo">
                <a href="<?php echo site_url(); ?>">
                    <img src="<?php echo get_theme_file_uri() . '/assets/images/logo.png'; ?>" alt="Happy New Year!">
                </a>
            </div>
            <nav class="header__menu">
                <ul>
                    <?php 
                    
                    if ( is_user_logged_in() ) { ?>
                        <a class="header__menu--item" href="<?php echo wp_logout_url( home_url() ); ?>&_wpnonce=<?php echo wp_create_nonce('log-out'); ?>"><li>Выход</li></a>
                        <a class="header__menu--item" href="<?php echo site_url() . '/profile'; ?>">
                            <img class="header__avatar" src="<?php echo mimiadm_get_user_avatar_url(false, 'thumbnail'); ?>" alt="Профиль">
                        </a>
                    <?php } else { ?>
                        <a class="header__menu--item" href="<?php echo site_url() . '/login'; ?>"><li>Вход</li></a>
                        <a class="header__menu--item" href="<?php echo site_url() . '/register'; ?>"><li class="btn btn--white btn--middle">Регистрация</li></a>      
                    <?php }
                    
                    ?>
              
                </ul>
            </nav>
        </div>

    </header>
    <main>


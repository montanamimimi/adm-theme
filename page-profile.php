<?php if ( !is_user_logged_in() )  { wp_redirect(home_url()); } ?>

<?php get_header(); ?>

<?php $current_user = wp_get_current_user(); ?>

    <section class="profile" style="background-image:url(<?php echo get_theme_file_uri() . '/assets/images/BG5.png'; ?>)">        
        <div class="container profile__container">
            <h1><?php the_title(); ?></h1>            
            <div class="profile__info">
                <div class="profile__picture">
                    <img class="profile__img" src="<?php echo mimiadm_get_user_avatar_url($current_user->ID); ?>" alt="">
                    
                </div>
                <div class="profile__data">
                    <div class="profile__item">
                        <h2>Имя:</h2>
                        <p><?php echo $current_user->display_name; ?></p>
                    </div>
                    <div class="profile__item">
                        <h2>email:</h2>
                        <p><?php echo $current_user->user_email; ?></p>
                    </div>
                    <div class="profile__item">
                        <h2>Пожелания к подарку:</h2>
                        <p><?php echo get_field('wishlist', 'user_' . $current_user->ID); ?></p>    
                    </div>                    
                    <div class="profile__item">
                        <a href="<?php echo site_url() . "/edit"; ?>" class="btn btn--green btn--middle">Редактировать</a>
                    </div> 
                </div>
            </div>      
           
        </div>
    </section>
<?php get_footer(); ?>
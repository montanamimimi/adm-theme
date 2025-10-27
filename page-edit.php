<?php if ( !is_user_logged_in() )  { wp_redirect(home_url()); } ?>

<?php get_header(); ?>

<?php 
$current_user = wp_get_current_user(); 
$avatars = mimiadm_get_available_avatars($current_user->ID); 
?>

    <section class="profile-edit" style="background-image:url(<?php echo get_theme_file_uri() . '/assets/images/BG5.png'; ?>)">        
        <div class="container">
            <h1><?php the_title(); ?></h1>            
            <form id="editForm" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="POST">
                <input type="hidden" name="action" value="edituser">
                <input type="hidden" id="avatarId" name="image_id" value="<?php echo mimiadm_get_user_avatar_id($current_user->ID); ?>">
                <div class="profile__picture">
                    <div id="profilePictureEditor" class="profile__avatar">
                        <img class="profile__img" src="<?php echo mimiadm_get_user_avatar_url($current_user->ID, 'thumbnail'); ?>" alt="">   
                    </div>     
                    <div class="profile__avatars" id="availableAvatars">
                        <?php                  
                        foreach ($avatars as $item) { 
                            echo '<div class="profile__image"><img class="profile__img" src="' . $item['url'] . '" alt="" data-id="' . $item['image'] .'"></div>';
                        } 
                        ?>
                    </div>                          
                </div>
                
                <div class="profile__item">
                    <h2>Имя:</h2>
                    <input 
                        class="input input--middle input--green input--bald input--rounded" 
                        type="text" 
                        id="name" 
                        name="name" 
                        value="<?php echo $current_user->display_name; ?>"
                    >                        
                </div>
                <div class="profile__item">
                    <h2>email:</h2>
                    <p><?php echo $current_user->user_email; ?> - это уже не исправить =)</p> 
                </div>
                <div class="profile__item">
                    <h2>Пожелания к подарку:</h2>
                    <textarea name="wishlist" id="wishlist" rows="4" cols="50"><?php echo get_field('wishlist', 'user_' . $current_user->ID); ?></textarea>
                
                </div>                    
                <div class="profile__item">
                    <button class="btn btn--green btn--middle" type="submit">Сохранить</button>
                </div> 
                
            </form>
                
           
        </div>
    </section>
<?php get_footer(); ?>
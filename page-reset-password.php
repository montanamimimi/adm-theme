<?php if ( is_user_logged_in() )  { wp_redirect(home_url()); } ?>

<?php get_header(); ?>

<?php 
$error = false;
$user = check_password_reset_key($_GET['key'] ?? '', $_GET['login'] ?? '');
if (is_wp_error($user)) {
    $error = 'Неверная ссылка для восстановления пароля';    
} 

?>
    <section class="register" style="background-image:url(<?php echo get_theme_file_uri() . '/assets/images/BG4.jpg'; ?>)">        
        <div class="container register__container">
            <h1><?php the_title(); ?></h1>
            <div class="register__error">          
                <?php echo $error ? $error : ""; ?>
            </div>
            <?php if (!$error) { ?>
                <form id="resetForm" class="register__form" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="POST">
                    <input type="hidden" name="action" value="changepass">
                    <input type="hidden" name="login" value="<?php echo $_GET['login']; ?>">
                    <input type="hidden" name="key" value="<?php echo $_GET['key']; ?>">
                    <input class="input input--green input--large" type="password" id="password" name="password" placeholder="Пароль">
                    <input class="input input--green input--large" type="password" id="password_ok" name="password_ok" placeholder="Повторите пароль">                                        
                    <button class="btn btn--large btn--green">Установить пароль</button>
                </form>
            <?php } ?>

        </div>
    </section>
<?php get_footer(); ?>
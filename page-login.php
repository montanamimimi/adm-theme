<?php if ( is_user_logged_in() )  { wp_redirect(home_url()); } ?>

<?php get_header(); ?>

<?php 

$email = isset($_GET['email']) ? $_GET['email'] : "";
$error = false;

if (isset($_SERVER['QUERY_STRING'])) {
    parse_str($_SERVER['QUERY_STRING'], $query);
    if (isset($query['error'])) {
        $error = $query['error'];
    }
}

?>
    <section class="register" style="background-image:url(<?php echo get_theme_file_uri() . '/assets/images/BG4.jpg'; ?>)">        
        <div class="container register__container">
            <h1><?php the_title(); ?></h1>
            <div class="register__error">
                <?php echo $error ? $error : ""; ?>
                <?php echo $_GET['message'] ? $_GET['message'] : "" ?>
            </div>
            <form id="loginForm" class="register__form" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="POST">
                <input type="hidden" name="action" value="loginuser">
                <input class="input input--green input--large" type="email" id="email" name="email" placeholder="email" value="<?php echo $email; ?>">
                <input class="input input--green input--large" type="password" id="password" name="password" placeholder="Пароль">     
                <a class="link link--green" href="<?php echo site_url() . '/forgot-password/'; ?>">Забыли пароль?</a>           
                <button class="btn btn--large btn--green">Войтить</button>
            </form>
        </div>
    </section>
<?php get_footer(); ?>
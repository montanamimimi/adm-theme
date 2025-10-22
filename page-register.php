<?php if ( is_user_logged_in() )  { wp_redirect(home_url()); } ?>
<?php get_header(); ?>
    <section class="register" style="background-image:url(<?php echo get_theme_file_uri() . '/assets/images/BG4.jpg'; ?>)">
        <div class="container register__container">
            <h1>Регистрация</h1>
            <div class="register__error"></div>
            <form id="registerForm" class="register__form" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="POST">
                <input type="hidden" name="action" value="registeruser">
                <input class="input input--green input--large" type="text" id="name" name="name" placeholder="Ваше имя">
                <input class="input input--green input--large" type="email" id="email" name="email" placeholder="email">
                <input class="input input--green input--large" type="password" id="password" name="password" placeholder="Пароль">
                <input class="input input--green input--large" type="password" id="password_ok" name="password_ok" placeholder="Повторите пароль">
                <button class="btn btn--large btn--green">Йей погнали!</button>
            </form>
        </div>
    </section>
<?php get_footer(); ?>
<?php get_header(); ?>
<?php $santas = mimiadm_get_all_santas(); ?>
    <section class="banner" style="background-image:url(<?php echo get_theme_file_uri() . '/assets/images/background.jpg'; ?>)">
        <div class="container banner__container">

            <div class="banner__text">
                <h1>Пора врываться в Новый Год!</h1>
                <p>Будем дарить друг другу подарки и получать от этого безграничное удовольствие.</p>
            </div>
            <div class="banner__image">
                <img src="<?php echo get_theme_file_uri() . '/assets/images/Santa.png'; ?>" alt="">
            </div>
        </div>
    </section>
    <section class="article">
        <div class="container article__container">
            <div class="article__image">
                <img src="<?php echo get_theme_file_uri() . '/assets/images/Tree.png'; ?>" alt="">
            </div>

            <div class="article__text">
                <h2>Кто уже в деле:</h2>
                <div class="article__santas">
                    <?php 

                    if (count($santas) == 0) {
                        echo "Пока никого тут нет, совсем!";
                    }
                    
                    foreach ($santas  as $santa) { ?>

                        <div class="article__santa">
                            <div class="article__santa--image">
                                <img src="<?php echo mimiadm_get_user_avatar_url($santa->ID, 'thumbnail'); ?>" alt="">
                            </div>
                            <div class="article__santa--name">
                                <?php echo $santa->display_name; ?>
                            </div>
                        </div>

                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
<?php get_footer(); ?>
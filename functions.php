<?php 

require get_template_directory() . '/inc/setup.php';
require get_template_directory() . '/inc/enqueue.php';
require get_template_directory() . '/inc/helpers.php';
require get_template_directory() . '/inc/actions/register.php';


MimimiAdm\Scripts::init();
MimimiAdm\Setup::init();
MimimiAdm\Register::init();
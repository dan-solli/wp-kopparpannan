<!DOCTYPE html>
<html <?php language_attributes(); ?> >
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php wp_head(); ?>
</head>

<body <?php body_class('ui container'); ?>>
    <div class="grid-container">
        <header class="grid-header">
            <h1 class="ui header">
                <?php if (function_exists('the_custom_logo')) {
                    the_custom_logo();
                } ?>
                <div class="content">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                        <?php bloginfo( 'name' ); ?>
                    </a>
                </div>
            </h1>
<!--
            <h1 class="ui header">
                <img src="logo1.png"> 
                <div class="content">
                    Kopparpannans Whiskyklubb
                    <div class="sub header">Est. 2009</div>
                </div>
            </h1>
-->
<!-- Handle menu here. -->
<?php clean_custom_menu('header-menu') ?>

        </header>

    <?php get_sidebar('left'); ?>

    <main class="grid-main ui divided items">

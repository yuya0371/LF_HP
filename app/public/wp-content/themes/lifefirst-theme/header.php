<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
    <div class="container header-inner">
        <div class="site-logo">
            <?php lifefirst_the_custom_logo(); ?>
        </div>

        <nav class="global-nav">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'global-nav',
                'container'      => false,
                'menu_class'     => 'nav-list',
                'fallback_cb'    => 'lifefirst_fallback_menu',
            ));
            ?>
        </nav>

        <button class="menu-toggle" aria-label="メニューを開く" aria-expanded="false">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>
</header>

<nav class="mobile-nav" aria-hidden="true">
    <?php
    wp_nav_menu(array(
        'theme_location' => 'global-nav',
        'container'      => false,
        'menu_class'     => 'mobile-nav-list',
        'fallback_cb'    => 'lifefirst_fallback_menu_mobile',
    ));
    ?>
</nav>

<main class="site-main">

<?php
/**
 * Fallback menu for global nav
 */
function lifefirst_fallback_menu() {
    ?>
    <ul class="nav-list">
        <li><a href="<?php echo esc_url(home_url('/company/')); ?>">会社概要</a></li>
        <li><a href="<?php echo esc_url(home_url('/service/')); ?>">事業内容</a></li>
        <li><a href="<?php echo esc_url(home_url('/recruit/')); ?>">採用</a></li>
        <li><a href="<?php echo esc_url(home_url('/privacy/')); ?>">プライバシーポリシー</a></li>
    </ul>
    <?php
}

/**
 * Fallback menu for mobile nav
 */
function lifefirst_fallback_menu_mobile() {
    ?>
    <ul class="mobile-nav-list">
        <li><a href="<?php echo esc_url(home_url('/company/')); ?>">会社概要</a></li>
        <li><a href="<?php echo esc_url(home_url('/service/')); ?>">事業内容</a></li>
        <li><a href="<?php echo esc_url(home_url('/recruit/')); ?>">採用</a></li>
        <li><a href="<?php echo esc_url(home_url('/privacy/')); ?>">プライバシーポリシー</a></li>
    </ul>
    <?php
}
?>

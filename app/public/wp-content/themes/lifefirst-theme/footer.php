</main>

<footer class="site-footer">
    <div class="container">
        <nav class="footer-nav">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'footer-nav',
                'container'      => false,
                'menu_class'     => '',
                'items_wrap'     => '%3$s',
                'fallback_cb'    => 'lifefirst_fallback_footer_menu',
            ));
            ?>
        </nav>
        <p class="copyright">&copy; 2025 <?php echo esc_html(lifefirst_get_company_info('name')); ?></p>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>

<?php
/**
 * Fallback menu for footer nav
 */
function lifefirst_fallback_footer_menu() {
    ?>
    <a href="<?php echo esc_url(home_url('/company/')); ?>">会社概要</a>
    <a href="<?php echo esc_url(home_url('/service/')); ?>">事業内容</a>
    <a href="<?php echo esc_url(home_url('/recruit/')); ?>">採用</a>
    <a href="<?php echo esc_url(home_url('/privacy/')); ?>">プライバシーポリシー</a>
    <?php
}
?>

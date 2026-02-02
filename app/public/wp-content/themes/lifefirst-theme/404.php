<?php
/**
 * 404 Template
 *
 * @package LifeFirst
 */

get_header();
?>

<div class="error-404">
    <div class="container">
        <h1>404</h1>
        <p>お探しのページが見つかりませんでした。</p>
        <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">トップページへ戻る</a>
    </div>
</div>

<?php
get_footer();

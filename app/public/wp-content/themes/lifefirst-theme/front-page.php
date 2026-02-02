<?php
/**
 * Front Page Template
 *
 * @package LifeFirst
 */

get_header();

$firstview_type = lifefirst_get_firstview_type();
$tagline = get_theme_mod('firstview_tagline', '清掃を通じて暮らしを整えるサービスを提供。');
$company_name = lifefirst_get_company_info('name');

// 背景画像
$firstview_bg = get_theme_mod('firstview_bg_image', '');
$firstview_overlay = get_theme_mod('firstview_overlay', true);

// 事業カード画像
$service_cleaning_image = get_theme_mod('service_cleaning_image', '');
$service_kaitori_image = get_theme_mod('service_kaitori_image', '');
$service_minpaku_image = get_theme_mod('service_minpaku_image', '');

// 背景画像のスタイル
$bg_style = '';
if ($firstview_bg) {
    $bg_style = 'background-image: url(' . esc_url($firstview_bg) . '); background-size: cover; background-position: center;';
}
?>

<!-- First View -->
<section class="first-view first-view--<?php echo esc_attr($firstview_type); ?><?php echo $firstview_bg && $firstview_overlay ? ' has-overlay' : ''; ?>" style="<?php echo esc_attr($bg_style); ?>">
    <div class="first-view-content">
        <?php if ($firstview_type === 'type-a') : ?>
            <!-- 案A：法人名ドン -->
            <h1><?php echo esc_html($company_name); ?></h1>
            <p class="tagline"><?php echo esc_html($tagline); ?></p>
            <div class="btn-group">
                <a href="<?php echo esc_url(home_url('/company/')); ?>" class="btn btn-primary">会社概要へ</a>
                <a href="<?php echo esc_url(home_url('/service/')); ?>" class="btn btn-outline">事業内容へ</a>
            </div>

        <?php elseif ($firstview_type === 'type-b') : ?>
            <!-- 案B：事業ドン -->
            <h1>ハウスクリーニング<br><span style="font-size: 0.6em;">（お掃除本舗FC）</span></h1>
            <p class="tagline"><?php echo esc_html($tagline); ?></p>
            <div class="btn-group">
                <a href="<?php echo esc_url(home_url('/service/')); ?>" class="btn btn-primary">事業内容へ</a>
                <a href="<?php echo esc_url(home_url('/company/')); ?>" class="btn btn-outline">会社概要へ</a>
            </div>

        <?php else : ?>
            <!-- 案C：超シンプル -->
            <h1><?php echo esc_html($company_name); ?></h1>
            <?php if (has_custom_logo()) : ?>
                <div class="logo-large">
                    <?php the_custom_logo(); ?>
                </div>
            <?php endif; ?>

        <?php endif; ?>
    </div>
</section>

<!-- 事業紹介セクション -->
<section class="section section-alt">
    <div class="container">
        <h2 class="section-title">事業内容</h2>
        <div class="service-cards">
            <div class="service-card">
                <?php if ($service_cleaning_image) : ?>
                    <div class="service-card-image">
                        <img src="<?php echo esc_url($service_cleaning_image); ?>" alt="ハウスクリーニング事業">
                    </div>
                <?php endif; ?>
                <h3>ハウスクリーニング事業</h3>
                <p>お掃除本舗フランチャイズ加盟店として、一般家庭・法人向けの清掃サービスを提供しています。</p>
                <span class="status-badge status-badge--active">提供中</span>
            </div>
            <div class="service-card">
                <?php if ($service_kaitori_image) : ?>
                    <div class="service-card-image">
                        <img src="<?php echo esc_url($service_kaitori_image); ?>" alt="中古品買取サービス">
                    </div>
                <?php endif; ?>
                <h3>中古品買取サービス</h3>
                <p>出張買取を中心とした中古品買取サービスを準備中です。</p>
                <span class="status-badge status-badge--preparing">準備中</span>
            </div>
            <div class="service-card">
                <?php if ($service_minpaku_image) : ?>
                    <div class="service-card-image">
                        <img src="<?php echo esc_url($service_minpaku_image); ?>" alt="住宅宿泊（民泊）事業">
                    </div>
                <?php endif; ?>
                <h3>住宅宿泊（民泊）事業</h3>
                <p>住宅宿泊事業（民泊）のサービス提供を準備中です。</p>
                <span class="status-badge status-badge--preparing">準備中</span>
            </div>
        </div>
        <div class="section-more">
            <a href="<?php echo esc_url(home_url('/service/')); ?>" class="btn btn-primary">事業内容の詳細へ</a>
        </div>
    </div>
</section>

<!-- 会社紹介セクション -->
<section class="section">
    <div class="container">
        <h2 class="section-title">会社概要</h2>
        <div class="company-summary">
            <h3><?php echo esc_html($company_name); ?></h3>
            <dl>
                <dt>代表</dt>
                <dd><?php echo esc_html(lifefirst_get_company_info('representative')); ?></dd>
                <dt>設立</dt>
                <dd><?php echo esc_html(lifefirst_get_company_info('established')); ?></dd>
            </dl>
            <a href="<?php echo esc_url(home_url('/company/')); ?>" class="btn btn-outline">会社概要の詳細へ</a>
        </div>
    </div>
</section>

<!-- 採用情報セクション -->
<section class="section section-alt">
    <div class="container">
        <h2 class="section-title">採用情報</h2>
        <div class="recruit-message">
            <p>現在、採用募集は準備中です。<br>募集開始時期が決まり次第、本ページでお知らせします。</p>
            <a href="<?php echo esc_url(home_url('/recruit/')); ?>" class="btn btn-outline">採用ページへ</a>
        </div>
    </div>
</section>

<?php
get_footer();

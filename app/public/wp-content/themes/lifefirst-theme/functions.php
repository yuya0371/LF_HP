<?php
/**
 * LifeFirst Theme functions and definitions
 *
 * @package LifeFirst
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme Setup
 */
function lifefirst_setup() {
    // タイトルタグのサポート
    add_theme_support('title-tag');

    // カスタムロゴ
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 300,
        'flex-height' => true,
        'flex-width'  => true,
    ));

    // HTML5サポート
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));

    // メニュー登録
    register_nav_menus(array(
        'global-nav' => 'グローバルナビゲーション',
        'footer-nav' => 'フッターナビゲーション',
    ));
}
add_action('after_setup_theme', 'lifefirst_setup');

/**
 * Enqueue scripts and styles
 */
function lifefirst_scripts() {
    // Google Fonts - Shippori Mincho (Display) + Noto Sans JP (Body)
    wp_enqueue_style(
        'google-fonts',
        'https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400;500;600;700&family=Shippori+Mincho:wght@400;500;600&display=swap',
        array(),
        null
    );

    // Theme stylesheet
    wp_enqueue_style(
        'lifefirst-style',
        get_stylesheet_uri(),
        array('google-fonts'),
        wp_get_theme()->get('Version')
    );

    // Theme scripts
    wp_enqueue_script(
        'lifefirst-script',
        get_template_directory_uri() . '/assets/js/main.js',
        array(),
        wp_get_theme()->get('Version'),
        true
    );
}
add_action('wp_enqueue_scripts', 'lifefirst_scripts');

/**
 * Customizer Settings
 */
function lifefirst_customize_register($wp_customize) {
    // ファーストビュー設定セクション
    $wp_customize->add_section('lifefirst_firstview', array(
        'title'    => 'ファーストビュー設定',
        'priority' => 30,
    ));

    // ファーストビュータイプ
    $wp_customize->add_setting('firstview_type', array(
        'default'           => 'type-a',
        'sanitize_callback' => 'lifefirst_sanitize_firstview_type',
    ));

    $wp_customize->add_control('firstview_type', array(
        'label'    => 'ファーストビューのタイプ',
        'section'  => 'lifefirst_firstview',
        'type'     => 'radio',
        'choices'  => array(
            'type-a' => '案A：法人名ドン（会社としての信頼感重視）',
            'type-b' => '案B：事業ドン（事業内容のアピール重視）',
            'type-c' => '案C：超シンプル（ミニマルデザイン重視）',
        ),
    ));

    // ファーストビューのキャッチコピー
    $wp_customize->add_setting('firstview_tagline', array(
        'default'           => '清掃を通じて暮らしを整えるサービスを提供。',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('firstview_tagline', array(
        'label'   => 'キャッチコピー',
        'section' => 'lifefirst_firstview',
        'type'    => 'text',
    ));

    // 会社情報セクション
    $wp_customize->add_section('lifefirst_company', array(
        'title'    => '会社情報',
        'priority' => 35,
    ));

    // 会社名
    $wp_customize->add_setting('company_name', array(
        'default'           => '株式会社ライフファースト',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('company_name', array(
        'label'   => '会社名',
        'section' => 'lifefirst_company',
        'type'    => 'text',
    ));

    // 代表者名
    $wp_customize->add_setting('company_representative', array(
        'default'           => '代表 小山内 央全',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('company_representative', array(
        'label'   => '代表者',
        'section' => 'lifefirst_company',
        'type'    => 'text',
    ));

    // 設立日
    $wp_customize->add_setting('company_established', array(
        'default'           => '2025年7月24日',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('company_established', array(
        'label'   => '設立日',
        'section' => 'lifefirst_company',
        'type'    => 'text',
    ));

    // ========================================
    // ファーストビュー背景画像
    // ========================================
    $wp_customize->add_setting('firstview_bg_image', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'firstview_bg_image', array(
        'label'       => '背景画像',
        'description' => 'ファーストビューの背景画像（推奨: 1920×1080px）',
        'section'     => 'lifefirst_firstview',
    )));

    // 背景画像のオーバーレイ
    $wp_customize->add_setting('firstview_overlay', array(
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ));

    $wp_customize->add_control('firstview_overlay', array(
        'label'   => '背景画像にオーバーレイを追加',
        'section' => 'lifefirst_firstview',
        'type'    => 'checkbox',
    ));

    // ========================================
    // 事業カード画像セクション
    // ========================================
    $wp_customize->add_section('lifefirst_services', array(
        'title'    => '事業カード画像',
        'priority' => 32,
    ));

    // ハウスクリーニング画像
    $wp_customize->add_setting('service_cleaning_image', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'service_cleaning_image', array(
        'label'       => 'ハウスクリーニング事業',
        'description' => 'アイコンまたは写真（推奨: 400×300px）',
        'section'     => 'lifefirst_services',
    )));

    // 中古品買取画像
    $wp_customize->add_setting('service_kaitori_image', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'service_kaitori_image', array(
        'label'       => '中古品買取サービス',
        'description' => 'アイコンまたは写真（推奨: 400×300px）',
        'section'     => 'lifefirst_services',
    )));

    // 民泊事業画像
    $wp_customize->add_setting('service_minpaku_image', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'service_minpaku_image', array(
        'label'       => '住宅宿泊（民泊）事業',
        'description' => 'アイコンまたは写真（推奨: 400×300px）',
        'section'     => 'lifefirst_services',
    )));

    // ========================================
    // OGP設定セクション
    // ========================================
    $wp_customize->add_section('lifefirst_ogp', array(
        'title'    => 'OGP / SNS設定',
        'priority' => 40,
    ));

    // OGP画像
    $wp_customize->add_setting('ogp_image', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'ogp_image', array(
        'label'       => 'OGP画像',
        'description' => 'SNSでシェアされた時に表示される画像（推奨: 1200×630px）',
        'section'     => 'lifefirst_ogp',
    )));

    // OGP説明文
    $wp_customize->add_setting('ogp_description', array(
        'default'           => '株式会社ライフファーストは、ハウスクリーニング事業を中心に、暮らしを整えるサービスを提供しています。',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('ogp_description', array(
        'label'   => 'サイト説明文',
        'description' => 'SNSシェア時や検索結果に表示される説明文',
        'section' => 'lifefirst_ogp',
        'type'    => 'textarea',
    ));
}
add_action('customize_register', 'lifefirst_customize_register');

/**
 * Sanitize firstview type
 */
function lifefirst_sanitize_firstview_type($input) {
    $valid = array('type-a', 'type-b', 'type-c');
    if (in_array($input, $valid, true)) {
        return $input;
    }
    return 'type-a';
}

/**
 * Get firstview type
 */
function lifefirst_get_firstview_type() {
    return get_theme_mod('firstview_type', 'type-a');
}

/**
 * Get company info
 */
function lifefirst_get_company_info($key) {
    $defaults = array(
        'name'           => '株式会社ライフファースト',
        'representative' => '代表 小山内 央全',
        'established'    => '2025年7月24日',
        'capital'        => '100万円',
        'hours'          => '9:00〜19:00（平日・土日）',
        'holiday'        => '不定休',
    );

    if ($key === 'name') {
        return get_theme_mod('company_name', $defaults['name']);
    }
    if ($key === 'representative') {
        return get_theme_mod('company_representative', $defaults['representative']);
    }
    if ($key === 'established') {
        return get_theme_mod('company_established', $defaults['established']);
    }

    return isset($defaults[$key]) ? $defaults[$key] : '';
}

/**
 * Custom Logo or Site Title
 */
function lifefirst_the_custom_logo() {
    if (has_custom_logo()) {
        the_custom_logo();
    } else {
        echo '<a href="' . esc_url(home_url('/')) . '" class="site-title">' . esc_html(get_bloginfo('name')) . '</a>';
    }
}

/**
 * Output OGP and meta tags
 */
function lifefirst_output_ogp() {
    $site_name = get_bloginfo('name');
    $description = get_theme_mod('ogp_description', '株式会社ライフファーストは、ハウスクリーニング事業を中心に、暮らしを整えるサービスを提供しています。');
    $ogp_image = get_theme_mod('ogp_image', '');
    $url = home_url($_SERVER['REQUEST_URI']);

    // ページタイトル
    if (is_front_page()) {
        $title = $site_name;
    } else {
        $title = wp_title('|', false, 'right') . $site_name;
    }

    // メタディスクリプション
    echo '<meta name="description" content="' . esc_attr($description) . '">' . "\n";

    // OGP
    echo '<meta property="og:title" content="' . esc_attr($title) . '">' . "\n";
    echo '<meta property="og:description" content="' . esc_attr($description) . '">' . "\n";
    echo '<meta property="og:type" content="website">' . "\n";
    echo '<meta property="og:url" content="' . esc_url($url) . '">' . "\n";
    echo '<meta property="og:site_name" content="' . esc_attr($site_name) . '">' . "\n";
    echo '<meta property="og:locale" content="ja_JP">' . "\n";

    if ($ogp_image) {
        echo '<meta property="og:image" content="' . esc_url($ogp_image) . '">' . "\n";
    }

    // Twitter Card
    echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
    echo '<meta name="twitter:title" content="' . esc_attr($title) . '">' . "\n";
    echo '<meta name="twitter:description" content="' . esc_attr($description) . '">' . "\n";

    if ($ogp_image) {
        echo '<meta name="twitter:image" content="' . esc_url($ogp_image) . '">' . "\n";
    }
}
add_action('wp_head', 'lifefirst_output_ogp', 1);

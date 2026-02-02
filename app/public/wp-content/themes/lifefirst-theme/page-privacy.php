<?php
/**
 * Template Name: プライバシーポリシー
 * Slug: privacy
 *
 * @package LifeFirst
 */

get_header();
?>

<div class="page-header">
    <div class="container">
        <h1>プライバシーポリシー</h1>
    </div>
</div>

<div class="page-content">
    <div class="container">
        <div style="max-width: 800px; margin: 0 auto;">
            <p><?php echo esc_html(lifefirst_get_company_info('name')); ?>（以下「当社」）は、個人情報の保護に関する法令を遵守し、適切に取り扱います。</p>

            <h2>個人情報の利用目的</h2>
            <ul style="list-style: disc; padding-left: 1.5em; margin-bottom: var(--spacing-lg);">
                <li>お問い合わせへの対応</li>
                <li>サービス提供のため</li>
                <li>その他、事業運営に必要な範囲</li>
            </ul>

            <h2>個人情報の第三者提供</h2>
            <p>当社は、法令に基づく場合を除き、個人情報を第三者に提供いたしません。</p>

            <h2>個人情報の管理</h2>
            <p>当社は、個人情報の漏洩・紛失・改ざん等を防止するため、適切な安全管理措置を講じます。</p>

            <h2>お問い合わせ</h2>
            <p>個人情報の取り扱いに関するお問い合わせは下記までご連絡ください。</p>
            <p>
                <?php echo esc_html(lifefirst_get_company_info('name')); ?><br>
                <?php echo esc_html(lifefirst_get_company_info('representative')); ?>
            </p>

            <p style="margin-top: var(--spacing-2xl); color: var(--color-text-light);">
                制定日：2025年7月24日
            </p>
        </div>
    </div>
</div>

<?php
get_footer();

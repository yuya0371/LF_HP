<?php
/**
 * Template Name: 会社概要
 * Slug: company
 *
 * @package LifeFirst
 */

get_header();
?>

<div class="page-header">
    <div class="container">
        <h1>会社概要</h1>
    </div>
</div>

<div class="page-content">
    <div class="container">
        <table class="company-table">
            <tr>
                <th>会社名</th>
                <td><?php echo esc_html(lifefirst_get_company_info('name')); ?></td>
            </tr>
            <tr>
                <th>代表</th>
                <td><?php echo esc_html(lifefirst_get_company_info('representative')); ?></td>
            </tr>
            <tr>
                <th>設立</th>
                <td><?php echo esc_html(lifefirst_get_company_info('established')); ?></td>
            </tr>
            <tr>
                <th>資本金</th>
                <td><?php echo esc_html(lifefirst_get_company_info('capital')); ?></td>
            </tr>
            <tr>
                <th>営業時間</th>
                <td><?php echo esc_html(lifefirst_get_company_info('hours')); ?></td>
            </tr>
            <tr>
                <th>休業日</th>
                <td><?php echo esc_html(lifefirst_get_company_info('holiday')); ?></td>
            </tr>
            <tr>
                <th>事業内容</th>
                <td>
                    <ul style="list-style: disc; padding-left: 1.5em;">
                        <li>ハウスクリーニング事業（お掃除本舗FC）</li>
                        <li>中古品買取サービス（準備中）</li>
                        <li>住宅宿泊（民泊）事業（準備中）</li>
                    </ul>
                </td>
            </tr>
        </table>
    </div>
</div>

<?php
get_footer();

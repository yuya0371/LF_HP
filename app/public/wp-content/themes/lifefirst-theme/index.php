<?php
/**
 * The main template file
 *
 * @package LifeFirst
 */

get_header();
?>

<div class="page-content">
    <div class="container">
        <?php
        if (have_posts()) :
            while (have_posts()) :
                the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <h2><?php the_title(); ?></h2>
                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>
                </article>
                <?php
            endwhile;
        else :
            ?>
            <p>コンテンツがありません。</p>
            <?php
        endif;
        ?>
    </div>
</div>

<?php
get_footer();

<?php get_header(); ?>
<div class="container">
    <div>
        <?php while (have_posts()) : the_post(); ?>

        <?php the_content();
        endwhile;
        ?>
    </div>
</div>
<?php get_footer(); ?>
<?php get_header(); ?>
<main>
    <div class="container">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <article>
                    <div class="article-img">
                        <?php the_post_thumbnail(); ?>"
                    </div>

                    <div class="article-title">
                        <h1><?php the_title(); ?></h1>
                    </div>
                    <div class="article-meta">
                        <p>By <?php the_author(); ?></p>
                    </div>

                    <div class="article-copy">
                        <?php the_content(); ?>
                    </div>
                </article>
        <?php endwhile;
        endif; ?>
    </div>
</main>
<?php get_footer(); ?>
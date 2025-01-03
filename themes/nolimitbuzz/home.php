<?php get_header(); ?>
<div class="container post-container">
    <div>
        <h1 class="post-page">Latest Posts</h1>

        <div class="post-collection">
            <?php
            // WordPress loop for displaying recent blog posts
            $args = array(
                'post_type' => 'post', // Ensures only blog posts are shown
                'posts_per_page' => 5, // Number of posts to show
            );
            $latest_posts = new WP_Query($args);

            if ($latest_posts->have_posts()) :
                while ($latest_posts->have_posts()) : $latest_posts->the_post(); ?>
                    <div class='post-item'>
                        <div class='post-img'>
                            <img src="<?php the_post_thumbnail(); ?>" alt="">
                        </div>
                        <div class='post-meta'>
                            <div class='post-name'>
                                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                <p> <?php the_excerpt(); ?></p>
                            </div>
                            <div class='post-link'>
                                <a href="<?php the_permalink(); ?>">Read More</a>
                            </div>
                        </div>
                    </div>
            <?php endwhile;
                wp_reset_postdata();
            else :
                echo 'No posts found.';
            endif;
            ?>
        </div>
    </div>

</div>

<?php get_footer(); ?>
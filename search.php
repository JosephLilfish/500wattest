<?php

 
get_header(); ?>
    <div class="search-container">
    <section id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
        <div class="full_width_row">
            <div class="et_pb_row bread_row">
                <?php
                    if ( function_exists('yoast_breadcrumb') ) {
                        yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
                    }
                ?>
            </div>
        </div>
        
        
        <?php if ( have_posts() ) : ?>
            
            
            
            <ul class="search_main_box">
            <?php /* Start the Loop */ ?>
            <?php while ( have_posts() ) : the_post(); ?>
            <li class="search_box">
                <div class="search_image_box">
                    <a href="<?php echo get_permalink( $post ) ?>"><?php echo get_the_post_thumbnail( $post_id, 'full', array( 'alt' => "500WAT") ); ?></a>
                </div>
                <div class="search_content_box">
                    <span class="search-post-title"><?php the_title(); ?></span>
                    <a class="grey_button" href="<?php the_permalink(); ?>">Zobacz</a>
                </div>   
            </li>
 
            <?php endwhile; ?>
        </ul>
        
        <?php else : ?>
        <ul class="search_main_box">
            Brak wyników dla:&nbsp;  <span class="search-page-title"><?php printf( esc_html__( ' %s ' ), '<span>' . get_search_query() . '</span>' ); ?></span>

        </ul>
 
            <?php //get_template_part( 'template-parts/content', 'none' ); ?>
 
        <?php endif; ?>
 
        </main><!-- #main -->
    </section><!-- #primary -->
</div>
<?php //get_sidebar(); ?>
<?php get_footer(); ?>
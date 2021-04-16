<?php



$the_query_all_post = new WP_Query( array(

      'posts_per_page' => -1,
	  'order' => 'DESC',
	  'orderby' => 'date'

   ));

if ( $the_query_all_post->have_posts() ) :
?>
<div class="et_pb_rowx">
    <h1 class="title_page">Aktualności</h1>
	<ul class="blog_posts_page all_posts">

	<?php

	while ( $the_query_all_post->have_posts() ) : $the_query_all_post->the_post();

    $categories = get_the_category();
	?>
		<li class="post_li" data-aos="fade-up">
			<div class="image_box">
				<a href="<?php echo get_permalink( $post ) ?>"><?php echo get_the_post_thumbnail( $post_id, 'full', array( 'alt' => "500 Wat") ); ?></a>
			</div>
			<div class="content_post">
                <a href="<?php echo get_permalink( $post ) ?>"><h2 class="entry_title"><?php echo  the_title();  ?></h2></a>
                <div class="blog_excerpt"><?php echo  the_excerpt();  ?></div>
			</div>
		</li>
	<?php endwhile; ?>
	</ul>
</div> <?php

wp_reset_postdata();
    else :
endif;
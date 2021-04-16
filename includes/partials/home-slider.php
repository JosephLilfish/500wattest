<?php $slider_id = get_field('home_slider');

?>
<div class="home-slider-wrapper desktop">
	
	<div class="slider_home-slider">
	<?php 
	$count = 0;
	?>
	<?php foreach( $slider_id as $index => $slide ){	?>
        <div class="slide_t_box" style="background-image: url(<?php echo $slide['background']['url'];?>)">
			
                <div class="text_box">
					<div class="h2_block">
						 <h2 class="size-x1 bold white title"><?php echo $slide['tytul'];?> halp</h2>
						 <a class="slide_button" href="<?php echo $slide['btn_url'];?>"><?php echo $slide['btn_text'];?></a>
                    </div>
                </div>
				
			</div>		
			
			<?php 
			$count++;
		} ?>
		</div>
	</div>
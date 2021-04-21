<?php 
$banner_id = get_field('banner');
$count = 0;
?>
<div class="home-banner">
	
	<?php foreach( $banner_id as $index => $banner ){	?>
        <div class="singleBanner" style="background-image: url(<?php echo $banner['banner_image'];?>)">
		<a href="<?php echo $banner["banner_link"]?>">
                <div class="bannerTextBox">

						 <h2 class="bannerText"><?php echo $banner['banner_text'];?></h2>
						 <p><?php echo $banner['banner_text_bottom'];?></p>
                   
						 
                </div>
				</a>
				<?php 
				$social_id = get_field("banner_social");
			
				if($count == 2){
					?> 
					<div class="iconContainer">
					<?php
					foreach($social_id as $index => $social){
					?>
					<a href="<?php echo $social["social_link"] ?>"><img src="<?php echo $social["social_icon"] ?>" alt="social"></a>
					<?php
					}
					?>
					</div>
					<?php
				}
				?>

				</div>
			<?php 
			
			$count++;
			}  ?>
		
		
	</div>
<?php

	/*---------------------------------------------------------------
		SINGLE PAGE HERO
	---------------------------------------------------------------*/

	if(is_single()){
		$heroClass = 'sub-page-hero sub-page-hero--large';
	}else{
		$heroClass = 'sub-page-hero';
	}

	$alternativeTitle = get_post_meta( get_the_ID(), 'alternative_title' )[0];

	var_dump($pageMeta);

?>

<div class="hero <?php echo $heroClass; ?>" data-parallax="true" data-speed="0.1" data-direction="up">
	<?php
		if(has_post_thumbnail()){
			the_post_thumbnail( 'pmk-featured-image' );
		}else{
			$default_source = get_bloginfo('template_directory') . '/src/images/';
			$output = '';
			$output .= '<img class="wp-post-image" src="' . $default_source . 'default-sub-page-image.png"';
			$output .= 'srcset="';
			$output .= $default_source . 'default-sub-page-image--full.png 2000w, ';
			$output .= $default_source . 'default-sub-page-image--1024x614.png 1024w, ';
			$output .= $default_source . 'default-sub-page-image--768x461.png 768w, ';
			$output .= $default_source . 'default-sub-page-image--320x192.png 320w"';
			$output .= 'sizes="(max-width: 2000px) 100vw, 2000px"';
			$output .= '>';
			echo($output);
		}
	?>
	<div class="sub-page-hero__haze"></div>
	<div class="sub-page-hero__gradient"></div>
	<div class="sub-page-hero__content" data-parallax="true" data-speed="0.2" data-direction="up">
		<?php if ( $post->post_parent ) : ?>
			<a class="sub-page-hero__parent-page-link" href="<?php echo get_permalink( $post->post_parent ); ?>">
				<?php echo pmk_get_svg( array( 'icon' => '24-leftcaret', 'size' => '24' ) );?>
				<?php echo get_the_title( $post->post_parent ); ?>
			</a>
		<?php endif; ?>
		<h1>
			<?php

			if(!empty($alternativeTitle)){
				echo $alternativeTitle;
			}else{
				the_title();
			}

			?>
		</h1>
		<?php if(has_excerpt()): ?>
		<p><?php echo get_the_excerpt(); ?></p>
		<?php endif; ?>
	</div>
</div>

<?php ?>

<?php

/*---------------------------------------------------------------
	THEME HEADER
---------------------------------------------------------------*/


?>
<!DOCTYPE html>
	<html <?php language_attributes(); ?> class="no-js no-svg">
		<head>
			<meta charset="<?php bloginfo( 'charset' ); ?>">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="profile" href="http://gmpg.org/xfn/11">
			<?php wp_head(); ?>

			<?php include('json-ld.php'); ?>

			<script type="application/ld+json">
				<?php echo json_encode($staticPayload); ?>
			</script>
			<script type="application/ld+json">
				<?php echo json_encode($dynamicPayload); ?>
			</script>
		</head>

		<body>

			<script>
				//LOAD THE FB JS SDK
				window.fbAsyncInit = function() {
					FB.init({
						appId      : '442946962717392',
						xfbml      : true,
						version    : 'v2.9'
					});
					FB.AppEvents.logPageView();
				};

				(function(d, s, id){
					var js, fjs = d.getElementsByTagName(s)[0];
					if (d.getElementById(id)) {return;}
					js = d.createElement(s); js.id = id;
					js.src = "//connect.facebook.net/en_US/sdk.js";
					fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));
			</script>


			<div id="page" class="site">
				<a class="skip-link screen-reader-text" href="#content">
					<?php _e( 'Skip to content', 'pmk' ); ?>
				</a>

				<div class="intro-gradient">
				</div>

				<header class="main-header" role="banner">
					<?php
						if ( has_nav_menu( 'sub' ) ){
							get_template_part( 'template-parts/navigation/navigation', 'sub' );
							get_template_part( 'template-parts/search/search', 'menu' );
						}
						if( has_nav_menu( 'top' ) ){
							get_template_part( 'template-parts/navigation/navigation', 'main' );
							get_template_part( 'template-parts/navigation/navigation', 'mobile' );
						}
					?>
					<button type="button" class="mobile-menu-toggle" aria-haspopup="true" aria-expanded="false" aria-controls="menu" aria-label="Navigation">
						<div class="bar bar-1"></div>
						<div class="bar bar-2"></div>
						<div class="bar bar-3"></div>
					</button>
				</header>

				<?php

					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

					if( pmk_is_frontpage()){

						get_template_part( 'template-parts/hero/hero', 'home' );

					}elseif( is_home() && $paged == 1 ){

						get_template_part( 'template-parts/hero/hero', 'posts' );

					}elseif( is_home() && $paged != 1 || is_archive() || is_404() ){

						get_template_part( 'template-parts/hero/hero', 'paged-posts' );

					}elseif( is_search() ){

						get_template_part( 'template-parts/hero/hero', 'search' );

					}else{

						get_template_part( 'template-parts/hero/hero', 'single' );

					}

				?>

				<?php if( pmk_is_frontpage()) : ?>

					<div class="site__content site__content--home">

				<?php elseif( is_home() && $paged == 1 ) : ?>

					<div class="site__content site__content--blog">

				<?php elseif( is_home() && $paged != 1 || is_archive() || is_404() ) : ?>

					<div class="site__content site__content--blog-paged">

				<?php elseif( is_single() ) : ?>

					<div class="site__content site__content--sub site__content--sub--large">

				<?php else : ?>

					<div class="site__content site__content--sub">

				<?php endif; ?>

<?php

/*---------------------------------------------------------------
	THEME HEADER
---------------------------------------------------------------*/

?>
<!doctype html>
	<html amp lang="en" class="no-js no-svg">
		<head>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, minimum-scale=1, initial-scale=1">


			<?php wp_head(); ?>


			<style amp-custom>
				<?php require get_parent_theme_file_path( '/src/main.css' ); ?>
			</style>

			<script async src="https://cdn.ampproject.org/v0.js"></script>
			<script src="https://use.typekit.net/teg2qqe.js"></script>
			<script>try{Typekit.load({ async: true });}catch(e){}</script>
    		<style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
		</head>

		<body <?php body_class(); ?>>

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

					if( is_front_page() && ! is_home() ){

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

				<?php if( is_front_page() && ! is_home() ) : ?>

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

<?php

/*---------------------------------------------------------------
	THEME FOOTER
---------------------------------------------------------------*/


	$current_page = sanitize_post( $GLOBALS['wp_the_query']->get_queried_object() );
	if(!empty($current_page->post_name)){
		$slug = $current_page->post_name;
	}
	$displayCTA = true;

	if( is_404() ){
		$displayCTA = false;
	}

	if(!empty($slug)){
		if($slug == 'request-a-demo'){
			$displayCTA = false;
		}
	}

?>

			<?php if( $displayCTA ) : ?>
				<section class="slide slide-cta">
					<div class="slide-cta__haze"></div>
					<div class="slide-cta__gradient"></div>
					<div class="slide-cta__content">
						<h2>Join us Today!</h2>
						<p>PikMyKid gives you the tools to ensure your kids are safe and your parents are happy. Let us show you how we can make your school more safe and efficient.</p>
						<div class="cta-buttons">
							<a class="cta-button cta-button--secondary" href="<?php echo get_permalink( get_page_by_path( 'contact' ) ); ?>">
								Contact Us
								<?php echo pmk_get_svg( array( 'icon' => '32-contact', 'size' => '32' ) );?>
							</a>
							<a class="cta-button cta-button--primary" type="button" href="<?php echo get_permalink( get_page_by_path( 'request-a-demo' ) ); ?>">
								Request Demo
								<?php echo pmk_get_svg( array( 'icon' => '32-rarrow', 'size' => '32' ) );?>
							</a>
						</div>

					</div>
				</section>
			<?php endif; ?>

			<footer class="footer">
				<div class="footer__primary">
					<div class="inner">
						<a class="footer__logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
							<?php echo pmk_get_svg( array( 'icon' => 'logo' ) );?>
						</a>
						<?php wp_nav_menu( array(
							'menu_id' => 'footer-menu',
					 		'container'      => false,
							'theme_location' => 'footer',
							'items_wrap' => '<nav id="%1$s" class="%1$s">%3$s</nav>',
							'walker' => new Footer_Menu_Walker
						) ); ?>
					</div>
				</div>
				<div class="footer__copyright">
					<div class="footer__copyright-text">
						Copyright &copy; PikMyKid. 2015-2017. 5115 West Memorial Highway, Tampa Florida 33232. <br>
						Message us at <a href="mailto:hello@pikmykid.com">hello@pikmykid.com</a>.<br>
						View our <a href="<?php echo get_permalink( get_page_by_path( 'terms-of-service' ) ); ?>">Terms of Service</a> or <a href="<?php echo get_permalink( get_page_by_path( 'privacy-policy' ) ); ?>">Privacy Policy</a>.
					</div>
					<div class="footer-social-menu">
						<a href="https://www.facebook.com/pikmykid/" title="Like us on Facebook" class="footer-social-menu__link">
							<?php echo pmk_get_svg( array( 'icon' => '32-facebook', 'size' => '32' ) );?>
						</a>
						<a href="https://twitter.com/pikmykid" title="Follow us on Twitter" class="footer-social-menu__link">
							<?php echo pmk_get_svg( array( 'icon' => '32-twitter', 'size' => '32' ) );?>
						</a>
						<a href="https://www.instagram.com/pikmykid/" title="Follow us on Instagram" class="footer-social-menu__link">
							<?php echo pmk_get_svg( array( 'icon' => '32-instagram', 'size' => '32' ) );?>
						</a>
						<a href="https://plus.google.com/114342026633777180200" title="Follow us on Google Plus" class="footer-social-menu__link">
							<?php echo pmk_get_svg( array( 'icon' => '32-gplus', 'size' => '32' ) );?>
						</a>
						<a href="https://www.linkedin.com/company/pikmykid" title="Connect with us on Linkedin" class="footer-social-menu__link">
							<?php echo pmk_get_svg( array( 'icon' => '32-linkedin', 'size' => '32' ) );?>
						</a>
					</div>
				</div>
			</footer>

		</div><!-- .site__content -->
	</div><!-- .site-content-contain -->
</div><!-- #page -->

<div class="app-icons-wrap" style="width: 1px; height: 1px; opacity: 0;">
	<?php require_once( get_parent_theme_file_path( '/src/app-sfx.svg' ) ); ?>
	<?php require_once( get_parent_theme_file_path( '/src/app-icons.svg' ) ); ?>
</div>

<?php wp_footer(); ?>

<?php if(is_single()) : ?>
	<script>
	document.getElementById('shareBtn').onclick = function() {
	  FB.ui({
	    method: 'share',
	    display: 'popup',
	    href: '<?php echo the_permalink(); ?>'
	  }, function(response){});
	}
	</script>
<?php endif; ?>

</body>
</html>

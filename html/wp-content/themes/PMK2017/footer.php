<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>

			<section class="slide slide-cta">
				<div class="slide-cta__content">
					<h2>Join us Today!</h2>
					<p>PikMyKid gives you the Dismissal tools to ensure your kids are safe and your parents are happy. Let us show you how we can make your school more safe and efficient.</p>
					<div class="cta-buttons">
						<a class="cta-button cta-button--secondary" type="button" href="#">
							Contact Us
							<?php echo pmk_get_svg( array( 'icon' => '32-contact', 'size' => '32' ) );?>
						</a>
						<a class="cta-button cta-button--primary" type="button" href="#">
							Request Demo
							<?php echo pmk_get_svg( array( 'icon' => '32-rarrow', 'size' => '32' ) );?>
						</a>
					</div>
				</div>
			</section>

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
						Message us at <a>hello@pikmykid.com</a> or give us a call at <a>+1 (813) 123-1234.</a><br>
						View our Terms of Service or Privacy Policy.
					</div>
					<div class="footer-social-menu">
						<a alt="Facebook" class="footer-social-menu__link">
							<?php echo pmk_get_svg( array( 'icon' => '32-facebook', 'size' => '32' ) );?>
						</a>
						<a alt="Twitter" class="footer-social-menu__link">
							<?php echo pmk_get_svg( array( 'icon' => '32-twitter', 'size' => '32' ) );?>
						</a>
						<a alt="Instagram" class="footer-social-menu__link">
							<?php echo pmk_get_svg( array( 'icon' => '32-instagram', 'size' => '32' ) );?>
						</a>
					</div>
				</div>
			</footer>

		</div><!-- .site__content -->
	</div><!-- .site-content-contain -->
</div><!-- #page -->


<?php wp_footer(); ?>

</body>
</html>

<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "site-content" div and all content after.
 *
 * @package WordPress
 * @subpackage Swiss_Design_Group
 * @since Swiss Design Group 1.0
 */
?>

	</div><!-- .site-content -->

	<footer id="colophon" class="site-footer" role="contentinfo">

		<div class="conitainer">

			<?php 

			$socials = ot_get_option('site_socials');
			foreach ($socials as $key => $social) {
				
				if ( empty($social['href']) )

					unset($socials[$key]);
			}

			if ( 'on' == ot_get_option('footer_social_active') && is_array($socials) && !empty($socials) ): ?>
			<div class="socials">
				<?php 

				foreach ($socials as $social)

					echo '<a href="', esc_url($social['href']), '" rel="publisher" target="_blank"></a>';

				?>
			</div>
			<?php endif; ?>

			<?php if ( has_nav_menu( 'footer' ) ) : ?> 
			<nav id="footer-navigation" class="<?php echo apply_filters( 'hb_desktop_hidden_class', ot_get_option('mobile_menu') ); ?>">
				<?php wp_nav_menu( array( 'theme_location' => 'footer', 'menu_class' => 'nav-menu', 'depth' => 1 ) ); ?>
			</nav>
			<?php endif; ?>

			<div class="site-info">
				<?php
					/**
					 * Fires before the Swiss Design Group footer text for footer customization.
					 *
					 * @since Swiss Design Group 1.0
					 */
					echo '<span>&copy; ', __( strip_tags ( ot_get_option('footer_copywright') ) ), '</span>';
				?>
			</div><!-- .site-info -->
		</div>

	</footer><!-- .site-footer -->

	<?php wp_footer(); ?>

</div><!-- .site -->

<?php
	/**
	 *
	 * @hook hb_print_facebook_login_script
	 *
	 */
	do_action('hb_after_page');
?>

</body>
</html>
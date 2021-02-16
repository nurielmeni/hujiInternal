<?php
/**
 * The template for displaying footer.
 *
 * @package HelloElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<footer id="site-footer" class="site-footer bg-primary" role="contentinfo">
	<?php // footer. ?>
	<section class="site-footer flex content space-between color-white">
		<div class="footer-parts flex wrap">
			<!-- Footer Right -->
			<div class="footer-text flex column">
				<h4><?= get_theme_mod('hello_child_footer_right_title') ?></h4>
				<?= wpautop(get_theme_mod('hello_child_footer_right')) ?>
			</div>

			<!-- Footer Contact -->
			<div class="footer-text flex column">
				<h4><?= get_theme_mod('hello_child_footer_center_title') ?></h4>
				<?= wpautop(get_theme_mod('hello_child_footer_center')) ?>
			</div>

			<!-- Footer Left -->
			<div class="footer-text flex column">
				<h4><?= get_theme_mod('hello_child_footer_left_title') ?></h4>
				<?= wpautop(get_theme_mod('hello_child_footer_left')) ?>
			</div>
		</div>

		<!-- Footer Logo -->
		<div class="footer-logo flex column">
			<img src="<?= get_stylesheet_directory_uri() . '/images/logo_footer@3.png' ?>" alt="Logo">
		</div>

	</section>
	<p class="powered flex center color-white"><a href="https://niloosoft.com/he/">POWERED BY NILOOSOFT HUNTER EDGE</a></p>
</footer>

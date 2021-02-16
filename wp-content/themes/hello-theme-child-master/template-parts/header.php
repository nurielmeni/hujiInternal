<?php
/**
 * The template for displaying header.
 *
 * @package HelloElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
$site_name = get_bloginfo( 'name' );
$tagline   = get_bloginfo( 'description', 'display' );
?>
<header class="" role="banner">
    <section class="site-header">
        <div class="site-branding">
            <?php
            if ( has_custom_logo() ) {
                the_custom_logo();
            } elseif ( $site_name ) {
                ?>
                <h1 class="site-title">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php esc_attr_e( 'Home', 'hello-elementor' ); ?>" rel="home">
                        <?php echo esc_html( $site_name ); ?>
                    </a>
                </h1>
                <p class="site-description">
                    <?php
                    if ( $tagline ) {
                        echo esc_html( $tagline );
                    }
                    ?>
                </p>
            <?php } ?>
        </div>

        <?php if ( has_nav_menu( 'header' ) ) : ?>
            <nav class="site-navigation" role="navigation">
                <?php wp_nav_menu( array( 'theme_location' => 'header' ) ); ?>
            </nav>
        <?php endif; ?>
        <?php if ( has_nav_menu( 'mobile' ) ) : ?>
            <a href="#" class="toggle-mnu"><span></span></a>
            <nav class="site-navigation mobile" role="navigation">
                <?php wp_nav_menu( array( 'theme_location' => 'mobile' ) ); ?>
            </nav>            
        <?php endif; ?>
    </section>
</header>

<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 *  @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.6.0
 */

defined( 'ABSPATH' ) || exit;

// Elementor `archive` location
if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'archive' ) ) {

	if ( ! machic_is_pjax() ) {
	    get_header( 'shop' );
	}
	?>
	
	<div class="shop-content">
		<div class="container">
		
			<?php get_template_part( 'includes/woocommerce/banner' ); ?>
	
			<div class="shop-page-header">
				<?php woocommerce_breadcrumb(); ?>
			</div>
	
			<?php machic_do_action( 'machic_before_main_shop'); ?>
	
			<?php do_action( 'woocommerce_before_main_content' ); ?>

			<?php			
			/**
			 * Hook: woocommerce_shop_loop_header.
			 *
			 * @since 8.6.0
			 *
			 * @hooked woocommerce_product_taxonomy_archive_header - 10
			 */
			do_action( 'woocommerce_shop_loop_header' );
			?>
			
			<?php
				/**
				 * Hook: woocommerce_before_shop_loop.
				 *
				 * @hooked woocommerce_output_all_notices - 10
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */
				do_action( 'woocommerce_before_shop_loop' );
				
			?>
					
			<?php if( get_theme_mod( 'machic_shop_layout' ) == 'full-width' || machic_get_option() == 'full-width') { ?>
				<div class="row content-wrapper">
					<div class="col col-12 col-lg-12 content-primary">
					    <?php do_action('klb_before_products'); ?>
						
						<?php
						if ( woocommerce_product_loop() ) {
							woocommerce_product_loop_start();
	
							if ( wc_get_loop_prop( 'total' ) ) {
								while ( have_posts() ) {
									the_post();
	
									/**
									 * Hook: woocommerce_shop_loop.
									 */
									do_action( 'woocommerce_shop_loop' );
	
									wc_get_template_part( 'content', 'product' );
								}
							}
	
							woocommerce_product_loop_end();
	
							do_action( 'woocommerce_after_shop_loop' );
						} else {
							do_action( 'woocommerce_no_products_found' );
						}
						?>
					
					</div>
					<div id="sidebar" class="col col-12 col-lg-3 content-secondary site-sidebar filtered-sidebar hide-desktop">
						<div class="site-scroll">
							<div class="sidebar-inner">
							
								<div class="sidebar-mobile-header">
									<h3 class="entry-title"><?php esc_html_e('Filter Products','machic'); ?></h3>
	
									<div class="close-sidebar">
										<i class="klbth-icon-cancel"></i>
									</div>
								</div>
								
								<?php if ( is_active_sidebar( 'shop-sidebar' ) ) { ?>
									<?php dynamic_sidebar( 'shop-sidebar' ); ?>
								<?php } ?>
								
							</div>
						</div>
					</div>
				</div>
			<?php } elseif( get_theme_mod( 'machic_shop_layout' ) == 'right-sidebar' || machic_get_option() == 'right-sidebar') { ?>
				<div class="row content-wrapper sidebar-right">
					<div class="col col-12 col-lg-9 content-primary">
						<?php do_action('klb_before_products'); ?>
						
						<?php
						if ( woocommerce_product_loop() ) {
							woocommerce_product_loop_start();
	
							if ( wc_get_loop_prop( 'total' ) ) {
								while ( have_posts() ) {
									the_post();
	
									/**
									 * Hook: woocommerce_shop_loop.
									 */
									do_action( 'woocommerce_shop_loop' );
	
									wc_get_template_part( 'content', 'product' );
								}
							}
	
							woocommerce_product_loop_end();
	
							do_action( 'woocommerce_after_shop_loop' );
						} else {
							do_action( 'woocommerce_no_products_found' );
						}
						?>
					
					</div>
					<div id="sidebar" class="col col-12 col-lg-3 content-secondary site-sidebar filtered-sidebar">
						<div class="site-scroll">
							<div class="sidebar-inner">
							
								<div class="sidebar-mobile-header">
									<h3 class="entry-title"><?php esc_html_e('Filter Products','machic'); ?></h3>
	
									<div class="close-sidebar">
										<i class="klbth-icon-cancel"></i>
									</div>
								</div>
								
								<?php if ( is_active_sidebar( 'shop-sidebar' ) ) { ?>
									<?php dynamic_sidebar( 'shop-sidebar' ); ?>
								<?php } ?>
								
							</div>
						</div>
					</div>
				</div>
			<?php } else { ?>
				<?php if ( is_active_sidebar( 'shop-sidebar' ) ) { ?>
					<div class="row content-wrapper sidebar-left">
						<div class="col col-12 col-lg-9 content-primary">
							<?php do_action('klb_before_products'); ?>
						
							<?php
							if ( woocommerce_product_loop() ) {
								woocommerce_product_loop_start();
	
								if ( wc_get_loop_prop( 'total' ) ) {
									while ( have_posts() ) {
										the_post();
	
										/**
										 * Hook: woocommerce_shop_loop.
										 */
										do_action( 'woocommerce_shop_loop' );
	
										wc_get_template_part( 'content', 'product' );
									}
								}
	
								woocommerce_product_loop_end();
	
								do_action( 'woocommerce_after_shop_loop' );
							} else {
								do_action( 'woocommerce_no_products_found' );
							}
							?>
						
						</div>
						<div id="sidebar" class="col col-12 col-lg-3 content-secondary site-sidebar filtered-sidebar">
							<div class="site-scroll">
								<div class="sidebar-inner">
								
									<div class="sidebar-mobile-header">
										<h3 class="entry-title"><?php esc_html_e('Filter Products','machic'); ?></h3>
	
										<div class="close-sidebar">
											<i class="klbth-icon-cancel"></i>
										</div>
									</div>
									
									<?php if ( is_active_sidebar( 'shop-sidebar' ) ) { ?>
										<?php dynamic_sidebar( 'shop-sidebar' ); ?>
									<?php } ?>
									
								</div>
							</div>
						</div>
					</div>
				<?php } else { ?>
					<div class="row content-wrapper">
						<div class="col col-12 col-lg-12 content-primary">
							<?php do_action('klb_before_products'); ?>
							
							<?php
							if ( woocommerce_product_loop() ) {
								woocommerce_product_loop_start();
	
								if ( wc_get_loop_prop( 'total' ) ) {
									while ( have_posts() ) {
										the_post();
	
										/**
										 * Hook: woocommerce_shop_loop.
										 */
										do_action( 'woocommerce_shop_loop' );
	
										wc_get_template_part( 'content', 'product' );
									}
								}
	
								woocommerce_product_loop_end();
	
								do_action( 'woocommerce_after_shop_loop' );
							} else {
								do_action( 'woocommerce_no_products_found' );
							}
							?>
						
						</div>
						<div id="sidebar" class="col col-12 col-lg-3 content-secondary site-sidebar filtered-sidebar hide-desktop">
							<div class="site-scroll">
								<div class="sidebar-inner">
								
									<div class="sidebar-mobile-header">
										<h3 class="entry-title"><?php esc_html_e('Filter Products','machic'); ?></h3>
	
										<div class="close-sidebar">
											<i class="klbth-icon-cancel"></i>
										</div>
									</div>
									
									<?php if ( is_active_sidebar( 'shop-sidebar' ) ) { ?>
										<?php dynamic_sidebar( 'shop-sidebar' ); ?>
									<?php } ?>
									
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
			<?php } ?>
				
			<?php do_action( 'woocommerce_after_main_content' ); ?>
	
			<?php machic_do_action( 'machic_after_main_shop'); ?>
		</div>
	</div>
	<?php
		if ( ! machic_is_pjax() ) {
			get_footer( 'shop' );
		}

}

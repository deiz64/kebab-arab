<?php
defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

$term = get_queried_object();
?>

<div class="ffk-shop-archive">
	<div class="ffk-shop-archive__wrap">

		<?php if ( is_product_category() && $term && ! empty( $term->name ) ) : ?>
			<div class="ffk-shop-archive__hero">
				<h1 class="ffk-shop-archive__title"><?php echo esc_html( $term->name ); ?></h1>
				<?php if ( ! empty( $term->description ) ) : ?>
					<div class="ffk-shop-archive__desc">
						<?php echo esc_html( wp_strip_all_tags( $term->description ) ); ?>
					</div>
				<?php endif; ?>
			</div>
		<?php else : ?>
			<div class="ffk-shop-archive__hero">
				<h1 class="ffk-shop-archive__title"><?php woocommerce_page_title(); ?></h1>
			</div>
		<?php endif; ?>

		<?php if ( woocommerce_product_loop() ) : ?>

			<?php do_action( 'woocommerce_before_shop_loop' ); ?>

			<div class="ffk-products-grid">
				<?php
				if ( wc_get_loop_prop( 'total' ) ) {
					while ( have_posts() ) {
						the_post();
						do_action( 'woocommerce_shop_loop' );
						wc_get_template_part( 'content', 'product' );
					}
				}
				?>
			</div>

			<?php do_action( 'woocommerce_after_shop_loop' ); ?>

		<?php else : ?>

			<div class="ffk-shop-empty">
				<?php do_action( 'woocommerce_no_products_found' ); ?>
			</div>

		<?php endif; ?>

	</div>
</div>

<?php
get_footer( 'shop' );
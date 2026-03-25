<?php
defined( 'ABSPATH' ) || exit;

global $product;

if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form();
	return;
}

$product_id   = $product->get_id();
$weight       = $product->get_weight();
$unit         = get_option( 'woocommerce_weight_unit', 'g' );
$short_desc   = apply_filters( 'woocommerce_short_description', $post->post_excerpt );
?>

<div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'ffk-single-product', $product ); ?>>
	<div class="ffk-single-product__wrap">

		<div class="ffk-single-product__breadcrumbs">
			<?php woocommerce_breadcrumb(); ?>
		</div>

		<div class="ffk-single-product__grid">
			<div class="ffk-single-product__gallery">
				<div class="ffk-single-product__main-image">
					<?php
					if ( has_post_thumbnail() ) {
						echo wp_get_attachment_image( $product->get_image_id(), 'large' );
					} else {
						echo wc_placeholder_img( 'large' );
					}
					?>
				</div>
			</div>

			<div class="ffk-single-product__summary">
				<h1 class="ffk-single-product__title"><?php the_title(); ?></h1>

				<?php if ( $short_desc ) : ?>
					<div class="ffk-single-product__excerpt">
						<?php echo wp_kses_post( $short_desc ); ?>
					</div>
				<?php endif; ?>

				<?php if ( '' !== $weight ) : ?>
					<div class="ffk-single-product__weight">
						<?php echo esc_html( $weight . ' ' . $unit ); ?>
					</div>
				<?php endif; ?>

				<div class="ffk-single-product__price">
					<?php echo wp_kses_post( $product->get_price_html() ); ?>
				</div>

				<div class="ffk-single-product__cart">
					<?php woocommerce_template_single_add_to_cart(); ?>
				</div>
			</div>
		</div>

		<div class="ffk-single-product__after">
			<?php
			/*
			 * Здесь выводятся:
			 * - addons / extra options
			 * - tabs
			 * - related products
			 * Всё, что цепляется хуками плагинов
			 */
			do_action( 'woocommerce_after_single_product_summary' );
			?>
		</div>

	</div>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
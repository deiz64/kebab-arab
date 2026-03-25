<?php
defined('ABSPATH') || exit;

global $product;

if (!$product || !$product->is_visible()) {
	return;
}

$short_description = $product->get_short_description();
$image_html = $product->get_image('medium');

if (!$image_html) {
	$image_html = wc_placeholder_img('medium');
}
?>

<article <?php wc_product_class('ffk-product-card', $product); ?>>
	<a class="ffk-product-card__image" href="<?php the_permalink(); ?>">
		<?php echo $image_html; ?>
	</a>

	<div class="ffk-product-card__body">
		<h3 class="ffk-product-card__title">
			<a href="<?php the_permalink(); ?>"><?php echo esc_html($product->get_name()); ?></a>
		</h3>

		<?php if (!empty($short_description)) : ?>
			<div class="ffk-product-card__desc">
				<?php echo wp_kses_post(wp_trim_words($short_description, 18)); ?>
			</div>
		<?php endif; ?>

		<div class="ffk-product-card__bottom">
			<div class="ffk-product-card__price">
				<?php echo wp_kses_post($product->get_price_html()); ?>
			</div>

			<a class="ffk-product-card__button" href="<?php the_permalink(); ?>">
				<?php esc_html_e('View product', 'ffkebab'); ?>
			</a>
		</div>
	</div>
</article>
<?php
defined('ABSPATH') || exit;

if (! function_exists('kc_restaurant_menu_has_woocommerce')) {
	function kc_restaurant_menu_has_woocommerce() {
		return class_exists('WooCommerce');
	}
}

if (! function_exists('kc_restaurant_menu_get_categories')) {
	function kc_restaurant_menu_get_categories() {
		if (! taxonomy_exists('product_cat')) {
			return array();
		}

		$terms = get_terms(array(
			'taxonomy'   => 'product_cat',
			'hide_empty' => true,
			'orderby'    => 'menu_order',
			'order'      => 'ASC',
		));

		if (is_wp_error($terms)) {
			return array();
		}

		return $terms;
	}
}

if (! function_exists('ff_menu_get_topping_icon_svg')) {
	function ff_menu_get_topping_icon_svg() {
		ob_start();
		?>
		<svg class="ff-menu-card__icon-svg ff-menu-card__icon-svg--topping" viewBox="0 0 86 64" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
			<!-- корзина -->
			<path d="M16 24 H60 L56 46 H20 Z" fill="#c9d0d8" stroke="#4f5d6a" stroke-width="3" stroke-linejoin="round"/>
			<path d="M26 24 L34 14" fill="none" stroke="#4f5d6a" stroke-width="4" stroke-linecap="round"/>
			<path d="M50 24 L42 14" fill="none" stroke="#4f5d6a" stroke-width="4" stroke-linecap="round"/>
			<path d="M28 30 V40" fill="none" stroke="#7a8794" stroke-width="3" stroke-linecap="round"/>
			<path d="M38 30 V40" fill="none" stroke="#7a8794" stroke-width="3" stroke-linecap="round"/>
			<path d="M48 30 V40" fill="none" stroke="#7a8794" stroke-width="3" stroke-linecap="round"/>

			<!-- зелёная стрелка вверх -->
			<path d="M38 10 L48 20 H42 V31 H34 V20 H28 Z" fill="#7ad03a" stroke="#4f8f26" stroke-width="2.5" stroke-linejoin="round"/>

			<!-- зелёный круг с плюсиком -->
			<g class="ff-menu-card__icon-plus-group">
				<circle cx="64" cy="41" r="12" fill="#67c23a" stroke="#4f8f26" stroke-width="3"/>
				<path class="ff-menu-card__icon-plus" d="M64 35 V47 M58 41 H70" fill="none" stroke="#ffffff" stroke-width="4.5" stroke-linecap="round"/>
			</g>
		</svg>
		<?php
		return trim(ob_get_clean());
	}
}

if (! function_exists('ff_menu_get_cart_icon_svg')) {
	function ff_menu_get_cart_icon_svg() {
		ob_start();
		?>
		<svg class="ff-menu-card__icon-svg ff-menu-card__icon-svg--cart" viewBox="0 0 86 64" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
			<!-- корзина -->
			<path d="M16 24 H60 L56 46 H20 Z" fill="#c9d0d8" stroke="#4f5d6a" stroke-width="3" stroke-linejoin="round"/>
			<path d="M26 24 L34 14" fill="none" stroke="#4f5d6a" stroke-width="4" stroke-linecap="round"/>
			<path d="M50 24 L42 14" fill="none" stroke="#4f5d6a" stroke-width="4" stroke-linecap="round"/>
			<path d="M28 30 V40" fill="none" stroke="#7a8794" stroke-width="3" stroke-linecap="round"/>
			<path d="M38 30 V40" fill="none" stroke="#7a8794" stroke-width="3" stroke-linecap="round"/>
			<path d="M48 30 V40" fill="none" stroke="#7a8794" stroke-width="3" stroke-linecap="round"/>

			<!-- красный круг с плюсиком -->
			<g class="ff-menu-card__icon-plus-group">
				<circle cx="64" cy="41" r="12" fill="#e31e24" stroke="#b1171c" stroke-width="3"/>
				<path class="ff-menu-card__icon-plus" d="M64 35 V47 M58 41 H70" fill="none" stroke="#ffffff" stroke-width="4.5" stroke-linecap="round"/>
			</g>
		</svg>
		<?php
		return trim(ob_get_clean());
	}
}

if (! function_exists('kc_restaurant_render_product_card')) {
	function kc_restaurant_render_product_card($product) {
		if (! $product || ! is_a($product, 'WC_Product')) {
			return;
		}

		$image_html = $product->get_image('medium');

		if (! $image_html) {
			$image_html = wc_placeholder_img('medium');
		}

		$short_description = $product->get_short_description();
		$product_url = $product->get_permalink();
		?>
		<article class="ff-menu-card js-menu-product-trigger" data-product-id="<?php echo esc_attr($product->get_id()); ?>" data-product-url="<?php echo esc_url($product_url); ?>">
			<a class="ff-menu-card__image-link" href="<?php echo esc_url($product_url); ?>" aria-label="<?php echo esc_attr($product->get_name()); ?>">
				<div class="ff-menu-card__image">
					<?php echo $image_html; ?>
				</div>
			</a>

			<div class="ff-menu-card__body">
				<h3 class="ff-menu-card__title">
					<a class="ff-menu-card__title-link" href="<?php echo esc_url($product_url); ?>"><?php echo esc_html($product->get_name()); ?></a>
				</h3>

				<?php if (! empty($short_description)) : ?>
					<div class="ff-menu-card__desc">
						<?php echo wp_kses_post(wp_trim_words($short_description, 18)); ?>
					</div>
				<?php endif; ?>

				<div class="ff-menu-card__footer">
					<div class="ff-menu-card__price">
						<?php echo wp_kses_post($product->get_price_html()); ?>
					</div>

					<div class="ff-menu-card__actions">
						<div class="ff-menu-card__control ff-menu-card__control--topping">
							<span class="ff-menu-card__control-label ff-menu-card__control-label--topping">
								<?php esc_html_e('Toping', 'ffkebab'); ?>
							</span>

							<span class="ff-menu-card__icon-shell" aria-hidden="true">
								<?php echo ff_menu_get_topping_icon_svg(); ?>
							</span>
						</div>

						<div class="ff-menu-card__control ff-menu-card__control--cart">
							<span class="ff-menu-card__control-label ff-menu-card__control-label--cart">
								<?php esc_html_e('Adaugă în coș', 'ffkebab'); ?>
							</span>

							<button
								type="button"
								class="ff-menu-card__button"
								data-product-id="<?php echo esc_attr($product->get_id()); ?>"
								data-product-url="<?php echo esc_url($product_url); ?>"
								aria-label="<?php esc_attr_e('Adaugă în coș', 'ffkebab'); ?>"
								title="<?php esc_attr_e('Adaugă în coș', 'ffkebab'); ?>"
							>
								<?php echo ff_menu_get_cart_icon_svg(); ?>
							</button>
						</div>
					</div>
				</div>
			</div>
		</article>
		<?php
	}
}

/**
 * Рекурсивная очистка значений из формы.
 */
function ff_menu_clean_recursive($value) {
	if (is_array($value)) {
		return array_map('ff_menu_clean_recursive', $value);
	}

	return wc_clean(wp_unslash($value));
}

/**
 * Определяет режим popup по категориям товара.
 */
function ff_menu_get_popup_layout_by_product($product_id) {
	$terms = get_the_terms($product_id, 'product_cat');

	if (empty($terms) || is_wp_error($terms)) {
		return 'full';
	}

	$compact_slugs = array(
	'salata',
	'salate',
	'sosuri',
	'bauturi',
	'dulce',
	'cafea',
	'ceai',
	'coffee',
	'drinks',
	'water',
	'sauces',
	'extras',
	'additives',
	'beverages',
	'tea'
);

	foreach ($terms as $term) {
		if (in_array($term->slug, $compact_slugs, true)) {
			return 'compact';
		}
	}

	return 'full';
}

/**
 * HTML обёртка sticky cart.
 */
function ff_menu_get_sticky_cart_html() {
	$count = WC()->cart ? WC()->cart->get_cart_contents_count() : 0;
	$total = WC()->cart ? wp_strip_all_tags(WC()->cart->get_cart_total()) : '';

	ob_start();
	?>
	<div id="ff-sticky-cart-wrap">
		<div class="ff-sticky-cart<?php echo $count > 0 ? '' : ' is-hidden'; ?>">
			<?php if ($count > 0) : ?>
				<a class="ff-sticky-cart__link" href="<?php echo esc_url(wc_get_cart_url()); ?>">
					<span class="ff-sticky-cart__text">
						<?php echo esc_html(sprintf(__('Coșul tău • %1$d • %2$s', 'ffkebab'), $count, $total)); ?>
					</span>
					<span class="ff-sticky-cart__cta"><?php esc_html_e('Vezi coșul', 'ffkebab'); ?></span>
				</a>
			<?php endif; ?>
		</div>
	</div>
	<?php
	return ob_get_clean();
}

/**
 * Держим sticky cart синхронизированным с Woo fragments.
 */
add_filter('woocommerce_add_to_cart_fragments', function ($fragments) {
	$fragments['#ff-sticky-cart-wrap'] = ff_menu_get_sticky_cart_html();
	return $fragments;
});

/**
 * Печатаем стили кнопок карточки прямо отсюда,
 * чтобы не трогать основной CSS-файл.
 */
add_action('wp_head', 'ff_menu_print_card_controls_css', 120);

function ff_menu_print_card_controls_css() {

	if (! is_page('menu')) {
		return;
	}
	?>
	<style>
		.ff-menu-card__footer {
			display: flex;
			align-items: flex-end;
			justify-content: space-between;
			gap: 12px;
		}

		.ff-menu-card__actions {
			display: flex;
			align-items: flex-end;
			gap: 18px;
			margin-left: auto;
			flex: 0 0 auto;
		}

		.ff-menu-card__control {
			display: flex;
			flex-direction: column;
			align-items: center;
			gap: 4px;
			position: relative;
			z-index: 2;
		}

		.ff-menu-card__control-label {
			display: block;
			font-size: 12px;
			line-height: 1.1;
			font-weight: 700;
			text-align: center;
			white-space: nowrap;
			user-select: none;
		}

		.ff-menu-card__control-label--topping {
			color: #5ebc46;
		}

		.ff-menu-card__control-label--cart {
			color: #e31e24;
		}

		.ff-menu-card__icon-shell {
			display: inline-flex;
			align-items: center;
			justify-content: center;
			width: 74px;
			height: 52px;
			cursor: pointer;
			transition:
				transform 0.18s ease,
				filter 0.18s ease;
		}

		.ff-menu-card__control--cart .ff-menu-card__button {
			display: inline-flex;
			align-items: center;
			justify-content: center;
			width: 74px !important;
			height: 52px !important;
			min-width: 74px !important;
			min-height: 52px !important;
			padding: 0 !important;
			border: 0 !important;
			background: transparent !important;
			box-shadow: none !important;
			border-radius: 0 !important;
			line-height: 0 !important;
			font-size: 0 !important;
			text-indent: 0 !important;
			transition:
				transform 0.18s ease,
				filter 0.18s ease;
		}

		.ff-menu-card__icon-svg {
			display: block;
			width: 74px;
			height: 52px;
			overflow: visible;
		}

		.ff-menu-card__icon-plus {
			transform-origin: 64px 41px;
			transition: transform 0.22s ease;
		}

		.ff-menu-card__control--topping:hover .ff-menu-card__icon-shell {
			transform: scale(1.08);
			filter: drop-shadow(0 4px 8px rgba(99, 184, 47, 0.22));
		}

		.ff-menu-card__control--topping {
			transform: translateX(-50px);
		}

		.ff-menu-card__control--cart:hover .ff-menu-card__button {
			transform: scale(1.08);
			filter: drop-shadow(0 4px 8px rgba(227, 30, 36, 0.22));
		}

		.ff-menu-card__control--topping:hover .ff-menu-card__icon-plus,
		.ff-menu-card__control--cart:hover .ff-menu-card__icon-plus {
			transform: rotate(90deg);
		}

		.ff-menu-card__control--cart .ff-menu-card__button.is-loading {
			opacity: 0.72;
			pointer-events: none;
		}

		@media (max-width: 767px) {
			.ff-menu-card__footer {
				display: flex;
				flex-direction: row;
				align-items: flex-end;
				justify-content: space-between;
			}

			.ff-menu-card__actions {
				gap: 12px;
			}

			.ff-menu-card__control-label {
				font-size: 11px;
			}

			.ff-menu-card__icon-shell,
			.ff-menu-card__control--cart .ff-menu-card__button,
			.ff-menu-card__icon-svg {
				width: 66px !important;
				height: 48px !important;
				min-width: 66px !important;
				min-height: 48px !important;
			}
		}
	</style>
	<?php
}

/**
 * Рендерим селекты вариаций в popup.
 */
function ff_menu_render_variation_fields(WC_Product_Variable $product) {
	$attributes = $product->get_variation_attributes();

	if (empty($attributes)) {
		return;
	}

	echo '<div class="ff-modifier-group ff-modifier-group--variations">';
	echo '<h3 class="ff-modifier-group__title">' . esc_html__('Options', 'ffkebab') . '</h3>';

	foreach ($attributes as $attribute_name => $options) {
		$field_id = sanitize_title($attribute_name);

		echo '<div class="ff-modifier-row">';
		echo '<label class="ff-modifier-row__label" for="' . esc_attr($field_id) . '">';
		echo esc_html(wc_attribute_label($attribute_name));
		echo '</label>';

		wc_dropdown_variation_attribute_options(array(
			'options'   => $options,
			'attribute' => $attribute_name,
			'product'   => $product,
			'class'     => 'ff-variation-select',
		));

		echo '</div>';
	}

	echo '</div>';
}

/**
 * Генерируем HTML popup товара.
 */
function ff_menu_get_product_modal_html($product_id) {
	$product = wc_get_product($product_id);
	$post    = get_post($product_id);

	if (! $product || ! $post || 'product' !== $post->post_type) {
		return '';
	}

	$backup_post    = $GLOBALS['post'] ?? null;
	$backup_product = $GLOBALS['product'] ?? null;

	$GLOBALS['post']    = $post;
	$GLOBALS['product'] = $product;
	setup_postdata($post);

	$short_description = apply_filters('woocommerce_short_description', $post->post_excerpt);
	$base_price        = (float) wc_get_price_to_display($product);
	$is_variable       = $product->is_type('variable');
	$popup_layout      = ff_menu_get_popup_layout_by_product($product_id);

	$form_classes = array('ff-menu-add-form', 'cart');

	if ($is_variable) {
		$form_classes[] = 'variations_form';
	}

	ob_start();
	?>
	<div
		class="ff-modal-product ff-modal-product--<?php echo esc_attr($popup_layout); ?>"
		data-base-price="<?php echo esc_attr($base_price); ?>"
		data-popup-layout="<?php echo esc_attr($popup_layout); ?>"
	>
		<button type="button" class="ff-menu-modal__close js-ff-menu-close" aria-label="<?php esc_attr_e('Close', 'ffkebab'); ?>">
			<span aria-hidden="true">&times;</span>
		</button>

		<?php do_action('woocommerce_before_add_to_cart_form'); ?>

		<form
			class="<?php echo esc_attr(implode(' ', $form_classes)); ?>"
			method="post"
			enctype="multipart/form-data"
			<?php if ($is_variable) : ?>
				data-product_id="<?php echo esc_attr($product->get_id()); ?>"
				data-product_variations="<?php echo htmlspecialchars(wp_json_encode($product->get_available_variations()), ENT_QUOTES, 'UTF-8'); ?>"
			<?php endif; ?>
		>
			<input type="hidden" name="product_id" value="<?php echo esc_attr($product->get_id()); ?>">
			<input type="hidden" name="add-to-cart" value="<?php echo esc_attr($product->get_id()); ?>">

			<div class="ff-modal-product__grid">
				<div class="ff-modal-product__summary">
					<div class="ff-modal-product__image">
						<?php
						if ($product->get_image_id()) {
							echo wp_get_attachment_image(
								$product->get_image_id(),
								'medium',
								false,
								array(
									'loading'  => 'lazy',
									'decoding' => 'async',
									'class'    => 'ff-menu-card__img',
								)
							);
						} else {
							echo wc_placeholder_img('large');
						}
						?>
					</div>

					<div class="ff-modal-product__meta">
						<h2 id="ff-menu-modal-title" class="ff-modal-product__title">
							<?php echo esc_html($product->get_name()); ?>
						</h2>

						<?php if (! empty($short_description)) : ?>
							<div class="ff-modal-product__desc">
								<?php echo wp_kses_post($short_description); ?>
							</div>
						<?php endif; ?>

						<div class="ff-modal-product__price js-ff-modal-unit-price">
							<?php echo wp_kses_post(wc_price($base_price)); ?>
						</div>

						<?php if ($popup_layout === 'compact') : ?>
							<div class="ff-popup-layout-compact">
								<div class="ff-popup-layout-compact__row ff-popup-layout-compact__row--top">
									<div class="ff-popup-compact-comment">
										<?php echo esc_html(ff_menu_ui_get('ff_menu_text_special_request_label')); ?>
									</div>
									<div class="ff-popup-compact-rating">★</div>
								</div>
							</div>
						<?php endif; ?>
					</div>
				</div>

				<div class="ff-modal-product__options">
					<?php if ($is_variable) : ?>
						<?php ff_menu_render_variation_fields($product); ?>

						<div class="single_variation_wrap" style="display:none;">
							<div class="woocommerce-variation single_variation"></div>
							<div class="woocommerce-variation-add-to-cart variations_button">
								<input type="hidden" name="variation_id" class="variation_id" value="0">
							</div>
						</div>
					<?php endif; ?>

<?php if ($popup_layout === 'full') : ?>
	<div class="ff-menu-special-request ff-menu-special-request--full">
		<label class="ff-menu-special-request__label" for="ff_special_request_<?php echo esc_attr($product->get_id()); ?>">
			<?php echo esc_html(ff_menu_ui_get('ff_menu_text_special_request_label')); ?>
		</label>

		<textarea
			id="ff_special_request_<?php echo esc_attr($product->get_id()); ?>"
			name="ff_special_request"
			class="ff-menu-special-request__textarea"
			rows="4"
			placeholder="<?php echo esc_attr(ff_menu_ui_get('ff_menu_text_special_request_placeholder')); ?>"
		></textarea>
	</div>
<?php endif; ?>

					<?php
					do_action('woocommerce_before_add_to_cart_button');
					do_action('ff_menu_modal_modifiers', $product);
					do_action('woocommerce_after_add_to_cart_button');
					?>

					<div class="ff-form-messages"></div>
				</div>
			</div>

			<div class="ff-modal-product__footer">
				<div class="ff-qty">
					<button type="button" class="ff-qty__btn" data-step="-1" aria-label="<?php esc_attr_e('Decrease quantity', 'ffkebab'); ?>">−</button>

					<?php
					woocommerce_quantity_input(array(
						'min_value'   => 1,
						'input_value' => 1,
						'max_value'   => $product->get_max_purchase_quantity(),
					), $product, true);
					?>

					<button type="button" class="ff-qty__btn" data-step="1" aria-label="<?php esc_attr_e('Increase quantity', 'ffkebab'); ?>">+</button>
				</div>

				<button type="submit" class="button alt ff-menu-submit">
					<span class="ff-menu-submit__label"><?php esc_html_e('ADD', 'ffkebab'); ?></span>
					<span class="ff-menu-submit__dot">•</span>
					<span class="ff-menu-submit__price js-ff-menu-submit-price"><?php echo wp_kses_post(wc_price($base_price)); ?></span>
				</button>
			</div>
		</form>

		<?php do_action('woocommerce_after_add_to_cart_form'); ?>
	</div>
	<?php

	$html = ob_get_clean();

	wp_reset_postdata();
	$GLOBALS['post'] = $backup_post;

	if ($backup_product) {
		$GLOBALS['product'] = $backup_product;
	} else {
		unset($GLOBALS['product']);
	}

	return $html;
}

/**
 * AJAX: грузим popup товара.
 */
add_action('wp_ajax_ff_menu_get_product', 'ff_menu_ajax_get_product');
add_action('wp_ajax_nopriv_ff_menu_get_product', 'ff_menu_ajax_get_product');

function ff_menu_ajax_get_product() {
	check_ajax_referer('ff_menu_nonce', 'nonce');

	$product_id = isset($_POST['product_id']) ? absint($_POST['product_id']) : 0;
	$html       = $product_id ? ff_menu_get_product_modal_html($product_id) : '';

	if (! $html) {
		wp_send_json_error(array(
			'message' => __('Invalid product.', 'ffkebab'),
		), 400);
	}

	wp_send_json_success(array(
		'html' => $html,
	));
}
 
 /**
 * Сохраняем special request в cart item data
 */
add_filter('woocommerce_add_cart_item_data', 'ff_menu_add_special_request_to_cart_item', 10, 4);

function ff_menu_add_special_request_to_cart_item($cart_item_data, $product_id, $variation_id, $quantity) {
	$special_request = '';

	if (isset($_POST['ff_special_request'])) {
		$special_request = wc_clean(wp_unslash($_POST['ff_special_request']));
	}

	if ($special_request !== '') {
		$cart_item_data['ff_special_request'] = $special_request;
		$cart_item_data['ff_special_request_key'] = md5($special_request . '|' . microtime(true));
	}

	return $cart_item_data;
}

/**
 * Показываем special request в корзине и checkout
 */
add_filter('woocommerce_get_item_data', 'ff_menu_render_special_request_cart_data', 10, 2);

function ff_menu_render_special_request_cart_data($item_data, $cart_item) {
	if (!empty($cart_item['ff_special_request'])) {
		$item_data[] = array(
			'key'   => ff_menu_ui_get('ff_menu_text_special_request_label'),
			'value' => wc_clean($cart_item['ff_special_request']),
		);
	}

	return $item_data;
}

/**
 * Сохраняем special request в order item meta
 */
add_action('woocommerce_checkout_create_order_line_item', 'ff_menu_add_special_request_to_order_item', 10, 4);

function ff_menu_add_special_request_to_order_item($item, $cart_item_key, $values, $order) {
	if (!empty($values['ff_special_request'])) {
		$item->add_meta_data(ff_menu_ui_get('ff_menu_text_special_request_label'), $values['ff_special_request'], true);
	}
}
/**
 * AJAX: добавляем товар в корзину из popup или кнопки карточки.
 */
add_action('wp_ajax_ff_menu_add_to_cart', 'ff_menu_ajax_add_to_cart');
add_action('wp_ajax_nopriv_ff_menu_add_to_cart', 'ff_menu_ajax_add_to_cart');

function ff_menu_ajax_add_to_cart() {
	check_ajax_referer('ff_menu_nonce', 'nonce');

	if (empty($_POST['form'])) {
		wp_send_json_error(array(
			'message' => __('Missing form data.', 'ffkebab'),
		), 400);
	}

	parse_str(wp_unslash($_POST['form']), $form);
	$form = ff_menu_clean_recursive($form);

	$product_id   = absint($form['product_id'] ?? $form['add-to-cart'] ?? 0);
	$quantity     = max(1, wc_stock_amount($form['quantity'] ?? 1));
	$variation_id = absint($form['variation_id'] ?? 0);
	$variations   = array();

	foreach ($form as $key => $value) {
		if (0 === strpos($key, 'attribute_')) {
			$variations[$key] = $value;
		}
	}

	if (! $product_id) {
		wp_send_json_error(array(
			'message' => __('Missing product ID.', 'ffkebab'),
		), 400);
	}

	$previous_post    = $_POST;
	$previous_request = $_REQUEST;

	$_POST    = array_merge($_POST, $form);
	$_REQUEST = array_merge($_REQUEST, $form);

	$cart_item_data = apply_filters('woocommerce_add_cart_item_data', array(), $product_id, $variation_id, $quantity);
	$passed         = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity, $variation_id, $variations, $cart_item_data);

	if ($passed && false !== WC()->cart->add_to_cart($product_id, $quantity, $variation_id, $variations, $cart_item_data)) {
		do_action('woocommerce_ajax_added_to_cart', $product_id);

		$_POST    = $previous_post;
		$_REQUEST = $previous_request;

		wc_clear_notices();

		wp_send_json_success(array(
			'stickyCartHtml' => ff_menu_get_sticky_cart_html(),
			'cartCount'      => WC()->cart->get_cart_contents_count(),
			'cartTotal'      => wp_strip_all_tags(WC()->cart->get_cart_total()),
		));
	}

	$message = wc_print_notices(true);
	wc_clear_notices();

	$_POST    = $previous_post;
	$_REQUEST = $previous_request;

	wp_send_json_error(array(
		'message' => $message ? $message : __('Could not add this product to the cart.', 'ffkebab'),
	), 400);
}
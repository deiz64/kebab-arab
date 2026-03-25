<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Подключаем CSS только на шаблоне MENU.
 */
add_action( 'wp_enqueue_scripts', 'ffk_menu_page_assets', 40 );
function ffk_menu_page_assets() {
	if ( ! is_page_template( 'template-ffk-menu.php' ) ) {
		return;
	}

	$css_path = get_stylesheet_directory() . '/assets/css/ffk-menu-page.css';
	$css_uri  = get_stylesheet_directory_uri() . '/assets/css/ffk-menu-page.css';

	if ( file_exists( $css_path ) ) {
		wp_enqueue_style( 'ffk-menu-page-style', $css_uri, array(), filemtime( $css_path ) );
	}
}

/**
 * Список категорий MENU в нужном порядке.
 * ВАЖНО:
 * если slug у тебя другой — поменяй только slug здесь.
 */
function ffk_get_menu_categories_config() {
	return array(
		array(
			'slug'  => 'kebab',
			'title' => 'Kebab',
			'icon'  => '🌯',
		),
		array(
			'slug'  => 'kebab-special',
			'title' => 'Kebab Special',
			'icon'  => '🔥',
		),
		array(
			'slug'  => 'combo',
			'title' => 'Combo',
			'icon'  => '🍟',
		),
		array(
			'slug'  => 'baghete',
			'title' => 'Baghete',
			'icon'  => '🥖',
		),
		array(
			'slug'  => 'burger',
			'title' => 'Burger',
			'icon'  => '🍔',
		),
		array(
			'slug'  => 'crispy',
			'title' => 'Crispy',
			'icon'  => '🍗',
		),
		array(
			'slug'  => 'cartofi',
			'title' => 'Cartofi',
			'icon'  => '🍟',
		),
		array(
			'slug'  => 'salate',
			'title' => 'Salate',
			'icon'  => '🥗',
		),
		array(
			'slug'  => 'sosuri',
			'title' => 'Sosuri',
			'icon'  => '🥫',
		),
		array(
			'slug'  => 'bauturi',
			'title' => 'Băuturi',
			'icon'  => '🥤',
		),
		array(
			'slug'  => 'cafea',
			'title' => 'Cafea',
			'icon'  => '☕',
		),
		array(
			'slug'  => 'ceai',
			'title' => 'Ceai',
			'icon'  => '🍵',
		),
		array(
			'slug'  => 'dulce',
			'title' => 'Dulce',
			'icon'  => '🍰',
		),
	);
}

/**
 * Получить готовые карточки категорий.
 */
function ffk_get_menu_category_cards() {
	if ( ! class_exists( 'WooCommerce' ) ) {
		return array();
	}

	$config = ffk_get_menu_categories_config();
	$cards  = array();

	foreach ( $config as $item ) {
		$term = get_term_by( 'slug', $item['slug'], 'product_cat' );

		if ( ! $term || is_wp_error( $term ) ) {
			continue;
		}

		$link = get_term_link( $term );
		if ( is_wp_error( $link ) ) {
			continue;
		}

		$thumbnail_id = get_term_meta( $term->term_id, 'thumbnail_id', true );
		$image_url    = $thumbnail_id ? wp_get_attachment_image_url( $thumbnail_id, 'medium_large' ) : wc_placeholder_img_src();

		$cards[] = array(
			'title' => $item['title'],
			'icon'  => $item['icon'],
			'count' => (int) $term->count,
			'link'  => $link,
			'image' => $image_url,
		);
	}

	return $cards;
}
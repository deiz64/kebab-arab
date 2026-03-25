<?php
/**
 * Template Name: FFK Menu Categories
 */

defined( 'ABSPATH' ) || exit;

get_header();

if ( ! class_exists( 'WooCommerce' ) ) {
	echo '<div style="padding:40px;text-align:center;">WooCommerce nu este activ.</div>';
	get_footer();
	return;
}

/**
 * Порядок категорий.
 * ВАЖНО: slug должны совпадать с реальными slug категорий в WooCommerce.
 */
$menu_categories = array(
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

$cards = array();

foreach ( $menu_categories as $item ) {
	$term = get_term_by( 'slug', $item['slug'], 'product_cat' );

	if ( ! $term || is_wp_error( $term ) ) {
		continue;
	}

	$thumbnail_id = get_term_meta( $term->term_id, 'thumbnail_id', true );
	$image_url    = $thumbnail_id ? wp_get_attachment_image_url( $thumbnail_id, 'medium_large' ) : wc_placeholder_img_src();
	$link         = get_term_link( $term );

	if ( is_wp_error( $link ) ) {
		continue;
	}

	$cards[] = array(
		'title' => $item['title'],
		'icon'  => $item['icon'],
		'image' => $image_url,
		'link'  => $link,
		'count' => (int) $term->count,
	);
}
?>

<style>
.ffk-menu-page {
	background: #f7f5ef;
	padding: 0 0 50px;
}

.ffk-menu-hero {
	padding: 50px 20px 30px;
	text-align: center;
	background: #fff;
	border-bottom: 1px solid #ece7dd;
}

.ffk-menu-hero__title {
	margin: 0;
	font-size: 48px;
	line-height: 1.05;
	font-weight: 800;
	color: #161616;
}

.ffk-menu-hero__text {
	margin: 12px auto 0;
	max-width: 700px;
	font-size: 18px;
	line-height: 1.6;
	color: #666;
}

.ffk-menu-wrap {
	max-width: 1400px;
	margin: 0 auto;
	padding: 30px 20px 0;
}

.ffk-menu-grid {
	display: grid;
	grid-template-columns: repeat(4, minmax(0, 1fr));
	gap: 24px;
}

.ffk-menu-card {
	display: block;
	background: #fff;
	border-radius: 24px;
	overflow: hidden;
	text-decoration: none;
	box-shadow: 0 10px 24px rgba(0,0,0,.06);
	border: 1px solid #ece7dd;
	transition: transform .2s ease, box-shadow .2s ease;
}

.ffk-menu-card:hover {
	transform: translateY(-4px);
	box-shadow: 0 14px 28px rgba(0,0,0,.10);
}

.ffk-menu-card__image {
	aspect-ratio: 4 / 3;
	background: #f0f0f0;
	overflow: hidden;
}

.ffk-menu-card__image img {
	width: 100%;
	height: 100%;
	object-fit: cover;
	display: block;
}

.ffk-menu-card__body {
	padding: 18px 18px 20px;
}

.ffk-menu-card__top {
	display: flex;
	align-items: center;
	gap: 10px;
	margin-bottom: 10px;
}

.ffk-menu-card__icon {
	font-size: 22px;
	line-height: 1;
}

.ffk-menu-card__title {
	margin: 0;
	font-size: 24px;
	line-height: 1.15;
	font-weight: 800;
	color: #141414;
}

.ffk-menu-card__meta {
	font-size: 14px;
	line-height: 1.5;
	color: #777;
}

.ffk-menu-empty {
	padding: 40px 20px;
	text-align: center;
	font-size: 18px;
	color: #666;
}

@media (max-width: 1200px) {
	.ffk-menu-grid {
		grid-template-columns: repeat(3, minmax(0, 1fr));
	}
}

@media (max-width: 900px) {
	.ffk-menu-hero__title {
		font-size: 38px;
	}

	.ffk-menu-grid {
		grid-template-columns: repeat(2, minmax(0, 1fr));
	}
}

@media (max-width: 640px) {
	.ffk-menu-hero {
		padding: 36px 16px 22px;
	}

	.ffk-menu-hero__title {
		font-size: 30px;
	}

	.ffk-menu-hero__text {
		font-size: 16px;
	}

	.ffk-menu-wrap {
		padding: 20px 16px 0;
	}

	.ffk-menu-grid {
		grid-template-columns: 1fr;
		gap: 16px;
	}

	.ffk-menu-card__title {
		font-size: 22px;
	}
}
</style>

<div class="ffk-menu-page">
	<div class="ffk-menu-hero">
		<h1 class="ffk-menu-hero__title">Menu</h1>
		<div class="ffk-menu-hero__text">
			Alege categoria și vezi produsele.
		</div>
	</div>

	<div class="ffk-menu-wrap">
		<?php if ( empty( $cards ) ) : ?>
			<div class="ffk-menu-empty">Nu există categorii disponibile.</div>
		<?php else : ?>
			<div class="ffk-menu-grid">
				<?php foreach ( $cards as $card ) : ?>
					<a class="ffk-menu-card" href="<?php echo esc_url( $card['link'] ); ?>">
						<div class="ffk-menu-card__image">
							<img src="<?php echo esc_url( $card['image'] ); ?>" alt="<?php echo esc_attr( $card['title'] ); ?>">
						</div>
						<div class="ffk-menu-card__body">
							<div class="ffk-menu-card__top">
								<span class="ffk-menu-card__icon"><?php echo esc_html( $card['icon'] ); ?></span>
								<h2 class="ffk-menu-card__title"><?php echo esc_html( $card['title'] ); ?></h2>
							</div>
							<div class="ffk-menu-card__meta">
								<?php echo esc_html( $card['count'] ); ?> produse
							</div>
						</div>
					</a>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</div>

<?php
get_footer();
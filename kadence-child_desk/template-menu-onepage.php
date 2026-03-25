<?php
/**
 * Template Name: FFK Menu One Page
 */

defined( 'ABSPATH' ) || exit;

get_header();

if ( ! class_exists( 'WooCommerce' ) ) {
	echo '<div style="padding:40px;text-align:center;">WooCommerce nu este activ.</div>';
	get_footer();
	return;
}

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

$sections = array();

foreach ( $menu_categories as $item ) {
	$term = get_term_by( 'slug', $item['slug'], 'product_cat' );

	if ( ! $term || is_wp_error( $term ) ) {
		continue;
	}

	$query = new WP_Query(
		array(
			'post_type'           => 'product',
			'post_status'         => 'publish',
			'posts_per_page'      => -1,
			'ignore_sticky_posts' => true,
			'tax_query'           => array(
				array(
					'taxonomy' => 'product_cat',
					'field'    => 'term_id',
					'terms'    => $term->term_id,
				),
			),
			'orderby'             => array(
				'menu_order' => 'ASC',
				'title'      => 'ASC',
			),
		)
	);

	if ( ! $query->have_posts() ) {
		wp_reset_postdata();
		continue;
	}

	$sections[] = array(
		'term'  => $term,
		'title' => $item['title'],
		'icon'  => $item['icon'],
		'query' => $query,
	);
}
?>

<style>
.ffk-onepage-menu {
	background: #f5f5f2;
	padding-bottom: 50px;
}

.ffk-onepage-menu__hero {
	background: #fff;
	border-bottom: 1px solid #ebe7df;
	padding: 36px 20px 24px;
	text-align: center;
}

.ffk-onepage-menu__hero h1 {
	margin: 0;
	font-size: 44px;
	line-height: 1.05;
	font-weight: 800;
	color: #111;
}

.ffk-onepage-menu__hero p {
	margin: 10px auto 0;
	max-width: 720px;
	font-size: 17px;
	line-height: 1.6;
	color: #666;
}

.ffk-onepage-menu__nav-wrap {
	position: sticky;
	top: 0;
	z-index: 50;
	background: rgba(245,245,242,.96);
	backdrop-filter: blur(8px);
	border-bottom: 1px solid #e7e2d8;
}

body.admin-bar .ffk-onepage-menu__nav-wrap {
	top: 32px;
}

.ffk-onepage-menu__nav {
	max-width: 1400px;
	margin: 0 auto;
	padding: 12px 20px;
	display: flex;
	gap: 10px;
	overflow-x: auto;
	scrollbar-width: none;
}

.ffk-onepage-menu__nav::-webkit-scrollbar {
	display: none;
}

.ffk-onepage-menu__nav-link {
	flex: 0 0 auto;
	display: inline-flex;
	align-items: center;
	gap: 8px;
	padding: 12px 16px;
	border-radius: 999px;
	background: #fff;
	border: 1px solid #e7e2d8;
	color: #222;
	text-decoration: none;
	font-size: 15px;
	font-weight: 700;
	white-space: nowrap;
	transition: .2s ease;
}

.ffk-onepage-menu__nav-link:hover,
.ffk-onepage-menu__nav-link.is-active {
	background: #ef3b33;
	border-color: #ef3b33;
	color: #fff;
}

.ffk-onepage-menu__nav-icon {
	font-size: 16px;
	line-height: 1;
}

.ffk-onepage-menu__wrap {
	max-width: 1400px;
	margin: 0 auto;
	padding: 28px 20px 0;
}

.ffk-onepage-menu__section {
	padding-top: 26px;
	margin-top: 8px;
}

.ffk-onepage-menu__section-head {
	margin-bottom: 20px;
}

.ffk-onepage-menu__section-title {
	margin: 0;
	font-size: 38px;
	line-height: 1.08;
	font-weight: 800;
	color: #121212;
	text-transform: uppercase;
}

.ffk-onepage-menu__section-meta {
	margin-top: 8px;
	font-size: 15px;
	color: #777;
}

.ffk-onepage-menu__grid {
	display: grid;
	grid-template-columns: repeat(3, minmax(0, 1fr));
	gap: 24px;
}

.ffk-onepage-card {
	background: #fff;
	border-radius: 24px;
	overflow: hidden;
	border: 1px solid #e9e7e1;
	box-shadow: 0 10px 24px rgba(0,0,0,.05);
}

.ffk-onepage-card__image {
	display: block;
	aspect-ratio: 4 / 3;
	background: #efefef;
	overflow: hidden;
}

.ffk-onepage-card__image img {
	width: 100%;
	height: 100%;
	object-fit: cover;
	display: block;
}

.ffk-onepage-card__body {
	padding: 18px 18px 20px;
}

.ffk-onepage-card__title {
	margin: 0;
	font-size: 22px;
	line-height: 1.2;
	font-weight: 800;
}

.ffk-onepage-card__title a {
	color: #111;
	text-decoration: none;
}

.ffk-onepage-card__desc {
	margin-top: 10px;
	font-size: 15px;
	line-height: 1.55;
	color: #555;
	min-height: 48px;
}

.ffk-onepage-card__weight {
	margin-top: 10px;
	font-size: 15px;
	font-weight: 700;
	color: #333;
}

.ffk-onepage-card__bottom {
	margin-top: 18px;
	display: flex;
	align-items: center;
	justify-content: space-between;
	gap: 16px;
}

.ffk-onepage-card__price {
	font-size: 24px;
	font-weight: 900;
	color: #111;
}

.ffk-onepage-card__price .price {
	margin: 0;
	font-size: inherit;
	font-weight: inherit;
	color: inherit;
}

.ffk-onepage-card__price del {
	font-size: 16px;
	color: #999;
	margin-right: 8px;
}

.ffk-onepage-card__price ins {
	text-decoration: none;
}

.ffk-onepage-card__button {
	display: inline-flex;
	align-items: center;
	justify-content: center;
	min-width: 150px;
	min-height: 46px;
	padding: 0 18px;
	background: #ef3b33;
	color: #fff;
	text-decoration: none;
	border-radius: 14px;
	font-size: 15px;
	font-weight: 800;
	transition: .2s ease;
}

.ffk-onepage-card__button:hover {
	background: #d93029;
	color: #fff;
}

.ffk-onepage-menu__empty {
	padding: 40px 20px;
	text-align: center;
	font-size: 18px;
	color: #666;
}

@media (max-width: 1200px) {
	.ffk-onepage-menu__grid {
		grid-template-columns: repeat(2, minmax(0, 1fr));
	}
}

@media (max-width: 782px) {
	body.admin-bar .ffk-onepage-menu__nav-wrap {
		top: 46px;
	}
}

@media (max-width: 640px) {
	.ffk-onepage-menu__hero {
		padding: 28px 16px 18px;
	}

	.ffk-onepage-menu__hero h1 {
		font-size: 30px;
	}

	.ffk-onepage-menu__hero p {
		font-size: 15px;
	}

	.ffk-onepage-menu__nav {
		padding: 10px 16px;
	}

	.ffk-onepage-menu__wrap {
		padding: 20px 16px 0;
	}

	.ffk-onepage-menu__section-title {
		font-size: 28px;
	}

	.ffk-onepage-menu__grid {
		grid-template-columns: 1fr;
		gap: 18px;
	}
}
</style>

<div class="ffk-onepage-menu">
	<div class="ffk-onepage-menu__hero">
		<h1>Menu</h1>
		<p>Alege categoria și mergi rapid la produsele dorite.</p>
	</div>

	<?php if ( ! empty( $sections ) ) : ?>
		<div class="ffk-onepage-menu__nav-wrap">
			<div class="ffk-onepage-menu__nav">
				<?php foreach ( $sections as $index => $section ) : ?>
					<a class="ffk-onepage-menu__nav-link<?php echo 0 === $index ? ' is-active' : ''; ?>" href="#cat-<?php echo esc_attr( $section['term']->slug ); ?>">
						<span class="ffk-onepage-menu__nav-icon"><?php echo esc_html( $section['icon'] ); ?></span>
						<span><?php echo esc_html( $section['title'] ); ?></span>
					</a>
				<?php endforeach; ?>
			</div>
		</div>
	<?php endif; ?>

	<div class="ffk-onepage-menu__wrap">
		<?php if ( empty( $sections ) ) : ?>
			<div class="ffk-onepage-menu__empty">Nu există categorii sau produse disponibile.</div>
		<?php else : ?>
			<?php foreach ( $sections as $section ) : ?>
				<section id="cat-<?php echo esc_attr( $section['term']->slug ); ?>" class="ffk-onepage-menu__section">
					<div class="ffk-onepage-menu__section-head">
						<h2 class="ffk-onepage-menu__section-title">
							<?php echo esc_html( $section['title'] ); ?>
						</h2>
						<div class="ffk-onepage-menu__section-meta">
							<?php echo esc_html( $section['term']->count ); ?> produse
						</div>
					</div>

					<div class="ffk-onepage-menu__grid">
						<?php
						while ( $section['query']->have_posts() ) :
							$section['query']->the_post();
							$product = wc_get_product( get_the_ID() );

							if ( ! $product ) {
								continue;
							}

							$product_id  = $product->get_id();
							$product_url = get_permalink( $product_id );
							$price_html  = $product->get_price_html();
							$weight      = $product->get_weight();
							$unit        = get_option( 'woocommerce_weight_unit', 'g' );
							$short_desc  = $product->get_short_description();

							if ( '' === trim( wp_strip_all_tags( $short_desc ) ) ) {
								$short_desc = $product->get_description();
							}

							$short_desc = wp_trim_words( wp_strip_all_tags( $short_desc ), 16, '…' );
							?>
							<article class="ffk-onepage-card">
								<a class="ffk-onepage-card__image" href="<?php echo esc_url( $product_url ); ?>">
									<?php
									if ( has_post_thumbnail( $product_id ) ) {
										echo get_the_post_thumbnail( $product_id, 'medium_large' );
									} else {
										echo wc_placeholder_img( 'medium_large' );
									}
									?>
								</a>

								<div class="ffk-onepage-card__body">
									<h3 class="ffk-onepage-card__title">
										<a href="<?php echo esc_url( $product_url ); ?>">
											<?php echo esc_html( $product->get_name() ); ?>
										</a>
									</h3>

									<?php if ( $short_desc ) : ?>
										<div class="ffk-onepage-card__desc">
											<?php echo esc_html( $short_desc ); ?>
										</div>
									<?php endif; ?>

									<?php if ( '' !== $weight ) : ?>
										<div class="ffk-onepage-card__weight">
											<?php echo esc_html( $weight . ' ' . $unit ); ?>
										</div>
									<?php endif; ?>

									<div class="ffk-onepage-card__bottom">
										<div class="ffk-onepage-card__price">
											<?php echo wp_kses_post( $price_html ); ?>
										</div>

										<a class="ffk-onepage-card__button" href="<?php echo esc_url( $product_url ); ?>">
											Vezi produs
										</a>
									</div>
								</div>
							</article>
						<?php endwhile; wp_reset_postdata(); ?>
					</div>
				</section>
			<?php endforeach; ?>
		<?php endif; ?>
	</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
	const links = document.querySelectorAll('.ffk-onepage-menu__nav-link');
	const sections = document.querySelectorAll('.ffk-onepage-menu__section');

	links.forEach(function(link) {
		link.addEventListener('click', function(e) {
			e.preventDefault();

			const targetId = this.getAttribute('href');
			const target = document.querySelector(targetId);

			if (!target) return;

			const stickyNav = document.querySelector('.ffk-onepage-menu__nav-wrap');
			const headerOffset = stickyNav ? stickyNav.offsetHeight + 20 : 20;
			const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - headerOffset;

			window.scrollTo({
				top: targetPosition,
				behavior: 'smooth'
			});
		});
	});

	function setActiveLink() {
		let currentId = '';

		sections.forEach(function(section) {
			const rect = section.getBoundingClientRect();
			if (rect.top <= 140 && rect.bottom > 140) {
				currentId = '#' + section.getAttribute('id');
			}
		});

		links.forEach(function(link) {
			link.classList.remove('is-active');
			if (link.getAttribute('href') === currentId) {
				link.classList.add('is-active');
			}
		});
	}

	window.addEventListener('scroll', setActiveLink);
	setActiveLink();
});
</script>

<?php
get_footer();
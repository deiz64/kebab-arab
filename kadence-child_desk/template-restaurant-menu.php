<?php
/**
 * Template Name: Restaurant Menu
 */

defined( 'ABSPATH' ) || exit;

get_header();

if ( ! kc_restaurant_menu_has_woocommerce() ) :
	?>
	<div class="kc-menu-page">
		<div class="kc-menu-container">
			<div class="kc-menu-empty">WooCommerce nu este activ.</div>
		</div>
	</div>
	<?php
	get_footer();
	return;
endif;

$categories = kc_restaurant_menu_get_categories();
?>

<div class="kc-menu-page">
	<div class="kc-menu-hero">
		<div class="kc-menu-container">
			<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<h1 class="kc-menu-title"><?php the_title(); ?></h1>

					<?php if ( trim( get_the_excerpt() ) ) : ?>
						<div class="kc-menu-subtitle">
							<?php echo esc_html( wp_strip_all_tags( get_the_excerpt() ) ); ?>
						</div>
					<?php endif; ?>
				<?php endwhile; ?>
			<?php endif; ?>
		</div>
	</div>

	<div class="kc-menu-container">
		<?php if ( ! empty( $categories ) ) : ?>
			<nav class="kc-menu-nav" aria-label="Menu categories">
				<div class="kc-menu-nav__inner">
					<?php foreach ( $categories as $category ) : ?>
						<a class="kc-menu-nav__link" href="#kc-cat-<?php echo esc_attr( $category->slug ); ?>">
							<?php echo esc_html( $category->name ); ?>
						</a>
					<?php endforeach; ?>
				</div>
			</nav>
		<?php endif; ?>

		<?php
		if ( empty( $categories ) ) :
			echo '<div class="kc-menu-empty">Nu există produse în meniu.</div>';
		else :
			foreach ( $categories as $category ) :
				$products = wc_get_products(
					array(
						'status'   => 'publish',
						'limit'    => -1,
						'category' => array( $category->slug ),
						'orderby'  => 'menu_order',
						'order'    => 'ASC',
						'return'   => 'objects',
					)
				);

				if ( empty( $products ) ) {
					continue;
				}
				?>
				<section id="kc-cat-<?php echo esc_attr( $category->slug ); ?>" class="kc-menu-section">
					<header class="kc-menu-section__header">
						<h2 class="kc-menu-section__title"><?php echo esc_html( $category->name ); ?></h2>

						<?php if ( ! empty( $category->description ) ) : ?>
							<div class="kc-menu-section__desc">
								<?php echo esc_html( wp_strip_all_tags( $category->description ) ); ?>
							</div>
						<?php endif; ?>
					</header>

					<div class="kc-menu-grid">
						<?php
						foreach ( $products as $product ) {
							kc_restaurant_render_product_card( $product );
						}
						?>
					</div>
				</section>
				<?php
			endforeach;
		endif;
		?>
	</div>
</div>

<?php echo ff_menu_get_sticky_cart_html(); ?>

<div id="ff-menu-modal" class="ff-menu-modal" hidden>
	<div class="ff-menu-modal__backdrop js-ff-menu-close"></div>

	<div
		class="ff-menu-modal__dialog"
		role="dialog"
		aria-modal="true"
		aria-labelledby="ff-menu-modal-title"
	>
		<div class="ff-menu-modal__body js-ff-menu-modal-body"></div>
	</div>
</div>

<?php get_footer(); ?>
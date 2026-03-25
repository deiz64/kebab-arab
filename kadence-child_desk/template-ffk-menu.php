<?php
/**
 * Template Name: FFK Menu Safe
 */

defined( 'ABSPATH' ) || exit;

get_header();

$cards = function_exists( 'ffk_get_menu_category_cards' ) ? ffk_get_menu_category_cards() : array();
?>

<div class="ffk-menu-page">
	<div class="ffk-menu-page__hero">
		<div class="ffk-menu-page__hero-inner">
			<h1 class="ffk-menu-page__title">Menu</h1>
			<p class="ffk-menu-page__subtitle">Alege categoria și vezi produsele.</p>
		</div>
	</div>

	<div class="ffk-menu-page__wrap">
		<?php if ( empty( $cards ) ) : ?>
			<div class="ffk-menu-page__empty">Nu există categorii disponibile.</div>
		<?php else : ?>
			<div class="ffk-menu-page__grid">
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

							<div class="ffk-menu-card__button-wrap">
								<span class="ffk-menu-card__button">Vezi categoria</span>
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
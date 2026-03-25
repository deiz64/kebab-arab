<?php
/* ======================================================
   ПЕРЕОПРЕДЕЛЕНИЕ ТЕКСТА ОБЯЗАТЕЛЬНЫХ МОДИФИКАТОРОВ WCDM
   Файл: inc/wcdm-required-message.php
   ====================================================== */

defined( 'ABSPATH' ) || exit;

/* ------------------------------------------------------
   Подменяем стандартную строку плагина WCDM
   ------------------------------------------------------ */
add_filter( 'gettext', 'ff_wcdm_override_required_message', 20, 3 );

function ff_wcdm_override_required_message( $translation, $text, $domain ) {

	/* Работаем только со строками нужного плагина */
	if ( 'wcdm21' !== $domain ) {
		return $translation;
	}

	/* Подменяем только нужную строку обязательного выбора */
	if ( 'Grupul "%s" este obligatoriu.' !== $text ) {
		return $translation;
	}

	/* Определяем текущую локаль сайта */
	$locale = function_exists( 'determine_locale' ) ? determine_locale() : get_locale();
	$locale = strtolower( (string) $locale );

	/* Русский */
	if ( 0 === strpos( $locale, 'ru' ) ) {
		return 'Для этого товара нужно сначала выбрать обязательные добавки.';
	}

	/* Английский */
	if ( 0 === strpos( $locale, 'en' ) ) {
		return 'For this product, you need to select the required options first.';
	}

	/* По умолчанию — румынский */
	return 'Pentru acest produs, trebuie mai întâi să selectați opțiunile obligatorii.';
}
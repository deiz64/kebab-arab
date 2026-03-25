<?php
/**
 * Файл функций дочерней темы.
 * Содержит все настройки для кастомного меню-ресторана.
 */

defined('ABSPATH') || exit; // Защита от прямого доступа

/* ==================== ПОДКЛЮЧЕНИЕ ОСНОВНОГО ФАЙЛА МЕНЮ ==================== */
// В этом файле находятся функции для вывода меню (kc_*, ff_*)
require_once get_stylesheet_directory() . '/inc/restaurant-menu.php';
/* подключаем настройки UI меню */
require_once get_stylesheet_directory() . '/inc/menu-ui-settings.php';

//Тут написана будет группа модификаторов
require_once get_stylesheet_directory() . '/inc/wcdm-required-message.php';

/* ==================== ПОДКЛЮЧЕНИЕ СТИЛЕЙ И СКРИПТОВ ТОЛЬКО НА СТРАНИЦЕ /MENU/ ==================== */
add_action('wp_enqueue_scripts', 'ff_restaurant_menu_assets', 20);

function ff_restaurant_menu_assets() {
    // Если это не страница /menu/ – ничего не делаем
    if (!is_page('menu')) {
        return;
    }

    // Подключаем CSS файл
    $css_file = get_stylesheet_directory() . '/assets/css/restaurant-menu.css';
    wp_enqueue_style(
        'ff-restaurant-menu',
        get_stylesheet_directory_uri() . '/assets/css/restaurant-menu.css',
        array(),
        file_exists($css_file) ? filemtime($css_file) : null // версия = время изменения файла
    );

    // Подключаем JS файл
    $js_file = get_stylesheet_directory() . '/assets/js/restaurant-menu.js';
    wp_enqueue_script(
        'ff-restaurant-menu',
        get_stylesheet_directory_uri() . '/assets/js/restaurant-menu.js',
        array('jquery', 'wc-add-to-cart-variation'), // зависимости: jQuery и скрипт вариаций WooCommerce
        file_exists($js_file) ? filemtime($js_file) : null,
        true // подключать в подвале
    );

    // Передаём данные из PHP в JavaScript (для AJAX, форматирования цен и т.д.)
    wp_localize_script('ff-restaurant-menu', 'ffMenu', array(
        'ajaxUrl'                   => admin_url('admin-ajax.php'),
        'nonce'                     => wp_create_nonce('ff_menu_nonce'),
        'currencySymbol'            => function_exists('get_woocommerce_currency_symbol') ? html_entity_decode(get_woocommerce_currency_symbol(), ENT_QUOTES, 'UTF-8') : '',
        'currencyFormatNumDecimals' => function_exists('wc_get_price_decimals') ? wc_get_price_decimals() : 2,
        'currencyFormatDecimalSep'  => function_exists('wc_get_price_decimal_separator') ? wc_get_price_decimal_separator() : '.',
        'currencyFormatThousandSep' => function_exists('wc_get_price_thousand_separator') ? wc_get_price_thousand_separator() : ',',
        'currencyFormat'            => function_exists('get_woocommerce_price_format') ? get_woocommerce_price_format() : '%1$s%2$s',
        'phoneButtonSelector'       => '.ff-phone-button',
        'i18n' => array( // переводы для JS
            'loading'  => __('Loading…', 'ffkebab'),
            'error'    => __('Could not load product.', 'ffkebab'),
            'addError' => __('Could not add product to cart.', 'ffkebab'),
            'close'    => __('Close', 'ffkebab'),
            'add'      => __('ADD', 'ffkebab'),
        ),
    ));
}


/* ==================== ОТКЛЮЧЕНИЕ ЛИШНИХ СКРИПТОВ НА СТРАНИЦЕ /MENU/ ==================== */

/**
 * Отключаем скрипт навигации Kadence, который может конфликтовать с нашим меню.
 * Срабатывает с высоким приоритетом (100), чтобы отключить после регистрации.
 */
add_action('wp_enqueue_scripts', 'ff_menu_disable_kadence_navigation_js', 100);
function ff_menu_disable_kadence_navigation_js() {
    if (!is_page('menu')) {
        return;
    }
    // Удаляем стандартный скрипт навигации Kadence
    wp_dequeue_script('kadence-navigation');
    wp_deregister_script('kadence-navigation');

    // Дополнительно удаляем возможные связанные скрипты
    wp_dequeue_script('kadence-navigation-js-extra');
    wp_deregister_script('kadence-navigation-js-extra');

    wp_dequeue_script('navigation');
    wp_deregister_script('navigation');
}

add_action('wp_enqueue_scripts', 'ffk_shop_assets', 20);

function ffk_shop_assets() {
    if (!is_shop() && !is_product_taxonomy()) {
        return;
    }

    $css_file = get_stylesheet_directory() . '/assets/css/ffk-shop.css';

    if (file_exists($css_file)) {
        wp_enqueue_style(
            'ffk-shop',
            get_stylesheet_directory_uri() . '/assets/css/ffk-shop.css',
            array(),
            filemtime($css_file)
        );
    }
}

add_action('after_setup_theme', 'ffk_child_theme_setup');
function ffk_child_theme_setup() {
    add_theme_support('woocommerce');
}

/**
 * Отключаем тяжёлые скрипты WooCommerce на странице меню (чтобы ускорить загрузку).
 * Они нам не нужны, потому что у нас своя AJAX-корзина.
 */
add_action('wp_enqueue_scripts', 'ff_menu_remove_wc_scripts', 100);
function ff_menu_remove_wc_scripts() {
    if (!is_page('menu')) {
        return;
    }
    // Фрагменты корзины (cart fragments) – самый тяжёлый скрипт
    wp_dequeue_script('wc-cart-fragments');
    // Стандартный скрипт добавления в корзину WooCommerce
    wp_dequeue_script('wc-add-to-cart');
    // Основной скрипт WooCommerce
    wp_dequeue_script('woocommerce');
    // Скрипты блоков (Gutenberg)
    wp_dequeue_script('wc-blocks');
}


    

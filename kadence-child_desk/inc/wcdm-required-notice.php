<?php
/**
 * FF Kebab - Перехват валидации WCDM
 * Возвращает JSON флаг вместо HTML
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('WCDM_Plugin')) {
    return;
}

/**
 * Перехватываем ПОСЛЕ WCDM (приоритет 15, WCDM использует 10)
 */
add_filter('woocommerce_add_to_cart_validation', 'ffk_wcdm_intercept_validation', 15, 3);
function ffk_wcdm_intercept_validation($passed, $product_id, $quantity) {
    
    if (!wp_doing_ajax()) {
        return $passed;
    }
    
    $action = $_POST['action'] ?? '';
    if ($action !== 'ff_menu_add_to_cart') {
        return $passed;
    }
    
    $notices = wc_get_notices('error');
    $has_wcdm_error = false;
    
    foreach ($notices as $notice) {
        $notice_text = $notice['notice'] ?? '';
        if (strpos($notice_text, 'Grupul') !== false || 
            strpos($notice_text, 'obligatoriu') !== false ||
            strpos($notice_text, 'обязательн') !== false ||
            strpos($notice_text, 'Topping') !== false) {
            $has_wcdm_error = true;
            break;
        }
    }
    
    if ($has_wcdm_error) {
        wc_clear_notices();
        
        // Сохраняем флаг в transient
        set_transient('ffk_wcdm_missing_' . get_current_user_id(), true, 30);
        
        add_filter('woocommerce_ajax_add_to_cart_error', 'ffk_wcdm_custom_ajax_response', 100, 2);
        
        return false;
    }
    
    return $passed;
}

/**
 * Возвращаем JSON флаг
 */
function ffk_wcdm_custom_ajax_response($error, $product) {
    $has_missing = get_transient('ffk_wcdm_missing_' . get_current_user_id());
    delete_transient('ffk_wcdm_missing_' . get_current_user_id());
    
    return array(
        'error'                => true,
        'ffk_missing_required' => (bool) $has_missing,
        'product_id'           => $product ? $product->get_id() : 0
    );
}
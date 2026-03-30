<?php
/* ======================================================
   FFKebab Menu UI Builder
   Файл: inc/menu-ui-settings.php
   ====================================================== */

defined('ABSPATH') || exit;

/* ------------------------------------------------------
   1. Дефолты
   ------------------------------------------------------ */
function ff_menu_ui_get_defaults() {
	return array(

		/* ---------- сетка карточек меню ---------- */
		'ff_menu_grid_container_max_width'   => 1400,
		'ff_menu_grid_container_side_padding'=> 16,
		'ff_menu_grid_cols_desktop'          => 4,
		'ff_menu_grid_cols_laptop'           => 3,
		'ff_menu_grid_cols_tablet'           => 2,
		'ff_menu_grid_cols_mobile'           => 1,
		'ff_menu_grid_gap_x'                 => 24,
		'ff_menu_grid_gap_y'                 => 24,

		/* ---------- карточки товаров ---------- */
		'ff_menu_card_padding'               => 16,
		'ff_menu_card_radius'                => 16,
		'ff_menu_card_bg'                    => '#ffffff',
		'ff_menu_card_border_color'          => '#eeeeee',
		'ff_menu_card_border_width'          => 1,
		'ff_menu_card_title_size'            => 22,
		'ff_menu_card_desc_size'             => 14,
		'ff_menu_card_price_size'            => 18,
		'ff_menu_card_footer_gap'            => 12,
		'ff_menu_card_img_height_desktop'    => 220,
		'ff_menu_card_img_height_tablet'     => 220,
		'ff_menu_card_img_height_mobile'     => 220,
		'ff_menu_card_img_ratio_desktop'     => '4 / 3',
		'ff_menu_card_img_ratio_tablet'      => '4 / 3',
		'ff_menu_card_img_ratio_mobile'      => '16 / 9',
		'ff_menu_card_img_fit_mode'          => 'cover',
		'ff_menu_card_button_radius'         => 10,
		'ff_menu_card_button_bg'             => '#e31e24',
		'ff_menu_card_button_text'           => '#ffffff',
		'ff_menu_card_button_font_size'      => 15,

		/* ---------- popup desktop ---------- */
		'ff_menu_popup_width_px'             => 1100,
		'ff_menu_popup_min_width_px'         => 700,
		'ff_menu_popup_max_width_px'         => 1400,
		'ff_menu_popup_height_vh'            => 90,
		'ff_menu_popup_radius'               => 24,
		'ff_menu_popup_padding'              => 24,
		'ff_menu_popup_gap'                  => 0,
		'ff_menu_popup_summary_width'        => 420,
		'ff_menu_popup_image_ratio'          => '4 / 3',
		'ff_menu_popup_image_radius'         => 18,
		'ff_menu_popup_summary_padding_bottom'=> 130,
		'ff_menu_popup_overlay_opacity'      => 56,
		'ff_menu_popup_overlay_blur'         => 2,

		/* ---------- popup mobile ---------- */
		'ff_menu_popup_mobile_height_dvh'             => 100,
		'ff_menu_popup_mobile_radius'                 => 20,
		'ff_menu_popup_mobile_image_ratio'            => '16 / 10',
		'ff_menu_popup_mobile_footer_padding'         => 12,
		'ff_menu_popup_mobile_summary_padding_bottom' => 4,
		'ff_menu_popup_mobile_image_margin_bottom'    => 10,
		'ff_menu_popup_mobile_title_margin_bottom'    => 6,
		'ff_menu_popup_mobile_desc_margin_bottom'     => 8,
		'ff_menu_popup_mobile_price_margin_bottom'    => 6,
		'ff_menu_popup_mobile_options_padding_top'    => 8,

		/* ---------- внутренняя сетка popup ---------- */
		'ff_menu_popup_group_gap'            => 18,
		'ff_menu_popup_group_radius'         => 14,
		'ff_menu_popup_group_padding'        => 0,
		'ff_menu_popup_group_bg'             => '#ffffff',
		'ff_menu_popup_group_border_color'   => '#ececec',
		'ff_menu_popup_group_border_width'   => 1,

		/* ---------- notice / ошибки ---------- */
		'ff_menu_notice_text'                => 'Выберите обязательные опции',
		'ff_menu_notice_font_size'           => 15,
		'ff_menu_notice_text_color'          => '#111827',
		'ff_menu_notice_bg_color'            => '#fff7ed',
		'ff_menu_notice_border_color'        => '#fdba74',
		'ff_menu_notice_border_width'        => 1,
		'ff_menu_notice_radius'              => 16,
		'ff_menu_notice_padding_y'           => 12,
		'ff_menu_notice_padding_x'           => 14,
		'ff_menu_notice_margin_bottom'       => 16,
		'ff_menu_notice_max_width'           => 100,
		'ff_menu_notice_show_icon'           => 1,
		'ff_menu_notice_icon_size'           => 18,

		/* ---------- подсветка обязательной группы ---------- */
		'ff_menu_required_group_border_color'=> '#ef4444',
		'ff_menu_required_group_bg_color'    => '#fef2f2',
		'ff_menu_required_group_border_width'=> 1,
		'ff_menu_required_group_radius'      => 16,
		'ff_menu_required_group_padding'     => 12,
		'ff_menu_required_group_scroll_offset'=> 18,
		'ff_menu_required_group_autoscroll'  => 1,
		'ff_menu_required_group_highlight'   => 1,

		/* ---------- footer popup ---------- */
		'ff_menu_footer_padding_y'           => 16,
		'ff_menu_qty_width'                  => 64,
		'ff_menu_add_button_height'          => 52,
		'ff_menu_footer_bg_opacity'          => 98,
		'ff_menu_footer_blur'                => 8,

		/* ---------- верхние категории ---------- */
		'ff_menu_nav_top'                    => 70,
		'ff_menu_nav_blur'                   => 12,
		'ff_menu_nav_bg_opacity'             => 0.88,
		'ff_menu_nav_link_radius'            => 999,
		'ff_menu_nav_active_bg'              => '#e31e24',
		'ff_menu_nav_active_text'            => '#ffffff',
		'ff_menu_nav_gap'                    => 10,
		'ff_menu_nav_font_size'              => 16,

		/* ---------- sticky cart ---------- */
		'ff_menu_sticky_cart_radius'         => 18,
		'ff_menu_sticky_cart_bg'             => '#111827',
		'ff_menu_sticky_cart_text'           => '#ffffff',
		'ff_menu_sticky_cart_bottom'         => 16,
		'ff_menu_sticky_cart_side'           => 16,

		/* ---------- тексты интерфейса ---------- */
		'ff_menu_text_loading'               => 'Загрузка...',
		'ff_menu_text_notice_button'         => 'Выбрать ингредиенты',
		'ff_menu_text_close_button'          => 'Закрыть',
		'ff_menu_text_load_error'            => 'Не удалось загрузить товар.',
		'ff_menu_text_required_error'        => 'Выберите обязательные опции',
		'ff_menu_text_special_request_label' => 'Особые пожелания',
		'ff_menu_text_special_request_placeholder' => 'Например: без капусты, без моркови, меньше соуса',
	);
}

function ff_menu_ui_get_sections() {
	return array(
		'grid' => array(
			'label'   => 'Сетка карточек меню',
			'options' => array(
				'ff_menu_grid_container_max_width',
				'ff_menu_grid_container_side_padding',
				'ff_menu_grid_cols_desktop',
				'ff_menu_grid_cols_laptop',
				'ff_menu_grid_cols_tablet',
				'ff_menu_grid_cols_mobile',
				'ff_menu_grid_gap_x',
				'ff_menu_grid_gap_y',
			),
		),
		'cards' => array(
			'label'   => 'Карточки товаров',
			'options' => array(
				'ff_menu_card_padding',
				'ff_menu_card_radius',
				'ff_menu_card_bg',
				'ff_menu_card_border_color',
				'ff_menu_card_border_width',
				'ff_menu_card_title_size',
				'ff_menu_card_desc_size',
				'ff_menu_card_price_size',
				'ff_menu_card_footer_gap',
				'ff_menu_card_img_height_desktop',
				'ff_menu_card_img_height_tablet',
				'ff_menu_card_img_height_mobile',
				'ff_menu_card_img_ratio_desktop',
				'ff_menu_card_img_ratio_tablet',
				'ff_menu_card_img_ratio_mobile',
				'ff_menu_card_img_fit_mode',
				'ff_menu_card_button_radius',
				'ff_menu_card_button_bg',
				'ff_menu_card_button_text',
				'ff_menu_card_button_font_size',
			),
		),
		'popup_desktop' => array(
			'label'   => 'Popup desktop',
			'options' => array(
				'ff_menu_popup_width_px',
				'ff_menu_popup_min_width_px',
				'ff_menu_popup_max_width_px',
				'ff_menu_popup_height_vh',
				'ff_menu_popup_radius',
				'ff_menu_popup_padding',
				'ff_menu_popup_gap',
				'ff_menu_popup_summary_width',
				'ff_menu_popup_image_ratio',
				'ff_menu_popup_image_radius',
				'ff_menu_popup_summary_padding_bottom',
				'ff_menu_popup_overlay_opacity',
				'ff_menu_popup_overlay_blur',
			),
		),
		'popup_mobile' => array(
			'label'   => 'Popup mobile',
			'options' => array(
				'ff_menu_popup_mobile_height_dvh',
				'ff_menu_popup_mobile_radius',
				'ff_menu_popup_mobile_image_ratio',
				'ff_menu_popup_mobile_footer_padding',
				'ff_menu_popup_mobile_summary_padding_bottom',
				'ff_menu_popup_mobile_image_margin_bottom',
				'ff_menu_popup_mobile_title_margin_bottom',
				'ff_menu_popup_mobile_desc_margin_bottom',
				'ff_menu_popup_mobile_price_margin_bottom',
				'ff_menu_popup_mobile_options_padding_top',
			),
		),
		'popup_grid' => array(
			'label'   => 'Внутренняя сетка popup',
			'options' => array(
				'ff_menu_popup_group_gap',
				'ff_menu_popup_group_radius',
				'ff_menu_popup_group_padding',
				'ff_menu_popup_group_bg',
				'ff_menu_popup_group_border_color',
				'ff_menu_popup_group_border_width',
			),
		),
		'notice' => array(
			'label'   => 'Notice / ошибки',
			'options' => array(
				'ff_menu_notice_text',
				'ff_menu_notice_font_size',
				'ff_menu_notice_text_color',
				'ff_menu_notice_bg_color',
				'ff_menu_notice_border_color',
				'ff_menu_notice_border_width',
				'ff_menu_notice_radius',
				'ff_menu_notice_padding_y',
				'ff_menu_notice_padding_x',
				'ff_menu_notice_margin_bottom',
				'ff_menu_notice_max_width',
				'ff_menu_notice_show_icon',
				'ff_menu_notice_icon_size',
			),
		),
		'highlight' => array(
			'label'   => 'Подсветка обязательных групп',
			'options' => array(
				'ff_menu_required_group_border_color',
				'ff_menu_required_group_bg_color',
				'ff_menu_required_group_border_width',
				'ff_menu_required_group_radius',
				'ff_menu_required_group_padding',
				'ff_menu_required_group_scroll_offset',
				'ff_menu_required_group_autoscroll',
				'ff_menu_required_group_highlight',
			),
		),
		'footer' => array(
			'label'   => 'Нижняя панель popup',
			'options' => array(
				'ff_menu_footer_padding_y',
				'ff_menu_qty_width',
				'ff_menu_add_button_height',
				'ff_menu_footer_bg_opacity',
				'ff_menu_footer_blur',
			),
		),
		'nav' => array(
			'label'   => 'Категории сверху',
			'options' => array(
				'ff_menu_nav_top',
				'ff_menu_nav_blur',
				'ff_menu_nav_bg_opacity',
				'ff_menu_nav_link_radius',
				'ff_menu_nav_active_bg',
				'ff_menu_nav_active_text',
				'ff_menu_nav_gap',
				'ff_menu_nav_font_size',
			),
		),
		'sticky' => array(
			'label'   => 'Sticky cart',
			'options' => array(
				'ff_menu_sticky_cart_radius',
				'ff_menu_sticky_cart_bg',
				'ff_menu_sticky_cart_text',
				'ff_menu_sticky_cart_bottom',
				'ff_menu_sticky_cart_side',
			),
		),
		'texts' => array(
			'label'   => 'Тексты интерфейса',
			'options' => array(
				'ff_menu_text_loading',
				'ff_menu_text_notice_button',
				'ff_menu_text_close_button',
				'ff_menu_text_load_error',
				'ff_menu_text_required_error',
				'ff_menu_text_special_request_label',
				'ff_menu_text_special_request_placeholder',
			),
		),
	);
}

function ff_menu_ui_get($name) {
	$defaults = ff_menu_ui_get_defaults();
	return get_option($name, isset($defaults[$name]) ? $defaults[$name] : '');
}

function ff_menu_ui_sanitize_option($option_name, $value) {
	$text_options = array(
		'ff_menu_notice_text',
		'ff_menu_text_loading',
		'ff_menu_text_notice_button',
		'ff_menu_text_close_button',
		'ff_menu_text_load_error',
		'ff_menu_text_required_error',
		'ff_menu_text_special_request_label',
	);
	$textarea_options = array(
		'ff_menu_text_special_request_placeholder',
	);
	$checkbox_options = array(
		'ff_menu_notice_show_icon',
		'ff_menu_required_group_autoscroll',
		'ff_menu_required_group_highlight',
	);
	$hex_options = array(
		'ff_menu_card_bg',
		'ff_menu_card_border_color',
		'ff_menu_card_button_bg',
		'ff_menu_card_button_text',
		'ff_menu_popup_group_bg',
		'ff_menu_popup_group_border_color',
		'ff_menu_notice_text_color',
		'ff_menu_notice_bg_color',
		'ff_menu_notice_border_color',
		'ff_menu_required_group_border_color',
		'ff_menu_required_group_bg_color',
		'ff_menu_nav_active_bg',
		'ff_menu_nav_active_text',
		'ff_menu_sticky_cart_bg',
		'ff_menu_sticky_cart_text',
	);
	$ratio_options = array(
		'ff_menu_card_img_ratio_desktop',
		'ff_menu_card_img_ratio_tablet',
		'ff_menu_card_img_ratio_mobile',
		'ff_menu_popup_image_ratio',
		'ff_menu_popup_mobile_image_ratio',
	);
	$fit_mode_options = array(
		'ff_menu_card_img_fit_mode',
	);
	$float_options = array(
		'ff_menu_nav_bg_opacity',
	);

	if (in_array($option_name, $text_options, true)) {
		return sanitize_text_field($value);
	}

	if (in_array($option_name, $textarea_options, true)) {
		return sanitize_textarea_field($value);
	}

	if (in_array($option_name, $checkbox_options, true)) {
		return empty($value) ? 0 : 1;
	}

	if (in_array($option_name, $hex_options, true)) {
		$sanitized = sanitize_hex_color($value);
		$defaults = ff_menu_ui_get_defaults();
		return $sanitized ?: (isset($defaults[$option_name]) ? $defaults[$option_name] : '');
	}

	if (in_array($option_name, $ratio_options, true)) {
		$options = ff_menu_ui_ratio_options();
		return isset($options[$value]) ? $value : ff_menu_ui_get_defaults()[$option_name];
	}

	if (in_array($option_name, $fit_mode_options, true)) {
		$options = ff_menu_ui_fit_mode_options();
		return isset($options[$value]) ? $value : ff_menu_ui_get_defaults()[$option_name];
	}

	if (in_array($option_name, $float_options, true)) {
		return floatval($value);
	}

	return intval($value);
}

function ff_menu_ui_get_frontend_config() {
	return array(
		'texts' => array(
			'loading'       => (string) ff_menu_ui_get('ff_menu_text_loading'),
			'noticeButton'  => (string) ff_menu_ui_get('ff_menu_text_notice_button'),
			'closeButton'   => (string) ff_menu_ui_get('ff_menu_text_close_button'),
			'loadError'     => (string) ff_menu_ui_get('ff_menu_text_load_error'),
			'requiredError' => (string) ff_menu_ui_get('ff_menu_text_required_error'),
		),
		'behavior' => array(
			'showNoticeIcon'         => (int) ff_menu_ui_get('ff_menu_notice_show_icon') === 1,
			'requiredGroupHighlight' => (int) ff_menu_ui_get('ff_menu_required_group_highlight') === 1,
			'requiredGroupAutoscroll'=> (int) ff_menu_ui_get('ff_menu_required_group_autoscroll') === 1,
			'requiredGroupScrollOffset' => max(0, intval(ff_menu_ui_get('ff_menu_required_group_scroll_offset'))),
		),
	);
}

/* ------------------------------------------------------
   2. Меню в админке
   ------------------------------------------------------ */
add_action('admin_menu', 'ff_menu_ui_add_admin_page');

function ff_menu_ui_add_admin_page() {
	add_theme_page(
		'FFKebab UI Builder',
		'FFKebab UI',
		'manage_options',
		'ff-menu-ui-settings',
		'ff_menu_ui_render_page'
	);
}

/* ------------------------------------------------------
   3. Регистрация настроек
   ------------------------------------------------------ */
add_action('admin_init', 'ff_menu_ui_register_settings');

function ff_menu_ui_register_settings() {
	foreach (ff_menu_ui_get_defaults() as $option_name => $default_value) {
		register_setting('ff_menu_ui_group', $option_name, array(
			'sanitize_callback' => function ($value) use ($option_name) {
				return ff_menu_ui_sanitize_option($option_name, $value);
			},
		));
	}
}

/* ------------------------------------------------------
   4. Заполнение пустых значений дефолтами
   ------------------------------------------------------ */
add_action('admin_init', 'ff_menu_ui_fill_empty_defaults', 20);

function ff_menu_ui_fill_empty_defaults() {
	foreach (ff_menu_ui_get_defaults() as $option_name => $default_value) {
		$current_value = get_option($option_name, null);
		if ($current_value === '' || $current_value === null) {
			update_option($option_name, $default_value);
		}
	}
}

/* ------------------------------------------------------
   5. Reset: обработка
   ------------------------------------------------------ */
add_action('admin_post_ff_menu_ui_reset', 'ff_menu_ui_handle_reset');

function ff_menu_ui_handle_reset() {
	if (! current_user_can('manage_options')) {
		wp_die('Недостаточно прав.');
	}

	check_admin_referer('ff_menu_ui_reset_action', 'ff_menu_ui_reset_nonce');

	$section = '';
	if (isset($_POST['ff_menu_ui_reset_section'])) {
		$section = sanitize_text_field(wp_unslash($_POST['ff_menu_ui_reset_section']));
	} elseif (isset($_GET['ff_menu_ui_reset_section'])) {
		$section = sanitize_text_field(wp_unslash($_GET['ff_menu_ui_reset_section']));
	} else {
		$section = 'all';
	}

	$defaults = ff_menu_ui_get_defaults();
	$sections = ff_menu_ui_get_sections();

	if ($section === 'all') {
		foreach ($defaults as $option_name => $default_value) {
			update_option($option_name, $default_value);
		}
		$notice = 'reset_all';
	} elseif (isset($sections[$section])) {
		foreach ($sections[$section]['options'] as $option_name) {
			if (array_key_exists($option_name, $defaults)) {
				update_option($option_name, $defaults[$option_name]);
			}
		}
		$notice = 'reset_' . $section;
	} else {
		$notice = 'reset_invalid';
	}

	$redirect = add_query_arg(
		array(
			'page'   => 'ff-menu-ui-settings',
			'notice' => $notice,
		),
		admin_url('themes.php')
	);

	wp_safe_redirect($redirect);
	exit;
}

/* ------------------------------------------------------
   6. Admin notice после reset
   ------------------------------------------------------ */
add_action('admin_notices', 'ff_menu_ui_admin_notices');

function ff_menu_ui_admin_notices() {
	if (! isset($_GET['page']) || $_GET['page'] !== 'ff-menu-ui-settings' || empty($_GET['notice'])) {
		return;
	}

	$notice = sanitize_text_field(wp_unslash($_GET['notice']));
	$map = array(
		'reset_all'           => 'Все настройки UI сброшены к значениям по умолчанию.',
		'reset_grid'          => 'Сетка карточек сброшена к значениям по умолчанию.',
		'reset_cards'         => 'Карточки товаров сброшены к значениям по умолчанию.',
		'reset_popup_desktop' => 'Настройки desktop popup сброшены к значениям по умолчанию.',
		'reset_popup_mobile'  => 'Настройки mobile popup сброшены к значениям по умолчанию.',
		'reset_popup_grid'    => 'Внутренняя сетка popup сброшена к значениям по умолчанию.',
		'reset_notice'        => 'Notice / ошибки сброшены к значениям по умолчанию.',
		'reset_highlight'     => 'Подсветка обязательных групп сброшена к значениям по умолчанию.',
		'reset_footer'        => 'Нижняя панель popup сброшена к значениям по умолчанию.',
		'reset_nav'           => 'Категории сверху сброшены к значениям по умолчанию.',
		'reset_sticky'        => 'Sticky cart сброшен к значениям по умолчанию.',
		'reset_texts'         => 'Тексты интерфейса сброшены к значениям по умолчанию.',
	);

	if (! isset($map[$notice])) {
		return;
	}

	echo '<div class="notice notice-success is-dismissible"><p>' . esc_html($map[$notice]) . '</p></div>';
}

/* ------------------------------------------------------
   7. Варианты пропорций
   ------------------------------------------------------ */
function ff_menu_ui_ratio_options() {
	return array(
		'1 / 1'   => '1 : 1 (квадрат)',
		'4 / 3'   => '4 : 3 (классика)',
		'3 / 2'   => '3 : 2',
		'16 / 10' => '16 : 10',
		'16 / 9'  => '16 : 9 (широкое)',
	);
}

function ff_menu_ui_fit_mode_options() {
	return array(
		'cover'   => 'cover',
		'contain' => 'contain',
	);
}

/* ------------------------------------------------------
   8. Вспомогательные поля
   ------------------------------------------------------ */
function ff_menu_ui_render_number_input($name, $value, $min = '', $max = '', $step = '1') {
	?>
	<input
		type="number"
		name="<?php echo esc_attr($name); ?>"
		value="<?php echo esc_attr($value); ?>"
		<?php echo $min !== '' ? 'min="' . esc_attr($min) . '"' : ''; ?>
		<?php echo $max !== '' ? 'max="' . esc_attr($max) . '"' : ''; ?>
		step="<?php echo esc_attr($step); ?>"
		class="regular-text"
	>
	<?php
}

function ff_menu_ui_render_color_input($name, $value) {
	?>
	<input
		type="color"
		name="<?php echo esc_attr($name); ?>"
		value="<?php echo esc_attr($value); ?>"
	>
	<?php
}

function ff_menu_ui_render_select_input($name, $current_value, $options) {
	?>
	<select name="<?php echo esc_attr($name); ?>">
		<?php foreach ($options as $value => $label) : ?>
			<option value="<?php echo esc_attr($value); ?>" <?php selected($current_value, $value); ?>>
				<?php echo esc_html($label); ?>
			</option>
		<?php endforeach; ?>
	</select>
	<?php
}

function ff_menu_ui_render_checkbox_input($name, $checked_value) {
	?>
	<input type="hidden" name="<?php echo esc_attr($name); ?>" value="0">
	<label>
		<input type="checkbox" name="<?php echo esc_attr($name); ?>" value="1" <?php checked((int) $checked_value, 1); ?>>
		Включено
	</label>
	<?php
}

function ff_menu_ui_render_text_input($name, $value, $placeholder = '') {
	?>
	<input
		type="text"
		name="<?php echo esc_attr($name); ?>"
		value="<?php echo esc_attr($value); ?>"
		placeholder="<?php echo esc_attr($placeholder); ?>"
		class="regular-text"
	>
	<?php
}

function ff_menu_ui_render_textarea_input($name, $value, $rows = 2) {
	?>
	<textarea
		name="<?php echo esc_attr($name); ?>"
		rows="<?php echo (int) $rows; ?>"
		class="large-text"
	><?php echo esc_textarea($value); ?></textarea>
	<?php
}

function ff_menu_ui_render_reset_link($section_key, $label = 'Сбросить секцию') {
	$url = wp_nonce_url(
		admin_url('admin-post.php?action=ff_menu_ui_reset&ff_menu_ui_reset_section=' . rawurlencode($section_key)),
		'ff_menu_ui_reset_action',
		'ff_menu_ui_reset_nonce'
	);
	?>
	<a
		href="<?php echo esc_url($url); ?>"
		class="button button-secondary"
		onclick="return confirm('Сбросить эту секцию к значениям по умолчанию?');"
	>
		<?php echo esc_html($label); ?>
	</a>
	<?php
}

function ff_menu_ui_render_reset_all_link() {
	$url = wp_nonce_url(
		admin_url('admin-post.php?action=ff_menu_ui_reset&ff_menu_ui_reset_section=all'),
		'ff_menu_ui_reset_action',
		'ff_menu_ui_reset_nonce'
	);
	?>
	<a
		href="<?php echo esc_url($url); ?>"
		class="button button-secondary"
		onclick="return confirm('Сбросить ВСЕ настройки UI к значениям по умолчанию?');"
	>
		Сбросить все настройки UI
	</a>
	<?php
}

function ff_menu_ui_render_slider_input($name, $value, $min, $max, $step = '1', $unit = '') {
	$defaults      = ff_menu_ui_get_defaults();
	$default_value = isset($defaults[$name]) ? $defaults[$name] : $value;
	$range_id      = 'ff_range_' . sanitize_html_class($name);
	$number_id     = 'ff_num_' . sanitize_html_class($name);
	$default_pct   = 0;

	if ((float) $max > (float) $min) {
		$default_pct = (((float) $default_value - (float) $min) / ((float) $max - (float) $min)) * 100;
		$default_pct = max(0, min(100, $default_pct));
	}
	?>
	<div class="ff-ui-slider" data-name="<?php echo esc_attr($name); ?>">
		<div class="ff-ui-slider__row">
			<div class="ff-ui-slider__track-wrap">
				<input
					type="range"
					id="<?php echo esc_attr($range_id); ?>"
					min="<?php echo esc_attr($min); ?>"
					max="<?php echo esc_attr($max); ?>"
					step="<?php echo esc_attr($step); ?>"
					value="<?php echo esc_attr($value); ?>"
					class="ff-ui-slider__range"
				>
				<span class="ff-ui-slider__default-mark" style="left: <?php echo esc_attr($default_pct); ?>%;" title="Default: <?php echo esc_attr($default_value); ?>"></span>
			</div>
			<input
				type="number"
				id="<?php echo esc_attr($number_id); ?>"
				name="<?php echo esc_attr($name); ?>"
				min="<?php echo esc_attr($min); ?>"
				max="<?php echo esc_attr($max); ?>"
				step="<?php echo esc_attr($step); ?>"
				value="<?php echo esc_attr($value); ?>"
				class="small-text ff-ui-slider__number"
			>
		</div>
		<div class="ff-ui-slider__meta">
			<span>Current: <strong class="ff-ui-slider__current"><?php echo esc_html($value); ?></strong><?php echo $unit ? ' ' . esc_html($unit) : ''; ?></span>
			<span>Default: <strong><?php echo esc_html($default_value); ?></strong><?php echo $unit ? ' ' . esc_html($unit) : ''; ?></span>
		</div>
	</div>
	<?php
}

/* ------------------------------------------------------
   9. Рендер страницы настроек
   ------------------------------------------------------ */
function ff_menu_ui_render_page() {
	if (! current_user_can('manage_options')) {
		return;
	}

	$ratio_options    = ff_menu_ui_ratio_options();
	$fit_mode_options = ff_menu_ui_fit_mode_options();
	$palette_image_url = get_stylesheet_directory_uri() . '/assets/img/hexcodesofcolors.png';
	?>
	<div class="wrap ff-ui-builder-wrap">
		<h1>FFKebab UI Builder</h1>
		<p>Настройки страницы меню, карточек товаров, popup, mobile popup, notice и основных UI-элементов.</p>

		<style>
			.ff-ui-builder-wrap .ff-ui-topbar{
				display:flex;gap:12px;align-items:center;justify-content:space-between;flex-wrap:wrap;
				margin:18px 0 22px;padding:14px 16px;background:#fff;border:1px solid #e5e7eb;border-radius:14px;
			}
			.ff-ui-builder-wrap .ff-ui-grid{
				display:grid;grid-template-columns:repeat(auto-fit,minmax(420px,1fr));gap:18px;
			}
			.ff-ui-builder-wrap .ff-ui-card{
				background:#fff;border:1px solid #e5e7eb;border-radius:16px;padding:20px;
			}
			.ff-ui-builder-wrap .ff-ui-card h2{margin-top:0;margin-bottom:6px;}
			.ff-ui-builder-wrap .ff-ui-card p.ff-ui-desc{margin-top:0;color:#6b7280;}
			.ff-ui-builder-wrap .form-table th{width:48%;}
			.ff-ui-builder-wrap .ff-ui-card .form-table{margin-top:8px;}
			.ff-ui-builder-wrap .ff-ui-card .form-table tr:first-child th,
			.ff-ui-builder-wrap .ff-ui-card .form-table tr:first-child td{padding-top:8px;}
			.ff-ui-builder-wrap .ff-ui-card .ff-ui-card-footer{
				margin-top:14px;padding-top:14px;border-top:1px solid #f1f5f9;display:flex;justify-content:flex-end;
			}
			.ff-ui-builder-wrap .ff-ui-actions{display:flex;gap:10px;flex-wrap:wrap;align-items:center;}
			.ff-ui-builder-wrap .ff-ui-savebar{
				display:flex;gap:10px;align-items:center;justify-content:space-between;flex-wrap:wrap;
				margin:0 0 18px;padding:14px 16px;background:#fff;border:1px solid #e5e7eb;border-radius:14px;
				position:sticky;top:32px;z-index:20;
			}
			.ff-ui-builder-wrap .ff-ui-palette{
				background:#fff;border:1px solid #e5e7eb;border-radius:16px;padding:20px;margin:0 0 18px;
			}
			.ff-ui-builder-wrap .ff-ui-palette h2{margin:0 0 6px;}
			.ff-ui-builder-wrap .ff-ui-palette p{margin-top:0;color:#6b7280;}
			.ff-ui-builder-wrap .ff-ui-palette-scroll{
				max-height:320px;overflow:auto;border:1px solid #e5e7eb;border-radius:12px;padding:8px;background:#fafafa;
			}
			.ff-ui-builder-wrap .ff-ui-palette-scroll img{
				display:block;max-width:100%;height:auto;
			}
			.ff-ui-slider{min-width:320px;max-width:520px}
			.ff-ui-slider__row{display:grid;grid-template-columns:minmax(0,1fr) 90px;gap:12px;align-items:center}
			.ff-ui-slider__track-wrap{position:relative}
			.ff-ui-slider__range{width:100%;margin:0}
			.ff-ui-slider__default-mark{
				position:absolute;top:50%;transform:translate(-50%,-50%);
				width:2px;height:18px;background:#ef4444;border-radius:2px;pointer-events:none;opacity:.9;
			}
			.ff-ui-slider__meta{
				display:flex;gap:16px;justify-content:space-between;flex-wrap:wrap;
				margin-top:6px;font-size:12px;color:#6b7280;
			}
			.ff-ui-slider__number{width:90px}
		</style>

		<div class="ff-ui-topbar">
			<div class="ff-ui-actions">
				<a href="<?php echo esc_url(home_url('/menu/')); ?>" class="button button-secondary" target="_blank" rel="noopener noreferrer">Открыть /menu/</a>
				<?php ff_menu_ui_render_reset_all_link(); ?>
			</div>
			<div>Страница: <strong>Внешний вид → FFKebab UI</strong></div>
		</div>

		<div class="ff-ui-palette">
			<h2>Палитра цветов</h2>
			<p>Подсказка по цветам. Можно прокручивать и использовать hex-коды для подбора оттенков.</p>
			<div class="ff-ui-palette-scroll">
				<img src="<?php echo esc_url($palette_image_url); ?>" alt="Палитра цветов с hex-кодами">
			</div>
		</div>

		<form method="post" action="options.php">
			<?php settings_fields('ff_menu_ui_group'); ?>

			<div class="ff-ui-savebar">
				<div><strong>Быстрое действие:</strong> сохрани настройки перед переходом на /menu/</div>
				<div><?php submit_button('Сохранить настройки', 'primary', 'submit_top', false); ?></div>
			</div>

			<div class="ff-ui-grid">

				<div class="ff-ui-card">
					<h2>Сетка карточек меню</h2>
					<p class="ff-ui-desc">Управление контейнером страницы меню и количеством карточек в ряд.</p>
					<table class="form-table">
						<tr><th>Максимальная ширина контейнера меню</th><td><?php ff_menu_ui_render_slider_input('ff_menu_grid_container_max_width', ff_menu_ui_get('ff_menu_grid_container_max_width'), 900, 2200, 5, 'px'); ?></td></tr>
						<tr><th>Боковые отступы контейнера</th><td><?php ff_menu_ui_render_slider_input('ff_menu_grid_container_side_padding', ff_menu_ui_get('ff_menu_grid_container_side_padding'), 0, 80, 1, 'px'); ?></td></tr>
						<tr><th>Колонок на desktop</th><td><?php ff_menu_ui_render_slider_input('ff_menu_grid_cols_desktop', ff_menu_ui_get('ff_menu_grid_cols_desktop'), 1, 6, 1); ?></td></tr>
						<tr><th>Колонок на laptop</th><td><?php ff_menu_ui_render_slider_input('ff_menu_grid_cols_laptop', ff_menu_ui_get('ff_menu_grid_cols_laptop'), 1, 6, 1); ?></td></tr>
						<tr><th>Колонок на tablet</th><td><?php ff_menu_ui_render_slider_input('ff_menu_grid_cols_tablet', ff_menu_ui_get('ff_menu_grid_cols_tablet'), 1, 4, 1); ?></td></tr>
						<tr><th>Колонок на mobile</th><td><?php ff_menu_ui_render_slider_input('ff_menu_grid_cols_mobile', ff_menu_ui_get('ff_menu_grid_cols_mobile'), 1, 2, 1); ?></td></tr>
						<tr><th>Горизонтальный gap</th><td><?php ff_menu_ui_render_slider_input('ff_menu_grid_gap_x', ff_menu_ui_get('ff_menu_grid_gap_x'), 0, 80, 1, 'px'); ?></td></tr>
						<tr><th>Вертикальный gap</th><td><?php ff_menu_ui_render_slider_input('ff_menu_grid_gap_y', ff_menu_ui_get('ff_menu_grid_gap_y'), 0, 80, 1, 'px'); ?></td></tr>
					</table>
					<div class="ff-ui-card-footer"><?php ff_menu_ui_render_reset_link('grid', 'Сбросить сетку'); ?></div>
				</div>

				<div class="ff-ui-card">
					<h2>Карточки товаров</h2>
					<p class="ff-ui-desc">Управление карточкой и фото товара до открытия popup.</p>
					<table class="form-table">
						<tr><th>Внутренние отступы карточки</th><td><?php ff_menu_ui_render_slider_input('ff_menu_card_padding', ff_menu_ui_get('ff_menu_card_padding'), 0, 40, 1, 'px'); ?></td></tr>
						<tr><th>Скругление карточки</th><td><?php ff_menu_ui_render_slider_input('ff_menu_card_radius', ff_menu_ui_get('ff_menu_card_radius'), 0, 40, 1, 'px'); ?></td></tr>
						<tr><th>Цвет фона карточки</th><td><?php ff_menu_ui_render_color_input('ff_menu_card_bg', ff_menu_ui_get('ff_menu_card_bg')); ?></td></tr>
						<tr><th>Цвет рамки карточки</th><td><?php ff_menu_ui_render_color_input('ff_menu_card_border_color', ff_menu_ui_get('ff_menu_card_border_color')); ?></td></tr>
						<tr><th>Толщина рамки карточки</th><td><?php ff_menu_ui_render_slider_input('ff_menu_card_border_width', ff_menu_ui_get('ff_menu_card_border_width'), 0, 4, 1, 'px'); ?></td></tr>
						<tr><th>Размер заголовка карточки</th><td><?php ff_menu_ui_render_slider_input('ff_menu_card_title_size', ff_menu_ui_get('ff_menu_card_title_size'), 12, 40, 1, 'px'); ?></td></tr>
						<tr><th>Размер описания карточки</th><td><?php ff_menu_ui_render_slider_input('ff_menu_card_desc_size', ff_menu_ui_get('ff_menu_card_desc_size'), 10, 24, 1, 'px'); ?></td></tr>
						<tr><th>Размер цены карточки</th><td><?php ff_menu_ui_render_slider_input('ff_menu_card_price_size', ff_menu_ui_get('ff_menu_card_price_size'), 12, 32, 1, 'px'); ?></td></tr>
						<tr><th>Расстояние в footer карточки</th><td><?php ff_menu_ui_render_slider_input('ff_menu_card_footer_gap', ff_menu_ui_get('ff_menu_card_footer_gap'), 0, 30, 1, 'px'); ?></td></tr>
						<tr><th>Высота фото на desktop</th><td><?php ff_menu_ui_render_slider_input('ff_menu_card_img_height_desktop', ff_menu_ui_get('ff_menu_card_img_height_desktop'), 120, 700, 5, 'px'); ?></td></tr>
						<tr><th>Высота фото на tablet</th><td><?php ff_menu_ui_render_slider_input('ff_menu_card_img_height_tablet', ff_menu_ui_get('ff_menu_card_img_height_tablet'), 120, 700, 5, 'px'); ?></td></tr>
						<tr><th>Высота фото на mobile</th><td><?php ff_menu_ui_render_slider_input('ff_menu_card_img_height_mobile', ff_menu_ui_get('ff_menu_card_img_height_mobile'), 120, 700, 5, 'px'); ?></td></tr>
						<tr><th>Формат фото на desktop</th><td><?php ff_menu_ui_render_select_input('ff_menu_card_img_ratio_desktop', ff_menu_ui_get('ff_menu_card_img_ratio_desktop'), $ratio_options); ?></td></tr>
						<tr><th>Формат фото на tablet</th><td><?php ff_menu_ui_render_select_input('ff_menu_card_img_ratio_tablet', ff_menu_ui_get('ff_menu_card_img_ratio_tablet'), $ratio_options); ?></td></tr>
						<tr><th>Формат фото на mobile</th><td><?php ff_menu_ui_render_select_input('ff_menu_card_img_ratio_mobile', ff_menu_ui_get('ff_menu_card_img_ratio_mobile'), $ratio_options); ?></td></tr>
						<tr><th>Режим отображения фото</th><td><?php ff_menu_ui_render_select_input('ff_menu_card_img_fit_mode', ff_menu_ui_get('ff_menu_card_img_fit_mode'), $fit_mode_options); ?></td></tr>
						<tr><th>Скругление кнопки ADD</th><td><?php ff_menu_ui_render_slider_input('ff_menu_card_button_radius', ff_menu_ui_get('ff_menu_card_button_radius'), 0, 40, 1, 'px'); ?></td></tr>
						<tr><th>Цвет кнопки ADD</th><td><?php ff_menu_ui_render_color_input('ff_menu_card_button_bg', ff_menu_ui_get('ff_menu_card_button_bg')); ?></td></tr>
						<tr><th>Цвет текста кнопки ADD</th><td><?php ff_menu_ui_render_color_input('ff_menu_card_button_text', ff_menu_ui_get('ff_menu_card_button_text')); ?></td></tr>
						<tr><th>Размер текста кнопки ADD</th><td><?php ff_menu_ui_render_slider_input('ff_menu_card_button_font_size', ff_menu_ui_get('ff_menu_card_button_font_size'), 10, 24, 1, 'px'); ?></td></tr>
					</table>
					<div class="ff-ui-card-footer"><?php ff_menu_ui_render_reset_link('cards', 'Сбросить карточки'); ?></div>
				</div>

				<div class="ff-ui-card">
					<h2>Popup desktop</h2>
					<p class="ff-ui-desc">Основные размеры и геометрия окна popup на компьютере.</p>
					<table class="form-table">
						<tr><th>Ширина popup</th><td><?php ff_menu_ui_render_slider_input('ff_menu_popup_width_px', ff_menu_ui_get('ff_menu_popup_width_px'), 700, 1800, 5, 'px'); ?></td></tr>
						<tr><th>Минимальная ширина popup</th><td><?php ff_menu_ui_render_slider_input('ff_menu_popup_min_width_px', ff_menu_ui_get('ff_menu_popup_min_width_px'), 500, 1800, 5, 'px'); ?></td></tr>
						<tr><th>Максимальная ширина popup</th><td><?php ff_menu_ui_render_slider_input('ff_menu_popup_max_width_px', ff_menu_ui_get('ff_menu_popup_max_width_px'), 700, 2200, 5, 'px'); ?></td></tr>
						<tr><th>Высота popup</th><td><?php ff_menu_ui_render_slider_input('ff_menu_popup_height_vh', ff_menu_ui_get('ff_menu_popup_height_vh'), 50, 100, 1, 'vh'); ?></td></tr>
						<tr><th>Скругление popup</th><td><?php ff_menu_ui_render_slider_input('ff_menu_popup_radius', ff_menu_ui_get('ff_menu_popup_radius'), 0, 40, 1, 'px'); ?></td></tr>
						<tr><th>Внутренние отступы popup</th><td><?php ff_menu_ui_render_slider_input('ff_menu_popup_padding', ff_menu_ui_get('ff_menu_popup_padding'), 0, 60, 1, 'px'); ?></td></tr>
						<tr><th>Расстояние между колонками</th><td><?php ff_menu_ui_render_slider_input('ff_menu_popup_gap', ff_menu_ui_get('ff_menu_popup_gap'), 0, 60, 1, 'px'); ?></td></tr>
						<tr><th>Ширина правого блока summary</th><td><?php ff_menu_ui_render_slider_input('ff_menu_popup_summary_width', ff_menu_ui_get('ff_menu_popup_summary_width'), 260, 700, 5, 'px'); ?></td></tr>
						<tr><th>Формат фото в popup</th><td><?php ff_menu_ui_render_select_input('ff_menu_popup_image_ratio', ff_menu_ui_get('ff_menu_popup_image_ratio'), $ratio_options); ?></td></tr>
						<tr><th>Скругление фото в popup</th><td><?php ff_menu_ui_render_slider_input('ff_menu_popup_image_radius', ff_menu_ui_get('ff_menu_popup_image_radius'), 0, 40, 1, 'px'); ?></td></tr>
						<tr><th>Нижний запас summary</th><td><?php ff_menu_ui_render_slider_input('ff_menu_popup_summary_padding_bottom', ff_menu_ui_get('ff_menu_popup_summary_padding_bottom'), 40, 260, 1, 'px'); ?></td></tr>
						<tr><th>Затемнение overlay</th><td><?php ff_menu_ui_render_slider_input('ff_menu_popup_overlay_opacity', ff_menu_ui_get('ff_menu_popup_overlay_opacity'), 0, 100, 1, '%'); ?></td></tr>
						<tr><th>Blur overlay</th><td><?php ff_menu_ui_render_slider_input('ff_menu_popup_overlay_blur', ff_menu_ui_get('ff_menu_popup_overlay_blur'), 0, 20, 1, 'px'); ?></td></tr>
					</table>
					<div class="ff-ui-card-footer"><?php ff_menu_ui_render_reset_link('popup_desktop', 'Сбросить desktop popup'); ?></div>
				</div>

				<div class="ff-ui-card">
					<h2>Popup mobile</h2>
					<p class="ff-ui-desc">Отдельные размеры и отступы popup на мобильных устройствах.</p>
					<table class="form-table">
						<tr><th>Высота mobile popup</th><td><?php ff_menu_ui_render_slider_input('ff_menu_popup_mobile_height_dvh', ff_menu_ui_get('ff_menu_popup_mobile_height_dvh'), 60, 100, 1, 'dvh'); ?></td></tr>
						<tr><th>Скругление верхних углов</th><td><?php ff_menu_ui_render_slider_input('ff_menu_popup_mobile_radius', ff_menu_ui_get('ff_menu_popup_mobile_radius'), 0, 40, 1, 'px'); ?></td></tr>
						<tr><th>Формат фото на mobile</th><td><?php ff_menu_ui_render_select_input('ff_menu_popup_mobile_image_ratio', ff_menu_ui_get('ff_menu_popup_mobile_image_ratio'), $ratio_options); ?></td></tr>
						<tr><th>Нижний отступ footer</th><td><?php ff_menu_ui_render_slider_input('ff_menu_popup_mobile_footer_padding', ff_menu_ui_get('ff_menu_popup_mobile_footer_padding'), 0, 40, 1, 'px'); ?></td></tr>
						<tr><th>Нижний отступ summary</th><td><?php ff_menu_ui_render_slider_input('ff_menu_popup_mobile_summary_padding_bottom', ff_menu_ui_get('ff_menu_popup_mobile_summary_padding_bottom'), 0, 40, 1, 'px'); ?></td></tr>
						<tr><th>Отступ под фото</th><td><?php ff_menu_ui_render_slider_input('ff_menu_popup_mobile_image_margin_bottom', ff_menu_ui_get('ff_menu_popup_mobile_image_margin_bottom'), 0, 40, 1, 'px'); ?></td></tr>
						<tr><th>Отступ под заголовком</th><td><?php ff_menu_ui_render_slider_input('ff_menu_popup_mobile_title_margin_bottom', ff_menu_ui_get('ff_menu_popup_mobile_title_margin_bottom'), 0, 40, 1, 'px'); ?></td></tr>
						<tr><th>Отступ под описанием</th><td><?php ff_menu_ui_render_slider_input('ff_menu_popup_mobile_desc_margin_bottom', ff_menu_ui_get('ff_menu_popup_mobile_desc_margin_bottom'), 0, 40, 1, 'px'); ?></td></tr>
						<tr><th>Отступ под ценой</th><td><?php ff_menu_ui_render_slider_input('ff_menu_popup_mobile_price_margin_bottom', ff_menu_ui_get('ff_menu_popup_mobile_price_margin_bottom'), 0, 40, 1, 'px'); ?></td></tr>
						<tr><th>Верхний отступ блока options</th><td><?php ff_menu_ui_render_slider_input('ff_menu_popup_mobile_options_padding_top', ff_menu_ui_get('ff_menu_popup_mobile_options_padding_top'), 0, 40, 1, 'px'); ?></td></tr>
					</table>
					<div class="ff-ui-card-footer"><?php ff_menu_ui_render_reset_link('popup_mobile', 'Сбросить mobile popup'); ?></div>
				</div>

				<div class="ff-ui-card">
					<h2>Внутренняя сетка popup</h2>
					<p class="ff-ui-desc">Параметры групп модификаторов внутри popup.</p>
					<table class="form-table">
						<tr><th>Расстояние между группами</th><td><?php ff_menu_ui_render_slider_input('ff_menu_popup_group_gap', ff_menu_ui_get('ff_menu_popup_group_gap'), 0, 40, 1, 'px'); ?></td></tr>
						<tr><th>Скругление группы</th><td><?php ff_menu_ui_render_slider_input('ff_menu_popup_group_radius', ff_menu_ui_get('ff_menu_popup_group_radius'), 0, 30, 1, 'px'); ?></td></tr>
						<tr><th>Внутренние отступы группы</th><td><?php ff_menu_ui_render_slider_input('ff_menu_popup_group_padding', ff_menu_ui_get('ff_menu_popup_group_padding'), 0, 30, 1, 'px'); ?></td></tr>
						<tr><th>Цвет фона группы</th><td><?php ff_menu_ui_render_color_input('ff_menu_popup_group_bg', ff_menu_ui_get('ff_menu_popup_group_bg')); ?></td></tr>
						<tr><th>Цвет рамки группы</th><td><?php ff_menu_ui_render_color_input('ff_menu_popup_group_border_color', ff_menu_ui_get('ff_menu_popup_group_border_color')); ?></td></tr>
						<tr><th>Толщина рамки группы</th><td><?php ff_menu_ui_render_slider_input('ff_menu_popup_group_border_width', ff_menu_ui_get('ff_menu_popup_group_border_width'), 0, 4, 1, 'px'); ?></td></tr>
					</table>
					<div class="ff-ui-card-footer"><?php ff_menu_ui_render_reset_link('popup_grid', 'Сбросить внутреннюю сетку'); ?></div>
				</div>

				<div class="ff-ui-card">
					<h2>Notice / ошибки</h2>
					<p class="ff-ui-desc">Верхнее notice внутри popup и стили сообщений.</p>
					<table class="form-table">
						<tr><th>Текст notice</th><td><?php ff_menu_ui_render_text_input('ff_menu_notice_text', ff_menu_ui_get('ff_menu_notice_text')); ?></td></tr>
						<tr><th>Размер текста notice</th><td><?php ff_menu_ui_render_slider_input('ff_menu_notice_font_size', ff_menu_ui_get('ff_menu_notice_font_size'), 10, 24, 1, 'px'); ?></td></tr>
						<tr><th>Цвет текста notice</th><td><?php ff_menu_ui_render_color_input('ff_menu_notice_text_color', ff_menu_ui_get('ff_menu_notice_text_color')); ?></td></tr>
						<tr><th>Цвет фона notice</th><td><?php ff_menu_ui_render_color_input('ff_menu_notice_bg_color', ff_menu_ui_get('ff_menu_notice_bg_color')); ?></td></tr>
						<tr><th>Цвет рамки notice</th><td><?php ff_menu_ui_render_color_input('ff_menu_notice_border_color', ff_menu_ui_get('ff_menu_notice_border_color')); ?></td></tr>
						<tr><th>Толщина рамки notice</th><td><?php ff_menu_ui_render_slider_input('ff_menu_notice_border_width', ff_menu_ui_get('ff_menu_notice_border_width'), 0, 4, 1, 'px'); ?></td></tr>
						<tr><th>Скругление notice</th><td><?php ff_menu_ui_render_slider_input('ff_menu_notice_radius', ff_menu_ui_get('ff_menu_notice_radius'), 0, 30, 1, 'px'); ?></td></tr>
						<tr><th>Внутренний padding Y</th><td><?php ff_menu_ui_render_slider_input('ff_menu_notice_padding_y', ff_menu_ui_get('ff_menu_notice_padding_y'), 0, 30, 1, 'px'); ?></td></tr>
						<tr><th>Внутренний padding X</th><td><?php ff_menu_ui_render_slider_input('ff_menu_notice_padding_x', ff_menu_ui_get('ff_menu_notice_padding_x'), 0, 40, 1, 'px'); ?></td></tr>
						<tr><th>Отступ снизу notice</th><td><?php ff_menu_ui_render_slider_input('ff_menu_notice_margin_bottom', ff_menu_ui_get('ff_menu_notice_margin_bottom'), 0, 40, 1, 'px'); ?></td></tr>
						<tr><th>Максимальная ширина notice</th><td><?php ff_menu_ui_render_slider_input('ff_menu_notice_max_width', ff_menu_ui_get('ff_menu_notice_max_width'), 20, 100, 1, '%'); ?></td></tr>
						<tr><th>Показывать иконку</th><td><?php ff_menu_ui_render_checkbox_input('ff_menu_notice_show_icon', ff_menu_ui_get('ff_menu_notice_show_icon')); ?></td></tr>
						<tr><th>Размер иконки</th><td><?php ff_menu_ui_render_slider_input('ff_menu_notice_icon_size', ff_menu_ui_get('ff_menu_notice_icon_size'), 10, 40, 1, 'px'); ?></td></tr>
					</table>
					<div class="ff-ui-card-footer"><?php ff_menu_ui_render_reset_link('notice', 'Сбросить notice'); ?></div>
				</div>

				<div class="ff-ui-card">
					<h2>Подсветка обязательных групп</h2>
					<p class="ff-ui-desc">Параметры для первой проблемной обязательной группы внутри popup.</p>
					<table class="form-table">
						<tr><th>Включить подсветку</th><td><?php ff_menu_ui_render_checkbox_input('ff_menu_required_group_highlight', ff_menu_ui_get('ff_menu_required_group_highlight')); ?></td></tr>
						<tr><th>Включить автоскролл</th><td><?php ff_menu_ui_render_checkbox_input('ff_menu_required_group_autoscroll', ff_menu_ui_get('ff_menu_required_group_autoscroll')); ?></td></tr>
						<tr><th>Цвет рамки проблемной группы</th><td><?php ff_menu_ui_render_color_input('ff_menu_required_group_border_color', ff_menu_ui_get('ff_menu_required_group_border_color')); ?></td></tr>
						<tr><th>Цвет фона проблемной группы</th><td><?php ff_menu_ui_render_color_input('ff_menu_required_group_bg_color', ff_menu_ui_get('ff_menu_required_group_bg_color')); ?></td></tr>
						<tr><th>Толщина рамки</th><td><?php ff_menu_ui_render_slider_input('ff_menu_required_group_border_width', ff_menu_ui_get('ff_menu_required_group_border_width'), 0, 4, 1, 'px'); ?></td></tr>
						<tr><th>Скругление подсветки</th><td><?php ff_menu_ui_render_slider_input('ff_menu_required_group_radius', ff_menu_ui_get('ff_menu_required_group_radius'), 0, 30, 1, 'px'); ?></td></tr>
						<tr><th>Внутренний padding подсветки</th><td><?php ff_menu_ui_render_slider_input('ff_menu_required_group_padding', ff_menu_ui_get('ff_menu_required_group_padding'), 0, 30, 1, 'px'); ?></td></tr>
						<tr><th>Отступ автоскролла сверху</th><td><?php ff_menu_ui_render_slider_input('ff_menu_required_group_scroll_offset', ff_menu_ui_get('ff_menu_required_group_scroll_offset'), 0, 60, 1, 'px'); ?></td></tr>
					</table>
					<div class="ff-ui-card-footer"><?php ff_menu_ui_render_reset_link('highlight', 'Сбросить подсветку'); ?></div>
				</div>

				<div class="ff-ui-card">
					<h2>Нижняя панель popup</h2>
					<p class="ff-ui-desc">Размеры и плотность нижней панели с quantity и Add.</p>
					<table class="form-table">
						<tr><th>Вертикальные отступы footer</th><td><?php ff_menu_ui_render_slider_input('ff_menu_footer_padding_y', ff_menu_ui_get('ff_menu_footer_padding_y'), 0, 40, 1, 'px'); ?></td></tr>
						<tr><th>Ширина блока количества</th><td><?php ff_menu_ui_render_slider_input('ff_menu_qty_width', ff_menu_ui_get('ff_menu_qty_width'), 40, 140, 1, 'px'); ?></td></tr>
						<tr><th>Высота кнопки Add</th><td><?php ff_menu_ui_render_slider_input('ff_menu_add_button_height', ff_menu_ui_get('ff_menu_add_button_height'), 36, 80, 1, 'px'); ?></td></tr>
						<tr><th>Плотность фона footer</th><td><?php ff_menu_ui_render_slider_input('ff_menu_footer_bg_opacity', ff_menu_ui_get('ff_menu_footer_bg_opacity'), 0, 100, 1, '%'); ?></td></tr>
						<tr><th>Blur footer</th><td><?php ff_menu_ui_render_slider_input('ff_menu_footer_blur', ff_menu_ui_get('ff_menu_footer_blur'), 0, 20, 1, 'px'); ?></td></tr>
					</table>
					<div class="ff-ui-card-footer"><?php ff_menu_ui_render_reset_link('footer', 'Сбросить footer'); ?></div>
				</div>

				<div class="ff-ui-card">
					<h2>Категории сверху</h2>
					<p class="ff-ui-desc">Sticky-полоса категорий меню и её внешний вид.</p>
					<table class="form-table">
						<tr><th>Отступ sticky-полосы сверху</th><td><?php ff_menu_ui_render_slider_input('ff_menu_nav_top', ff_menu_ui_get('ff_menu_nav_top'), 0, 200, 1, 'px'); ?></td></tr>
						<tr><th>Blur фона категорий</th><td><?php ff_menu_ui_render_slider_input('ff_menu_nav_blur', ff_menu_ui_get('ff_menu_nav_blur'), 0, 40, 1, 'px'); ?></td></tr>
						<tr><th>Плотность фона категорий</th><td><?php ff_menu_ui_render_slider_input('ff_menu_nav_bg_opacity', ff_menu_ui_get('ff_menu_nav_bg_opacity'), 0, 1, 0.01); ?></td></tr>
						<tr><th>Скругление кнопок категорий</th><td><?php ff_menu_ui_render_slider_input('ff_menu_nav_link_radius', ff_menu_ui_get('ff_menu_nav_link_radius'), 0, 999, 1, 'px'); ?></td></tr>
						<tr><th>Цвет активной категории</th><td><?php ff_menu_ui_render_color_input('ff_menu_nav_active_bg', ff_menu_ui_get('ff_menu_nav_active_bg')); ?></td></tr>
						<tr><th>Цвет текста активной категории</th><td><?php ff_menu_ui_render_color_input('ff_menu_nav_active_text', ff_menu_ui_get('ff_menu_nav_active_text')); ?></td></tr>
						<tr><th>Расстояние между категориями</th><td><?php ff_menu_ui_render_slider_input('ff_menu_nav_gap', ff_menu_ui_get('ff_menu_nav_gap'), 0, 40, 1, 'px'); ?></td></tr>
						<tr><th>Размер шрифта категорий</th><td><?php ff_menu_ui_render_slider_input('ff_menu_nav_font_size', ff_menu_ui_get('ff_menu_nav_font_size'), 10, 24, 1, 'px'); ?></td></tr>
					</table>
					<div class="ff-ui-card-footer"><?php ff_menu_ui_render_reset_link('nav', 'Сбросить категории'); ?></div>
				</div>

				<div class="ff-ui-card">
					<h2>Sticky cart</h2>
					<p class="ff-ui-desc">Плавающая кнопка корзины внизу экрана.</p>
					<table class="form-table">
						<tr><th>Скругление sticky cart</th><td><?php ff_menu_ui_render_slider_input('ff_menu_sticky_cart_radius', ff_menu_ui_get('ff_menu_sticky_cart_radius'), 0, 40, 1, 'px'); ?></td></tr>
						<tr><th>Цвет фона sticky cart</th><td><?php ff_menu_ui_render_color_input('ff_menu_sticky_cart_bg', ff_menu_ui_get('ff_menu_sticky_cart_bg')); ?></td></tr>
						<tr><th>Цвет текста sticky cart</th><td><?php ff_menu_ui_render_color_input('ff_menu_sticky_cart_text', ff_menu_ui_get('ff_menu_sticky_cart_text')); ?></td></tr>
						<tr><th>Нижний отступ sticky cart</th><td><?php ff_menu_ui_render_slider_input('ff_menu_sticky_cart_bottom', ff_menu_ui_get('ff_menu_sticky_cart_bottom'), 0, 80, 1, 'px'); ?></td></tr>
						<tr><th>Боковые отступы sticky cart</th><td><?php ff_menu_ui_render_slider_input('ff_menu_sticky_cart_side', ff_menu_ui_get('ff_menu_sticky_cart_side'), 0, 80, 1, 'px'); ?></td></tr>
					</table>
					<div class="ff-ui-card-footer"><?php ff_menu_ui_render_reset_link('sticky', 'Сбросить sticky cart'); ?></div>
				</div>

				<div class="ff-ui-card">
					<h2>Тексты интерфейса</h2>
					<p class="ff-ui-desc">Тексты, которые потом можно использовать в JS / popup / notice.</p>
					<table class="form-table">
						<tr><th>Текст loading</th><td><?php ff_menu_ui_render_text_input('ff_menu_text_loading', ff_menu_ui_get('ff_menu_text_loading')); ?></td></tr>
						<tr><th>Текст кнопки notice</th><td><?php ff_menu_ui_render_text_input('ff_menu_text_notice_button', ff_menu_ui_get('ff_menu_text_notice_button')); ?></td></tr>
						<tr><th>Текст кнопки закрытия</th><td><?php ff_menu_ui_render_text_input('ff_menu_text_close_button', ff_menu_ui_get('ff_menu_text_close_button')); ?></td></tr>
						<tr><th>Текст ошибки загрузки товара</th><td><?php ff_menu_ui_render_text_input('ff_menu_text_load_error', ff_menu_ui_get('ff_menu_text_load_error')); ?></td></tr>
						<tr><th>Текст ошибки обязательных опций</th><td><?php ff_menu_ui_render_text_input('ff_menu_text_required_error', ff_menu_ui_get('ff_menu_text_required_error')); ?></td></tr>
						<tr><th>Заголовок поля пожеланий</th><td><?php ff_menu_ui_render_text_input('ff_menu_text_special_request_label', ff_menu_ui_get('ff_menu_text_special_request_label')); ?></td></tr>
						<tr><th>Placeholder поля пожеланий</th><td><?php ff_menu_ui_render_textarea_input('ff_menu_text_special_request_placeholder', ff_menu_ui_get('ff_menu_text_special_request_placeholder'), 2); ?></td></tr>
					</table>
					<div class="ff-ui-card-footer"><?php ff_menu_ui_render_reset_link('texts', 'Сбросить тексты'); ?></div>
				</div>

			</div>

			<p style="margin-top:22px; display:flex; gap:10px; align-items:center; flex-wrap:wrap;">
				<?php submit_button('Сохранить настройки', 'primary', 'submit_bottom', false); ?>
				<span>Сохранил → обнови страницу <strong>/menu/</strong> без кеша.</span>
			</p>
		</form>

		<script>
		document.addEventListener('DOMContentLoaded', function () {
			document.querySelectorAll('.ff-ui-slider').forEach(function (wrap) {
				const range = wrap.querySelector('.ff-ui-slider__range');
				const number = wrap.querySelector('.ff-ui-slider__number');
				const current = wrap.querySelector('.ff-ui-slider__current');

				if (!range || !number || !current) {
					return;
				}

				const sync = function (source, target) {
					target.value = source.value;
					current.textContent = source.value;
				};

				range.addEventListener('input', function () {
					sync(range, number);
				});

				number.addEventListener('input', function () {
					sync(number, range);
				});
			});
		});
		</script>
	</div>
	<?php
}

/* ------------------------------------------------------
   10. Динамический CSS на /menu/
   ------------------------------------------------------ */
add_action('wp_head', 'ff_menu_ui_print_dynamic_css', 99);

function ff_menu_ui_print_dynamic_css() {
	if (! is_page('menu')) {
		return;
	}

	$container_max_width   = max(900, intval(ff_menu_ui_get('ff_menu_grid_container_max_width')));
	$container_side        = max(0, intval(ff_menu_ui_get('ff_menu_grid_container_side_padding')));
	$cols_desktop          = max(1, intval(ff_menu_ui_get('ff_menu_grid_cols_desktop')));
	$cols_laptop           = max(1, intval(ff_menu_ui_get('ff_menu_grid_cols_laptop')));
	$cols_tablet           = max(1, intval(ff_menu_ui_get('ff_menu_grid_cols_tablet')));
	$cols_mobile           = max(1, intval(ff_menu_ui_get('ff_menu_grid_cols_mobile')));
	$gap_x                 = max(0, intval(ff_menu_ui_get('ff_menu_grid_gap_x')));
	$gap_y                 = max(0, intval(ff_menu_ui_get('ff_menu_grid_gap_y')));

	$card_padding          = max(0, intval(ff_menu_ui_get('ff_menu_card_padding')));
	$card_radius           = max(0, intval(ff_menu_ui_get('ff_menu_card_radius')));
	$card_bg               = sanitize_hex_color(ff_menu_ui_get('ff_menu_card_bg')) ?: '#ffffff';
	$card_border_color     = sanitize_hex_color(ff_menu_ui_get('ff_menu_card_border_color')) ?: '#eeeeee';
	$card_border_width     = max(0, intval(ff_menu_ui_get('ff_menu_card_border_width')));
	$card_title_size       = max(12, intval(ff_menu_ui_get('ff_menu_card_title_size')));
	$card_desc_size        = max(10, intval(ff_menu_ui_get('ff_menu_card_desc_size')));
	$card_price_size       = max(12, intval(ff_menu_ui_get('ff_menu_card_price_size')));
	$card_footer_gap       = max(0, intval(ff_menu_ui_get('ff_menu_card_footer_gap')));
	$card_img_h_desktop    = max(120, intval(ff_menu_ui_get('ff_menu_card_img_height_desktop')));
	$card_img_h_tablet     = max(120, intval(ff_menu_ui_get('ff_menu_card_img_height_tablet')));
	$card_img_h_mobile     = max(120, intval(ff_menu_ui_get('ff_menu_card_img_height_mobile')));
	$card_img_ratio_d      = esc_attr(ff_menu_ui_get('ff_menu_card_img_ratio_desktop'));
	$card_img_ratio_t      = esc_attr(ff_menu_ui_get('ff_menu_card_img_ratio_tablet'));
	$card_img_ratio_m      = esc_attr(ff_menu_ui_get('ff_menu_card_img_ratio_mobile'));
	$card_img_fit_mode     = esc_attr(ff_menu_ui_get('ff_menu_card_img_fit_mode'));
	$card_button_radius    = max(0, intval(ff_menu_ui_get('ff_menu_card_button_radius')));
	$card_button_bg        = sanitize_hex_color(ff_menu_ui_get('ff_menu_card_button_bg')) ?: '#e31e24';
	$card_button_text      = sanitize_hex_color(ff_menu_ui_get('ff_menu_card_button_text')) ?: '#ffffff';
	$card_button_font_size = max(10, intval(ff_menu_ui_get('ff_menu_card_button_font_size')));

	$popup_width_px        = max(700, intval(ff_menu_ui_get('ff_menu_popup_width_px')));
	$popup_max_width_px    = max($popup_width_px, intval(ff_menu_ui_get('ff_menu_popup_max_width_px')));
	$popup_height_vh       = max(50, intval(ff_menu_ui_get('ff_menu_popup_height_vh')));
	$popup_radius          = max(0, intval(ff_menu_ui_get('ff_menu_popup_radius')));
	$popup_padding         = max(0, intval(ff_menu_ui_get('ff_menu_popup_padding')));
	$popup_gap             = max(0, intval(ff_menu_ui_get('ff_menu_popup_gap')));
	$popup_summary_width   = max(240, intval(ff_menu_ui_get('ff_menu_popup_summary_width')));
	$popup_image_ratio     = esc_attr(ff_menu_ui_get('ff_menu_popup_image_ratio'));
	$popup_image_radius    = max(0, intval(ff_menu_ui_get('ff_menu_popup_image_radius')));
	$popup_summary_pb      = max(20, intval(ff_menu_ui_get('ff_menu_popup_summary_padding_bottom')));
	$popup_overlay_op      = max(0, min(100, intval(ff_menu_ui_get('ff_menu_popup_overlay_opacity'))));
	$popup_overlay_blur    = max(0, intval(ff_menu_ui_get('ff_menu_popup_overlay_blur')));

	$popup_mobile_height   = max(60, intval(ff_menu_ui_get('ff_menu_popup_mobile_height_dvh')));
	$popup_mobile_radius   = max(0, intval(ff_menu_ui_get('ff_menu_popup_mobile_radius')));
	$popup_mobile_ratio    = esc_attr(ff_menu_ui_get('ff_menu_popup_mobile_image_ratio'));
	$popup_mobile_footer   = max(0, intval(ff_menu_ui_get('ff_menu_popup_mobile_footer_padding')));
	$popup_mobile_pb       = max(0, intval(ff_menu_ui_get('ff_menu_popup_mobile_summary_padding_bottom')));
	$popup_mobile_img_mb   = max(0, intval(ff_menu_ui_get('ff_menu_popup_mobile_image_margin_bottom')));
	$popup_mobile_t_mb     = max(0, intval(ff_menu_ui_get('ff_menu_popup_mobile_title_margin_bottom')));
	$popup_mobile_d_mb     = max(0, intval(ff_menu_ui_get('ff_menu_popup_mobile_desc_margin_bottom')));
	$popup_mobile_p_mb     = max(0, intval(ff_menu_ui_get('ff_menu_popup_mobile_price_margin_bottom')));
	$popup_mobile_opt_pt   = max(0, intval(ff_menu_ui_get('ff_menu_popup_mobile_options_padding_top')));

	$popup_group_gap       = max(0, intval(ff_menu_ui_get('ff_menu_popup_group_gap')));
	$popup_group_radius    = max(0, intval(ff_menu_ui_get('ff_menu_popup_group_radius')));
	$popup_group_padding   = max(0, intval(ff_menu_ui_get('ff_menu_popup_group_padding')));
	$popup_group_bg        = sanitize_hex_color(ff_menu_ui_get('ff_menu_popup_group_bg')) ?: '#ffffff';
	$popup_group_border    = sanitize_hex_color(ff_menu_ui_get('ff_menu_popup_group_border_color')) ?: '#ececec';
	$popup_group_bw        = max(0, intval(ff_menu_ui_get('ff_menu_popup_group_border_width')));

	$notice_font_size      = max(10, intval(ff_menu_ui_get('ff_menu_notice_font_size')));
	$notice_text_color     = sanitize_hex_color(ff_menu_ui_get('ff_menu_notice_text_color')) ?: '#111827';
	$notice_bg_color       = sanitize_hex_color(ff_menu_ui_get('ff_menu_notice_bg_color')) ?: '#fff7ed';
	$notice_border_color   = sanitize_hex_color(ff_menu_ui_get('ff_menu_notice_border_color')) ?: '#fdba74';
	$notice_border_width   = max(0, intval(ff_menu_ui_get('ff_menu_notice_border_width')));
	$notice_radius         = max(0, intval(ff_menu_ui_get('ff_menu_notice_radius')));
	$notice_py             = max(0, intval(ff_menu_ui_get('ff_menu_notice_padding_y')));
	$notice_px             = max(0, intval(ff_menu_ui_get('ff_menu_notice_padding_x')));
	$notice_mb             = max(0, intval(ff_menu_ui_get('ff_menu_notice_margin_bottom')));
	$notice_max_width      = max(20, min(100, intval(ff_menu_ui_get('ff_menu_notice_max_width'))));
	$notice_icon_size      = max(10, intval(ff_menu_ui_get('ff_menu_notice_icon_size')));
	$notice_show_icon      = (int) ff_menu_ui_get('ff_menu_notice_show_icon') === 1;

	$required_border       = sanitize_hex_color(ff_menu_ui_get('ff_menu_required_group_border_color')) ?: '#ef4444';
	$required_bg           = sanitize_hex_color(ff_menu_ui_get('ff_menu_required_group_bg_color')) ?: '#fef2f2';
	$required_bw           = max(0, intval(ff_menu_ui_get('ff_menu_required_group_border_width')));
	$required_radius       = max(0, intval(ff_menu_ui_get('ff_menu_required_group_radius')));
	$required_padding      = max(0, intval(ff_menu_ui_get('ff_menu_required_group_padding')));

	$footer_padding_y      = max(0, intval(ff_menu_ui_get('ff_menu_footer_padding_y')));
	$qty_width             = max(40, intval(ff_menu_ui_get('ff_menu_qty_width')));
	$add_button_height     = max(36, intval(ff_menu_ui_get('ff_menu_add_button_height')));
	$footer_bg_opacity     = max(0, min(100, intval(ff_menu_ui_get('ff_menu_footer_bg_opacity'))));
	$footer_blur           = max(0, intval(ff_menu_ui_get('ff_menu_footer_blur')));

	$nav_top               = max(0, intval(ff_menu_ui_get('ff_menu_nav_top')));
	$nav_blur              = max(0, intval(ff_menu_ui_get('ff_menu_nav_blur')));
	$nav_bg_opacity        = max(0, min(1, floatval(ff_menu_ui_get('ff_menu_nav_bg_opacity'))));
	$nav_link_radius       = max(0, intval(ff_menu_ui_get('ff_menu_nav_link_radius')));
	$nav_active_bg         = sanitize_hex_color(ff_menu_ui_get('ff_menu_nav_active_bg')) ?: '#e31e24';
	$nav_active_text       = sanitize_hex_color(ff_menu_ui_get('ff_menu_nav_active_text')) ?: '#ffffff';
	$nav_gap               = max(0, intval(ff_menu_ui_get('ff_menu_nav_gap')));
	$nav_font_size         = max(10, intval(ff_menu_ui_get('ff_menu_nav_font_size')));

	$sticky_radius         = max(0, intval(ff_menu_ui_get('ff_menu_sticky_cart_radius')));
	$sticky_bg             = sanitize_hex_color(ff_menu_ui_get('ff_menu_sticky_cart_bg')) ?: '#111827';
	$sticky_text           = sanitize_hex_color(ff_menu_ui_get('ff_menu_sticky_cart_text')) ?: '#ffffff';
	$sticky_bottom         = max(0, intval(ff_menu_ui_get('ff_menu_sticky_cart_bottom')));
	$sticky_side           = max(0, intval(ff_menu_ui_get('ff_menu_sticky_cart_side')));
	?>

	<style>
		.kc-menu-container {
			width: min(<?php echo $container_max_width; ?>px, calc(100% - <?php echo ($container_side * 2); ?>px));
			margin: 0 auto;
		}
		.kc-menu-grid {
			display: grid !important;
			grid-template-columns: repeat(<?php echo $cols_desktop; ?>, minmax(0, 1fr)) !important;
			column-gap: <?php echo $gap_x; ?>px !important;
			row-gap: <?php echo $gap_y; ?>px !important;
			align-items: stretch;
		}

		.ff-menu-card {
			display: flex;
			flex-direction: column;
			width: 100%;
			height: 100%;
			padding: <?php echo $card_padding; ?>px;
			box-sizing: border-box;
			background: <?php echo $card_bg; ?>;
			border: <?php echo $card_border_width; ?>px solid <?php echo $card_border_color; ?>;
			border-radius: <?php echo $card_radius; ?>px;
		}
		.ff-menu-card__image {
			overflow: hidden;
			margin-bottom: 12px;
			aspect-ratio: <?php echo $card_img_ratio_d; ?>;
		}
		.ff-menu-card__image img {
			display: block;
			width: 100%;
			height: <?php echo $card_img_h_desktop; ?>px;
			object-fit: <?php echo $card_img_fit_mode; ?>;
			border-radius: max(8px, <?php echo max(8, $card_radius - 4); ?>px);
		}
		.ff-menu-card__body {
			display: flex;
			flex-direction: column;
			flex: 1;
		}
		.ff-menu-card__title {
			font-size: <?php echo $card_title_size; ?>px;
			line-height: 1.2;
		}
		.ff-menu-card__desc {
			font-size: <?php echo $card_desc_size; ?>px;
			line-height: 1.45;
		}
		.ff-menu-card__price {
			font-size: <?php echo $card_price_size; ?>px;
		}
		.ff-menu-card__footer {
			margin-top: auto;
			display: flex;
			align-items: center;
			justify-content: space-between;
			gap: <?php echo $card_footer_gap; ?>px;
		}
		.ff-menu-card__button {
			border-radius: <?php echo $card_button_radius; ?>px;
			background: <?php echo $card_button_bg; ?>;
			color: <?php echo $card_button_text; ?>;
			font-size: <?php echo $card_button_font_size; ?>px;
		}

		.ff-menu-modal__dialog {
			width: min(<?php echo $popup_width_px; ?>px, calc(100vw - 32px));
			max-width: min(<?php echo $popup_max_width_px; ?>px, calc(100vw - 32px));
			height: <?php echo $popup_height_vh; ?>vh;
			max-height: <?php echo $popup_height_vh; ?>vh;
			border-radius: <?php echo $popup_radius; ?>px;
		}
		.ff-menu-modal__backdrop {
			background: rgba(15, 23, 42, <?php echo ($popup_overlay_op / 100); ?>);
			backdrop-filter: blur(<?php echo $popup_overlay_blur; ?>px);
			-webkit-backdrop-filter: blur(<?php echo $popup_overlay_blur; ?>px);
		}
		.ff-modal-product__grid {
			grid-template-columns: minmax(0, 1fr) <?php echo $popup_summary_width; ?>px;
			gap: <?php echo $popup_gap; ?>px;
		}
		.ff-modal-product__options {
			padding: <?php echo $popup_padding; ?>px <?php echo $popup_padding; ?>px 130px;
		}
		.ff-modal-product__summary {
			padding: <?php echo $popup_padding; ?>px <?php echo $popup_padding; ?>px <?php echo $popup_summary_pb; ?>px;
		}
		.ff-modal-product__image {
			aspect-ratio: <?php echo $popup_image_ratio; ?>;
			border-radius: <?php echo $popup_image_radius; ?>px;
		}

		.ff-modal-product__options > * + * {
			margin-top: <?php echo $popup_group_gap; ?>px;
		}
		.ff-modal-product__options .wcdm-group,
		.ff-modal-product__options .ff-modifier-group,
		.ff-modal-product__options .ff-modifier-row-group {
			background: <?php echo $popup_group_bg; ?>;
			border: <?php echo $popup_group_bw; ?>px solid <?php echo $popup_group_border; ?>;
			border-radius: <?php echo $popup_group_radius; ?>px;
			padding: <?php echo $popup_group_padding; ?>px;
		}

		.ff-menu-popup-notice,
		.ff-form-message--error,
		.ff-required-options-notice__text {
			word-wrap: break-word;
			overflow-wrap: break-word;
		}
		.ff-menu-popup-notice {
			max-width: <?php echo $notice_max_width; ?>%;
			margin: 0 0 <?php echo $notice_mb; ?>px;
			padding: <?php echo $notice_py; ?>px <?php echo $notice_px; ?>px;
			font-size: <?php echo $notice_font_size; ?>px;
			line-height: 1.45;
			color: <?php echo $notice_text_color; ?>;
			background: <?php echo $notice_bg_color; ?>;
			border: <?php echo $notice_border_width; ?>px solid <?php echo $notice_border_color; ?>;
			border-radius: <?php echo $notice_radius; ?>px;
		}
		.ff-menu-popup-notice__icon {
			display: <?php echo $notice_show_icon ? 'inline-flex' : 'none'; ?>;
			font-size: <?php echo $notice_icon_size; ?>px;
			margin-right: 8px;
		}
		.ff-form-message--error {
			border-radius: 12px;
			padding: 12px 14px;
			background: #fef2f2;
			color: #991b1b;
			border: 1px solid #fecaca;
		}

		.ff-required-group-error {
			background: <?php echo $required_bg; ?> !important;
			border: <?php echo $required_bw; ?>px solid <?php echo $required_border; ?> !important;
			border-radius: <?php echo $required_radius; ?>px !important;
			padding: <?php echo $required_padding; ?>px !important;
		}

		.ff-modal-product__footer {
			padding: <?php echo $footer_padding_y; ?>px 20px calc(<?php echo $footer_padding_y; ?>px + env(safe-area-inset-bottom));
			background: rgba(255, 255, 255, <?php echo ($footer_bg_opacity / 100); ?>);
			backdrop-filter: blur(<?php echo $footer_blur; ?>px);
			-webkit-backdrop-filter: blur(<?php echo $footer_blur; ?>px);
		}
		.ff-qty .quantity {
			width: <?php echo $qty_width; ?>px;
		}
		.ff-menu-submit {
			height: <?php echo $add_button_height; ?>px;
		}

		.kc-menu-nav {
			top: <?php echo $nav_top; ?>px;
			background: rgba(255, 255, 255, <?php echo $nav_bg_opacity; ?>);
			backdrop-filter: blur(<?php echo $nav_blur; ?>px);
			-webkit-backdrop-filter: blur(<?php echo $nav_blur; ?>px);
		}
		.kc-menu-nav__inner {
			gap: <?php echo $nav_gap; ?>px;
		}
		.kc-menu-nav__link {
			border-radius: <?php echo $nav_link_radius; ?>px;
			font-size: <?php echo $nav_font_size; ?>px;
		}
		.kc-menu-nav__link.active {
			background: <?php echo $nav_active_bg; ?>;
			color: <?php echo $nav_active_text; ?>;
			border-color: <?php echo $nav_active_bg; ?>;
		}

		#ff-sticky-cart-wrap {
			left: <?php echo $sticky_side; ?>px;
			right: <?php echo $sticky_side; ?>px;
			bottom: calc(<?php echo $sticky_bottom; ?>px + var(--ff-phone-button-clearance, 0px) + env(safe-area-inset-bottom));
		}
		.ff-sticky-cart__link {
			border-radius: <?php echo $sticky_radius; ?>px;
			background: <?php echo $sticky_bg; ?>;
			color: <?php echo $sticky_text; ?>;
		}

		@media (max-width: 1200px) {
			.kc-menu-grid {
				grid-template-columns: repeat(<?php echo $cols_laptop; ?>, minmax(0, 1fr)) !important;
			}
			.ff-menu-card__image {
				aspect-ratio: <?php echo $card_img_ratio_t; ?>;
			}
			.ff-menu-card__image img {
				height: <?php echo $card_img_h_tablet; ?>px;
			}
		}

		@media (max-width: 900px) {
			.kc-menu-grid {
				grid-template-columns: repeat(<?php echo $cols_tablet; ?>, minmax(0, 1fr)) !important;
			}
			.ff-menu-card__image {
				aspect-ratio: <?php echo $card_img_ratio_t; ?>;
			}
			.ff-menu-card__image img {
				height: <?php echo $card_img_h_tablet; ?>px;
			}
		}

		@media (max-width: 767px) {
			.kc-menu-grid {
				grid-template-columns: repeat(<?php echo $cols_mobile; ?>, minmax(0, 1fr)) !important;
			}
			.ff-menu-card__image {
				aspect-ratio: <?php echo $card_img_ratio_m; ?>;
			}
			.ff-menu-card__image img {
				height: <?php echo $card_img_h_mobile; ?>px;
			}

			.ff-menu-modal__dialog {
				height: <?php echo $popup_mobile_height; ?>dvh;
				max-height: <?php echo $popup_mobile_height; ?>dvh;
				border-radius: <?php echo $popup_mobile_radius; ?>px <?php echo $popup_mobile_radius; ?>px 0 0;
			}
			.ff-modal-product__summary {
				padding-bottom: <?php echo $popup_mobile_pb; ?>px !important;
			}
			.ff-modal-product__image {
				aspect-ratio: <?php echo $popup_mobile_ratio; ?>;
				margin-bottom: <?php echo $popup_mobile_img_mb; ?>px !important;
			}
			.ff-modal-product__title {
				margin-bottom: <?php echo $popup_mobile_t_mb; ?>px !important;
			}
			.ff-modal-product__desc {
				margin-bottom: <?php echo $popup_mobile_d_mb; ?>px !important;
			}
			.ff-modal-product__price {
				margin-bottom: <?php echo $popup_mobile_p_mb; ?>px !important;
			}
			.ff-modal-product__options {
				padding-top: <?php echo $popup_mobile_opt_pt; ?>px !important;
			}
			.ff-modal-product__footer {
				padding: <?php echo $popup_mobile_footer; ?>px 12px calc(<?php echo $popup_mobile_footer; ?>px + env(safe-area-inset-bottom));
			}
			.ff-menu-popup-notice {
				max-width: 100%;
			}
		}
	</style>

	<?php
}
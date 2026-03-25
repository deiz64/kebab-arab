<?php
/* ======================================================
   ВИЗУАЛЬНЫЙ РЕДАКТОР POPUP
   Файл: inc/menu-ui-visual-editor.php
   ====================================================== */

defined('ABSPATH') || exit;

/* ------------------------------------------------------
   1. Добавляем отдельную страницу в Настройки
   ------------------------------------------------------ */
add_action('admin_menu', 'ff_menu_popup_editor_add_admin_page');

function ff_menu_popup_editor_add_admin_page() {

	/* Добавляем новую страницу рядом с обычными настройками меню */
	add_options_page(
		'Визуальный редактор popup',
		'Popup editor',
		'manage_options',
		'ff-menu-popup-visual-editor',
		'ff_menu_popup_editor_render_page'
	);
}

/* ------------------------------------------------------
   2. Берём список пропорций
   ------------------------------------------------------ */
function ff_menu_popup_editor_ratio_options() {

	/* Используем существующий список, если он уже есть */
	if (function_exists('ff_menu_ui_ratio_options')) {
		return ff_menu_ui_ratio_options();
	}

	/* Запасной список на случай, если функция недоступна */
	return array(
		'1 / 1'   => '1 : 1 (квадрат)',
		'4 / 3'   => '4 : 3 (классика)',
		'3 / 2'   => '3 : 2',
		'16 / 10' => '16 : 10',
		'16 / 9'  => '16 : 9 (широкое)',
	);
}

/* ------------------------------------------------------
   3. Поле number + range
   ------------------------------------------------------ */
function ff_menu_popup_editor_number_field($label, $name, $value, $min, $max, $step = 1, $unit = 'px') {
	?>
	<div class="ff-pe-field">
		<label class="ff-pe-label" for="<?php echo esc_attr($name); ?>">
			<?php echo esc_html($label); ?>
		</label>

		<div class="ff-pe-control-row">
			<input
				type="range"
				min="<?php echo esc_attr($min); ?>"
				max="<?php echo esc_attr($max); ?>"
				step="<?php echo esc_attr($step); ?>"
				value="<?php echo esc_attr($value); ?>"
				class="ff-pe-range"
				data-sync="<?php echo esc_attr($name); ?>"
			>

			<input
				type="number"
				id="<?php echo esc_attr($name); ?>"
				name="<?php echo esc_attr($name); ?>"
				min="<?php echo esc_attr($min); ?>"
				max="<?php echo esc_attr($max); ?>"
				step="<?php echo esc_attr($step); ?>"
				value="<?php echo esc_attr($value); ?>"
				class="ff-pe-number"
				data-sync="<?php echo esc_attr($name); ?>"
			>

			<span class="ff-pe-unit"><?php echo esc_html($unit); ?></span>
		</div>
	</div>
	<?php
}

/* ------------------------------------------------------
   4. Поле select
   ------------------------------------------------------ */
function ff_menu_popup_editor_select_field($label, $name, $value, $options) {
	?>
	<div class="ff-pe-field">
		<label class="ff-pe-label" for="<?php echo esc_attr($name); ?>">
			<?php echo esc_html($label); ?>
		</label>

		<select
			id="<?php echo esc_attr($name); ?>"
			name="<?php echo esc_attr($name); ?>"
			class="ff-pe-select"
		>
			<?php foreach ($options as $option_value => $option_label) : ?>
				<option value="<?php echo esc_attr($option_value); ?>" <?php selected($value, $option_value); ?>>
					<?php echo esc_html($option_label); ?>
				</option>
			<?php endforeach; ?>
		</select>
	</div>
	<?php
}

/* ------------------------------------------------------
   5. Рендер страницы редактора
   ------------------------------------------------------ */
function ff_menu_popup_editor_render_page() {

	/* Получаем текущие значения popup-настроек */
	$popup_width_px               = (int) get_option('ff_menu_popup_width_px', 1100);
	$popup_height_vh              = (int) get_option('ff_menu_popup_height_vh', 90);
	$popup_radius                 = (int) get_option('ff_menu_popup_radius', 24);
	$popup_padding                = (int) get_option('ff_menu_popup_padding', 24);
	$popup_gap                    = (int) get_option('ff_menu_popup_gap', 0);
	$popup_summary_width          = (int) get_option('ff_menu_popup_summary_width', 420);
	$popup_image_ratio            = get_option('ff_menu_popup_image_ratio', '4 / 3');
	$popup_image_radius           = (int) get_option('ff_menu_popup_image_radius', 18);
	$popup_summary_padding_bottom = (int) get_option('ff_menu_popup_summary_padding_bottom', 130);
	$popup_overlay_opacity        = (int) get_option('ff_menu_popup_overlay_opacity', 56);

	$popup_mobile_height_dvh      = (int) get_option('ff_menu_popup_mobile_height_dvh', 100);
	$popup_mobile_radius          = (int) get_option('ff_menu_popup_mobile_radius', 20);
	$popup_mobile_image_ratio     = get_option('ff_menu_popup_mobile_image_ratio', '16 / 10');
	$popup_mobile_footer_padding  = (int) get_option('ff_menu_popup_mobile_footer_padding', 12);

	$footer_padding_y             = (int) get_option('ff_menu_footer_padding_y', 16);
	$qty_width                    = (int) get_option('ff_menu_qty_width', 64);
	$add_button_height            = (int) get_option('ff_menu_add_button_height', 52);

	$ratio_options = ff_menu_popup_editor_ratio_options();
	?>
	<div class="wrap ff-pe-page">
		<h1>Визуальный редактор popup</h1>

		<form method="post" action="options.php" id="ff-pe-form">
			<?php settings_fields('ff_menu_ui_group'); ?>

			<div class="ff-pe-layout">

				<div class="ff-pe-sidebar">
					<div class="ff-pe-card">
						<h2>Popup — компьютер</h2>

						<?php ff_menu_popup_editor_number_field('Ширина popup', 'ff_menu_popup_width_px', $popup_width_px, 700, 1600, 1, 'px'); ?>
						<?php ff_menu_popup_editor_number_field('Высота popup', 'ff_menu_popup_height_vh', $popup_height_vh, 60, 100, 1, '%'); ?>
						<?php ff_menu_popup_editor_number_field('Скругление popup', 'ff_menu_popup_radius', $popup_radius, 0, 40, 1, 'px'); ?>
						<?php ff_menu_popup_editor_number_field('Внутренние отступы', 'ff_menu_popup_padding', $popup_padding, 0, 48, 1, 'px'); ?>
						<?php ff_menu_popup_editor_number_field('Расстояние между колонками', 'ff_menu_popup_gap', $popup_gap, 0, 40, 1, 'px'); ?>
						<?php ff_menu_popup_editor_number_field('Ширина правой колонки', 'ff_menu_popup_summary_width', $popup_summary_width, 280, 520, 1, 'px'); ?>
						<?php ff_menu_popup_editor_select_field('Пропорция фото', 'ff_menu_popup_image_ratio', $popup_image_ratio, $ratio_options); ?>
						<?php ff_menu_popup_editor_number_field('Скругление фото', 'ff_menu_popup_image_radius', $popup_image_radius, 0, 32, 1, 'px'); ?>
						<?php ff_menu_popup_editor_number_field('Нижний отступ под контентом', 'ff_menu_popup_summary_padding_bottom', $popup_summary_padding_bottom, 60, 220, 1, 'px'); ?>
						<?php ff_menu_popup_editor_number_field('Затемнение фона', 'ff_menu_popup_overlay_opacity', $popup_overlay_opacity, 0, 100, 1, '%'); ?>
					</div>

					<div class="ff-pe-card">
						<h2>Popup — мобильная версия</h2>

						<?php ff_menu_popup_editor_number_field('Высота popup', 'ff_menu_popup_mobile_height_dvh', $popup_mobile_height_dvh, 70, 100, 1, '%'); ?>
						<?php ff_menu_popup_editor_number_field('Скругление сверху', 'ff_menu_popup_mobile_radius', $popup_mobile_radius, 0, 32, 1, 'px'); ?>
						<?php ff_menu_popup_editor_select_field('Пропорция фото', 'ff_menu_popup_mobile_image_ratio', $popup_mobile_image_ratio, $ratio_options); ?>
						<?php ff_menu_popup_editor_number_field('Нижний padding fixed bar', 'ff_menu_popup_mobile_footer_padding', $popup_mobile_footer_padding, 0, 24, 1, 'px'); ?>
					</div>

					<div class="ff-pe-card">
						<h2>Нижняя панель</h2>

						<?php ff_menu_popup_editor_number_field('Вертикальный padding панели', 'ff_menu_footer_padding_y', $footer_padding_y, 8, 28, 1, 'px'); ?>
						<?php ff_menu_popup_editor_number_field('Ширина количества', 'ff_menu_qty_width', $qty_width, 44, 100, 1, 'px'); ?>
						<?php ff_menu_popup_editor_number_field('Высота кнопки ADD', 'ff_menu_add_button_height', $add_button_height, 40, 72, 1, 'px'); ?>
					</div>

					<?php submit_button('Сохранить popup'); ?>
				</div>

				<div class="ff-pe-preview-column">
					<div class="ff-pe-card">
						<h2>Превью — компьютер</h2>

						<div class="ff-pe-stage ff-pe-stage--desktop" id="ff-pe-stage-desktop">
							<div class="ff-pe-backdrop"></div>

							<div class="ff-pe-dialog ff-pe-dialog--desktop" id="ff-pe-dialog-desktop">
								<div class="ff-pe-dialog-inner ff-pe-grid" id="ff-pe-grid-desktop">
									<div class="ff-pe-options" id="ff-pe-options-desktop">
										<div class="ff-pe-lines">
											<span></span>
											<span></span>
											<span></span>
											<span></span>
											<span></span>
										</div>
									</div>

									<div class="ff-pe-summary" id="ff-pe-summary-desktop">
										<div class="ff-pe-image" id="ff-pe-image-desktop"></div>
										<div class="ff-pe-title"></div>
										<div class="ff-pe-text"></div>
										<div class="ff-pe-text ff-pe-text--short"></div>
										<div class="ff-pe-price"></div>
									</div>
								</div>

								<div class="ff-pe-footer" id="ff-pe-footer-desktop">
									<div class="ff-pe-qty" id="ff-pe-qty-desktop"></div>
									<div class="ff-pe-button" id="ff-pe-button-desktop"></div>
								</div>
							</div>
						</div>
					</div>

					<div class="ff-pe-card">
						<h2>Превью — мобильный</h2>

						<div class="ff-pe-stage ff-pe-stage--mobile" id="ff-pe-stage-mobile">
							<div class="ff-pe-backdrop"></div>

							<div class="ff-pe-dialog ff-pe-dialog--mobile" id="ff-pe-dialog-mobile">
								<div class="ff-pe-dialog-inner">
									<div class="ff-pe-mobile-image" id="ff-pe-image-mobile"></div>

									<div class="ff-pe-mobile-content">
										<div class="ff-pe-title"></div>
										<div class="ff-pe-text"></div>
										<div class="ff-pe-text ff-pe-text--short"></div>
										<div class="ff-pe-lines">
											<span></span>
											<span></span>
											<span></span>
										</div>
									</div>
								</div>

								<div class="ff-pe-footer" id="ff-pe-footer-mobile">
									<div class="ff-pe-qty" id="ff-pe-qty-mobile"></div>
									<div class="ff-pe-button" id="ff-pe-button-mobile"></div>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
		</form>
	</div>

	<style>
		/* ===== общая сетка страницы ===== */
		.ff-pe-layout {
			display: grid;
			grid-template-columns: 420px minmax(0, 1fr);
			gap: 20px;
			align-items: start;
		}

		/* ===== карточки блоков ===== */
		.ff-pe-card {
			background: #fff;
			border: 1px solid #dcdcde;
			border-radius: 14px;
			padding: 18px;
			margin-bottom: 20px;
			box-shadow: 0 1px 2px rgba(16, 24, 40, 0.04);
		}

		.ff-pe-card h2 {
			margin: 0 0 16px;
			font-size: 18px;
		}

		/* ===== поля ===== */
		.ff-pe-field + .ff-pe-field {
			margin-top: 14px;
		}

		.ff-pe-label {
			display: block;
			margin-bottom: 8px;
			font-weight: 600;
		}

		.ff-pe-control-row {
			display: grid;
			grid-template-columns: minmax(0, 1fr) 92px 28px;
			gap: 10px;
			align-items: center;
		}

		.ff-pe-range,
		.ff-pe-number,
		.ff-pe-select {
			width: 100%;
		}

		.ff-pe-unit {
			color: #6b7280;
			font-size: 12px;
			text-transform: uppercase;
		}

		/* ===== сцена предпросмотра ===== */
		.ff-pe-stage {
			position: relative;
			overflow: hidden;
			border-radius: 16px;
			background: #f3f4f6;
			border: 1px solid #e5e7eb;
		}

		.ff-pe-stage--desktop {
			height: 760px;
		}

		.ff-pe-stage--mobile {
			height: 820px;
			max-width: 460px;
		}

		.ff-pe-backdrop {
			position: absolute;
			inset: 0;
			background: rgba(15, 23, 42, 0.56);
		}

		/* ===== сам popup ===== */
		.ff-pe-dialog {
			position: absolute;
			left: 50%;
			bottom: 24px;
			background: #ffffff;
			box-shadow: 0 24px 60px rgba(15, 23, 42, 0.28);
			overflow: hidden;
			transform-origin: center center;
		}

		.ff-pe-dialog--desktop {
			top: 50%;
			bottom: auto;
			transform: translate(-50%, -50%);
		}

		.ff-pe-dialog--mobile {
			width: 375px;
			left: 50%;
			bottom: 0;
			transform: translateX(-50%);
		}

		.ff-pe-dialog-inner {
			position: relative;
			height: 100%;
			padding-bottom: 92px;
			box-sizing: border-box;
		}

		.ff-pe-grid {
			display: grid;
			height: 100%;
		}

		/* ===== колонки desktop ===== */
		.ff-pe-options,
		.ff-pe-summary {
			box-sizing: border-box;
		}

		.ff-pe-options {
			background: #ffffff;
		}

		.ff-pe-summary {
			background: #ffffff;
			border-left: 1px solid #f1f5f9;
		}

		/* ===== мобильный контент ===== */
		.ff-pe-mobile-content {
			padding: 16px 16px 110px;
		}

		/* ===== универсальные плейсхолдеры ===== */
		.ff-pe-image,
		.ff-pe-mobile-image {
			width: 100%;
			background: linear-gradient(135deg, #dbeafe, #bfdbfe);
		}

		.ff-pe-title {
			height: 20px;
			width: 72%;
			border-radius: 999px;
			background: #111827;
			margin: 16px 0 12px;
		}

		.ff-pe-text {
			height: 10px;
			width: 100%;
			border-radius: 999px;
			background: #d1d5db;
			margin-bottom: 8px;
		}

		.ff-pe-text--short {
			width: 68%;
		}

		.ff-pe-price {
			height: 18px;
			width: 90px;
			border-radius: 999px;
			background: #e31e24;
			margin-top: 16px;
		}

		.ff-pe-lines span {
			display: block;
			height: 44px;
			border-radius: 12px;
			background: #f3f4f6;
			margin-bottom: 10px;
			border: 1px solid #e5e7eb;
		}

		/* ===== footer popup ===== */
		.ff-pe-footer {
			position: absolute;
			left: 0;
			right: 0;
			bottom: 0;
			display: flex;
			gap: 12px;
			align-items: center;
			background: #ffffff;
			border-top: 1px solid #e5e7eb;
			box-sizing: border-box;
		}

		.ff-pe-qty {
			height: 44px;
			border-radius: 999px;
			background: #f3f4f6;
			border: 1px solid #d1d5db;
			flex: 0 0 auto;
		}

		.ff-pe-button {
			height: 52px;
			border-radius: 999px;
			background: #111827;
			flex: 1 1 auto;
		}

		/* ===== адаптив для админки ===== */
		@media (max-width: 1200px) {
			.ff-pe-layout {
				grid-template-columns: 1fr;
			}

			.ff-pe-stage--mobile {
				max-width: none;
			}
		}
	</style>

	<script>
		document.addEventListener('DOMContentLoaded', function () {

			/* Получаем форму редактора */
			const form = document.getElementById('ff-pe-form');

			/* Выходим, если форма не найдена */
			if (!form) {
				return;
			}

			/* Синхронизируем range и number по одному имени */
			function syncInputs(groupName, value, source) {
				const inputs = form.querySelectorAll('[data-sync="' + groupName + '"]');

				inputs.forEach(function (input) {
					if (input !== source) {
						input.value = value;
					}
				});
			}

			/* Получаем число из поля */
			function getNumber(name) {
				const field = form.querySelector('[name="' + name + '"]');
				return field ? parseFloat(field.value || 0) : 0;
			}

			/* Получаем строку из поля */
			function getValue(name) {
				const field = form.querySelector('[name="' + name + '"]');
				return field ? field.value : '';
			}

			/* Получаем desktop-элементы */
			const desktopStage   = document.getElementById('ff-pe-stage-desktop');
			const desktopDialog  = document.getElementById('ff-pe-dialog-desktop');
			const desktopGrid    = document.getElementById('ff-pe-grid-desktop');
			const desktopOptions = document.getElementById('ff-pe-options-desktop');
			const desktopSummary = document.getElementById('ff-pe-summary-desktop');
			const desktopImage   = document.getElementById('ff-pe-image-desktop');
			const desktopFooter  = document.getElementById('ff-pe-footer-desktop');
			const desktopQty     = document.getElementById('ff-pe-qty-desktop');
			const desktopButton  = document.getElementById('ff-pe-button-desktop');

			/* Получаем mobile-элементы */
			const mobileStage   = document.getElementById('ff-pe-stage-mobile');
			const mobileDialog  = document.getElementById('ff-pe-dialog-mobile');
			const mobileImage   = document.getElementById('ff-pe-image-mobile');
			const mobileFooter  = document.getElementById('ff-pe-footer-mobile');
			const mobileQty     = document.getElementById('ff-pe-qty-mobile');
			const mobileButton  = document.getElementById('ff-pe-button-mobile');

			/* Рисуем preview по текущим настройкам */
			function updatePreview() {

				/* ===== desktop popup ===== */
				const popupWidth               = getNumber('ff_menu_popup_width_px');
				const popupHeightVh            = getNumber('ff_menu_popup_height_vh');
				const popupRadius              = getNumber('ff_menu_popup_radius');
				const popupPadding             = getNumber('ff_menu_popup_padding');
				const popupGap                 = getNumber('ff_menu_popup_gap');
				const popupSummaryWidth        = getNumber('ff_menu_popup_summary_width');
				const popupImageRatio          = getValue('ff_menu_popup_image_ratio');
				const popupImageRadius         = getNumber('ff_menu_popup_image_radius');
				const popupSummaryPaddingBottom= getNumber('ff_menu_popup_summary_padding_bottom');
				const popupOverlayOpacity      = getNumber('ff_menu_popup_overlay_opacity');

				/* ===== mobile popup ===== */
				const popupMobileHeight        = getNumber('ff_menu_popup_mobile_height_dvh');
				const popupMobileRadius        = getNumber('ff_menu_popup_mobile_radius');
				const popupMobileImageRatio    = getValue('ff_menu_popup_mobile_image_ratio');
				const popupMobileFooterPadding = getNumber('ff_menu_popup_mobile_footer_padding');

				/* ===== footer ===== */
				const footerPaddingY           = getNumber('ff_menu_footer_padding_y');
				const qtyWidth                 = getNumber('ff_menu_qty_width');
				const addButtonHeight          = getNumber('ff_menu_add_button_height');

				/* ===== desktop viewport-имитация ===== */
				const desktopViewportHeight = 720;
				const desktopDialogHeight = Math.round((desktopViewportHeight * popupHeightVh) / 100);

				desktopDialog.style.width = popupWidth + 'px';
				desktopDialog.style.height = desktopDialogHeight + 'px';
				desktopDialog.style.borderRadius = popupRadius + 'px';

				desktopGrid.style.gridTemplateColumns = 'minmax(0, 1fr) ' + popupSummaryWidth + 'px';
				desktopGrid.style.gap = popupGap + 'px';

				desktopOptions.style.padding = popupPadding + 'px ' + popupPadding + 'px 130px';
				desktopSummary.style.padding = popupPadding + 'px ' + popupPadding + 'px ' + popupSummaryPaddingBottom + 'px';

				desktopImage.style.aspectRatio = popupImageRatio;
				desktopImage.style.borderRadius = popupImageRadius + 'px';

				desktopFooter.style.padding = footerPaddingY + 'px 20px';
				desktopQty.style.width = qtyWidth + 'px';
				desktopButton.style.height = addButtonHeight + 'px';

				desktopStage.querySelector('.ff-pe-backdrop').style.background = 'rgba(15, 23, 42, ' + (popupOverlayOpacity / 100) + ')';

				/* Масштабируем popup, чтобы он всегда помещался в preview */
				const desktopScaleX = (desktopStage.clientWidth - 40) / popupWidth;
				const desktopScaleY = (desktopStage.clientHeight - 40) / desktopDialogHeight;
				const desktopScale  = Math.min(1, desktopScaleX, desktopScaleY);

				desktopDialog.style.transform = 'translate(-50%, -50%) scale(' + desktopScale + ')';

				/* ===== mobile viewport-имитация ===== */
				const mobileViewportHeight = 780;
				const mobileDialogWidth = 375;
				const mobileDialogHeight = Math.round((mobileViewportHeight * popupMobileHeight) / 100);

				mobileDialog.style.height = mobileDialogHeight + 'px';
				mobileDialog.style.borderRadius = popupMobileRadius + 'px ' + popupMobileRadius + 'px 0 0';

				mobileImage.style.aspectRatio = popupMobileImageRatio;

				mobileFooter.style.padding = popupMobileFooterPadding + 'px 12px';
				mobileQty.style.width = qtyWidth + 'px';
				mobileButton.style.height = addButtonHeight + 'px';

				mobileStage.querySelector('.ff-pe-backdrop').style.background = 'rgba(15, 23, 42, ' + (popupOverlayOpacity / 100) + ')';

				/* Масштабируем mobile popup */
				const mobileScaleX = (mobileStage.clientWidth - 24) / mobileDialogWidth;
				const mobileScaleY = (mobileStage.clientHeight - 24) / mobileDialogHeight;
				const mobileScale  = Math.min(1, mobileScaleX, mobileScaleY);

				mobileDialog.style.transform = 'translateX(-50%) scale(' + mobileScale + ')';
			}

			/* Следим за всеми изменениями формы */
			form.addEventListener('input', function (event) {
				const target = event.target;

				/* Синхронизируем range и number */
				if (target.hasAttribute('data-sync')) {
					syncInputs(target.getAttribute('data-sync'), target.value, target);
				}

				/* Перерисовываем preview */
				updatePreview();
			});

			/* Следим за select-полями */
			form.addEventListener('change', function () {
				updatePreview();
			});

			/* Перерисовываем при ресайзе окна */
			window.addEventListener('resize', function () {
				updatePreview();
			});

			/* Рисуем первый раз */
			updatePreview();
		});
	</script>
	<?php
}
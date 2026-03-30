(function ($) {
    'use strict';

    const $modal = $('#ff-menu-modal');
    const $modalBody = $modal.find('.js-ff-menu-modal-body');
    const uiConfig = ffMenu.ui || {};
    const uiTexts = uiConfig.texts || {};
    const uiBehavior = uiConfig.behavior || {};
    let lastScrollTop = 0;

    function isMobilePopupViewport() {
        const breakpoint = Number(ffMenu.mobileBreakpoint || 767);
        return window.matchMedia('(max-width: ' + breakpoint + 'px)').matches;
    }

    function getText(key, fallback) {
        const value = uiTexts[key];

        if (typeof value === 'string' && value.trim() !== '') {
            return value.trim();
        }

        return fallback;
    }

    function getBehaviorFlag(key, fallback) {
        if (typeof uiBehavior[key] === 'undefined') {
            return fallback;
        }

        return !(uiBehavior[key] === false || uiBehavior[key] === 0 || uiBehavior[key] === '0');
    }

    function getBehaviorNumber(key, fallback) {
        const value = Number(uiBehavior[key]);
        return Number.isFinite(value) ? value : fallback;
    }

    function escapeHtml(value) {
        return $('<div>').text(String(value || '')).html();
    }

    /**
     * Форматирует цену согласно настройкам WooCommerce
     */
    function formatPrice(amount) {
        const decimals = Number(ffMenu.currencyFormatNumDecimals || 2);
        const decSep = ffMenu.currencyFormatDecimalSep || '.';
        const thouSep = ffMenu.currencyFormatThousandSep || ',';
        const format = ffMenu.currencyFormat || '%1$s%2$s';
        const symbol = ffMenu.currencySymbol || '';

        let n = Number(amount || 0).toFixed(decimals).split('.');
        n[0] = n[0].replace(/\B(?=(\d{3})+(?!\d))/g, thouSep);
        const price = n.join(decSep);

        return format
            .replace('%1$s', symbol)
            .replace('%2$s', price);
    }

    /**
     * Открывает модальное окно (оболочку) с загрузчиком
     */
    function openModalShell() {
        lastScrollTop = window.pageYOffset || document.documentElement.scrollTop || 0;

        $('body').addClass('ff-menu-modal-open');

        if (ffMenu.phoneButtonSelector) {
            $(ffMenu.phoneButtonSelector).addClass('is-hidden-by-modal');
        }

        $modalBody.html('<div class="ff-menu-modal__loading">' + escapeHtml(getText('loading', ffMenu.i18n.loading || 'Загрузка...')) + '</div>');
        $modal.prop('hidden', false).addClass('is-open');
    }

    /**
     * Закрывает модальное окно и восстанавливает прокрутку
     */
    function closeModal() {
        $modal.removeClass('is-open');
        $modalBody.empty();
        $modal.prop('hidden', true);

        $('body').removeClass('ff-menu-modal-open');

        if (ffMenu.phoneButtonSelector) {
            $(ffMenu.phoneButtonSelector).removeClass('is-hidden-by-modal');
        }

        window.scrollTo(0, lastScrollTop);
    }

    /**
     * Извлекает ID товара из триггера
     */
    function getProductId($trigger) {
        return (
            $trigger.data('productId') ||
            $trigger.closest('[data-product-id]').data('productId') ||
            $trigger.closest('[data-product-id]').attr('data-product-id') ||
            0
        );
    }

    /**
     * Возвращает актуальную цену за единицу товара
     */
    function getCurrentUnitPrice($form, forcedUnitPrice) {
        if (typeof forcedUnitPrice !== 'undefined') {
            return Number(forcedUnitPrice || 0);
        }

        const variationPrice = $form.data('currentVariationPrice');

        if (typeof variationPrice !== 'undefined' && variationPrice !== '' && variationPrice !== null) {
            return Number(variationPrice || 0);
        }

        return Number($form.closest('.ff-modal-product').data('basePrice') || 0);
    }

    /**
     * Обновляет отображаемую итоговую цену в форме
     */
    function updateSubmitPrice($form, forcedUnitPrice) {
        if (!$form.length) {
            return;
        }

        const qty = parseInt($form.find('input.qty').val(), 10) || 1;
        const unitPrice = getCurrentUnitPrice($form, forcedUnitPrice);

        $form.find('.js-ff-menu-submit-price').html(formatPrice(unitPrice * qty));
    }

    /**
     * Возвращает режим popup из HTML
     * На mobile всегда используем full, чтобы опции не скрывались.
     */
    function getPopupLayoutMode() {
        if (isMobilePopupViewport()) {
            return 'full';
        }

        const $product = $modal.find('.ff-modal-product').first();

        if (!$product.length) {
            return 'full';
        }

        const mode = String($product.data('popupLayout') || '').trim().toLowerCase();

        return mode === 'compact' ? 'compact' : 'full';
    }

    /**
     * Проставляет класс режима на диалог popup
     */
    function applyPopupLayoutMode() {
        const mode = getPopupLayoutMode();
        const $dialog = $modal.find('.ff-menu-modal__dialog').first();

        if (!$dialog.length) {
            return;
        }

        $dialog.removeClass('ff-modal--compact ff-modal--full');
        $dialog.addClass('ff-modal--' + mode);
    }

    /**
     * Проверяет, является ли заголовок группой остроты
     */
    function isSpiceGroupTitle(title) {
        if (!title) {
            return false;
        }

        const normalized = String(title)
            .toLowerCase()
            .replace(/\s+/g, ' ')
            .trim();

        return (
            normalized.indexOf('iuțeal') !== -1 ||
            normalized.indexOf('iuteala') !== -1 ||
            normalized.indexOf('iuteală') !== -1 ||
            normalized.indexOf('picant') !== -1 ||
            normalized.indexOf('spicy') !== -1
        );
    }

    /**
     * Переносит родную группу остроты в summary только для full popup
     */
    function moveSpiceGroupToSummary() {
        if (getPopupLayoutMode() !== 'full') {
            return;
        }

        const $summary = $modal.find('.ff-modal-product__summary').first();
        const $price = $summary.find('.ff-modal-product__price').first();
        const $options = $modal.find('.ff-modal-product__options').first();

        if (!$summary.length || !$price.length || !$options.length) {
            return;
        }

        $summary.find('.ff-spice-group').remove();

        let $spiceGroup = $();

        $options.find('.wcdm-group').each(function () {
            const $group = $(this);
            const title = $group.find('.wcdm-group-header h3').first().text().trim();

            if (isSpiceGroupTitle(title)) {
                $spiceGroup = $group;
                return false;
            }
        });

        if (!$spiceGroup.length) {
            return;
        }

        $spiceGroup
            .addClass('ff-spice-group ff-spice-group--moved')
            .insertAfter($price);
    }

    /**
     * Инициализирует содержимое модального окна
     */
    function initModalContent() {
        const $form = $modal.find('.ff-menu-add-form');

        if (!$form.length) {
            return;
        }

        applyPopupLayoutMode();

        if ($form.hasClass('variations_form') && $.fn.wc_variation_form) {
            $form.wc_variation_form();

            $form.on('found_variation', function (event, variation) {
                if (variation && typeof variation.display_price !== 'undefined') {
                    $form.data('currentVariationPrice', variation.display_price);
                    updateSubmitPrice($form, variation.display_price);
                }
            });

            $form.on('reset_data hide_variation', function () {
                $form.removeData('currentVariationPrice');
                updateSubmitPrice($form);
            });
        }

        updateSubmitPrice($form);
        moveSpiceGroupToSummary();
    }

    /**
     * Вытаскивает чистый текст ошибки из HTML WooCommerce
     */
    function extractErrorText(message) {
        if (!message) {
            return getText('requiredError', 'Выберите обязательные опции');
        }

        const html = $('<div>').html(message);
        const items = [];

        html.find('li').each(function () {
            const text = $(this).text().trim();
            if (text && items.indexOf(text) === -1) {
                items.push(text);
            }
        });

        if (items.length) {
            return items.join('<br>');
        }

        const plain = html.text().trim();
        return plain || getText('requiredError', 'Выберите обязательные опции');
    }

    /**
     * Возвращает контейнер опций внутри popup
     */
    function getModalOptionsContainer($form) {
        return $form.find('.ff-modal-product__options');
    }

    /**
     * Возвращает scroll-контейнер для автоскролла к ошибке
     * На mobile скроллится всё окно popup, а не только блок опций.
     */
    function getModalScrollContainer($form) {
        if (isMobilePopupViewport()) {
            const $body = $modal.find('.ff-menu-modal__body').first();
            if ($body.length) {
                return $body;
            }
        }

        return getModalOptionsContainer($form);
    }

    /**
     * Удаляет верхний notice обязательных опций
     */
    function clearRequiredOptionsNotice($form) {
        const $options = getModalOptionsContainer($form);

        if (!$options.length) {
            return;
        }

        $options.find('.js-ff-required-options-notice').remove();
    }

    /**
     * Удаляет подсветку обязательных групп
     */
    function clearRequiredGroupHighlight($form) {
        $form.find('.ff-required-group-error').removeClass('ff-required-group-error');
    }

    /**
     * Показывает верхний notice над списком опций
     */
    function showRequiredOptionsNoticeInline($form, message) {
        const $options = getModalOptionsContainer($form);
        const showNoticeIcon = getBehaviorFlag('showNoticeIcon', true);

        if (!$options.length) {
            return;
        }

        clearRequiredOptionsNotice($form);

        const noticeHtml = `
            <div class="ff-menu-popup-notice js-ff-required-options-notice" role="alert">
                ${showNoticeIcon ? '<span class="ff-menu-popup-notice__icon">⚠</span>' : ''}
                <span class="ff-menu-popup-notice__text">${message || getText('requiredError', 'Выберите обязательные опции')}</span>
            </div>
        `;

        $options.prepend(noticeHtml);
    }

    /**
     * Является ли группа обязательной
     */
    function isRequiredRadioGroup($group) {
        if (!$group || !$group.length) {
            return false;
        }

        return $group.find('.wcdm-group-header .required').length > 0;
    }

    /**
     * Есть ли в обязательной группе выбранный radio
     */
    function isRequiredRadioGroupValid($group) {
        if (!$group || !$group.length) {
            return true;
        }

        const $radios = $group.find('input[type="radio"]');

        if (!$radios.length) {
            return true;
        }

        return $radios.filter(':checked').length > 0;
    }

    /**
     * Находит первую незаполненную обязательную radio-группу
     */
    function findFirstInvalidRequiredRadioGroup($form) {
        let $invalidGroup = $();

        $form.find('.wcdm-group').each(function () {
            const $group = $(this);

            if (!isRequiredRadioGroup($group)) {
                return;
            }

            if (!isRequiredRadioGroupValid($group)) {
                $invalidGroup = $group;
                return false;
            }
        });

        return $invalidGroup;
    }

    /**
     * Подсветка первой проблемной группы
     */
    function highlightRequiredGroup($group) {
        if (!$group || !$group.length) {
            return;
        }

        if (!getBehaviorFlag('requiredGroupHighlight', true)) {
            return;
        }

        $group.addClass('ff-required-group-error');
    }

    /**
     * Автоскролл к проблемной группе
     */
    function scrollToRequiredGroup($form, $group) {
        if (!$group || !$group.length) {
            return;
        }

        if (!getBehaviorFlag('requiredGroupAutoscroll', true)) {
            return;
        }

        const $container = getModalScrollContainer($form);

        if (!$container.length) {
            return;
        }

        const containerTop = $container.offset().top;
        const groupTop = $group.offset().top;
        const currentScroll = $container.scrollTop();
        const fallbackOffset = isMobilePopupViewport() ? 14 : 18;
        const offset = getBehaviorNumber('requiredGroupScrollOffset', fallbackOffset);
        const targetScroll = currentScroll + (groupTop - containerTop) - offset;

        $container.stop().animate({
            scrollTop: Math.max(0, targetScroll)
        }, 300);
    }

    /**
     * Показать notice + подсветить + проскроллить
     */
    function showRequiredRadioValidationState($form, message) {
        const $invalidGroup = findFirstInvalidRequiredRadioGroup($form);

        clearRequiredGroupHighlight($form);

        if (!$invalidGroup.length) {
            clearRequiredOptionsNotice($form);
            return false;
        }

        showRequiredOptionsNoticeInline($form, message || getText('requiredError', 'Выберите обязательные опции'));
        highlightRequiredGroup($invalidGroup);
        scrollToRequiredGroup($form, $invalidGroup);

        return true;
    }

    /**
     * Перепроверка после выбора radio
     */
    function refreshRequiredRadioValidationState($form) {
        const $invalidGroup = findFirstInvalidRequiredRadioGroup($form);

        clearRequiredGroupHighlight($form);

        if ($invalidGroup.length) {
            highlightRequiredGroup($invalidGroup);
            return false;
        }

        clearRequiredOptionsNotice($form);
        return true;
    }

    /**
     * Красивое окно для обязательных ингредиентов
     */
    function openRequiredOptionsNotice(productId, message) {
        const safeMessage = message || getText('requiredError', 'Выберите обязательные опции');
        const titleText = escapeHtml(getText('requiredError', 'Выберите обязательные опции'));
        const actionText = escapeHtml(getText('noticeButton', 'Выбрать ингредиенты'));
        const closeText = escapeHtml(getText('closeButton', ffMenu.i18n.close || 'Закрыть'));
        lastScrollTop = window.pageYOffset || document.documentElement.scrollTop || 0;

        $('body').addClass('ff-menu-modal-open');

        if (ffMenu.phoneButtonSelector) {
            $(ffMenu.phoneButtonSelector).addClass('is-hidden-by-modal');
        }

        $modalBody.html(`
            <div class="ff-required-options-notice">
                <div class="ff-required-options-notice__icon">🍴</div>
                <h3 class="ff-required-options-notice__title">${titleText}</h3>
                <div class="ff-required-options-notice__text">${safeMessage}</div>

                <div class="ff-required-options-notice__actions">
                    <button type="button" class="ff-menu-btn ff-menu-btn--primary js-ff-open-product-options" data-product-id="${productId}">
                        ${actionText}
                    </button>

                    <button type="button" class="ff-menu-btn ff-menu-btn--ghost js-ff-menu-close">
                        ${closeText}
                    </button>
                </div>
            </div>
        `);

        $modal.prop('hidden', false).addClass('is-open');
    }

    /**
     * Красивое сообщение об ошибке загрузки товара
     */
    function renderProductLoadError(message) {
        const closeText = escapeHtml(getText('closeButton', ffMenu.i18n.close || 'Закрыть'));
        $modalBody.html(`
            <div class="ff-required-options-notice">
                <div class="ff-required-options-notice__icon">⚠️</div>
                <h3 class="ff-required-options-notice__title">Ошибка</h3>
                <div class="ff-required-options-notice__text">${message || getText('loadError', 'Не удалось загрузить товар.')}</div>

                <div class="ff-required-options-notice__actions">
                    <button type="button" class="ff-menu-btn ff-menu-btn--ghost js-ff-menu-close">
                        ${closeText}
                    </button>
                </div>
            </div>
        `);
    }

    /**
     * Открывает popup товара по productId
     */
    function openProductPopup(productId) {
        if (!productId) {
            return;
        }

        openModalShell();

        $.post(ffMenu.ajaxUrl, {
            action: 'ff_menu_get_product',
            nonce: ffMenu.nonce,
            product_id: productId
        })
        .done(function (response) {
            if (!response || !response.success || !response.data || !response.data.html) {
                renderProductLoadError(getText('loadError', ffMenu.i18n.error || 'Не удалось загрузить товар.'));
                return;
            }

            $modalBody.html(response.data.html);
            initModalContent();
        })
        .fail(function () {
            renderProductLoadError(getText('loadError', ffMenu.i18n.error || 'Не удалось загрузить товар.'));
        });
    }

    // ==================== Обработчики событий ====================

    $(document).on('click', '.js-menu-product-trigger', function (e) {
        if ($(e.target).closest('.js-ff-card-add, .ff-menu-card__button').length) {
            return;
        }

        e.preventDefault();
        e.stopPropagation();

        const $trigger = $(this);
        const productId = parseInt(getProductId($trigger), 10);

        if (!productId) {
            return;
        }

        openProductPopup(productId);
    });

    $(document).on('click', '.js-ff-open-product-options', function (e) {
        e.preventDefault();

        const productId = parseInt($(this).data('productId'), 10);

        if (!productId) {
            return;
        }

        openProductPopup(productId);
    });

    $(document).on('click', '.js-ff-menu-close, #ff-menu-modal .ff-menu-modal__backdrop', function (e) {
        e.preventDefault();
        closeModal();
    });

    $(document).on('keydown', function (e) {
        if (e.key === 'Escape' && $modal.hasClass('is-open')) {
            closeModal();
        }
    });

    $(document).on('click', '#ff-menu-modal .ff-qty__btn', function (e) {
        e.preventDefault();

        const $btn = $(this);
        const $qty = $btn.siblings('.quantity').find('input.qty');
        const step = parseFloat($qty.attr('step')) || 1;
        const min = parseFloat($qty.attr('min')) || 1;
        const maxRaw = parseFloat($qty.attr('max'));
        const max = Number.isFinite(maxRaw) ? maxRaw : 9999;
        const delta = parseFloat($btn.data('step')) || 1;
        const now = parseFloat($qty.val()) || 1;

        let next = now + (delta * step);

        if (next < min) {
            next = min;
        }

        if (next > max) {
            next = max;
        }

        $qty.val(next).trigger('change');
    });

    $(document).on('input change', '#ff-menu-modal input.qty', function () {
        updateSubmitPrice($(this).closest('form'));
    });

    $(document).on('change', '#ff-menu-modal .wcdm-group input[type="radio"]', function () {
        const $form = $(this).closest('form');

        if (!$form.length) {
            return;
        }

        refreshRequiredRadioValidationState($form);
    });

    $(document).on('submit', '#ff-menu-modal .ff-menu-add-form', function (e) {
        e.preventDefault();

        const $form = $(this);
        const $submit = $form.find('.ff-menu-submit');
        const $messages = $form.find('.ff-form-messages');

        if ($submit.prop('disabled')) {
            return;
        }

        $submit.prop('disabled', true).addClass('is-loading');
        $messages.empty().removeClass('is-error is-success');

        $.post(ffMenu.ajaxUrl, {
            action: 'ff_menu_add_to_cart',
            nonce: ffMenu.nonce,
            form: $form.serialize()
        })
        .done(function (response) {
            if (!response || !response.success) {
                let msg = getText('requiredError', 'Выберите обязательные опции');

                if (response && response.data && response.data.message) {
                    msg = extractErrorText(response.data.message);
                }

                const handledRequiredRadio = showRequiredRadioValidationState($form, msg);

                if (!handledRequiredRadio) {
                    $messages
                        .addClass('is-error')
                        .html('<div class="ff-form-message ff-form-message--error">' + msg + '</div>');
                }

                return;
            }

            if (response.data && response.data.stickyCartHtml) {
                $('#ff-sticky-cart-wrap').replaceWith(response.data.stickyCartHtml);
            }

            $(document.body).trigger('added_to_cart');
            $(document.body).trigger('wc_fragment_refresh');

            clearRequiredOptionsNotice($form);
            clearRequiredGroupHighlight($form);

            closeModal();
        })
        .fail(function (xhr) {
            let msg = getText('requiredError', 'Выберите обязательные опции');

            if (xhr.responseJSON && xhr.responseJSON.data && xhr.responseJSON.data.message) {
                msg = extractErrorText(xhr.responseJSON.data.message);
            }

            const handledRequiredRadio = showRequiredRadioValidationState($form, msg);

            if (!handledRequiredRadio) {
                $messages
                    .addClass('is-error')
                    .html('<div class="ff-form-message ff-form-message--error">' + msg + '</div>');
            }
        })
        .always(function () {
            $submit.prop('disabled', false).removeClass('is-loading');
        });
    });

    $(document).on('click', '#ff-menu-modal .wcdm-qty-btn', function (e) {
        e.preventDefault();
        e.stopPropagation();

        const $btn = $(this);
        const isPlus = $btn.hasClass('plus');
        const isMinus = $btn.hasClass('minus');
        const modId = $btn.data('modId');

        if (!modId) {
            return;
        }

        const $row = $btn.closest('.wcdm-option-row');
        const $group = $btn.closest('.wcdm-group');
        const $input = $row.find('.wcdm-qty-input');
        const $value = $row.find('.wcdm-qty-val');

        if (!$input.length || !$value.length) {
            return;
        }

        const current = parseInt($input.val(), 10) || 0;
        const limit = parseInt($group.data('limit'), 10) || 0;

        let next = current;

        if (isPlus) {
            next = current + 1;

            if (limit > 0) {
                let groupTotal = 0;

                $group.find('.wcdm-qty-input').each(function () {
                    groupTotal += parseInt($(this).val(), 10) || 0;
                });

                if (groupTotal >= limit) {
                    return;
                }
            }
        }

        if (isMinus) {
            next = Math.max(0, current - 1);
        }

        $input.val(next).trigger('change');
        $value.text(next);
        $row.toggleClass('is-selected', next > 0);

        updateSubmitPrice($btn.closest('form'));
    });

    // ==================== КНОПКА БЫСТРОГО ДОБАВЛЕНИЯ С КАРТОЧКИ ====================

    $(document).on('click', '.js-ff-card-add, .ff-menu-card__button', function (e) {
        e.preventDefault();
        e.stopPropagation();

        const $button = $(this);
        const productId = parseInt($button.data('productId'), 10);

        if (!productId) {
            return;
        }

        if ($button.prop('disabled') || $button.data('processing') === true) {
            return;
        }

        $button.data('processing', true);
        $button.prop('disabled', true).addClass('is-loading');

        $.post(ffMenu.ajaxUrl, {
            action: 'ff_menu_add_to_cart',
            nonce: ffMenu.nonce,
            form: $.param({
                product_id: productId,
                'add-to-cart': productId,
                quantity: 1
            })
        })
        .done(function (response) {
            if (response && response.success) {
                if (response.data && response.data.stickyCartHtml) {
                    $('#ff-sticky-cart-wrap').replaceWith(response.data.stickyCartHtml);
                }

                $(document.body).trigger('added_to_cart');
                $(document.body).trigger('wc_fragment_refresh');

                $button.addClass('is-added');

                setTimeout(function () {
                    $button.removeClass('is-added');
                }, 1200);

                return;
            }

            let message = getText('requiredError', 'Выберите обязательные опции');

            if (response && response.data && response.data.message) {
                message = extractErrorText(response.data.message);
            }

            openRequiredOptionsNotice(productId, message);
        })
        .fail(function (xhr) {
            let message = getText('requiredError', 'Выберите обязательные опции');

            if (xhr.responseJSON && xhr.responseJSON.data && xhr.responseJSON.data.message) {
                message = extractErrorText(xhr.responseJSON.data.message);
            }

            openRequiredOptionsNotice(productId, message);
        })
        .always(function () {
            $button.prop('disabled', false).removeClass('is-loading');
            $button.data('processing', false);
        });
    });

    // ==================== НАВИГАЦИЯ ПО КАТЕГОРИЯМ ====================

    function ffSetActiveCategoryNavLink(categoryId) {
        const $links = $('.kc-menu-nav__link');

        if (!categoryId || !$links.length) {
            return;
        }

        $links.removeClass('active');

        const $activeLink = $links.filter('[href="#' + categoryId + '"]');
        $activeLink.addClass('active');

        const navInner = document.querySelector('.kc-menu-nav__inner');
        const activeEl = $activeLink.get(0);

        if (navInner && activeEl) {
            const navRect = navInner.getBoundingClientRect();
            const linkRect = activeEl.getBoundingClientRect();

            if (linkRect.left < navRect.left || linkRect.right > navRect.right) {
                navInner.scrollTo({
                    left: activeEl.offsetLeft - (navInner.clientWidth / 2) + (activeEl.clientWidth / 2),
                    behavior: 'smooth'
                });
            }
        }
    }

    function ffGetStickyNavOffset() {
        const nav = document.querySelector('.kc-menu-nav');
        return nav ? nav.offsetHeight + 12 : 12;
    }

    function ffInitCategoryNav() {
        const $links = $('.kc-menu-nav__link');
        const $sections = $('.kc-menu-section');

        if (!$links.length || !$sections.length) {
            return;
        }

        $links.on('click', function (e) {
            e.preventDefault();

            const targetId = $(this).attr('href');
            const $target = $(targetId);

            if (!$target.length) {
                return;
            }

            const top = $target.offset().top - ffGetStickyNavOffset();

            window.scrollTo({
                top: top,
                behavior: 'smooth'
            });

            ffSetActiveCategoryNavLink($target.attr('id'));
        });

        const observerOptions = {
            root: null,
            rootMargin: '-120px 0px -55% 0px',
            threshold: 0
        };

        const observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    ffSetActiveCategoryNavLink(entry.target.id);
                }
            });
        }, observerOptions);

        $sections.each(function () {
            observer.observe(this);
        });

        const firstSectionId = $sections.first().attr('id');

        if (firstSectionId) {
            ffSetActiveCategoryNavLink(firstSectionId);
        }
    }

    $(document).ready(function () {
        ffInitCategoryNav();
    });

})(jQuery);
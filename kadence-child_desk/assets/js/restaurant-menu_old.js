(function ($) {
    'use strict';

    const $modal = $('#ff-menu-modal');
    const $modalBody = $modal.find('.js-ff-menu-modal-body');
    let lastScrollTop = 0;

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

        $modalBody.html('<div class="ff-menu-modal__loading">' + ffMenu.i18n.loading + '</div>');
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
     * Извлекает ID товара из триггера (кнопки, карточки и т.д.)
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
     * Возвращает актуальную цену за единицу товара (с учётом вариации)
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
     * Инициализирует содержимое модального окна (вариации, обновление цены)
     */
    function initModalContent() {
        const $form = $modal.find('.ff-menu-add-form');

        if (!$form.length) {
            return;
        }

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
    }

    /**
     * Вытаскивает чистый текст ошибки из HTML WooCommerce
     */
    function extractErrorText(message) {
        if (!message) {
            return 'Для этого товара нужно сначала выбрать обязательные добавки.';
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
        return plain || 'Для этого товара нужно сначала выбрать обязательные добавки.';
    }

    /**
     * Красивое окно для обязательных ингредиентов
     */
    function openRequiredOptionsNotice(productId, message) {
        const safeMessage = message || 'Сначала выберите ингредиенты для этого блюда.';
        lastScrollTop = window.pageYOffset || document.documentElement.scrollTop || 0;

        $('body').addClass('ff-menu-modal-open');

        if (ffMenu.phoneButtonSelector) {
            $(ffMenu.phoneButtonSelector).addClass('is-hidden-by-modal');
        }

        $modalBody.html(`
            <div class="ff-required-options-notice">
                <div class="ff-required-options-notice__icon">🍴</div>
                <h3 class="ff-required-options-notice__title">Выберите ингредиенты</h3>
                <div class="ff-required-options-notice__text">${safeMessage}</div>

                <div class="ff-required-options-notice__actions">
                    <button type="button" class="ff-menu-btn ff-menu-btn--primary js-ff-open-product-options" data-product-id="${productId}">
                        Выбрать ингредиенты
                    </button>

                    <button type="button" class="ff-menu-btn ff-menu-btn--ghost js-ff-menu-close">
                        Закрыть
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
        $modalBody.html(`
            <div class="ff-required-options-notice">
                <div class="ff-required-options-notice__icon">⚠️</div>
                <h3 class="ff-required-options-notice__title">Ошибка</h3>
                <div class="ff-required-options-notice__text">${message || 'Не удалось загрузить товар.'}</div>

                <div class="ff-required-options-notice__actions">
                    <button type="button" class="ff-menu-btn ff-menu-btn--ghost js-ff-menu-close">
                        Закрыть
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

        console.log('✅ Открываем модальное окно для товара #' + productId);

        openModalShell();

        $.post(ffMenu.ajaxUrl, {
            action: 'ff_menu_get_product',
            nonce: ffMenu.nonce,
            product_id: productId
        })
        .done(function (response) {
            if (!response || !response.success || !response.data || !response.data.html) {
                console.log('❌ Ошибка загрузки товара');
                renderProductLoadError(ffMenu.i18n.error || 'Не удалось загрузить товар.');
                return;
            }

            console.log('✅ Товар загружен, вставляем в модалку');
            $modalBody.html(response.data.html);
            initModalContent();
        })
        .fail(function () {
            console.log('❌ AJAX fail при загрузке товара');
            renderProductLoadError(ffMenu.i18n.error || 'Не удалось загрузить товар.');
        });
    }

    // ==================== Обработчики событий ====================

    /**
     * Открытие модального окна при клике на триггер (карточку товара)
     */
    $(document).on('click', '.js-menu-product-trigger', function (e) {
        console.log('Сработал обработчик модального окна (js-menu-product-trigger)');

        if ($(e.target).closest('.js-ff-card-add, .ff-menu-card__button').length) {
            console.log('⛔ Клик по кнопке быстрого добавления, модальное окно не открывается');
            return;
        }

        e.preventDefault();
        e.stopPropagation();

        const $trigger = $(this);
        const productId = parseInt(getProductId($trigger), 10);

        if (!productId) {
            console.log('❌ Не найден productId');
            return;
        }

        openProductPopup(productId);
    });

    /**
     * Кнопка в красивом окне: открыть товар и выбрать ингредиенты
     */
    $(document).on('click', '.js-ff-open-product-options', function (e) {
        e.preventDefault();

        const productId = parseInt($(this).data('productId'), 10);

        if (!productId) {
            return;
        }

        openProductPopup(productId);
    });

    /**
     * Закрытие модального окна по кнопке закрытия или по клику на подложку
     */
    $(document).on('click', '.js-ff-menu-close, #ff-menu-modal .ff-menu-modal__backdrop', function (e) {
        e.preventDefault();
        console.log('Закрытие модального окна');
        closeModal();
    });

    /**
     * Закрытие модалки по клавише Escape
     */
    $(document).on('keydown', function (e) {
        if (e.key === 'Escape' && $modal.hasClass('is-open')) {
            console.log('Escape — закрываем модалку');
            closeModal();
        }
    });

    /**
     * Кнопки увеличения/уменьшения количества в модальном окне
     */
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

    /**
     * Изменение количества вручную — обновляем цену
     */
    $(document).on('input change', '#ff-menu-modal input.qty', function () {
        updateSubmitPrice($(this).closest('form'));
    });

    /**
     * Отправка формы добавления в корзину из модального окна
     */
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

        console.log('Отправка формы добавления в корзину');

        $.post(ffMenu.ajaxUrl, {
            action: 'ff_menu_add_to_cart',
            nonce: ffMenu.nonce,
            form: $form.serialize()
        })
        .done(function (response) {
            if (!response || !response.success) {
                let msg = 'Для этого товара нужно сначала выбрать обязательные добавки.';

                if (response && response.data && response.data.message) {
                    msg = extractErrorText(response.data.message);
                }

                console.log('❌ Ошибка добавления: ' + msg);

                $messages
                    .addClass('is-error')
                    .html('<div class="ff-form-message ff-form-message--error">' + msg + '</div>');

                return;
            }

            console.log('✅ Товар добавлен в корзину');

            if (response.data && response.data.stickyCartHtml) {
                $('#ff-sticky-cart-wrap').replaceWith(response.data.stickyCartHtml);
            }

            $(document.body).trigger('added_to_cart');
            $(document.body).trigger('wc_fragment_refresh');

            closeModal();
        })
        .fail(function (xhr) {
            let msg = 'Для этого товара нужно сначала выбрать обязательные добавки.';

            if (xhr.responseJSON && xhr.responseJSON.data && xhr.responseJSON.data.message) {
                msg = extractErrorText(xhr.responseJSON.data.message);
            }

            console.log('❌ AJAX fail: ' + msg);

            $messages
                .addClass('is-error')
                .html('<div class="ff-form-message ff-form-message--error">' + msg + '</div>');
        })
        .always(function () {
            $submit.prop('disabled', false).removeClass('is-loading');
        });
    });

    /**
     * Обработчики для модификаторов WCDM (ингредиенты)
     */
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
        console.log('⚡ Сработала кнопка быстрого добавления');

        e.preventDefault();
        e.stopPropagation();

        const $button = $(this);
        const productId = parseInt($button.data('productId'), 10);

        if (!productId) {
            console.log('❌ Нет productId у кнопки');
            return;
        }

        if ($button.prop('disabled') || $button.data('processing') === true) {
            console.log('⏳ Уже обрабатывается запрос');
            return;
        }

        $button.data('processing', true);
        $button.prop('disabled', true).addClass('is-loading');

        console.log('Отправка быстрого добавления товара #' + productId);

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
                console.log('✅ Товар добавлен через быструю кнопку');

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

            let message = 'Сначала выберите ингредиенты для этого блюда.';

            if (response && response.data && response.data.message) {
                message = extractErrorText(response.data.message);
            }

            console.log('❌ Нужны обязательные опции: ' + message);
            openRequiredOptionsNotice(productId, message);
        })
        .fail(function (xhr) {
            let message = 'Сначала выберите ингредиенты для этого блюда.';

            if (xhr.responseJSON && xhr.responseJSON.data && xhr.responseJSON.data.message) {
                message = extractErrorText(xhr.responseJSON.data.message);
            }

            console.log('❌ Ошибка запроса: ' + message);
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
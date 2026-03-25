/**
 * Kadence Quick View - Улучшенный скрипт
 * Автоматически закрывает popup после добавления в корзину
 */

(function($) {
    'use strict';
    
    var KadenceQuickViewHandler = {
        init: function() {
            this.bindEvents();
            this.setupObserver();
        },
        
        bindEvents: function() {
            var self = this;
            
            // Ловим событие добавления в корзину
            $(document).on('added_to_cart', function(event) {
                console.log('Added to cart detected in quick view');
                self.closeQuickView();
                self.updateFragments();
            });
            
            // Ловим успешный AJAX запрос add-to-cart
            $(document).on('wc-add-to-cart-success', function(event) {
                console.log('WC Add to cart success');
                self.closeQuickView();
                self.updateFragments();
            });
        },
        
        closeQuickView: function() {
            // Пытаемся закрыть через все известные методы
            
            // 1. Kadence встроенный способ
            if (typeof window.kadenceQuickView !== 'undefined' && window.kadenceQuickView.closeModal) {
                window.kadenceQuickView.closeModal();
                return;
            }
            
            // 2. Через Bootstrap модаль
            var bootstrapModal = document.querySelector('.modal.show');
            if (bootstrapModal) {
                var modal = new (window.bootstrap ? window.bootstrap.Modal : $.fn.modal)(bootstrapModal);
                modal.hide();
                return;
            }
            
            // 3. Через jQuery UI Dialog
            if ($('.ui-dialog:visible').length) {
                $('.ui-dialog:visible').find('[aria-label="Close"]').click();
                return;
            }
            
            // 4. Поиск кнопки закрытия в быстром просмотре
            var closeBtn = document.querySelector(
                '.kadence-quick-view-modal .close, ' +
                '.quick-view-popup .close, ' +
                '[data-quick-view] .close, ' +
                '.modal [aria-label="Close"], ' +
                '.modal button[class*="close"]'
            );
            
            if (closeBtn) {
                closeBtn.click();
                return;
            }
            
            // 5. Удаляем модаль через CSS display
            var modal = document.querySelector(
                '.kadence-quick-view-modal, ' +
                '.quick-view-popup, ' +
                '.kbs-modal, ' +
                '[data-quick-view="true"]'
            );
            
            if (modal) {
                $(modal).fadeOut(300, function() {
                    $(this).remove();
                    // Удаляем overlay
                    $('.quick-view-overlay, .modal-backdrop').fadeOut(300, function() {
                        $(this).remove();
                    });
                });
            }
        },
        
        updateFragments: function() {
            // Обновляем mini cart и другие фрагменты
            if (typeof wc_add_to_cart_params !== 'undefined') {
                $(document.body).trigger('wc_fragments_loaded');
            }
            
            // Альтернативный способ
            $.ajax({
                type: 'POST',
                url: wc_add_to_cart_params.ajax_url,
                data: { action: 'woocommerce_get_refreshed_fragments' },
                success: function(response) {
                    if (response && response.fragments) {
                        $.each(response.fragments, function(key, value) {
                            $(key).replaceWith(value);
                        });
                    }
                    $(document.body).trigger('wc_fragments_refreshed');
                }
            });
        }
    };
    
    // Инициализируем при готовности документа
    $(document).ready(function() {
        KadenceQuickViewHandler.init();
    });
    
})(jQuery);
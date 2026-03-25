# kebab-arab — FFKebab Restaurant Menu

Кастомное ресторанное меню на WordPress + WooCommerce.
Тема: Kadence Child Theme.

---

## Файлы шаблона restaurant-menu

Все файлы проекта находятся в папке `kadence-child_desk/`.

### Шаблоны страниц (Page Templates)

| Файл | Назначение |
|------|-----------|
| `template-restaurant-menu.php` | **Главный шаблон меню** — выводит категории и карточки товаров |
| `template-menu-categories.php` | Шаблон с иконками категорий меню |
| `template-menu-onepage.php` | Шаблон меню на одной странице |
| `template-ffk-menu.php` | Выбор категории в виде карточек |

### Основные PHP-файлы (Core PHP)

| Файл | Назначение |
|------|-----------|
| `functions.php` | Функции темы: подключение стилей/скриптов, настройки WooCommerce |
| `inc/restaurant-menu.php` | Ядро меню: карточки товаров, popup, AJAX-обработчики |
| `inc/menu-ui-settings.php` | UI Builder в админке: настройки сетки, карточек, popup |
| `inc/wcdm-required-message.php` | Переопределение текста обязательных модификаторов (WCDM) |
| `inc/wcdm-required-notice.php` | Перехват валидации WCDM, возврат JSON-флага |

### Стили (CSS)

| Файл | Назначение |
|------|-----------|
| `assets/css/restaurant-menu.css` | **Основные стили меню** — сетка карточек, popup, responsive |
| `assets/css/ffk-menu-page.css` | Стили страницы меню (дополнительные) |
| `assets/css/ffk-shop.css` | Стили страницы магазина WooCommerce |
| `assets/css/custom-styles.css` | Дополнительные кастомные стили темы |
| `woocommerce.css` | Переопределения стилей WooCommerce |

### JavaScript

| Файл | Назначение |
|------|-----------|
| `assets/js/restaurant-menu.js` | **Основной JS**: модальное окно, AJAX-корзина, валидация, форматирование цен |
| `assets/js/custom-quick-view.js` | Быстрый просмотр товара |

### WooCommerce-шаблоны

| Файл | Назначение |
|------|-----------|
| `woocommerce/content-single-product.php` | Кастомная страница товара |
| `woocommerce/single-product/add-to-cart/simple.php` | Кастомная форма добавления в корзину |

### Прочие файлы темы

| Файл | Назначение |
|------|-----------|
| `style.css` | Определение темы (Theme Name, Template) |
| `screenshot.png` | Скриншот темы для WordPress |
| `restaurant-menu.php` | Заглушка / placeholder |

---

## Технологии

- **WordPress** + Kadence Child Theme
- **WooCommerce** — хранение товаров, корзина, AJAX
- **Плагин WCDM** — группы модификаторов / ингредиентов
- Кастомный фронтенд на чистом JS + jQuery

## Основные функции

- Карточки товаров с сеткой (адаптивная: 4 / 3 / 2 / 1 колонки)
- Popup-окно с модификаторами, выбором количества, полем особых пожеланий
- Валидация обязательных radio-групп с подсветкой и автоскроллом
- AJAX-добавление в корзину
- Sticky-корзина внизу страницы
- UI Builder в админке для настройки всех визуальных параметров

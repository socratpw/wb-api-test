
```markdown
# WB API Integration

Проект на Laravel для загрузки данных из Wildberries API в MySQL БД.

## Стек
- PHP 8.x
- Laravel 13
- MySQL

## Установка

git clone https://github.com/socratpw/wb-api-test.git
cd wb-api-test
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve

## Доступы к БД

- **Host**: f964640a.beget.tech
- **Database**: f964640a_wb_test
- **Username**: f964640a_wb_test
- **Password**: 7x$TBeqeSJ?EdTm
- **phpMyAdmin**: https://free27.beget.com/phpMyAdmin

## Таблицы БД

- `wb_stocks` — остатки товаров (6523 записи загружены)
- `wb_orders` — заказы (API возвращает пустой ответ)
- `wb_sales` — продажи (API возвращает пустой ответ)
- `wb_incomes` — поставки (API возвращает пустой ответ)

## Примечание

Эндпоинты /api/orders, /api/sales, /api/incomes 
на тестовом сервере не содержат данных.
Код для их загрузки написан и закомментирован 
в WbApiService.php.
```

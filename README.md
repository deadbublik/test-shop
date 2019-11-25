# REST API shop

Данная разработка является упрощённой реализацией REST API с функционалом, указанным в ТЗ - `docs/Тестовое задание.docx`.

## Configuration

1. Создать базу данных.
2. Из файла `data/database.sql` выполнить sql-запрос.
3. В файле `config/db.php` изменить настройки подключения на свои.

## API documentation

1. Сгенерировать стартовый набор товаров (20 товаров).
В ответе будет список id созданных товаров.

```rest
POST /product
```

2. Получить список всех товаров.

```rest
GET /product
```

3. Создать заказ.
На вход принимается параметр `productsIds` со списком id-товаров через запятую.
В ответе будет id созданного товара.

```rest
POST /order
productsIds = {1,2,3}
```

4. Оплатить заказ.
На вход принимается параметр `price` с суммой оплаты (должен быть равен сумме заказа).
В ответе будет оплаченная сумма.

```rest
POST /order/{orderId}/payment
price = {10000}
```
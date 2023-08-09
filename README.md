### Описание решения

Решение реализовано в виде консольной команды Laravel `app/Console/Commands/GetData.php`, которую можно запустить из командной строки командами `php artisan app:get-data` или `make get-data`.

Данная команда выполняет запрос к API и сохраняет с него данные в БД. На экран выводятся сообщения количестве успешно сохраненных сущностей для каждой из четырех таблиц (Stocks, Incomes, Sales, Orders), либо возникшие в процессе ошибки.

![Sample Image](public/info.png)

Приложение задеплоено на PaaS-платформу **Railway**, параметры базы данных таковы:

**DATABASE_URL**

postgresql://postgres:967S2Z8D9iTxt8FhfK05@containers-us-west-57.railway.app:6077/railway

**PGDATABASE**

railway

**PGHOST**

containers-us-west-57.railway.app

**PGPASSWORD**

967S2Z8D9iTxt8FhfK05

**PGPORT**

6077

**PGUSER**

postgres

### Что было нужно сделать

Задача: стянуть все данные по описаным эндпоинтам и сохранить в БД.

Ссылка на репу, там задача описана подробно:
https://github.com/cy322666/wb-api/blob/master/README.md

Тут коллекция-дока с примерами запросов на постман:
https://www.postman.com/cy322666/workspace/app-api-test/overview

Хост:
89.108.115.241:6969
Ключ:
E6kUTYrYwZq2tN4QEtyzsbEBk3ie

Использовать Laravel, MySQL.
Код проекта выложить в git. БД развернуть на любом бесплатном хостинге, предоставить доступы к бд и названия таблиц.
Время на выполнение - 3 дня.

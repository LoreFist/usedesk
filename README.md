## Тестовое задание usedesk

### Задача
Написать приложение на laravel, реализующее базовый API для работы с клиентами. У клиента есть имя, фамилия, один или более номеров телефона, один или более почтовых ящиков. Нужно сделать пять методов: добавления, просмотра, изменения, удаления, поиска клиента. Поиск осуществляется в четырех вариантах: по имени и фамилии, телефону, почте или по всем предыдущим опциям одновременно. Тип поиска передается в параметре запроса. Доступ к API осуществляется по токену. Необходимо вести лог всех операций через API с сохранением авторства.

#### Инстуркция по развертыванию

1. `composer install`
2. поправить конфиг подключения к БД в файле `.env`
3. `php artisan migrate`
4. `php artisan passport:install`
5. `php artisan serve`

##### Точки доступа

1. Регистрация пользователя **POST** http://127.0.0.1:8000/api/register (name, email, password, password_confirmation)
2. Авторизация пользователя **POST** http://localhost:8000/api/login (email, password)
3. Logout **POST** http://127.0.0.1:8000/api/logout (OAuth:Token {token})
4. Создание клиента **POST** http://127.0.0.1:8000/api/clients (OAuth:Token {token}, first_name, last_name, phones[], emails[])
5. Просмотр карточки клиента **GET** http://127.0.0.1:8000/api/clients/{id} (OAuth:Token {token})   
6. Удаление клиента **DELETE** http://127.0.0.1:8000/api/clients/{id} (OAuth:Token {token})
7. Редактирование клиента **PUT** http://127.0.0.1:8000/api/clients/{id} (OAuth:Token {token}, first_name, last_name)
8. Поиск клиента **POST** http://127.0.0.1:8000/api/clients/search (OAuth:Token {token}, first_name, last_name, phone, email)
9. Для просмотра логов АПИ использовать интерфейс viewer_mysql

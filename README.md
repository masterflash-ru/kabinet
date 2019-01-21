#Кабинет посетителя на сайте

Пакет предназначен для управления регистрацией посетителей на сайте, редактирование профиля посетителя.
Использует пакет наш masterflash-ru/statpage для хранения сообщений посетителям и masterflash-ru/users, через который производятся все манипуляции.

Установка composer require masterflash-ru/kabinet 
После установки загрузите дамп из папки data, но после загрузки аналогичного дампа из пакета masterflash-ru/statpage.

Используется секция конфига приложения (ниже настройки по умолчанию):
```php
    "kabinet" => [
        "routeNameAfterLogin"=>"kabinet",   //имя маршрута куда переходим после авторизации
        
        /*конфигурация форм*/
        "forma_login"=>__DIR__."/forma.login.config.php",      
        "forma_reset"=>__DIR__."/forma.reset.config.php",
        "forma_registration"=>__DIR__."/forma.registration.config.php",
        /*раздел регистрированного посетителя*/
        "forma_profile_password"=>__DIR__."/forma.profile_password.config.php",
        "forma_profile"=>__DIR__."/forma.profile.config.php",
    ],
```
При необходимости формы можно заменить, обработка их производится автоматически, данные передаются в masterflash-ru/users (менеджер посетителей).



разработка продолжается!

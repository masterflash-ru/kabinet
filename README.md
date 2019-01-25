#Кабинет посетителя на сайте

Пакет предназначен для управления регистрацией посетителей на сайте, редактирование профиля посетителя.
Использует пакет наш masterflash-ru/statpage для хранения сообщений посетителям и masterflash-ru/users, через который производятся все манипуляции.

Установка composer require masterflash-ru/kabinet 
После установки загрузите дамп из папки data, но после загрузки аналогичного дампа из пакета masterflash-ru/statpage, 
скопируйте в публичную папку стили и яваскрипты и картинки, и включите их в основной макет сайта.

Все сверстано под bootstrap4. Имеется вывод tabs при помощи jqueryui, что бы его включить, в конфиге вашего приложения замените 
```php
    "kabinet" => [
        "tpl"=>[
            "index"=>"mf/kabinet/index/index_jqueryui",
        ],
    ],

```

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
        
        /*шаблоны вывода*/
        "tpl"=>[
            "login"=>"mf/kabinet/auth/login",
            "index"=>"mf/kabinet/index/index",
            "registration"=>"mf/kabinet/registration/index",
            "reset_password"=>"mf/kabinet/reset-password/index",
            "password"=>"mf/kabinet/user/password",
            "profile"=>"mf/kabinet/user/profile",
        ],
        /*конфиг вкладок регистрированного*/
        "tabs"=>[
            [
                "name"=>"Мой профиль",
                "route" => [
                    "name"=>"kabinet_data",
                    "options"=>[
                        "action"=>"profile"
                    ]
                ],
            ],
            [
                "name"=>"Сменить пароль",
                "route" => [
                    "name"=>"kabinet_data",
                    "options"=>[
                        "action"=>"password"
                    ]
                ],
            ],
        ],
        /*конфиг вкладок аутенификации*/
        "tabs_login"=>[
            [
                "name"=>"Вход",
                "route" => [
                    "name"=>"login",
                    "options"=>[
                    ]
                ],
            ],
            [
                "name"=>"Регистрация",
                "route" => [
                    "name"=>"registration",
                    "options"=>[
                    ]
                ],
            ],
            [
                "name"=>"Вспомнить пароль",
                "route" => [
                    "name"=>"reset-password",
                    "options"=>[
                    ]
                ],
            ],
        ],
    ],
```
При необходимости формы можно заменить, обработка их производится автоматически, данные передаются в masterflash-ru/users (менеджер посетителей).
После загрузки дампа в базу, отредактируйте сообщения которые будет получать посетитель.
Вы можете заменить и/или добавить как сами обработчики, так и сценарии вывода к ним. Формы так же можно заменить на свои, путем указания к файлам конфигурации.

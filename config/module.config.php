<?php
namespace Mf\Kabinet;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;

return [
    'router' => [
        'routes' => [
            'login' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/login',
                    'defaults' => [
                        'controller' => Controller\AuthController::class,
                        'action'     => 'login',
                    ],
                ],
            ],
            'logout' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/logout',
                    'defaults' => [
                        'controller' => Controller\AuthController::class,
                        'action'     => 'logout',
                    ],
                ],
            ],
            'kabinet' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/kabinet',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'kabinet_data' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/kabinet_data[/:action]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ],
                    'defaults' => [
                        'controller' => Controller\UserController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
          
            
           'registration' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/registration',
                    'defaults' => [
                        'controller' => Controller\RegistrationController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            
           'reset-password' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/reset-password',
                    'defaults' => [
                        'controller' => Controller\ResetPasswordController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
           'confirm' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/kabinet/confirm/:confirm',
                    'constraints' => [
                        'confirm' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ],

                    'defaults' => [
                        'controller' => Controller\ConfirmController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            
            /* 
            'set-password' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/set-password',
                    'defaults' => [
                        'controller' => Controller\UserController::class,
                        'action'     => 'setPassword',
                    ],
                ],
            ],
            'users' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/users[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[a-zA-Z0-9_-]*',
                    ],
                    'defaults' => [
                        'controller'    => Controller\UserController::class,
                        'action'        => 'index',
                    ],
                ],
            ],*/
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\AuthController::class => Controller\Factory\AuthControllerFactory::class,
            Controller\RegistrationController::class => Controller\Factory\RegistrationControllerFactory::class,
            Controller\UserController::class => Controller\Factory\UserControllerFactory::class,
            Controller\ResetPasswordController::class => Controller\Factory\ResetPasswordControllerFactory::class,
            Controller\IndexController::class => Controller\Factory\IndexControllerFactory::class,
            Controller\ConfirmController::class => Controller\Factory\ConfirmControllerFactory::class,
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
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
    /*дополнение новым статусом статичные страницы*/
    "statpage"=>[
        'status'=>[
            3=>"Различные оповещения и письма посетителям"
        ],
    ],
    "users" => [
        /*список допустимых состояний регистрированных юзеров, ключ - это код состояния*/
        'users_status' => [
            1=>"Регистрация не подтверждена",
        ],
    ],

//локали сайта - перезаписываются в глобальном конфиге
  "locale_default"=>"ru_RU",
  "locale_enable_list"=>["ru_RU"],


  //адреса получателей формы обратной связи по умолчанию
  //переопределите этот параметр в global.php, он заменит текущий
  "admin_emails"=>["sxq@yandex.ru"],
  //обратный адрес
  "email_robot"=>"robot@".trim($_SERVER["SERVER_NAME"],"w."),

];

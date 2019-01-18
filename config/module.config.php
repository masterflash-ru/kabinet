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
            ],/* 
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
        "forma_profile"=>__DIR__."/forma.profile.config.php",
        "forma_reset"=>__DIR__."/forma.reset.config.php",
        "forma_registration"=>__DIR__."/forma.registration.config.php",
    ],
    /*дополнение новым статусом статичные страницы*/
    "statpage"=>[
        'status'=>[
            1=>"Регистрация не подтверждена",
            3=>"Различные оповещения и письма посетителям"
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

<?php
/**
 * конфигурация формы аутентификации
 * для изменения создайте новую конфигурацию по аналогии см. https://docs.zendframework.com/zend-form/quick-start/#creation-via-factory
 * создается при помощи фабрики Zend
 */

namespace Mf\Kabinet;
use Zend\Form\Element;
use Zend\Validator\Hostname;


return [
    'elements' => [
        [
            'spec' => [
                'type' => Element\Email::class,
                'name' => 'login',
                'options' => [
                    'label' => 'email адрес',
                ]
            ],
        ],
        [
            'spec' => [
                'type' => Element\Password::class,
                'name' => 'password',
                'options' => [
                    'label' => 'Password',
                ]
            ],
        ],
        [
            'spec' => [
                'type' => Element\Text::class,
                'name' => 'name',
                'options' => [
                    'label' => 'Ваше имя',
                ]
            ],
        ],
        [
            'spec' => [
                'type' => Element\Text::class,
                'name' => 'full_name',
                'options' => [
                    'label' => 'Ваша фамилия',
                ]
            ],
        ],

        [
            'spec' => [
                'name' => 'submit',
                'type' => Element\Submit::class,
                'attributes' => [
                    'value' => 'Отправить',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Element\Csrf::class,
                'name' => 'security',
            ],
        ],

    ],

    /* распределение по fieldset элементам, если требуется
     * вы можете сразу распределить https://docs.zendframework.com/zend-form/quick-start/#creation-via-factory
     * смотри 2-й пример
    'fieldsets' => [
    ],
     */

    /*конфигурация фильтров и валидаторов*/
    'input_filter' => [
        "login" => [
            'required' => true,
            'filters' => [
                [ 'name' => 'StringTrim' ],
                [ 'name' => 'StripTags' ],
            ],
            'validators' => [
                [
                    'name' => 'EmailAddress',
                    'options' => [
                        'allow' => Hostname::ALLOW_DNS,
                        'useMxCheck' => false,
                    ],
                ],
            ],
        ],
        "password" => [
            'required' => true,
            'filters' => [
                [ 'name' => 'StringTrim' ],
                [ 'name' => 'StripTags' ],
            ],
        ],
        "name" => [
            'required' => true,
            'filters' => [
                [ 'name' => 'StringTrim' ],
                [ 'name' => 'StripTags' ],
            ],
        ],
        "full_name" => [
            'required' => false,
            'filters' => [
                [ 'name' => 'StringTrim' ],
                [ 'name' => 'StripTags' ],
            ],
        ],
    ],

];
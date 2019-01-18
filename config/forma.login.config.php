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
                'type' => Element\Checkbox::class,
                'name' => 'remember_me',
                'options' => [
                    'label' => 'Запомнить меня',
                ],
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
        "remember_me" => [
            'required' => false,
            'filters' => [
                [ 'name' => 'StringTrim' ],
                [ 'name' => 'StripTags' ],
            ],
            'validators' => [
                [
                    'name' => 'InArray',
                    'options' => [
                        'haystack' => [0, 1],
                    ],
                ],
            ],

        ],
    ],

];
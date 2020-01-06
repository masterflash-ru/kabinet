<?php
/**
 * конфигурация формы аутентификации
 * для изменения создайте новую конфигурацию по аналогии см. https://docs.zendframework.com/zend-form/quick-start/#creation-via-factory
 * создается при помощи фабрики Laminas
 */

namespace Mf\Kabinet;
use Laminas\Form\Element;
use Laminas\Validator\Hostname;


return [
    'elements' => [
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
                'name' => 'submit',
                'type' => Element\Submit::class,
                'attributes' => [
                    'value' => 'Отправить',
                    'class'=>"btn btn-primary",
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
        "password" => [
            'required' => true,
            'filters' => [
                [ 'name' => 'StringTrim' ],
            ],
        ],
    ],

];
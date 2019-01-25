<?php
/**
 * конфигурация формы 
 * для изменения создайте новую конфигурацию по аналогии см. https://docs.zendframework.com/zend-form/quick-start/#creation-via-factory
 * создается при помощи фабрики Zend
 */

namespace Mf\Kabinet;
use Zend\Form\Element;
use Zend\Validator\Hostname;


return [
    'attributes'=>[
        "method"=>"post"
        ],
    'elements' => [
        [
            'spec' => [
                'type' => Element\Text::class,
                'name' => 'login',
                'attributes'=>[
                    "readonly"=>"readonly",
                    "class"=>"form-control",
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Element\Text::class,
                'name' => 'name',
                'attributes'=>[
                    "class"=>"form-control",
                ],

            ],
        ],
        [
            'spec' => [
                'type' => Element\Text::class,
                'name' => 'full_name',
                'attributes'=>[
                    "class"=>"form-control",
                ],

            ],
        ],
        [
            'spec' => [
                'name' => 'logout',
                'type' => Element\Button::class,
                'attributes' => [
                    'value' => 'Выйти',
                    'class'=>"btn btn-warning",
                ],
            ],
        ],
        [
            'spec' => [
                'name' => 'submit',
                'type' => Element\Submit::class,
                'attributes' => [
                    'value' => 'Сохранить',
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
        "name" => [
            'required' => true,
            'filters' => [
                [ 'name' => 'StringTrim' ],
                [ 'name' => 'StripTags' ],
            ],
        ],
        "full_name" => [
            'required' => true,
            'filters' => [
                [ 'name' => 'StringTrim' ],
                [ 'name' => 'StripTags' ],
            ],
        ],

    ],

];
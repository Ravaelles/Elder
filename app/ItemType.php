<?php

namespace App;

class ItemType extends Eloquent
{

    use Traits\Scaffolded;

    public static $scaffoldFields = [
        'name' => 'text',
        'api' => [
            'type' => 'select',
            'values-from-model' => [
                'model' => 'App\Api',
                'field-option' => 'name',
                'field-value' => 'value',
            ],
        ]
    ];
    public static $scaffoldOptions = [
        'actions' => [
//            'show' => true,
        ],
        'sort' => [
            'name' => 'ASC'
        ]
    ];

}

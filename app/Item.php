<?php

namespace App;

class Item extends Eloquent
{

    use Traits\Scaffolded;

    public static $scaffoldFields = [
        'name' => 'text',
        'api' => [
            'type' => 'select',
            'values-from-model' => [
                'model' => App\ItemType::class,
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

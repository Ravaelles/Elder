<?php

namespace App;

class ItemType extends Eloquent
{

    use Traits\Scaffolded;

    public static $scaffoldFields = [
        'name' => 'text',
        'image' => 'text',
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

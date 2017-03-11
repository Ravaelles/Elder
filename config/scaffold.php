<?php

return [
    'layout' => 'hq.scaffold.layout.layout-scaffold',
    /**
     * Every route of Laravel5 Scaffold must be a named route prefixed with this string.
     */
    'route-base-name' => 'scaffold',
    /**
     * If non-null then only models with given full names will be allowed to be scaffolded.
     */
    'allowed-models' => [
        App\ItemType::class,
    ],
];

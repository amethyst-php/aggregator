<?php

return [
    'enabled'    => true,
    'controller' => Amethyst\Http\Controllers\Admin\AggregatorsController::class,
    'router'     => [
        'as'     => 'aggregator.',
        'prefix' => '/aggregators',
    ],
];

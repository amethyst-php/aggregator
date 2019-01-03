<?php

return [
    'enabled'     => true,
    'controller'  => Railken\Amethyst\Http\Controllers\Admin\AggregatorsController::class,
    'router'      => [
        'as'        => 'aggregator.',
        'prefix'    => '/aggregators',
    ],
];

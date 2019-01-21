<?php

return [
    'table'      => 'amethyst_aggregators',
    'comment'    => 'Aggregator',
    'model'      => Railken\Amethyst\Models\Aggregator::class,
    'schema'     => Railken\Amethyst\Schemas\AggregatorSchema::class,
    'repository' => Railken\Amethyst\Repositories\AggregatorRepository::class,
    'serializer' => Railken\Amethyst\Serializers\AggregatorSerializer::class,
    'validator'  => Railken\Amethyst\Validators\AggregatorValidator::class,
    'authorizer' => Railken\Amethyst\Authorizers\AggregatorAuthorizer::class,
    'faker'      => Railken\Amethyst\Fakers\AggregatorFaker::class,
    'manager'    => Railken\Amethyst\Managers\AggregatorManager::class,
    'aggregable' => [
        Railken\Amethyst\Models\Foo::class => Railken\Amethyst\Managers\FooManager::class,
    ],
];

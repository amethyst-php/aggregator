<?php

return [
    'table'      => 'amethyst_aggregators',
    'comment'    => 'Aggregator',
    'model'      => Amethyst\Models\Aggregator::class,
    'schema'     => Amethyst\Schemas\AggregatorSchema::class,
    'repository' => Amethyst\Repositories\AggregatorRepository::class,
    'serializer' => Amethyst\Serializers\AggregatorSerializer::class,
    'validator'  => Amethyst\Validators\AggregatorValidator::class,
    'authorizer' => Amethyst\Authorizers\AggregatorAuthorizer::class,
    'faker'      => Amethyst\Fakers\AggregatorFaker::class,
    'manager'    => Amethyst\Managers\AggregatorManager::class,
];

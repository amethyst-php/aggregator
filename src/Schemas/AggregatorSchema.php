<?php

namespace Railken\Amethyst\Schemas;

use Illuminate\Support\Facades\Config;
use Railken\Lem\Attributes;
use Railken\Lem\Schema;

class AggregatorSchema extends Schema
{
    /**
     * Get all the attributes.
     *
     * @var array
     */
    public function getAttributes()
    {
        return [
            Attributes\IdAttribute::make(),
            Attributes\EnumAttribute::make('source_type', array_keys(Config::get('amethyst.aggregator.data.aggregator.aggregable')))
                ->setRequired(true),
            Attributes\MorphToAttribute::make('source_id')
                ->setRelationKey('source_type')
                ->setRelationName('source')
                ->setRelations(Config::get('amethyst.aggregator.data.aggregator.aggregable'))
                ->setRequired(true),
            Attributes\EnumAttribute::make('aggregate_type', array_keys(Config::get('amethyst.aggregator.data.aggregator.aggregable')))
                ->setRequired(true),
            Attributes\MorphToAttribute::make('aggregate_id')
                ->setRelationKey('aggregate_type')
                ->setRelationName('aggregate')
                ->setRelations(Config::get('amethyst.aggregator.data.aggregator.aggregable'))
                ->setRequired(true),
            Attributes\CreatedAtAttribute::make(),
            Attributes\UpdatedAtAttribute::make(),
            Attributes\DeletedAtAttribute::make(),
        ];
    }
}

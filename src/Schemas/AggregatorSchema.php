<?php

namespace Amethyst\Schemas;

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
            Attributes\EnumAttribute::make('source_type', app('amethyst')->getMorphListable('aggregator', 'source'))
                ->setRequired(true),
            Attributes\MorphToAttribute::make('source_id')
                ->setRelationKey('source_type')
                ->setRelationName('source')
                ->setRelations(app('amethyst')->getMorphRelationable('aggregator', 'source'))
                ->setRequired(true),
            Attributes\EnumAttribute::make('aggregate_type', app('amethyst')->getMorphListable('aggregator', 'aggregate'))
                ->setRequired(true),
            Attributes\MorphToAttribute::make('aggregate_id')
                ->setRelationKey('aggregate_type')
                ->setRelationName('aggregate')
                ->setRelations(app('amethyst')->getMorphRelationable('aggregator', 'aggregate'))
                ->setRequired(true),
            Attributes\CreatedAtAttribute::make(),
            Attributes\UpdatedAtAttribute::make(),
            Attributes\DeletedAtAttribute::make(),
        ];
    }
}

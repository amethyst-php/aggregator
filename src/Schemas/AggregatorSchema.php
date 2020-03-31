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
            \Amethyst\Core\Attributes\DataNameAttribute::make('source_type')
                ->setRequired(true),
            Attributes\MorphToAttribute::make('source_id')
                ->setRelationKey('source_type')
                ->setRelationName('source')
                ->setRelations(app('amethyst')->getDataManagers())
                ->setRequired(true),
            \Amethyst\Core\Attributes\DataNameAttribute::make('aggregate_type')
                ->setRequired(true),
            Attributes\MorphToAttribute::make('aggregate_id')
                ->setRelationKey('aggregate_type')
                ->setRelationName('aggregate')
                ->setRelations(app('amethyst')->getDataManagers())
                ->setRequired(true),
            Attributes\CreatedAtAttribute::make(),
            Attributes\UpdatedAtAttribute::make(),
            Attributes\DeletedAtAttribute::make(),
        ];
    }
}

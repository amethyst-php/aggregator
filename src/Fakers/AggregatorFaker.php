<?php

namespace Railken\Amethyst\Fakers;

use Faker\Factory;
use Railken\Bag;
use Railken\Lem\Faker;

class AggregatorFaker extends Faker
{
    /**
     * @return \Railken\Bag
     */
    public function parameters()
    {
        $faker = Factory::create();

        $bag = new Bag();
        $bag->set('source_type', \Railken\Amethyst\Models\Foo::class);
        $bag->set('source', FooFaker::make()->parameters()->toArray());
        $bag->set('aggregate_type', \Railken\Amethyst\Models\Foo::class);
        $bag->set('aggregate', FooFaker::make()->parameters()->toArray());

        return $bag;
    }
}

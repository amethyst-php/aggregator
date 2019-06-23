<?php

namespace Railken\Amethyst\Tests;

abstract class BaseTest extends \Orchestra\Testbench\TestCase
{
    /**
     * Setup the test environment.
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->artisan('migrate:fresh');

        app('amethyst')->pushMorphRelation('aggregator', 'source', 'foo');
        app('amethyst')->pushMorphRelation('aggregator', 'aggregate', 'foo');
    }

    protected function getPackageProviders($app)
    {
        return [
            \Railken\Amethyst\Providers\AggregatorServiceProvider::class,
            \Railken\Amethyst\Providers\FooServiceProvider::class,
        ];
    }
}

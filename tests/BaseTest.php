<?php

namespace Amethyst\Tests;

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
            \Amethyst\Providers\AggregatorServiceProvider::class,
            \Amethyst\Providers\FooServiceProvider::class,
        ];
    }
}

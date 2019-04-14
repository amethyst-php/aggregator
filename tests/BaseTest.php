<?php

namespace Railken\Amethyst\Tests;

abstract class BaseTest extends \Orchestra\Testbench\TestCase
{
    /**
     * Setup the test environment.
     */
    public function setUp()
    {
        $dotenv = new \Dotenv\Dotenv(__DIR__.'/..', '.env');
        $dotenv->load();

        parent::setUp();

        app('amethyst')->pushMorphRelation('aggregator', 'source', 'foo');
        app('amethyst')->pushMorphRelation('aggregator', 'aggregate', 'foo');

        $this->artisan('migrate:fresh');
    }

    protected function getPackageProviders($app)
    {
        return [
            \Railken\Amethyst\Providers\AggregatorServiceProvider::class,
            \Railken\Amethyst\Providers\FooServiceProvider::class,
        ];
    }
}

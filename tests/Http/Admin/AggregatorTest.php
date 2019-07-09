<?php

namespace Amethyst\Tests\Http\Admin;

use Amethyst\Api\Support\Testing\TestableBaseTrait;
use Amethyst\Fakers\AggregatorFaker;
use Amethyst\Tests\BaseTest;

class AggregatorTest extends BaseTest
{
    use TestableBaseTrait;

    /**
     * Faker class.
     *
     * @var string
     */
    protected $faker = AggregatorFaker::class;

    /**
     * Router group resource.
     *
     * @var string
     */
    protected $group = 'admin';

    /**
     * Route name.
     *
     * @var string
     */
    protected $route = 'admin.aggregator';
}

<?php

namespace Railken\Amethyst\Tests\Managers;

use Railken\Amethyst\Fakers\AggregatorFaker;
use Railken\Amethyst\Managers\AggregatorManager;
use Railken\Amethyst\Tests\BaseTest;
use Railken\Lem\Support\Testing\TestableBaseTrait;

class AggregatorTest extends BaseTest
{
    use TestableBaseTrait;

    /**
     * Manager class.
     *
     * @var string
     */
    protected $manager = AggregatorManager::class;

    /**
     * Faker class.
     *
     * @var string
     */
    protected $faker = AggregatorFaker::class;
}

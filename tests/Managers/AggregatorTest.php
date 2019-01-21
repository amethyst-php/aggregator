<?php

namespace Railken\Amethyst\Tests\Managers;

use Railken\Amethyst\Fakers\AggregatorFaker;
use Railken\Amethyst\Fakers\FooFaker;
use Railken\Amethyst\Managers\AggregatorManager;
use Railken\Amethyst\Managers\FooManager;
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

    public function testCreateAggregate()
    {
        $fooManager = new FooManager();

        $foo1 = $fooManager->createOrFail(FooFaker::make()->parameters()->set('description', 'A'))->getResource();
        $foo2 = $fooManager->createOrFail(FooFaker::make()->parameters()->set('description', 'B'))->getResource();
        $foo3 = $fooManager->createOrFail(FooFaker::make()->parameters()->set('description', 'B'))->getResource();
        $foo4 = $fooManager->createOrFail(FooFaker::make()->parameters()->set('description', 'C'))->getResource();
        $foo5 = $fooManager->createOrFail(FooFaker::make()->parameters()->set('description', 'D'))->getResource();

        $aggregatorManager = new AggregatorManager();

        $onCreate = function ($fields) use ($fooManager) {
            return $fooManager->create($fields);
        };

        $result = $aggregatorManager->createAggregate([$foo1, $foo2, $foo3, $foo4, $foo5], [8, 5, 4, 2, 7], $onCreate);

        $aggregate = $result->getResource();

        $this->assertEquals('B', $aggregate->description);

        $result = $aggregatorManager->removeAggregate([$foo1, $foo2, $foo3, $foo4, $foo5], function () { });

        $this->assertEquals(null, $aggregatorManager->getRepository()->findOneBy(['aggregate_id' => $aggregate->id]));
        $this->assertEquals(null, $fooManager->getRepository()->findOneBy(['id' => $aggregate->id]));
    }
}

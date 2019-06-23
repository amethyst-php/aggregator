<?php

namespace Railken\Amethyst\Managers;

use Closure;
use Illuminate\Support\Collection;
use Railken\Amethyst\Common\ConfigurableManager;
use Railken\Bag;
use Railken\Lem\Manager;
use Railken\Lem\Result;

class AggregatorManager extends Manager
{
    use ConfigurableManager;

    /**
     * @var string
     */
    protected $config = 'amethyst.aggregator.data.aggregator';

    /**
     * Aggregate multiple entities to one final entity.
     *
     * @param array   $sources
     * @param array   $weight
     * @param Closure $onCreate
     *
     * @return Result
     */
    public function createAggregate(array $sources, array $weights = null, Closure $onCreate)
    {
        if ($weights === null) {
            $weights = array_fill(0, count($sources), 1);
        }

        if (count($sources) !== count($weights)) {
            throw new \InvalidArgumentException(sprintf('Mismatch count() array between sources(%s) and weights(%s)', count($sources), count($weights)));
        }

        $fields = $this->getAggregateAttributes($sources, $weights);
        
        $result = $onCreate($fields);

        if (!$result instanceof Result) {
            throw new \InvalidArgumentException(sprintf('Third parameter $onCreate should return an instance of %s', get_class(Result::class)));
        }

        if ($result->ok()) {
            foreach ($sources as $key => $source) {
                $params = [
                    'source_type'    => $source->getMorphName(),
                    'source_id'      => $source->id,
                    'weight'         => $weights[$key],
                    'aggregate_type' => $result->getResource()->getMorphName(),
                    'aggregate_id'   => $result->getResource()->id,
                ];
                $resultAggregatorCreate = $this->createOrFail($params);

                $result->addErrors($resultAggregatorCreate->getErrors());
            }
        }

        return $result;
    }

    /**
     * Aggregate multiple entities to one final entity.
     *
     * @param array   $sources
     * @param Closure $onRemove
     *
     * @return Result
     */
    public function removeAggregate(array $sources, Closure $onRemove)
    {
        $sources = Collection::make($sources);

        $q = $this->getRepository()->newQuery();

        $q->where(function ($q) use ($sources) {
            foreach ($sources as $source) {
                $q->orWhere(function ($q) use ($source) {
                    $q->where('source_type', $source->getMorphName());
                    $q->where('source_id', $source->id);
                });
            }
        });

        $q->get()->map(function ($aggregator) {
            $aggregator->aggregate()->delete();
            $aggregator->delete();
        });

        return new Result();
    }

    public function getAggregateAttributes(array $sources, array $weights): Collection
    {
        $fields = Collection::make();

        $fieldsName = array_keys($sources[0]->getAttributes());

        foreach ($fieldsName as $fieldName) {
            $score = Collection::make();

            foreach ($sources as $key => $source) {
                $value = $source->$fieldName;
                $weight = (int) $weights[$key];

                $fieldScore = (new Bag())->set('score', $weight)->set('value', $value);

                $found = $score->first(function ($item) use ($value) {
                    // Strict comparison
                    return $item->get('value') === $value;
                });

                if ($found) {
                    $found->set('score', $found->get('score') + $weight);
                } else {
                    $score[] = $fieldScore;
                }
            }

            $fields[$fieldName] = $score->sortByDesc(function ($item) {
                return $item->get('score');
            })->first()->get('value');
        }

        return $fields;
    }
}

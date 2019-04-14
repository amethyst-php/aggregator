<?php

namespace Railken\Amethyst\Providers;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Railken\Amethyst\Common\CommonServiceProvider;

class AggregatorServiceProvider extends CommonServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        parent::register();

        \Illuminate\Database\Eloquent\Builder::macro('aggregator_aggregates', function (): MorphMany {
            return app('amethyst')->createMacroMorphRelation($this, \Railken\Amethyst\Models\Aggregator::class, 'aggregator_aggregates', 'aggregate');
        });
        \Illuminate\Database\Eloquent\Builder::macro('aggregator_sources', function (): MorphMany {
            return app('amethyst')->createMacroMorphRelation($this, \Railken\Amethyst\Models\Aggregator::class, 'aggregator_sources', 'source');
        });
    }
}

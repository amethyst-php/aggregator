<?php

namespace Railken\Amethyst\Authorizers;

use Railken\Lem\Authorizer;
use Railken\Lem\Tokens;

class AggregatorAuthorizer extends Authorizer
{
    /**
     * List of all permissions.
     *
     * @var array
     */
    protected $permissions = [
        Tokens::PERMISSION_CREATE => 'aggregator.create',
        Tokens::PERMISSION_UPDATE => 'aggregator.update',
        Tokens::PERMISSION_SHOW   => 'aggregator.show',
        Tokens::PERMISSION_REMOVE => 'aggregator.remove',
    ];
}

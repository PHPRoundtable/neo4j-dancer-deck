<?php namespace DancerDeck\Subscriptions;

use DancerDeck\Database\BaseEdge;

abstract class BaseSubscriptionEdge extends BaseEdge
{
    /**
     * @var array
     */
    protected static $props = [
      'created_at',
    ];
}

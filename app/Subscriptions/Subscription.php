<?php namespace DancerDeck\Subscriptions;

use DancerDeck\Database\BaseNode;

class Subscription extends BaseNode
{
    /**
     * @const string
     */
    const LABEL = 'Subscription';

    /**
     * @var array
     */
    protected static $props = [
      'id',
      'slug',
      'name',
      'description',
      'created_at',
      'updated_at',
      'deleted_at',
    ];
}

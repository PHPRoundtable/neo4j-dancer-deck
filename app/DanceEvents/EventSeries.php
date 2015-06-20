<?php namespace DancerDeck\DanceEvents;

use DancerDeck\Database\BaseNode;

class EventSeries extends BaseNode
{
    /**
     * @const string
     */
    const LABEL = 'EventSeries';

    /**
     * @var array
     */
    protected static $props = [
      'id',
      'name',
      'website',
      'logo_url',
      'last_event_date',
      'locale',
      'country',
      'created_at',
      'updated_at',
      'deleted_at',
    ];
}

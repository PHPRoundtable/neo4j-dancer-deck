<?php namespace DancerDeck\DanceEvents;

use DancerDeck\Database\BaseNode;

class Event extends BaseNode
{
    /**
     * @const string
     */
    const LABEL = 'Event';

    /**
     * @var array
     */
    protected static $props = [
      'id',
      'name',
      'website',
      'logo_url',
      'start_date',
      'end_date',
      'early_bird_expiration_date',
      'description',
      'buy_ticket_url',
      'created_at',
      'updated_at',
      'deleted_at',
    ];
}

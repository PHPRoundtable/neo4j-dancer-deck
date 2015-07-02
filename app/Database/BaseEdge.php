<?php namespace DancerDeck\Database;

use Illuminate\Support\Collection;

class BaseEdge extends Collection
{
    use PropValidatorTrait;

    /**
     * @const string
     */
    const NAME = 'IS_BASE';

    /**
     * @var array
     */
    protected static $props = [];

    /**
     * @param array $items The list of props to instantiate with
     *
     * @throws \InvalidArgumentException
     */
    public function __construct($items = array())
    {
        parent::__construct($items);

        $this->validateProps();
    }

    /**
     * Overwriting the default behavior to not cause issues
     *
     * @return array
     */
    public function keys()
    {
        return array_keys($this->items);
    }
}

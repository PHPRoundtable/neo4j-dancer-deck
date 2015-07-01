<?php namespace DancerDeck\Database;

use Illuminate\Support\Collection;

class BaseNode extends Collection
{
    use UuidGeneratorTrait;

    /**
     * @const string
     */
    const LABEL = 'Base';

    /**
     * @var array
     */
    protected static $props = ['id'];

    /**
     * @param array|\ArrayAccess $items The list of props to instantiate with
     *
     * @throws \InvalidArgumentException
     */
    public function __construct($items = array())
    {
        if (!is_array($items) && !$items instanceof \ArrayAccess) {
            throw new \InvalidArgumentException('Expected data to be an array or implementation of ArrayAccess.');
        }

        parent::__construct($items);

        $this->validateProps();
    }

    /**
     * Gets the UUID for the node (every node has one).
     *
     * @return string
     */
    public function getId()
    {
        return $this->get('id');
    }

    /**
     * Returns the props as named parameters
     *
     * @return string
     */
    public function getNamedParametersForCreate()
    {
        $props = $this->keys();
        $namedParams = [];

        foreach ($props as $prop) {
            $namedParams[] = $prop.': {'.$prop.'}';
        }

        return implode(', ', $namedParams);
    }

    /**
     * Returns the props as named parameters
     *
     * @return string
     */
    public function getNamedParametersForUpdate()
    {
        $props = $this->keys();
        $namedParams = [];

        foreach ($props as $prop) {
            if ($prop === 'id') {
                continue;
            }
            $namedParams[] = 'n.'.$prop.' = {'.$prop.'}';
        }

        return implode(', ', $namedParams);
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

    /**
     * Validate that the props are expected
     *
     * @throws \InvalidArgumentException
     */
    private function validateProps()
    {
        $props = $this->keys();

        foreach ($props as $prop) {
            if (!in_array($prop, static::$props)) {
                throw new \InvalidArgumentException('Unexpected prop "'.$prop.'".');
            }
        }
    }
}

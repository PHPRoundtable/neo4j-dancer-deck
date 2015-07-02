<?php namespace DancerDeck\Database;

trait PropValidatorTrait
{
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

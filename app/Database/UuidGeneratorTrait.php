<?php namespace DancerDeck\Database;

use Rhumsaa\Uuid\Uuid;
use Rhumsaa\Uuid\Exception\UnsatisfiedDependencyException;

trait UuidGeneratorTrait
{
    /**
     * Generates a string to be used for this model on save.
     *
     * @return static
     */
    public function generateUuid()
    {
        try {
            $uuid4 = Uuid::uuid4();

            $props = ['id' => $uuid4->toString()] + $this->all();

            return new static($props);
        } catch (UnsatisfiedDependencyException $e) {
            dd($e->getMessage());
        }
    }
}

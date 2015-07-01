<?php namespace DancerDeck\Database\Seed;

use DancerDeck\Subscriptions\Subscription;
use Faker\Factory as Faker;

class SubscriptionFactory
{
    /**
     * Generates all the possible types of subscriptions
     *
     * @param int $numberOfNodes
     *
     * @return array
     */
    public function generateSubscriptions($numberOfNodes)
    {
        $faker = Faker::create();

        $nodes = [];

        for ($x=0; $x<$numberOfNodes; $x++) {
            $name = rtrim($faker->sentence(2), '.').' reminder';

            $node = new Subscription([
              'name' => $name,
              'slug' => str_slug(strtolower($name)),
              'description' => $faker->sentence(10),
              'created_at' => $faker->dateTimeThisYear->getTimestamp(),
              'updated_at' => $faker->dateTimeThisYear->getTimestamp(),
            ]);

            $nodes[] = $node;
        }

        return $nodes;
    }
}

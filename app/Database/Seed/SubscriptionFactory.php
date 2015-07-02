<?php namespace DancerDeck\Database\Seed;

use DancerDeck\Subscriptions\RegistrationSubscriptionEdge;
use DancerDeck\Subscriptions\EarlyBirdSubscriptionEdge;
use DancerDeck\Subscriptions\HotelBookingSubscriptionEdge;
use DancerDeck\Subscriptions\AirfareBookingSubscriptionEdge;

class SubscriptionFactory
{
    /**
     * @var array
     */
    private $subscriptions = [];

    public function __construct()
    {
        $this->subscriptions = [
          new RegistrationSubscriptionEdge,
          new EarlyBirdSubscriptionEdge,
          new HotelBookingSubscriptionEdge,
          new AirfareBookingSubscriptionEdge,
        ];
    }

    /**
     * Returns random subscription edges
     *
     * @return array
     */
    public function getRandomSubscriptionEdges()
    {
        $numberOfEdges = mt_rand(1, count($this->subscriptions));

        return Seeder::arrayRandomElement($this->subscriptions, $numberOfEdges);
    }
}

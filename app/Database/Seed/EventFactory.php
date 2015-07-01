<?php namespace DancerDeck\Database\Seed;

use DancerDeck\DanceEvents\Event;
use DancerDeck\DanceEvents\EventSeries;
use Faker\Factory as Faker;

class EventFactory
{
    /**
     * Makes an arbitrary number of nodes
     *
     * @param EventSeries $eventSeries
     *
     * @return array
     */
    public function generateEvents(EventSeries $eventSeries)
    {
        $faker = Faker::create();

        $nodes = [];

        $numberOfNodes = mt_rand(1,2);

        for ($x=0; $x<$numberOfNodes; $x++) {
            $startDate = $faker->dateTimeThisYear->getTimestamp();
            $numDays = mt_rand(2,4);
            $earlyBirdDays = mt_rand(30,90);

            $node = new Event([
              'name' => $eventSeries->get('name'),
              'website' => $eventSeries->get('website'),
              'logo_url' => $eventSeries->get('logo_url'),
              'start_date' => $startDate,
              'end_date' => strtotime('+'.$numDays.' days', $startDate),
              'early_bird_expiration_date' => strtotime('-'.$earlyBirdDays.' days', $startDate),
              'description' => $faker->sentence(10),
              'buy_ticket_url' => $faker->url,
              'created_at' => $faker->dateTimeThisYear->getTimestamp(),
              'updated_at' => $faker->dateTimeThisYear->getTimestamp(),
            ]);

            $nodes[] = $node;
        }

        return $nodes;
    }
}

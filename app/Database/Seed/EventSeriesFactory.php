<?php namespace DancerDeck\Database\Seed;

use DancerDeck\DanceEvents\EventSeries;
use Faker\Factory as Faker;

class EventSeriesFactory
{
    /**
     * Makes an arbitrary number of nodes
     *
     * @param int $numberOfNodes
     *
     * @return array
     */
    public function generateNodes($numberOfNodes = 10)
    {
        $faker = Faker::create();

        $nodes = [];

        for ($x=0; $x<$numberOfNodes; $x++) {
            $prependName = $faker->randomElement(['Swing', 'West Coast', 'Boogie', '', '']);
            $appendName = $faker->randomElement(['Dance', 'Jam', 'Nationals', 'Championship', '', '', '']);
            $node = new EventSeries([
              'name' => trim($prependName.' '.$faker->company.' '.$appendName),
              'website' => 'http://'.$faker->domainName,
              'logo_url' => $faker->imageUrl(400, 400),
              'last_event_date' => $faker->dateTimeThisYear->getTimestamp(),
              'locale' => $faker->locale,
              'country' => $faker->countryCode,
              'created_at' => $faker->dateTimeThisYear->getTimestamp(),
              'updated_at' => $faker->dateTimeThisYear->getTimestamp(),
            ]);

            $nodes[] = $node;
        }

        return $nodes;
    }
}

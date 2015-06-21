<?php namespace DancerDeck\Database\Seed;

use DancerDeck\Accounts\User;
use Illuminate\Contracts\Hashing\Hasher;
use Faker\Factory as Faker;

class UserFactory
{
    /**
     * @var Hasher
     */
    private $hasher;

    /**
     * @param Hasher $hasher
     */
    public function __construct(Hasher $hasher)
    {
        $this->hasher = $hasher;
    }

    /**
     * Makes an arbitrary number of nodes
     *
     * @param int $numberOfNodes
     *
     * @return array
     */
    public function generateNodes($numberOfNodes = 5)
    {
        $faker = Faker::create();

        $nodes = [];

        for ($x=0; $x<$numberOfNodes; $x++) {
            $firstName = $faker->firstName;
            $lastName = $faker->lastName;
            $password = implode('-', $faker->words);

            $user = new User([
              'name' => $firstName.' '.$lastName,
              'first_name' => $firstName,
              'last_name' => $lastName,
              'email' => strtolower($faker->email),
              'password' => $this->hasher->make($password),
              'locale' => $faker->locale,
              'facebook_id' => $faker->unique()->randomNumber(),
              'created_at' => $faker->dateTimeThisYear->getTimestamp(),
              'updated_at' => $faker->dateTimeThisYear->getTimestamp(),
            ]);

            $nodes[] = [
                'metadata' => [
                    'password' => $password,
                ],
                'node' => $user,
            ];
        }

        return $nodes;
    }
}

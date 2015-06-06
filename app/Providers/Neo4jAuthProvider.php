<?php namespace DancerDeck\Providers;

use Illuminate\Support\ServiceProvider;
use DancerDeck\Accounts\Neo4jUserProvider;
use DancerDeck\Accounts\User;

class Neo4jAuthProvider extends ServiceProvider
{
    /**
     * Load the Neo4j custom auth provider.
     *
     * @return void
     */
    public function boot()
    {
        $client = $this->app->make('DancerDeck\Database\Repository');
        $hasher = $this->app->make('Illuminate\Contracts\Hashing\Hasher');

        $this->app['auth']->extend('neo4j', function() use ($client, $hasher)
        {
            return new Neo4jUserProvider($client, new User, $hasher);
        });
    }

    /**
     * @return void
     */
    public function register()
    {
    }
}

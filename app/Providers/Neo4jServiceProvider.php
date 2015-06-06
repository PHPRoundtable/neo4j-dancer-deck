<?php namespace DancerDeck\Providers;

use Illuminate\Support\ServiceProvider;
use Neoxygen\NeoClient\ClientBuilder;

class Neo4jServiceProvider extends ServiceProvider
{
    /**
     * Register the Neo4j client.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Neoxygen\NeoClient\Client', function ($app) {
            $protocol = $app['config']->get('database.connections.neo4j.protocol');
            $host = $app['config']->get('database.connections.neo4j.host');
            $port = $app['config']->get('database.connections.neo4j.port');
            $username = $app['config']->get('database.connections.neo4j.username');
            $password = $app['config']->get('database.connections.neo4j.password');

            return ClientBuilder::create()
                                   ->addConnection('default', $protocol, $host, $port, $authMode = true, $username, $password)
                                   ->setAutoFormatResponse(true)
                                   ->build();
        });
    }
}

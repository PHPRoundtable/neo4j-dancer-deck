<?php namespace DancerDeck\Console\Commands;

use Illuminate\Console\Command;
use Neoxygen\NeoClient\Client;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class Neo4jClear extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'neo4j:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Completely clears the database of all data.';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param Client $client
     *
     * @return mixed
     */
    public function fire(Client $client)
    {
        if (env('APP_ENV') !== 'local') {
            $this->error('Whoa! Only clear the db on local.');
            return;
        }

        $challengeData = mt_rand(1000,9999);

        $this->error('Whoa! This will delete the whole frigging database!');
        $this->info('Enter the challenge [<comment>'.$challengeData.'</comment>] to confirm you want to do this.');
        $confirmData = (int) $this->ask('Challenge');

        if ($challengeData !== $confirmData) {
            $this->info('Challenge data did not match. Bailing.');
            return;
        }

        $this->info('Deleting all the things...');

        $query = "MATCH (n) OPTIONAL MATCH (n)-[r]-() DELETE n,r";
        $client->sendCypherQuery($query);

        $this->info('Done.');
    }
}

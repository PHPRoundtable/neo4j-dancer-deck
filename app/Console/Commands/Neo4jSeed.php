<?php namespace DancerDeck\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use DancerDeck\Database\Seed\Seeder;

class Neo4jSeed extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'neo4j:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed the Neo4j database with neat data.';

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
     * @param Seeder $seeder
     *
     * @return mixed
     */
    public function fire(Seeder $seeder)
    {
        if (env('APP_ENV') !== 'local') {
            $this->error('Whoa! Only gonna seed the db on local.');
            return;
        }

        $this->info('Seeding the graph database...');
        $displayInfo = $seeder->seed();

        foreach ($displayInfo as $info) {
            $this->line($info);
        }

        $this->info('Done.');
    }
}

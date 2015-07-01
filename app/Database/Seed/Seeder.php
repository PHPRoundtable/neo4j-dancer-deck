<?php namespace DancerDeck\Database\Seed;

use DancerDeck\Database\Repository;

class Seeder
{
    /**
     * @var Repository
     */
    private $repo;

    /**
     * @var UserFactory
     */
    private $userFactory;

    /**
     * @var array
     */
    private $userNodes;

    /**
     * @var array
     */
    private $eventSeriesNodes;

    /**
     * @var array
     */
    private $eventNodes;

    /**
     * @param Repository $repo
     * @param UserFactory $userFactory
     */
    public function __construct(Repository $repo, UserFactory $userFactory)
    {
        $this->repo = $repo;
        $this->userFactory = $userFactory;
    }

    /**
     * Seeds the database with all data
     *
     * @return array
     */
    public function seed()
    {
        $userDisplayInfo = $this->seedUserData();
        $eventSeriesDisplayInfo = $this->seedEventSeries();

        return array_merge($userDisplayInfo, $eventSeriesDisplayInfo);
    }

    /**
     * Seeds the database with user data
     *
     * @return array
     */
    private function seedUserData()
    {
        $nodes = $this->userFactory->generateNodes(10);

        $displayInfo = [
          '', // New line
          '<comment>Seeding User nodes...</comment>',
        ];
        foreach ($nodes as $entity) {
            $node = $this->repo->createNode($entity['node']);

            $this->userNodes[] = $node;

            $displayInfo[] = 'Created user <info>'.$node->get('email').'</info> with password <comment>'.$entity['metadata']['password'].'</comment> and ID <comment>'.$node->get('id').'</comment>';
        }

        return $displayInfo;
    }

    /**
     * Seeds the database with event series data
     *
     * @return array
     */
    private function seedEventSeries()
    {
        $eventSeriesFactory = new EventSeriesFactory;
        $eventFactory = new EventFactory;
        $nodes = $eventSeriesFactory->generateNodes(10);

        $displayInfo = [
          '', // New line
          '<comment>Seeding Event Series nodes...</comment>',
        ];
        foreach ($nodes as $eventSeriesNode) {
            $eventSeriesNode = $this->repo->createNode($eventSeriesNode);
            $this->eventSeriesNodes[] = $eventSeriesNode;

            $displayInfo[] = 'Created event series <info>'.$eventSeriesNode->get('name').'</info>';

            $eventNodes = $eventFactory->generateEvents($eventSeriesNode);

            foreach ($eventNodes as $eventNode) {
                $eventNode = $this->repo->createNode($eventNode);
                $this->repo->createEdge($eventSeriesNode, $eventNode, 'RUNS_EVENT');

                $startDate = date('M d y', $eventNode->get('start_date'));
                $endDate = date('M d y', $eventNode->get('end_date'));
                $displayInfo[] = '<comment>››</comment> New event <info>'.$startDate.'</info> to <info>'.$endDate.'</info>';
            }
        }

        return $displayInfo;
    }
}

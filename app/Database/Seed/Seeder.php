<?php namespace DancerDeck\Database\Seed;

use DancerDeck\Database\Repository;

class Seeder
{
    /**
     * @const int
     */
    const NUMBER_OF_USERS = 10;

    /**
     * @const int
     */
    const NUMBER_OF_EVENT_SERIES = 10;

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
     * @var array
     */
    private $subscriptionNodes;

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
        $subscriptionsDisplayInfo = $this->seedSubscriptions();

        return array_merge($userDisplayInfo, $eventSeriesDisplayInfo, $subscriptionsDisplayInfo);
    }

    /**
     * Returns random values from an array
     *
     * @param array $items
     * @param int $maxItems
     *
     * @return array
     */
    public static function arrayRandomElement(array $items, $maxItems)
    {
        $keys = array_rand($items, $maxItems);
        $keys = is_array($keys) ? $keys : [$keys];
        $returnItems = [];

        foreach ($keys as $key) {
            $returnItems[] = $items[$key];
        }

        return $returnItems;
    }

    /**
     * Seeds the database with user data
     *
     * @return array
     */
    private function seedUserData()
    {
        $nodes = $this->userFactory->generateNodes(self::NUMBER_OF_USERS);

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
        $nodes = $eventSeriesFactory->generateNodes(self::NUMBER_OF_EVENT_SERIES);
        $edge = $eventFactory->getRunsEventEdge();

        $displayInfo = [
          '', // New line
          '<comment>Seeding Event Series nodes...</comment>',
        ];
        foreach ($nodes as $eventSeriesNode) {
            $eventSeriesNode = $this->repo->createNode($eventSeriesNode);
            $this->eventSeriesNodes[] = $eventSeriesNode;

            $displayInfo[] = 'Created event series <info>'.$eventSeriesNode->get('name').'</info>';

            $this->eventNodes = $eventFactory->generateEvents($eventSeriesNode);

            foreach ($this->eventNodes as $eventNode) {
                $eventNode = $this->repo->createNode($eventNode);

                $this->repo->createEdge($eventSeriesNode, $eventNode, $edge);

                $startDate = date('M d y', $eventNode->get('start_date'));
                $endDate = date('M d y', $eventNode->get('end_date'));
                $displayInfo[] = '<comment>››</comment> New event <info>'.$startDate.'</info> to <info>'.$endDate.'</info>';
            }
        }

        return $displayInfo;
    }

    /**
     * Seeds the database with subscription nodes
     *
     * @return array
     */
    private function seedSubscriptions()
    {
        $randUsers = $this->getRandomUsers();

        $displayInfo = [
          '', // New line
          '<comment>Seeding subscription edges...</comment>',
        ];

        $factory = new SubscriptionFactory;

        foreach ($randUsers as $user) {
            $randEventSeries = $this->getRandomEventSeries(4);
            $displayInfo[] = 'Subscribing user <info>'.$user->get('name').'</info> to:';

            foreach ($randEventSeries as $eventSeries) {
                $edges = $factory->getRandomSubscriptionEdges();

                $displayInfo[] = '<comment>››</comment> <info>'.$eventSeries->get('name').'</info>:';
                foreach ($edges as $edge) {
                    $this->repo->createEdge($user, $eventSeries, $edge);
                    $displayInfo[] = '<comment>›››› '.$edge::NAME.'</comment>';
                }
            }
        }

        return $displayInfo;
    }

    /**
     * Gets a handful of random User nodes
     *
     * @return array
     */
    private function getRandomUsers()
    {
        $numberOfNodes = mt_rand(3, self::NUMBER_OF_USERS);

        return self::arrayRandomElement($this->userNodes, $numberOfNodes);
    }

    /**
     * Gets a random EventSeries node
     *
     * @param int $max
     *
     * @return array
     */
    private function getRandomEventSeries($max = null)
    {
        $max = $max ?: self::NUMBER_OF_EVENT_SERIES;
        $numberOfNodes = mt_rand(1, $max);

        return self::arrayRandomElement($this->eventSeriesNodes, $numberOfNodes);
    }
}

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

        return $userDisplayInfo;
    }

    /**
     * Seeds the database with user data
     *
     * @return array
     */
    private function seedUserData()
    {
        $users = $this->userFactory->generateNodes(10);

        $displayInfo = [
          '', // New line
          '<comment>Seeding User nodes...</comment>',
        ];
        foreach ($users as $entity) {

            $node = $this->repo->createNode($entity['node']);

            $displayInfo[] = 'Created user <info>'.$node->get('email').'</info> with password <comment>'.$entity['metadata']['password'].'</comment> and ID <comment>'.$node->get('id').'</comment>';
        }

        return $displayInfo;
    }
}

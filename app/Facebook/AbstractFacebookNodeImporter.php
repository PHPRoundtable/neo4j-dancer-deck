<?php namespace DancerDeck\Facebook;

use DancerDeck\Database\Repository;
use DancerDeck\Database\BaseNode;
use Facebook\GraphNodes\GraphNode;

abstract class AbstractFacebookNodeImporter
{
    /**
     * @const string The name of the node
     */
    const NODE = 'DancerDeck\Database\BaseNode';

    /**
     * @const string The name of the prop that stores the Facebook ID
     */
    const FACEBOOK_ID_PROP = 'facebook_id';

    /**
     * @var Repository
     */
    protected $repo;

    public function __construct(Repository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * Attempts to find a Facebook node in the database
     *
     * @param GraphNode $graphNode
     *
     * @return BaseNode
     */
    public function findNode(GraphNode $graphNode)
    {
        $node = $this->generateNewNode([
          static::FACEBOOK_ID_PROP => $graphNode->getField('id'),
        ]);

        $foundNode = $this->repo->findOneBy($node);

        return $foundNode;
    }

    /**
     * Creates a Graph node in the database
     *
     * @param GraphNode $graphNode
     *
     * @return BaseNode
     */
    public function createNode(GraphNode $graphNode)
    {
        $propsFromFacebook = [static::FACEBOOK_ID_PROP => $graphNode->getField('id')]
          + $graphNode->asArray();

        // Because ID's on FB are always "id"
        unset($propsFromFacebook['id']);

        $node = $this->generateNewNode($propsFromFacebook);

        return $this->repo->createNode($node);
    }

    /**
     * Update an existing node in the database with the node from Facebook
     *
     * @param BaseNode $node
     * @param GraphNode $graphNode
     *
     * @return BaseNode
     */
    public function updateNode(BaseNode $node, GraphNode $graphNode)
    {
        $propsFromFacebook = [static::FACEBOOK_ID_PROP => $graphNode->getField('id')]
          + $graphNode->asArray();

        // Because ID's on FB are always "id"
        unset($propsFromFacebook['id']);

        $props = array_merge($node->all(), $propsFromFacebook);

        $node = $this->generateNewNode($props);

        return $this->repo->updateNode($node);
    }

    /**
     * Generate a new node
     *
     * @param array $data
     *
     * @return BaseNode
     */
    private function generateNewNode(array $data = [])
    {
        $class = static::NODE;

        return new $class($data);
    }
}

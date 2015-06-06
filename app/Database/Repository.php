<?php namespace DancerDeck\Database;

use DancerDeck\Database\Exceptions\EntityNotFoundException;
use Neoxygen\NeoClient\Client;
use Neoxygen\NeoClient\Formatter\Node;

class Repository
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var string The last used query
     */
    private $lastQuery;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Creates a node in the database.
     *
     * @param BaseNode $node
     *
     * @return BaseNode
     */
    public function createNode(BaseNode $node)
    {
        $node = $node->generateUuid();
        $namedParams = $node->getNamedParametersForCreate();

        $this->lastQuery = "CREATE (n:".$node::LABEL." {".$namedParams."}) RETURN n";
        $this->client->sendCypherQuery($this->lastQuery, $node->all());

        return $this->parseSingleNodeResponse($node);
    }

    /**
     * Updates a node in the database.
     *
     * @param BaseNode $node
     *
     * @return BaseNode
     *
     * @throws \InvalidArgumentException
     */
    public function updateNode(BaseNode $node)
    {
        if (!$id = $node->get('id')) {
            throw new \InvalidArgumentException('An ID is required to update this node.');
        }

        $namedParams = $node->getNamedParametersForUpdate();

        $this->lastQuery = "MATCH (n:".$node::LABEL." {id: {id}}) SET ".$namedParams." RETURN n";
        $this->client->sendCypherQuery($this->lastQuery, $node->all());

        return $this->parseSingleNodeResponse($node);
    }

    /**
     * Deletes a node from the database.
     *
     * @param BaseNode $node
     *
     * @throws \InvalidArgumentException
     */
    public function deleteNode(BaseNode $node)
    {
        if (!$id = $node->get('id')) {
            throw new \InvalidArgumentException('An ID is required to delete this node.');
        }

        $this->lastQuery = "MATCH (n:".$node::LABEL." {id: {id}}) OPTIONAL MATCH (n)-[r]-() DELETE n,r";
        $this->client->sendCypherQuery($this->lastQuery, $node->all());
    }

    /**
     * Finds a node by prop(s)
     *
     * @param BaseNode $node
     *
     * @return BaseNode|null
     */
    public function findOneBy(BaseNode $node)
    {
        $namedParams = $node->getNamedParametersForCreate();

        $this->lastQuery = "MATCH (n:".$node::LABEL." {".$namedParams."}) RETURN n";
        $this->client->sendCypherQuery($this->lastQuery, $node->all());

        $result = $this->client->getResult();
        if (!$graphNode = $result->getSingleNode($node::LABEL)) {
            return null;
        }

        $nodeClassName = get_class($node);

        return new $nodeClassName($graphNode->getProperties());
    }

    /**
     * Returns the last used query
     *
     * @return string|null
     */
    public function getLastQuery()
    {
        return $this->lastQuery;

    }

    /**
     * Parses a response that expects a single node in return
     *
     * @param BaseNode $node
     *
     * @return BaseNode
     *
     * @throws EntityNotFoundException
     */
    private function parseSingleNodeResponse(BaseNode $node)
    {
        $result = $this->client->getResult();
        $graphNode = $result->getSingleNode($node::LABEL);

        if (!$graphNode instanceof Node) {
            throw new EntityNotFoundException('Expected a single node. None returned.');
        }

        $nodeClassName = get_class($node);

        return new $nodeClassName($graphNode->getProperties());
    }
}

<?php

namespace madmis\BtceApi;

use Doctrine\Common\Annotations\AnnotationRegistry;
use madmis\BtceApi\Client\ClientInterface;
use madmis\BtceApi\Client\GuzzleClient;
use madmis\BtceApi\Endpoint\EndpointFactory;

/**
 * Class BtceApi
 * @package madmis\BtceApi
 */
class BtceApi
{
    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var string
     */
    private $publicKey;

    /**
     * @var string
     */
    private $secretKey;

    /**
     * @var EndpointFactory
     */
    private $endpointFactory;

    /**
     * @param string $baseUri example: http://localhost:8080
     * @param string $publicKey
     * @param string $secretKey
     * @param string $apiUrn example: /api/v2
     * @param array $options extra parameters
     */
    public function __construct(
        string $baseUri,
        string $publicKey,
        string $secretKey,
        string $apiUrn = '/',
        array $options = []
    )
    {
        $this->client = new GuzzleClient($baseUri, $apiUrn, $options);
        $this->publicKey = $publicKey;
        $this->secretKey = $secretKey;
        $this->endpointFactory = new EndpointFactory();
    }

    /**
     * @param ClientInterface $client
     */
    public function setClient(ClientInterface $client): void
    {
        $this->client = $client;
    }

    /**
     * @return ClientInterface
     */
    public function getClient(): ClientInterface
    {
        return $this->client;
    }
}

AnnotationRegistry::registerLoader('class_exists');

<?php

namespace madmis\BtceApi\Endpoint;

use madmis\BtceApi\Client\ClientInterface;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Class AbstractEndpoint
 *
 * @package madmis\BtceApi\Endpoint
 */
abstract class AbstractEndpoint
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var string
     */
    protected $baseUrn = '/';

    /**
     * @var bool
     */
    protected $mapping = false;

    /**
     * Additional endpoint options
     *
     * @var array
     */
    protected $options = [];

    /**
     * @param ClientInterface $client
     * @param array $options
     */
    public function __construct(ClientInterface $client, array $options = [])
    {
        $this->client = $client;
        $this->options = $options;
    }

    /**
     * @param array $params
     * @return string
     */
    public function getApiUrn(array $params = []): string
    {
        $path = '';
        if ($params) {
            $params = array_map(function ($el) {
                return trim($el, '/');
            }, $params);
            $path = implode('/', $params);
        }

        return rtrim(sprintf(
            '%s%s/%s',
            rtrim($this->client->getApiUrn(), '/'),
            rtrim($this->baseUrn, '/'),
            $path
        ), '/');
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array $options
     * @return array
     */
    abstract protected function sendRequest(string $method, string $uri, array $options = []): array;

    /**
     * @param ResponseInterface $response
     * @return array
     * @throws \RuntimeException
     */
    protected function processResponse(ResponseInterface $response): array
    {
        return json_decode($response->getBody()->getContents(), true);
    }


    /**
     * @param array $items
     * @param string $className
     * @return array|object[]
     */
    protected function deserializeItems(array $items, string $className)
    {
        foreach ($items as $key => $item) {
            $items[$key] = $this->deserializeItem($item, $className);
        }

        return $items;
    }

    /**
     * @param array $item
     * @param string $className
     * @return object
     */
    protected function deserializeItem(array $item, string $className)
    {
        static $serializer = null;
        if ($serializer === null) {
            $normalizers = [
                new ObjectNormalizer(),
                new GetSetMethodNormalizer(),
                new DateTimeNormalizer(),
            ];
            $serializer = $serializer = new Serializer($normalizers, [new JsonEncoder()]);
        }

        return $serializer->deserialize(json_encode($item), $className, 'json');
    }
}

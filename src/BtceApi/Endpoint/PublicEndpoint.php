<?php

namespace madmis\BtceApi\Endpoint;

use madmis\BtceApi\Api;
use madmis\BtceApi\Client\ClientInterface;
use madmis\BtceApi\Exception\ClientException;

/**
 * Class PublicEndpoint
 * @package madmis\BtceApi\Endpoint
 */
class PublicEndpoint extends AbstractEndpoint implements EndpointInterface
{
    /**
     * @param ClientInterface $client
     * @param array $options
     */
    public function __construct(ClientInterface $client, array $options = [])
    {
        parent::__construct($client, $options);
        $this->baseUrn = '/api/3/';
    }

    /**
     * This method provides all the information about currently active pairs
     * @param bool $mapping
     * @return array|Info
     * @throws ClientException
     */
    public function info(bool $mapping = false)
    {
        $response = $this->sendRequest(Api::GET, $this->getApiUrn(['info']));

        if ($mapping) {
            $response = $this->deserializeItems($response, Info::class);
        }

        return $response;

    }

    /**
     * Provides all the information about currently active pairs.
     * All information is provided over the past 24 hours.
     * @param string $pair
     * @param bool $mapping
     * @return array|Ticker
     * @throws ClientException
     */
    public function ticker(string $pair, bool $mapping = false)
    {
        $response = $this->sendRequest(Api::GET, $this->getApiUrn(['ticker', $pair]));

        if ($mapping) {
            $response = $this->deserializeItems($response, Ticker::class);
        }

        return $response;
    }

    /**
     * Provides the information about active orders on the pair
     * @param string $pair
     * @param int $limit max value 5000
     * @param bool $mapping
     * @return array|Depth
     * @throws ClientException
     */
    public function depth(string $pair, int $limit = 150, bool $mapping = false)
    {
        if ($limit > 5000) {
            $limit = 5000;
        }

        $response = $this->sendRequest(
            Api::GET,
            $this->getApiUrn(['depth', $pair]),
            ['query' => ['limit' => $limit]]
        );

        if ($mapping) {
            $response = $this->deserializeItems($response, Depth::class);
        }

        return $response;
    }

    /**
     * Provides the information about the last trades
     * @param string $pair
     * @param int $limit max value 5000
     * @param bool $mapping
     * @return array|Trade
     * @throws ClientException
     */
    public function trades(string $pair, int $limit = 150, bool $mapping = false)
    {
        if ($limit > 5000) {
            $limit = 5000;
        }

        $response = $this->sendRequest(
            Api::GET,
            $this->getApiUrn(['trades', $pair]),
            ['query' => ['limit' => $limit]]
        );

        if ($mapping) {
            $response = $this->deserializeItems($response, Trade::class);
        }

        return $response;
    }

    /**
     * @param string $method Http::GET|POST
     * @param string $uri
     * @param array $options Request options to apply to the given
     *                                  request and to the transfer.
     * @return array response
     * @throws ClientException
     */
    protected function sendRequest(string $method, string $uri, array $options = []): array
    {
        $request = $this->client->createRequest($method, $uri);

        return $this->processResponse(
            $this->client->send($request, $options)
        );
    }
}

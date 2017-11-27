<?php

namespace madmis\WexnzApi\Endpoint;

use madmis\WexnzApi\Api;
use madmis\WexnzApi\Model\Depth;
use madmis\WexnzApi\Model\Info;
use madmis\WexnzApi\Model\PairInfo;
use madmis\WexnzApi\Model\Ticker;
use madmis\WexnzApi\Model\Trade;
use madmis\ExchangeApi\Client\ClientInterface;
use madmis\ExchangeApi\Endpoint\AbstractEndpoint;
use madmis\ExchangeApi\Endpoint\EndpointInterface;
use madmis\ExchangeApi\Exception\ClientException;

/**
 * Class PublicEndpoint
 * @package madmis\WexnzApi\Endpoint
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
            $pairs = $response['pairs'];
            foreach ($pairs as $pair => &$info) {
                $info['pair'] = $pair;
            }
            unset($info);
            $pairs = $this->deserializeItems($response, PairInfo::class);
            $response = $this->deserializeItem($response, Info::class);
            $response->setPairs($pairs);
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
            $item = array_merge(['pair' => $pair], $response[$pair]);
            $response = $this->deserializeItem($item, Ticker::class);
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
            $setDepth = function(array $item) {
                $depth = new Depth();
                $depth->setRate($item[0]);
                $depth->setAmount($item[1]);

                return $depth;
            };

            $result = ['asks' => [], 'bids' => []];
            $result['asks'] = array_map($setDepth, $response['asks']);
            $result['bids'] = array_map($setDepth, $response['bids']);

            $response = $result;
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

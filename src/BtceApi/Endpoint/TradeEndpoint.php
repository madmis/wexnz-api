<?php

namespace madmis\BtceApi\Endpoint;

use madmis\BtceApi\Api;
use madmis\BtceApi\Client\ClientInterface;
use madmis\BtceApi\Exception\ClientException;

/**
 * Class TradeEndpoint
 * @package madmis\BtceApi\Endpoint
 */
class TradeEndpoint extends AbstractEndpoint implements EndpointInterface
{
    /**
     * @param ClientInterface $client
     * @param array $options
     */
    public function __construct(ClientInterface $client, array $options = [])
    {
        parent::__construct($client, $options);
        $this->baseUrn = '/tapi';
    }

    /**
     * Returns information about the user’s current balance,
     * API-key privileges, the number of open orders and Server Time.
     * @param bool $mapping
     * @return array|UserInfo
     * @throws ClientException
     */
    public function userInfo(bool $mapping = false)
    {
        $options = [
            'query' => [
                'method' => 'getInfo',
                'nonce' => $this->getNonce(),
            ],
        ];

        $response = $this->sendRequest(Api::POST, $this->getApiUrn(), $options);

        if ($mapping) {
            $response = $this->deserializeItem($response, UserInfo::class);
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
        $sign = hash_hmac(
            'sha512',
            http_build_query($options['query']),
            $this->options['secretKey']
        );

        $request = $this->client->createRequest($method, $uri, [
            'Sign: ' . $sign,
            'Key: ' . $this->options['publicKey'],
        ]);

        $response = $this->client->send($request, $options);

        $this->updateNonce($options['query']['nonce'] + 1);

        return $this->processResponse($response);
    }

    /**
     * @return string
     */
    protected function nonceFilePath(): string
    {
        return sprintf(
            '%s/../../../var/%s-nonce.dat',
            __DIR__,
            $this->options['publicKey']
        );
    }

    /**
     * @param int $nonce
     * @return bool|int
     * @throws \RuntimeException
     */
    protected function updateNonce(int $nonce)
    {
        if ($nonce > 4294967294) {
            throw new \RuntimeException(
                'Reached nonce maximum. To solve this prolem create a new api key.'
            );
        }

        return file_put_contents($this->nonceFilePath(), $nonce);
    }

    /**
     * @return int
     * @throws \RuntimeException
     */
    protected function getNonce(): int
    {
        $path = $this->nonceFilePath();
        if (!file_exists($path)) {
            $this->updateNonce(1);
        }

        return (int)file_get_contents($path);
    }
}

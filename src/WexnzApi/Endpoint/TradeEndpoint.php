<?php

namespace madmis\WexnzApi\Endpoint;

use madmis\WexnzApi\Api;
use madmis\WexnzApi\Model\UserInfo;
use madmis\ExchangeApi\Client\ClientInterface;
use madmis\ExchangeApi\Endpoint\AbstractEndpoint;
use madmis\ExchangeApi\Endpoint\EndpointInterface;
use madmis\ExchangeApi\Exception\ClientException;
use Symfony\Component\OptionsResolver\Exception\AccessException;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class TradeEndpoint
 * @package madmis\WexnzApi\Endpoint
 */
class TradeEndpoint extends AbstractEndpoint implements EndpointInterface
{
    /**
     * @param ClientInterface $client
     * @param array $options
     */
    public function __construct(ClientInterface $client, array $options = [])
    {
        $resolver = new OptionsResolver();
        $this->configureOptions($resolver);

        parent::__construct($client, $resolver->resolve($options));
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
            'Sign' => $sign,
            'Key' => $this->options['publicKey'],
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

    /**
     * @param OptionsResolver $resolver
     * @throws AccessException
     */
    protected function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired(['publicKey', 'secretKey']);
        $resolver->setAllowedTypes('publicKey', 'string');
        $resolver->setAllowedTypes('secretKey', 'string');
    }
}

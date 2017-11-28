<?php

namespace madmis\WexnzApi\Endpoint;

use madmis\WexnzApi\Api;
use madmis\WexnzApi\Model\CancelOrder;
use madmis\WexnzApi\Model\NewOrder;
use madmis\WexnzApi\Model\Order;
use madmis\WexnzApi\Model\TradeHistory;
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
            'form_params' => [
                'nonce' => $this->getNonce(),
                'method' => 'getInfo',
            ],
        ];

        $response = $this->sendRequest(Api::POST, $this->getApiUrn(), $options);

        if ($mapping) {
            $response = $this->deserializeItem($response['return'], UserInfo::class);
        }

        return $response;
    }

    /**
     * Active orders list
     * @param string $pair
     * @param bool $mapping
     * @return array|Order[]
     */
    public function activeOrders(string $pair, bool $mapping = false): array
    {
        $options = [
            'form_params' => [
                'nonce' => $this->getNonce(),
                'method' => 'ActiveOrders',
                'pair' => $pair,
            ],
        ];

        $response = $this->sendRequest(Api::POST, $this->getApiUrn(), $options);

        if ($mapping) {
            $items = [];
            foreach ($response['return'] as $id => $item) {
                $item['id'] = $id;
                $items[] = $item;
            }
            $response = $this->deserializeItems($items, Order::class);
        }

        return $response;
    }

    /**
     * Create orders
     * @param string $pair
     * @param string $type buy|sell
     * @param float $rate
     * @param float $amount
     * @param bool $mapping
     * @return array|NewOrder
     */
    public function trade(string $pair, string $type, float $rate, float $amount, bool $mapping = false)
    {
        $options = [
            'form_params' => [
                'nonce' => $this->getNonce(),
                'method' => 'Trade',
                'pair' => $pair,
                'type' => $type,
                'rate' => $rate,
                'amount' => $amount,
            ],
        ];

        $response = $this->sendRequest(Api::POST, $this->getApiUrn(), $options);

        if ($mapping) {
            $response = $this->deserializeItem($response['return'], NewOrder::class);
        }

        return $response;
    }

    /**
     * @param int $orderId
     * @param bool $mapping
     * @return array|Order
     */
    public function orderInfo(int $orderId, bool $mapping = false)
    {
        $options = [
            'form_params' => [
                'nonce' => $this->getNonce(),
                'method' => 'OrderInfo',
                'order_id' => $orderId,
            ],
        ];

        $response = $this->sendRequest(Api::POST, $this->getApiUrn(), $options);

        if ($mapping) {
            $info = $response['return'][$orderId];
            $info['id'] = $orderId;
            $response = $this->deserializeItem($info, Order::class);
        }

        return $response;
    }

    /**
     * @param int $orderId
     * @param bool $mapping
     * @return array|CancelOrder
     */
    public function cancelOrder(int $orderId, bool $mapping = false)
    {
        $options = [
            'form_params' => [
                'nonce' => $this->getNonce(),
                'method' => 'CancelOrder',
                'order_id' => $orderId,
            ],
        ];

        $response = $this->sendRequest(Api::POST, $this->getApiUrn(), $options);

        if ($mapping) {
            $response = $this->deserializeItem($response['return'], CancelOrder::class);
        }

        return $response;
    }

    /**
     * @param string $pair
     * @param int $limit
     * @param string $order
     * @param bool $mapping
     * @return array|TradeHistory[]
     */
    public function tradeHistory(string $pair, bool $mapping = false, int $limit = 1000, string $order = 'DESC'): array
    {
        $options = [
            'form_params' => [
                'nonce' => $this->getNonce(),
                'method' => 'TradeHistory',
                'pair' => $pair,
                'limit' => $limit,
                'order' => $order,
            ],
        ];

        $response = $this->sendRequest(Api::POST, $this->getApiUrn(), $options);

        if ($mapping) {
            $response = $this->deserializeItem($response['return'], TradeHistory::class);
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
            http_build_query($options['form_params']),
            $this->options['secretKey']
        );

        $request = $this->client->createRequest($method, $uri, [
            'Sign' => $sign,
            'Key' => $this->options['publicKey'],
        ]);

        $options['debug'] = false;
        $response = $this->client->send($request, $options);

        $this->updateNonce($options['form_params']['nonce'] + 1);

        $response = $this->processResponse($response);
        if (!$response['success']) {
            $response['return'] = [];
        }

        return $response;
    }

    /**
     * @param array $item
     * @param string $className
     * @return array|object
     */
    protected function deserializeItems(array $item, string $className)
    {
        if (!$item) {
            return [];
        }

        return parent::deserializeItems($item, $className);
    }

    /**
     * @param array $item
     * @param string $className
     * @return array|object
     */
    protected function deserializeItem(array $item, string $className)
    {
        if (!$item) {
            return [];
        }

        return parent::deserializeItem($item, $className);
    }

    /**
     * @return string
     */
    protected function nonceFilePath(): string
    {
        return sprintf(
            '%s/%s-nonce.dat',
            $this->options['nonceFilePath'],
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
            throw new \RuntimeException('Reached nonce maximum. To solve this prolem create a new api key.');
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
        $resolver->setDefaults([
            'nonceFilePath' => '/tmp/',
        ]);
        $resolver->setRequired(['publicKey', 'secretKey']);
        $resolver->setAllowedTypes('publicKey', 'string');
        $resolver->setAllowedTypes('secretKey', 'string');
        $resolver->setAllowedTypes('nonceFilePath', 'string');
    }
}

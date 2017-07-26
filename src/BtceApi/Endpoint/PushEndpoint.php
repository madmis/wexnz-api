<?php

namespace madmis\BtceApi\Endpoint;

/**
 * Class PushEndpoint
 * @package madmis\BtceApi\Endpoint
 */
class PushEndpoint extends AbstractEndpoint implements EndpointInterface
{

    /**
     * @param string $method
     * @param string $uri
     * @param array $options
     * @return array
     */
    protected function sendRequest(string $method, string $uri, array $options = []): array
    {
        throw new \RuntimeException('Not implemented');
    }
}

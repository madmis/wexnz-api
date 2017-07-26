<?php

namespace madmis\BtceApi\Exception;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Class ClientException
 * @package madmis\BtceApi\Exception
 */
class ClientException extends \RuntimeException implements BtceApiExceptionInterface
{
    /** @var RequestInterface */
    private $request;

    /** @var ResponseInterface */
    private $response;

    /**
     * @param \Throwable $e
     * @param RequestInterface $request
     * @param ResponseInterface|null $response
     */
    public function __construct(\Throwable $e, RequestInterface $request, ResponseInterface $response = null)
    {
        parent::__construct($e->getMessage(), $e->getCode(), $e);
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * Get the request that caused the exception
     *
     * @return RequestInterface
     */
    public function getRequest(): RequestInterface
    {
        return $this->request;
    }

    /**
     * Get the associated response
     *
     * @return ResponseInterface|null
     */
    public function getResponse(): ?ResponseInterface
    {
        return $this->response;
    }

    /**
     * Check if a response was received
     *
     * @return bool
     */
    public function hasResponse(): bool
    {
        return $this->response !== null;
    }
}

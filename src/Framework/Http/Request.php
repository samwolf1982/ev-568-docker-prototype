<?php

namespace Framework\Http;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface;

class Request implements ServerRequestInterface
{
    private $queryParams;
    private $parsedBody;

    public function __construct(array $queryParams = [], $parsedBody = null)
    {
        $this->queryParams = $queryParams;
        $this->parsedBody = $parsedBody;
    }

    /**
     * @return array
     */
    public function getQueryParams()
    {
        return $this->queryParams;
    }

    /**
     * @param array $query
     * @return $this
     */
    public function withQueryParams(array $query)
    {
        $new = clone $this;
        $new->queryParams = $query;
        return $new;
    }

    /**
     * @return array|mixed|object|null
     */
    public function getParsedBody()
    {
        return $this->parsedBody;
    }

    /**
     * @param array|object|null $data
     * @return $this
     */
    public function withParsedBody($data)
    {
        $new = clone $this;
        $new->parsedBody = $data;
        return $new;
    }

    /**
     * @return string|void
     */
    public function getProtocolVersion() {}

    /**
     * @param string $version
     * @return Request|void
     */
    public function withProtocolVersion($version) {}

    /**
     * @return \string[][]|void
     */
    public function getHeaders() {}

    /**
     * @param string $name
     * @return bool|void
     */
    public function hasHeader($name) {}

    /**
     * @param string $name
     * @return string[]|void
     */
    public function getHeader($name) {}

    /**
     * @param string $name
     * @return string|void
     */
    public function getHeaderLine($name) {}

    /**
     * @param string $name
     * @param string|string[] $value
     * @return Request|void
     */
    public function withHeader($name, $value) {}

    /**
     * @param string $name
     * @param string|string[] $value
     * @return Request|void
     */
    public function withAddedHeader($name, $value) {}

    /**
     * @param string $name
     * @return Request|void
     */
    public function withoutHeader($name) {}

    /**
     * @return StreamInterface|void
     */
    public function getBody() {}

    /**
     * @param StreamInterface $body
     * @return Request|void
     */
    public function withBody(StreamInterface $body) {}

    /**
     * @return string|void
     */
    public function getRequestTarget() {}

    /**
     * @param mixed $requestTarget
     * @return Request|void
     */
    public function withRequestTarget($requestTarget) {}

    /**
     * @return string|void
     */
    public function getMethod() {}

    /**
     * @param string $method
     * @return Request|void
     */
    public function withMethod($method) {}

    /**
     * @return UriInterface|void
     */
    public function getUri() {}

    /**
     * @param UriInterface $uri
     * @param false $preserveHost
     * @return Request|void
     */
    public function withUri(UriInterface $uri, $preserveHost = false) {}

    /**
     * @return array|void
     */
    public function getServerParams() {}

    /**
     * @return array|void
     */
    public function getCookieParams() {}

    /**
     * @param array $cookies
     * @return Request|void
     */
    public function withCookieParams(array $cookies) {}

    /**
     * @return array|void
     */
    public function getUploadedFiles() {}

    /**
     * @param array $uploadedFiles
     * @return Request|void
     */
    public function withUploadedFiles(array $uploadedFiles) {}

    /**
     * @return array|void
     */
    public function getAttributes() {}

    /**
     * @param string $name
     * @param null $default
     * @return mixed|void
     */
    public function getAttribute($name, $default = null) {}

    /**
     * @param string $name
     * @param mixed $value
     * @return Request|void
     */
    public function withAttribute($name, $value) {}

    /**
     * @param string $name
     * @return Request|void
     */
    public function withoutAttribute($name) {}
}

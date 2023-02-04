<?php

namespace Framework\Http;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class Response implements ResponseInterface
{
    private $headers = [];
    private $body;
    private $statusCode;
    private $reasonPhrase = '';

    private static $phrases = [
        200 => 'OK',
        301 => 'Moved Permanently',
        400 => 'Bad Request',
        403 => 'Forbidden',
        404 => 'Not Found',
        500 => 'Internal Server Error',
    ];

    public function __construct($body, $status = 200)
    {
        // var_export(is_string($body));
        // var_dump($body);die();
//        var_dump();
        $this->body = $body instanceof StreamInterface ? $body : new Stream($body);
        $this->statusCode = $status;
    }

    /**
     * @return StreamInterface
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param StreamInterface $body
     * @return $this
     */
    public function withBody(StreamInterface $body)
    {
        $new = clone $this;
        $new->body = $body;
        return $new;
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @return string
     */
    public function getReasonPhrase()
    {
        if (!$this->reasonPhrase && isset(self::$phrases[$this->statusCode])) {
            $this->reasonPhrase = self::$phrases[$this->statusCode];
        }
        return $this->reasonPhrase;
    }

    /**
     * @param int $code
     * @param string $reasonPhrase
     * @return $this
     */
    public function withStatus($code, $reasonPhrase = '')
    {
        $new = clone $this;
        $new->statusCode = $code;
        $new->reasonPhrase = $reasonPhrase;
        return $new;
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasHeader($name)
    {
        return isset($this->headers[$name]);
    }

    /**
     * @param string $name
     * @return mixed|string[]|null
     */
    public function getHeader($name)
    {
        if (!$this->hasHeader($name)) {
            return null;
        }
        return $this->headers[$name];
    }

    /**
     * @param string $name
     * @param string|string[] $value
     * @return $this
     */
    public function withHeader($name, $value)
    {
        $new = clone $this;
        if ($new->hasHeader($name)) {
            unset($new->headers[$name]);
        }
        $new->headers[$name] = (array)$value;
        return $new;
    }

    /**
     * @param string $name
     * @param string|string[] $value
     * @return $this
     */
    public function withAddedHeader($name, $value)
    {
        $new = clone $this;
        $new->headers[$name] = array_merge($new->headers[$name], (array)$value);
        return $new;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function withoutHeader($name)
    {
        $new = clone $this;
        if ($new->hasHeader($name)) {
            unset($new->headers[$name]);
        }
        return $new;
    }

    /**
     * @return string|void
     */
    public function getProtocolVersion() {}

    /**
     * @param string $version
     * @return Response|void
     */
    public function withProtocolVersion($version) {}

    /**
     * @param string $name
     * @return string|void
     */
    public function getHeaderLine($name) {}
}

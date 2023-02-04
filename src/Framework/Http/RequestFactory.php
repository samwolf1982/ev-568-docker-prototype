<?php

namespace Framework\Http;

class RequestFactory
{
    /**
     * @param array|null $query
     * @param array|null $body
     * @return Request
     */
    public static function fromGlobals(array $query = null, array $body = null)
    {
        return (new Request())
            ->withQueryParams($query ?: $_GET)
            ->withParsedBody($body ?: $_POST);
    }
}
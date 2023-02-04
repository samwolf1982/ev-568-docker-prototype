<?php

namespace Framework\Http;

use Psr\Http\Message\StreamInterface;

class Stream implements StreamInterface
{
    private $content;

    /**
     * Stream constructor.
     * @param string $content
     */
//    public function __construct(string $content) // don't work in 5.6 use only doc block
    public function __construct($content)
    {
        $this->content = $content;
    }

    public function __toString()
    {
        return $this->getContents();
    }

    /**
     * @return string
     */
    public function getContents()
    {
        return $this->content;
    }

    /**
     * @param string $string
     * @return int|void
     */
    public function write($string)
    {
        $this->content .= $string;
    }

    /**
     * @return int|null
     */
    public function getSize()
    {
        return mb_strlen($this->content);
    }

    /**
     *
     */
    public function close() {}

    /**
     * @return resource|void|null
     */
    public function detach() {}

    /**
     * @return int|void
     */
    public function tell() {}

    /**
     * @return bool|void
     */
    public function eof() {}

    /**
     * @return bool|void
     */
    public function isSeekable() {}

    /**
     * @param int $offset
     * @param int $whence
     */
    public function seek($offset, $whence = SEEK_SET) {}

    /**
     *
     */
    public function rewind() {}

    /**
     * @return bool|void
     */
    public function isWritable() {}

    /**
     * @return bool|void
     */
    public function isReadable() {}

    /**
     * @param int $length
     * @return string|void
     */
    public function read($length) {}

    /**
     * @param null $key
     * @return array|mixed|void|null
     */
    public function getMetadata($key = null) {}
}

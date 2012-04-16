<?php

namespace Zend2\Http;

use Zend2\Loader\PluginClassLoader,
    Zend2\Loader\PluginClassLocator,
    Iterator,
    Countable;

/**
 * Basic HTTP headers collection functionality
 *
 * Handles aggregation of headers
 */
class Headers implements Iterator, Countable
{
    /**
     * @var \Zend2\Loader\PluginClassLoader
     */
    protected $pluginClassLoader = null;

    /**
     * @var array key names for $headers array
     */
    protected $headersKeys = array();

    /**
     * @var array Array of header array information or Header instances
     */
    protected $headers = array();

    /**
     * Populates headers from string representation
     *
     * Parses a string for headers, and aggregates them, in order, in the
     * current instance, primarily as strings until they are needed (they
     * will be lazy loaded)
     *
     * @param  string $string
     * @return Headers
     */
    public static function fromString($string)
    {
        $headers = new static();
        $current = array();

        // iterate the header lines, some might be continuations
        foreach (explode("\r\n", $string) as $line) {

            // check if a header name is present
            if (preg_match('/^(?P<name>[^()><@,;:\"\\/\[\]?=}{ \t]+):.*$/', $line, $matches)) {
                if ($current) {
                    // a header name was present, then store the current complete line
                    $headers->headersKeys[] = str_replace(array('-', '_'), '', strtolower($current['name']));
                    $headers->headers[] = $current;
                }
                $current = array(
                    'name' => $matches['name'],
                    'line' => trim($line)
                );
            } elseif (preg_match('/^\s+.*$/', $line, $matches)) {
                // continuation: append to current line
                $current['line'] .= trim($line);
            } elseif (preg_match('/^\s*$/', $line)) {
                // empty line indicates end of headers
                break;
            } else {
                // Line does not match header format!
                throw new Exception\RuntimeException(sprintf(
                    'Line "%s"does not match header format!',
                    $line
                ));
            }
        }
        if ($current) {
            $headers->headersKeys[] = str_replace(array('-', '_'), '', strtolower($current['name']));
            $headers->headers[] = $current;
        }
        return $headers;
    }

    /**
     * Set an alternate implementation for the PluginClassLoader
     *
     * @param \Zend2\Loader\PluginClassLocator $pluginClassLoader
     * @return Headers
     */
    public function setPluginClassLoader(PluginClassLocator $pluginClassLoader)
    {
        $this->pluginClassLoader = $pluginClassLoader;
        return $this;
    }

    /**
     * Return an instance of a PluginClassLocator, lazyload and inject map if necessary
     *
     * @return PluginClassLocator
     */
    public function getPluginClassLoader()
    {
        if ($this->pluginClassLoader === null) {
            $this->pluginClassLoader = new \Zend2\Loader\PluginClassLoader(array(
                'accept'             => 'Zend2\Http\Header\Accept',
                'acceptcharset'      => 'Zend2\Http\Header\AcceptCharset',
                'acceptencoding'     => 'Zend2\Http\Header\AcceptEncoding',
                'acceptlanguage'     => 'Zend2\Http\Header\AcceptLanguage',
                'acceptranges'       => 'Zend2\Http\Header\AcceptRanges',
                'age'                => 'Zend2\Http\Header\Age',
                'allow'              => 'Zend2\Http\Header\Allow',
                'authenticationinfo' => 'Zend2\Http\Header\AuthenticationInfo',
                'authorization'      => 'Zend2\Http\Header\Authorization',
                'cachecontrol'       => 'Zend2\Http\Header\CacheControl',
                'connection'         => 'Zend2\Http\Header\Connection',
                'contentdisposition' => 'Zend2\Http\Header\ContentDisposition',
                'contentencoding'    => 'Zend2\Http\Header\ContentEncoding',
                'contentlanguage'    => 'Zend2\Http\Header\ContentLanguage',
                'contentlength'      => 'Zend2\Http\Header\ContentLength',
                'contentlocation'    => 'Zend2\Http\Header\ContentLocation',
                'contentmd5'         => 'Zend2\Http\Header\ContentMD5',
                'contentrange'       => 'Zend2\Http\Header\ContentRange',
                'contenttype'        => 'Zend2\Http\Header\ContentType',
                'cookie'             => 'Zend2\Http\Header\Cookie',
                'date'               => 'Zend2\Http\Header\Date',
                'etag'               => 'Zend2\Http\Header\Etag',
                'expect'             => 'Zend2\Http\Header\Expect',
                'expires'            => 'Zend2\Http\Header\Expires',
                'from'               => 'Zend2\Http\Header\From',
                'host'               => 'Zend2\Http\Header\Host',
                'ifmatch'            => 'Zend2\Http\Header\IfMatch',
                'ifmodifiedsince'    => 'Zend2\Http\Header\IfModifiedSince',
                'ifnonematch'        => 'Zend2\Http\Header\IfNoneMatch',
                'ifrange'            => 'Zend2\Http\Header\IfRange',
                'ifunmodifiedsince'  => 'Zend2\Http\Header\IfUnmodifiedSince',
                'keepalive'          => 'Zend2\Http\Header\KeepAlive',
                'lastmodified'       => 'Zend2\Http\Header\LastModified',
                'location'           => 'Zend2\Http\Header\Location',
                'maxforwards'        => 'Zend2\Http\Header\MaxForwards',
                'pragma'             => 'Zend2\Http\Header\Pragma',
                'proxyauthenticate'  => 'Zend2\Http\Header\ProxyAuthenticate',
                'proxyauthorization' => 'Zend2\Http\Header\ProxyAuthorization',
                'range'              => 'Zend2\Http\Header\Range',
                'referer'            => 'Zend2\Http\Header\Referer',
                'refresh'            => 'Zend2\Http\Header\Refresh',
                'retryafter'         => 'Zend2\Http\Header\RetryAfter',
                'server'             => 'Zend2\Http\Header\Server',
                'setcookie'          => 'Zend2\Http\Header\SetCookie',
                'te'                 => 'Zend2\Http\Header\TE',
                'trailer'            => 'Zend2\Http\Header\Trailer',
                'transferencoding'   => 'Zend2\Http\Header\TransferEncoding',
                'upgrade'            => 'Zend2\Http\Header\Upgrade',
                'useragent'          => 'Zend2\Http\Header\UserAgent',
                'vary'               => 'Zend2\Http\Header\Vary',
                'via'                => 'Zend2\Http\Header\Via',
                'warning'            => 'Zend2\Http\Header\Warning',
                'wwwauthenticate'    => 'Zend2\Http\Header\WWWAuthenticate'
            ));
        }
        return $this->pluginClassLoader;
    }

    /**
     * Add many headers at once
     *
     * Expects an array (or Traversable object) of type/value pairs.
     *
     * @param  array|Traversable $headers
     * @return Headers
     */
    public function addHeaders($headers)
    {
        if (!is_array($headers) && !$headers instanceof \Traversable) {
            throw new Exception\InvalidArgumentException(sprintf(
                'Expected array or Traversable; received "%s"',
                (is_object($headers) ? get_class($headers) : gettype($headers))
            ));
        }

        foreach ($headers as $name => $value) {
            if (is_int($name)) {
                if (is_string($value)) {
                    $this->addHeaderLine($value);
                } elseif (is_array($value) && count($value) == 1) {
                    $this->addHeaderLine(key($value), current($value));
                } elseif (is_array($value) && count($value) == 2) {
                    $this->addHeaderLine($value[0], $value[1]);
                } elseif ($value instanceof Header\HeaderDescription) {
                    $this->addHeader($value);
                }
            } elseif (is_string($name)) {
                $this->addHeaderLine($name, $value);
            }

        }

        return $this;
    }

    /**
     * Add a raw header line, either in name => value, or as a single string 'name: value'
     *
     * This method allows for lazy-loading in that the parsing and instantiation of Header object
     * will be delayed until they are retrieved by either get() or current()
     *
     * @throws Exception\InvalidArgumentException
     * @param string $headerFieldNameOrLine
     * @param string $fieldValue optional
     * @return Headers
     */
    public function addHeaderLine($headerFieldNameOrLine, $fieldValue = null)
    {
        $matches = null;
        if (preg_match('/^(?P<name>[^()><@,;:\"\\/\[\]?=}{ \t]+):.*$/', $headerFieldNameOrLine, $matches)
            && $fieldValue === null) {
            // is a header
            $headerName = $matches['name'];
            $headerKey = str_replace(array('-', '_', ' ', '.'), '', strtolower($matches['name']));
            $line = $headerFieldNameOrLine;
        } elseif ($fieldValue === null) {
            throw new Exception\InvalidArgumentException('A field name was provided without a field value');
        } else {
            $headerName = $headerFieldNameOrLine;
            $headerKey = str_replace(array('-', '_', ' ', '.'), '', strtolower($headerFieldNameOrLine));
            $line = $headerFieldNameOrLine . ': ' . $fieldValue;
        }

        $this->headersKeys[] = $headerKey;
        $this->headers[] = array('name' => $headerName, 'line' => $line);
        return $this;
    }

    /**
     * Add a Header to this container, for raw values @see addHeaderLine() and addHeaders()
     * 
     * @param  Header\HeaderDescription $header
     * @return Headers
     */
    public function addHeader(Header\HeaderDescription $header)
    {
        $key = str_replace(array('-', '_', ' ', '.'), '', strtolower($header->getFieldName()));

        $this->headersKeys[] = $key;
        $this->headers[] = $header;
        return $this;
    }

    /**
     * Remove a Header from the container
     *
     * @param Header\HeaderDescription $header
     * @return bool
     */
    public function removeHeader(Header\HeaderDescription $header)
    {
        $index = array_search($header, $this->headers, true);
        if ($index !== false) {
            unset($this->headersKeys[$index]);
            unset($this->headers[$index]);
            return true;
        }
        return false;
    }

    /**
     * Clear all headers
     *
     * Removes all headers from queue
     * 
     * @return Headers
     */
    public function clearHeaders()
    {
        $this->headers = $this->headersKeys = array();
        return $this;
    }

    /**
     * Get all headers of a certain name/type
     * 
     * @param  string $name
     * @return false|Header\HeaderDescription|\ArrayIterator
     */
    public function get($name)
    {
        $key = str_replace(array('-', '_', ' ', '.'), '', strtolower($name));
        if (!in_array($key, $this->headersKeys)) {
            return false;
        }

        $class = ($this->getPluginClassLoader()->load($key)) ?: 'Zend2\Http\Header\GenericHeader';

        if (in_array('Zend2\Http\Header\MultipleHeaderDescription', class_implements($class, true))) {
            $headers = array();
            foreach (array_keys($this->headersKeys, $key) as $index) {
                if (is_array($this->headers[$index])) {
                    $this->lazyLoadHeader($index);
                }
            }
            foreach (array_keys($this->headersKeys, $key) as $index) {
                $headers[] = $this->headers[$index];
            }
            return new \ArrayIterator($headers);
        } else {
            $index = array_search($key, $this->headersKeys);
            if ($index === false) {
                return false;
            }
            if (is_array($this->headers[$index])) {
                return $this->lazyLoadHeader($index);
            } else {
                return $this->headers[$index];
            }
        }
    }

    /**
     * Test for existence of a type of header
     * 
     * @param  string $name
     * @return bool
     */
    public function has($name)
    {
        $name = str_replace(array('-', '_', ' ', '.'), '', strtolower($name));
        return (in_array($name, $this->headersKeys));
    }

    /**
     * Advance the pointer for this object as an interator
     *
     * @return void
     */
    public function next()
    {
        next($this->headers);
    }

    /**
     * Return the current key for this object as an interator
     *
     * @return mixed
     */
    public function key()
    {
        return (key($this->headers));
    }

    /**
     * Is this iterator still valid?
     *
     * @return bool
     */
    public function valid()
    {
        return (current($this->headers) !== false);
    }

    /**
     * Reset the internal pointer for this object as an iterator
     *
     * @return void
     */
    public function rewind()
    {
        reset($this->headers);
    }

    /**
     * Return the current value for this iterator, lazy loading it if need be
     *
     * @return Header\HeaderDescription
     */
    public function current()
    {
        $current = current($this->headers);
        if (is_array($current)) {
            $current = $this->lazyLoadHeader(key($this->headers));
        }
        return $current;
    }

    /**
     * Return the number of headers in this contain, if all headers have not been parsed, actual count could
     * increase if MultipleHeader objects exist in the Request/Response.  If you need an exact count, iterate
     *
     * @return int count of currently known headers
     */
    public function count()
    {
        return count($this->headers);
    }

    /**
     * Render all headers at once
     *
     * This method handles the normal iteration of headers; it is up to the
     * concrete classes to prepend with the appropriate status/request line.
     *
     * @return string
     */
    public function toString()
    {
        $headers = '';
        foreach ($this->toArray() as $fieldName => $fieldValue) {
            if (is_array($fieldValue)) {
                // Handle multi-value headers
                foreach ($fieldValue as $value) {
                    $headers .= $fieldName . ': ' . $value . "\r\n";
                }
                continue;
            }
            // Handle single-value headers
            $headers .= $fieldName . ': ' . $fieldValue . "\r\n";
        }
        return $headers;
    }

    /**
     * Return the headers container as an array
     *
     * @todo determine how to produce single line headers, if they are supported
     * @return array
     */
    public function toArray()
    {
        $headers = array();
        /* @var $header Header\HeaderDescription */
        foreach ($this->headers as $header) {
            if ($header instanceof Header\MultipleHeaderDescription) {
                $name = $header->getFieldName();
                if (!isset($headers[$name])) {
                    $headers[$name] = array();
                }
                $headers[$name][] = $header->getFieldValue();
            } elseif ($header instanceof Header\HeaderDescription) {
                $headers[$header->getFieldName()] = $header->getFieldValue();
            } else {
                $matches = null;
                preg_match('/^(?P<name>[^()><@,;:\"\\/\[\]?=}{ \t]+):\s*(?P<value>.*)$/', $header['line'], $matches);
                if ($matches) {
                    $headers[$matches['name']] = $matches['value'];
                }
            }
        }
        return $headers;
    }

    /**
     * By calling this, it will force parsing and loading of all headers, after this count() will be accurate
     *
     * @return bool
     */
    public function forceLoading()
    {
        foreach ($this as $item) {
            // $item should now be loaded
        }
        return true;
    }

    /**
     * @param $index
     * @return mixed|void
     */
    protected function lazyLoadHeader($index)
    {
        $current = $this->headers[$index];

        $key = $this->headersKeys[$index];
        /* @var $class Header\HeaderDescription */
        $class = ($this->getPluginClassLoader()->load($key)) ?: 'Zend2\Http\Header\GenericHeader';

        $headers = $class::fromString($current['line']);
        if (is_array($headers)) {
            $this->headers[$index] = $current = array_shift($headers);
            foreach ($headers as $header) {
                $this->headersKeys[] = $key;
                $this->headers[] = $header;
            }
            return $current;
        } else {
            $this->headers[$index] = $current = $headers;
            return $current;
        }

    }

}

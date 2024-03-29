<?php

namespace Zend2\Stdlib;

interface MessageDescription
{
    public function setMetadata($spec, $value = null);
    public function getMetadata($key = null);

    public function setContent($content);
    public function getContent();

}

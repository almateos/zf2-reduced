<?php

namespace Zend2\Http\Header;

interface MultipleHeaderDescription extends HeaderDescription
{
    public function toStringMultipleHeaders(array $headers);
}
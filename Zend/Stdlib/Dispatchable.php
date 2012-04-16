<?php
namespace Zend2\Stdlib;

interface Dispatchable
{
    public function dispatch(RequestDescription $request, ResponseDescription $response = null);
}

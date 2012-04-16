<?php
namespace Zend2\Di\Exception;

use Zend2\Di\Exception,
    DomainException;

class CircularDependencyException extends DomainException implements Exception
{
}

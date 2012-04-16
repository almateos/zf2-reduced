<?php

namespace Zend2\Date\Exception;

class InvalidArgumentException
    extends \InvalidArgumentException
    implements \Zend2\Date\Exception
{

    /*

    protected $operand = null;

    public function __construct($message, $code = 0, $e = null, $op = null)
    {
        $this->operand = $op;
        parent::__construct($message, $code, $e);
    }

    public function getOperand()
    {
        return $this->operand;
    }

     */
    
}

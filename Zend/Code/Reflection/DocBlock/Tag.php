<?php

namespace Zend2\Code\Reflection\DocBlock;

interface Tag
{
    public function getName();
    public function initialize($content);
}
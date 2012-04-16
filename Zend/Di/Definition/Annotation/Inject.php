<?php

namespace Zend2\Di\Definition\Annotation;

use Zend2\Code\Annotation\Annotation;

class Inject implements Annotation
{

    protected $content = null;

    public function initialize($content)
    {
        $this->content = $content;
    }
}
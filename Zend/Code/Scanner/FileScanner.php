<?php

namespace Zend2\Code\Scanner;

use Zend2\Code\Scanner,
    Zend2\Code\Exception,
    Zend2\Code\Annotation\AnnotationManager;

class FileScanner extends TokenArrayScanner implements Scanner
{
    /**
     * @var string
     */
    protected $file = null;

    public function __construct($file, AnnotationManager $annotationManager = null)
    {
        $this->file = $file;
        if (!file_exists($file)) {
            throw new Exception\InvalidArgumentException(sprintf(
                'File "%s" not found', $file
            ));
        }
        parent::__construct(token_get_all(file_get_contents($file)), $annotationManager);
    }

    public function getFile()
    {
        return $this->file;
    }

}

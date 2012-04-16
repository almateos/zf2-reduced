<?php

namespace Zend2\Code\Generator;

use Zend2\Code\Generator\Exception\RuntimeException;

class FileGeneratorRegistry
{
	/**
	 * @var array[string]\Zend2\Code\Generator\FileGenerator $_fileCodeGenerators registry for Zend2\Code\Generator\FileGenerator
	 */
	static private $_fileCodeGenerators = array();
	
	/**
	 * Registry for the Zend2_Code package. Zend2_Tool uses this
	 * 
	 * @param FileGenerator $fileCodeGenerator
	 * @param string $fileName
	 * @throws RuntimeException
	 */
    public static function registerFileCodeGenerator(FileGenerator $fileCodeGenerator, $fileName = null)
    {
        if ($fileName == null) {
            $fileName = $fileCodeGenerator->getFilename();
        }

        if ($fileName == '') {
            throw new RuntimeException('FileName does not exist.');
        }

        // cannot use realpath since the file might not exist, but we do need to have the index
        // in the same DIRECTORY_SEPARATOR that realpath would use:
        $fileName = str_replace(array('\\', '/'), DIRECTORY_SEPARATOR, $fileName);

        self::$_fileCodeGenerators[$fileName] = $fileCodeGenerator;

    }
}
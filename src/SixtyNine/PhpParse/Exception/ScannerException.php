<?php

namespace SixtyNine\PhpParse\Exception;

use SixtyNine\PhpParse\Reader\ReaderInterface;

class ScannerException extends \Exception
{
    public function __construct(ReaderInterface $reader, $msg)
    {
        $msg = sprintf(
            "SCANNER ERROR: %s at line %s, column %s.\nCurrent buffer \"%s\"",
            $msg,
            $reader->getCurrentLine(),
            $reader->getCurrentColumn(),
            $reader->consume()
        );

        parent::__construct($msg);
    }
}

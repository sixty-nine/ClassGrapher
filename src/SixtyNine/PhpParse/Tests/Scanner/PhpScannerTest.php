<?php

namespace SixtyNine\PhpParse\Tests\Scanner;

use SixtyNine\PhpParse\Scanner\PhpScanner,
    SixtyNine\PhpParse\Scanner\Token,
    SixtyNine\PhpParse\Reader\BufferReader,
    SixtyNine\PhpParse\Scanner\Context\DefaultScannerContext;

class PhpParserTest extends \PHPUnit_Framework_TestCase
{
    public function testScan()
    {
        $reader = new BufferReader("<?php echo 'Hello world';\n");
        $scanner = new PhpScanner(new DefaultScannerContext());
        $queue = $scanner->scan($reader);

        $this->assertEquals(new Token(T_OPEN_TAG, '<?php', 1), $queue->get());
        $this->assertEquals(new Token(T_ECHO, 'echo', 1), $queue->get());
        $this->assertEquals(new Token(T_CONSTANT_ENCAPSED_STRING, "'Hello world'", 1), $queue->get());
        $this->assertEquals(new Token(0, ';', 1), $queue->get());
        $this->assertFalse($queue->get());
    }

}
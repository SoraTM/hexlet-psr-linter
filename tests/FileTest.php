<?php

namespace Linter;

class FileTest extends \PHPUnit_Framework_TestCase
{
    private $testfile;

    public function setUp()
    {
        $this->testFile = __DIR__ . DIRECTORY_SEPARATOR . 'fixtures/testfile';
    }

    public function testFileReading()
    {
        $this->assertEquals('test string', File\getContent($this->testFile));
    }
}

<?php

namespace Linter;

class FileTest extends \PHPUnit_Framework_TestCase
{
    private $testfile;
    private $notExistFile;

    public function setUp()
    {
        $this->testFile = __DIR__ . DIRECTORY_SEPARATOR . 'fixtures/testfile';
        $this->notExistFile = __DIR__ . DIRECTORY_SEPARATOR . 'fixtures/notExistFile';
    }

    public function testFileReading()
    {
        $this->assertEquals('test string', File\getContent($this->testFile));
    }
    
    /**
     * @expectedException \Linter\Exceptions\FileException;
     */
    public function testException()
    {
        try {
            File\getContent($this->notExistFile);
            $this->fail('Expected FileException');
        } catch (\Linter\Exceptions\FileException $e) {
        }
    }
}

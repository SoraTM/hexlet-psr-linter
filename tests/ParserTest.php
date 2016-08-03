<?php

namespace Linter;

class ParserTest extends \PHPUnit_Framework_TestCase
{
    private $fileValid;
    private $fileInvalid;
    private $fileValidContent;
    private $fileInvalidContent;
    private $functionsValid;
    
    public function setUp()
    {
        $this->fileValid = __DIR__ . DIRECTORY_SEPARATOR . 'fixtures/Valid.php';
        $this->fileInValid = __DIR__ . DIRECTORY_SEPARATOR . 'fixtures/InValid.php';
        $this->fileValidContent = File\getContent($this->fileValid);
        $this->fileInValidContent = File\getContent($this->fileInValid);
        $this->functionsValid = ['testTest', 'testToTest'];
    }
    
    public function testGetFunctionNames()
    {
        $this->assertEquals($this->functionsValid, Parser\getFunctions($this->fileValidContent));
    }
}

<?php

namespace Linter;

class ParserTest extends \PHPUnit_Framework_TestCase
{
    private $fileValid;
    private $fileInvalid;
    private $fileValidContent;
    private $fileInvalidContent;
    private $functionErrors;
    
    public function setUp()
    {
        $this->fileValid = __DIR__ . DIRECTORY_SEPARATOR . 'fixtures/Valid.php';
        $this->fileInValid = __DIR__ . DIRECTORY_SEPARATOR . 'fixtures/InValid.php';
        $this->fileValidContent = File\getContent($this->fileValid);
        $this->fileInValidContent = File\getContent($this->fileInValid);
        $this->functionErrors = [
            [
                'error:',
                'Function name MUST NOT include underscores',
                'test_test',
            ],
            [
                'error:',
                'Function name MUST NOT include underscores',
                'test_test_2',
            ],
            [
                'error:',
                'Function name MUST be in camelCase',
                'CamelCase',
            ],
        ];
    }
    
    public function testErrorsFunctionNames()
    {
        $this->assertEquals($this->functionErrors, Parser\checkCode($this->fileInValidContent));
        $this->assertEquals([], Parser\checkCode($this->fileValidContent));
    }
}

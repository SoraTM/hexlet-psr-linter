<?php

namespace Linter;

class ParserTest extends \PHPUnit_Framework_TestCase
{
    private $fileValid;
    private $fileInvalid;
    private $fileValidContent;
    private $fileInvalidContent;
    private $parseErrors;
    
    public function setUp()
    {
        $this->fileValid = __DIR__ . DIRECTORY_SEPARATOR . 'fixtures/Valid.php';
        $this->fileInValid = __DIR__ . DIRECTORY_SEPARATOR . 'fixtures/InValid.php';
        $this->fileValidContent = File\getContent($this->fileValid);
        $this->fileInValidContent = File\getContent($this->fileInValid);
        $this->parseErrors = [
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
            [
                'error:',
                'Variable name MUST NOT include underscores',
                'test_variable',
            ],
            [
                'error:',
                'Variable name MUST be in camelCase',
                'TestVariable',
            ],
            [
                'error:',
                'Multiple function declaration',
                'correctFunction'
            ]
        ];
    }
    
    public function testErrorsFunctionNames()
    {
        $this->assertEquals($this->parseErrors, Parser\checkCode($this->fileInValidContent));
        $this->assertEquals([], Parser\checkCode($this->fileValidContent));
    }
}

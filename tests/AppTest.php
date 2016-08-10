<?php

namespace Linter;

class AppTest extends \PHPUnit_Framework_TestCase
{
    private $fileValid;
    private $fileInValid;
    private $outputInValid;
    private $outputValid;
    
    public function setUp()
    {
        $this->fileValid = __DIR__ . DIRECTORY_SEPARATOR . 'fixtures/Valid.php';
        $this->fileInValid = __DIR__ . DIRECTORY_SEPARATOR . 'fixtures/InValid.php';
        $this->outputValid = "Everything OK!" . PHP_EOL;
        $this->outputInValid = <<<EOT
 error: Function name MUST NOT include underscores test_test
 error: Function name MUST NOT include underscores test_test_2
 error: Function name MUST be in camelCase CamelCase
 error: Multiple function declaration correctFunction
 error: Variable name MUST NOT include underscores test_variable
 error: Variable name MUST be in camelCase TestVariable
6 problems

EOT;
    }
    
    public function testLint()
    {
        $this->assertEquals($this->outputInValid, \Linter\lint($this->fileInValid));
    }
}

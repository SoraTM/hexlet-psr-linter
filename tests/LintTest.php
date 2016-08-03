<?php

namespace Linter;

class LintTest extends \PHPUnit_Framework_TestCase
{
    private $functionErrors = [];
    private $classErrors = [];
    
    public function setUp()
    {
        $this->functionErrors = [
            [
                'error:',
                'Function name MUST be in camelCase',
                'NotCamelCase',
            ],
            [
                'error:',
                'Function name MUST NOT include underscores',
                'with_under_scores',
            ],
        ];
    }
    
    public function testValidFunctionName()
    {
        $this->assertTrue(\Linter\isFunctionNameCamelCase('camelCase'));
        $this->assertFalse(\Linter\isFunctionNameCamelCase('NotCamelCase'));
        $this->assertTrue(\Linter\isFunctionNameWithUnderScores('with_under_scores'));
        $this->assertFalse(\Linter\isFunctionNameWithUnderScores('withunderscores'));
    }
    
    public function testCheckFunctionName()
    {
        $this->assertEquals('Function name MUST be in camelCase', \Linter\checkFunctionName('NotCamelCase'));
        $this->assertEquals('Function name MUST NOT include underscores', \Linter\checkFunctionName('with_under_scores'));
    }
    
    public function testCheckFunctionNames()
    {
        $this->assertEquals($this->functionErrors, \Linter\checkFunctions(['NotCamelCase', 'with_under_scores']));
    }
}

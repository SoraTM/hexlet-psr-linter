<?php

namespace Linter;

class RulesFunctionsTest extends \PHPUnit_Framework_TestCase
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
        $this->assertTrue(\Linter\Rules\Functions\isFunctionNameCamelCase('camelCase'));
        $this->assertFalse(\Linter\Rules\Functions\isFunctionNameCamelCase('NotCamelCase'));
        $this->assertTrue(\Linter\Rules\Functions\isFunctionNameWithUnderScores('with_under_scores'));
        $this->assertFalse(\Linter\Rules\Functions\isFunctionNameWithUnderScores('withunderscores'));
    }
    
    public function testCheckFunctionName()
    {
        $this->assertEquals(
            'Function name MUST be in camelCase',
            \Linter\Rules\Functions\checkFunctionName('NotCamelCase')
        );
        $this->assertEquals(
            'Function name MUST NOT include underscores',
            \Linter\Rules\Functions\checkFunctionName('with_under_scores')
        );
    }
    
    public function testCheckFunctionNames()
    {
        $this->assertEquals(
            $this->functionErrors,
            \Linter\Rules\Functions\checkFunctions(['NotCamelCase', 'with_under_scores'])
        );
    }
}

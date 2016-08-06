<?php

namespace Linter;

class RulesFunctionsTest extends \PHPUnit_Framework_TestCase
{
    private $functionErrors = [];
    private $functionNames = [];
    private $functionRepeats = [];
    
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
        $this->functionNames = [
            'functionName',
            'functionName'
        ];
        $this->functionRepeats = [
            [
                'functionName',
                'Multiple function declaration'
            ]
        ];
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
    
    public function testFunctionTestFunctionsRepeat()
    {
        $this->assertEquals($this->functionRepeats, \Linter\Rules\Functions\checkFunctionsRepeat($this->functionNames));
    }
}

<?php

namespace Linter;

class RulesVariablesTest extends \PHPUnit_Framework_TestCase
{
    private $variableErrors = [];
    private $classErrors = [];
    
    public function setUp()
    {
        $this->variableErrors = [
            [
                'error:',
                'Variable name MUST be in camelCase',
                'NotCamelCase',
            ],
            [
                'error:',
                'Variable name MUST NOT include underscores',
                'with_under_scores',
            ],
        ];
    }
    
    public function testCheckVariableName()
    {
        $this->assertEquals(
            'Variable name MUST be in camelCase',
            \Linter\Rules\Variables\checkVariableName('NotCamelCase')
        );
        $this->assertEquals(
            'Variable name MUST NOT include underscores',
            \Linter\Rules\Variables\checkVariableName('with_under_scores')
        );
    }
}

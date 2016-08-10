<?php

namespace Linter;

use \PhpParser\Node;

class RulesVariableNameTest extends \PHPUnit_Framework_TestCase
{
    private $errorCamelCase = [];
    private $errorUnderScore = [];
    private $nodeStubNotCamelCase;
    private $nodeStubUnderScore;
    
    public function setUp()
    {
        $this->nodeStubNotCamelCase = $this->createMock('\PhpParser\Node\Expr\Variable');
        $this->nodeStubNotCamelCase->name = 'NotCamelCase';

        $this->nodeStubUnderScore = $this->createMock('\PhpParser\Node\Expr\Variable');
        $this->nodeStubUnderScore->name = 'with_under_scores';
        
        $this->errorCamelCase = [
            'error:',
            'Variable name MUST be in camelCase',
            'NotCamelCase',
        ];
        
        $this->errorUnderScore = [
            'error:',
            'Variable name MUST NOT include underscores',
            'with_under_scores',
        ];
    }
    
    public function testCheckVariableNames()
    {
        $rule = new \Linter\Rules\VariableName;
        
        $rule->apply($this->nodeStubNotCamelCase);
        $this->assertEquals($this->errorCamelCase, $rule->getError());
        $rule->cleanError();
        $this->assertEquals(null, $rule->getError());
        
        $rule->apply($this->nodeStubUnderScore);
        $this->assertEquals($this->errorUnderScore, $rule->getError());
        $rule->cleanError();
        $this->assertEquals(null, $rule->getError());
    }
}

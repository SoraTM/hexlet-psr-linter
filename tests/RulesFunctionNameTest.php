<?php

namespace Linter;

use \PhpParser\Node;

class RulesFunctionNameTest extends \PHPUnit_Framework_TestCase
{
    private $errorCamelCase = [];
    private $errorUnderScore = [];
    private $nodeStubNotCamelCase;
    private $nodeStubUnderScore;
    
    public function setUp()
    {
        $this->nodeStubNotCamelCase = $this->createMock('\PhpParser\Node\Stmt\Function_');
        $this->nodeStubNotCamelCase->name = 'NotCamelCase';
        
        $this->nodeStubUnderScore = $this->createMock('\PhpParser\Node\Stmt\Function_');
        $this->nodeStubUnderScore->name = 'with_under_scores';
        
        $this->errorCamelCase = [
            'error:',
            'Function name MUST be in camelCase',
            'NotCamelCase',
        ];
        
        $this->errorUnderScore = [
            'error:',
            'Function name MUST NOT include underscores',
            'with_under_scores',
        ];
    }
    
    public function testCheckFunctionNames()
    {
        $rule = new \Linter\Rules\FunctionName;
        
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

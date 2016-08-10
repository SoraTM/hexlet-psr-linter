<?php

namespace Linter;

use \PhpParser\Node;

class RulesFunctionRepeatsTest extends \PHPUnit_Framework_TestCase
{
    private $error = [];
    private $nodeStubFirstFunc;
    private $nodeStubSecondFunc;
    
    public function setUp()
    {
        $this->nodeStubFirstFunc = $this->createMock('\PhpParser\Node\Stmt\Function_');
        $this->nodeStubFirstFunc->name = 'testFunction';
        
        $this->nodeStubSecondFunc = $this->createMock('\PhpParser\Node\Stmt\Function_');
        $this->nodeStubSecondFunc->name = 'testFunction';
        
        $this->error = [
            'error:',
            'Multiple function declaration',
            'testFunction',
        ];
    }
    
    public function testCheckFunctionNames()
    {
        $rule = new \Linter\Rules\FunctionRepeats;
        
        $rule->apply($this->nodeStubFirstFunc);
        $rule->cleanError();
        $this->assertEquals(null, $rule->getError());
        
        $rule->apply($this->nodeStubSecondFunc);
        $this->assertEquals($this->error, $rule->getError());
        $rule->cleanError();
        $this->assertEquals(null, $rule->getError());
    }
}

<?php
namespace Linter\Parser;

use \PhpParser\Node;
use function \Linter\Rules\Functions\checkFunctions;

class ParserVisitor extends \PhpParser\NodeVisitorAbstract
{
    private $functions = [];
    private $errors = [];
    
    public function leaveNode(Node $node)
    {
        if ($node instanceof Node\Stmt\Function_) {
            $this->functions[] = $node->name;
        }
    }
    
    public function checkCode()
    {
        $this->errors = array_merge(
            $this->errors,
            checkFunctions($this->functions)
        );
        return $this;
    }
    
    public function getErrors()
    {
        return $this->errors;
    }
}

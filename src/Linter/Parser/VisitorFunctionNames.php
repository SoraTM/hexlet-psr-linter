<?php
namespace Linter\Parser;

use \PhpParser\Node;

class VisitorFunctionNames extends \PhpParser\NodeVisitorAbstract
{
    private $functions = [];
    
    public function leaveNode(Node $node)
    {
        if ($node instanceof Node\Stmt\Function_) {
            $this->functions[] = $node->name;
        }
    }
    
    public function getFunctions()
    {
        return $this->functions;
    }
}

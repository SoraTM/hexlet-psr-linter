<?php

namespace Linter\Parser;

use \PhpParser\Node;
use function \Linter\Rules\Functions\checkFunctionName;
use function \Linter\Rules\Functions\checkFunctionsRepeat;
use function \Linter\Rules\Variables\checkVariableName;

class ParserVisitor extends \PhpParser\NodeVisitorAbstract
{
    private $errors = [];
    private $functions = [];
    private $rules = [];

    public function leaveNode(Node $node)
    {
        foreach ($this->rules as $rule) {
            $rule->cleanError();
            $rule->apply($node);
            $error = $rule->getError();
            if (isset($error)) {
                $this->errors[] = $error;
            }
        }
    }
    
    public function addRules($rules)
    {
        $this->rules = $rules;
    }
    
    public function getErrors()
    {
        return $this->errors;
    }
}

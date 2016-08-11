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

    public function __construct($rules)
    {
        $this->rules = $rules;
    }

    public function leaveNode(Node $node)
    {
        foreach ($this->rules as $rule) {
            $error = $rule->apply($node)->getError();
            if (!empty($error)) {
                $this->errors[] = $error;
            }
        }
    }
    
    public function getErrors()
    {
        return $this->errors;
    }
}

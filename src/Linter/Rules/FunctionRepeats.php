<?php

namespace Linter\Rules;

use \PhpParser\Node;

class FunctionRepeats implements RuleInterface
{
    private $error;
    private $functionNames = [];
    
    public function apply(Node $node)
    {
        $this->cleanError();
        if ($node instanceof Node\Stmt\Function_) {
            $message = $this->checkFunctionRepeats($node->name);
            if (isset($message)) {
                $this->setError($message, $node->name);
            }
        }
        return $this;
    }
    
    private function setError($message, $name)
    {
        $this->error = [
            'error:',
            $message,
            $name,
        ];
    }
    
    public function cleanError()
    {
        $this->error = null;
    }
    
    public function getError()
    {
        return $this->error;
    }
    
    public function checkFunctionRepeats($funcName)
    {
        $funcArr = array_filter($this->functionNames, function ($value) use ($funcName) {
            return $value === $funcName;
        });
        $this->functionNames[] = $funcName;
        if (!empty($funcArr)) {
            return 'Multiple function declaration';
        }
    }
}

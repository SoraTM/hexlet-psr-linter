<?php

namespace Linter\Rules;

use \PhpParser\Node;

class VariableName implements RuleInterface
{
    private $error;
    
    public function apply(Node $node)
    {
        if ($node instanceof Node\Expr\Variable) {
            $message = $this->checkVariableName($node->name);
            if (isset($message)) {
                $this->setError($message, $node->name);
            }
        }
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
    
    public function checkVariableName($string)
    {
        if ($this->isWithUnderScores($string)) {
            return 'Variable name MUST NOT include underscores';
        }
        if (!$this->isCamelCase($string)) {
            return 'Variable name MUST be in camelCase';
        }
    }
    
    private function isWithUnderScores($string)
    {
        if (strstr($string, '_')) {
            return true;
        }
        return false;
    }

    private function isCamelCase($string)
    {
        return \PHP_CodeSniffer::isCamelCaps($string);
    }
}

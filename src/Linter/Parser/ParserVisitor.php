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
    
    public function leaveNode(Node $node)
    {
        if ($node instanceof Node\Stmt\Function_) {
            $this->functions[] = $node->name;
        }
        if ($node instanceof Node\Expr\Variable) {
            $this->variables[] = $node->name;
        }
    }
    
    public function checkCode()
    {
        $this->checkNames();
        $this->checkRepeats();
        return $this;
    }
    
    private function checkNames()
    {
        foreach ($this->functions as $value) {
            $messageCheck = checkFunctionName($value);
            if (isset($messageCheck)) {
                $this->addError($messageCheck, $value);
            }
        }
        foreach ($this->variables as $value) {
            $messageCheck = checkVariableName($value);
            if (isset($messageCheck)) {
                $this->addError($messageCheck, $value);
            }
        }
    }
    
    private function checkRepeats()
    {
        $functionRepeats = checkFunctionsRepeat($this->functions);
        if (!empty($functionRepeats)) {
            foreach ($functionRepeats as $value) {
                $this->addError($value[1], $value[0]);
            }
        }
    }
    
    public function addError($message, $nodeName)
    {
        $this->errors[] = [
            'error:',
            $message,
            $nodeName,
        ];
    }
    
    public function getErrors()
    {
        return $this->errors;
    }
}

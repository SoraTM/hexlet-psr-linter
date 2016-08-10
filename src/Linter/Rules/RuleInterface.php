<?php

namespace Linter\Rules;

use \PhpParser\Node;

interface RuleInterface
{
    public function apply(Node $node);
    
    public function cleanError();
    
    public function getError();
}

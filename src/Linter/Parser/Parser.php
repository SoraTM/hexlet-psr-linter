<?php

namespace Linter\Parser;

use \PhpParser\ParserFactory;
use \PhpParser\NodeTraverser;
use Linter\Rules\VariablesNames;

function initRules()
{
    return [
        new \Linter\Rules\VariableName,
        new \Linter\Rules\FunctionName,
        new \Linter\Rules\FunctionRepeats,
    ];
}

function checkCode($content)
{
    $structure = getStructure($content);
    $traverser = new NodeTraverser;
    $visitor = new ParserVisitor;
    $visitor->addRules(initRules());
    $traverser->addVisitor($visitor);
    $stmts = $traverser->traverse($structure);
    return $visitor->getErrors();
}

function getStructure($content)
{
    $parser = (new ParserFactory)->create(ParserFactory::PREFER_PHP7);
    
    try {
        $stmts = $parser->parse($content);
        return $stmts;
    } catch (Error $e) {
        $e->getMessage();
    }
}

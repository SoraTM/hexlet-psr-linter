<?php

namespace Linter\Parser;

use \PhpParser\ParserFactory;
use \PhpParser\NodeTraverser;

function getStructure($content)
{
    $parser = (new ParserFactory)->create(ParserFactory::PREFER_PHP7);
    
    try {
        $stmts = $parser->parse($content);
        return $stmts;
    } catch (Error $e) {
        echo 'Parse Error: ', $e->getMessage();
    }
}

function getFunctions($content)
{
    $structure = getStructure($content);
    $traverser = new NodeTraverser;
    $visitor = new VisitorFunctionNames;
    $traverser->addVisitor($visitor);
    $stmts = $traverser->traverse($structure);
    return $visitor->getFunctions();
}

<?php

namespace Linter;

function lint($file)
{
    $content = File\getContent($file);
    $functions = Parser\getFunctions($content);
    $result = \Linter\checkFunctions($functions);
    return checkErrors($result);
}

function checkErrors($result)
{
    if (empty($result)) {
        return "Everithing OK!" . PHP_EOL;
    }
    return(formatErrors($result));
}

function formatErrors($errors)
{
    $result = array_reduce($errors, function ($acc, $error) {
        $acc[] = array_reduce($error, function ($acc, $item) {
            return $acc . ' ' . $item;
        }, '');
        
        return $acc;
    }, []);
    
    $count = sizeof($result) . " problems";
    
    
    return implode(PHP_EOL, $result) . PHP_EOL . $count . PHP_EOL;
}

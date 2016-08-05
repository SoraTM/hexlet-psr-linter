<?php

namespace Linter;

function lint($destination)
{
    $files = [];
    
    if (is_dir($destination)) {
        $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($destination));
        $files = new \RegexIterator($files, '/\.php$/');
    } else {
        $files[] = $destination;
    }
    
    $result = array_reduce($files, function ($acc, $item) {
        $content = File\getContent($item);
        $result = Parser\checkCode($content);
        return array_merge($acc, $result);
    }, []);
    
    return checkErrors($result);
}

function checkErrors($result)
{
    if (empty($result)) {
        return "Everything OK!" . PHP_EOL;
    }
    return formatErrors($result);
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

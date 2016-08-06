<?php

namespace Linter;

function lint($destination)
{
    $files = [];
    $errors = [];
    
    if (is_dir($destination)) {
        $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($destination));
        $files = new \RegexIterator($files, '/\.php$/');
    } else {
        $files[] = $destination;
    }
    
    foreach ($files as $file) {
        $content = File\getContent($file);
        $result = Parser\checkCode($content);
        $errors = array_merge($errors, $result);
    }
    
    return checkErrors($errors);
}

function checkErrors($errors)
{
    if (empty($errors)) {
        return "Everything OK!" . PHP_EOL;
    }
    return formatErrors($errors);
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

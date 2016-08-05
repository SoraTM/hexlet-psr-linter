<?php

namespace Linter\Rules\Functions;

function isFunctionNameWithUnderScores($string)
{
    if (strstr($string, '_')) {
        return true;
    }
    return false;
}

function isFunctionNameCamelCase($string)
{
    return \PHP_CodeSniffer::isCamelCaps($string);
}

function checkFunctionName($string)
{
    if (isFunctionNameWithUnderScores($string)) {
        return 'Function name MUST NOT include underscores';
    }
    if (!isFunctionNameCamelCase($string)) {
        return 'Function name MUST be in camelCase';
    }
}

function checkFunctions($functions)
{
    $result = array_reduce($functions, function ($acc, $item) {
        $messageCheck = checkFunctionName($item);
        if (isset($messageCheck)) {
            $acc[] = [
                'error:',
                $messageCheck,
                $item,
            ];
        }
        return $acc;
    }, []);
    
    return $result;
}

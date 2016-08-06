<?php

namespace Linter\Rules\Functions;

function checkFunctionName($string)
{
    if (\Linter\Rules\General\isWithUnderScores($string)) {
        return 'Function name MUST NOT include underscores';
    }
    if (!\Linter\Rules\General\isCamelCase($string)) {
        return 'Function name MUST be in camelCase';
    }
}

function checkFunctionsRepeat($arr)
{
    $counts = array_count_values($arr);
    $doubles = array_filter($counts, function ($value) {
        return $value > 1;
    });
    $result = array_map(function ($item) {
        return [
            $item,
            'Multiple function declaration'
        ];
    }, array_keys($doubles));
    
    return $result;
}

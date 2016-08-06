<?php

namespace Linter\Rules\General;

function isWithUnderScores($string)
{
    if (strstr($string, '_')) {
        return true;
    }
    return false;
}

function isCamelCase($string)
{
    return \PHP_CodeSniffer::isCamelCaps($string);
}

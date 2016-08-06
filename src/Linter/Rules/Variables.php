<?php

namespace Linter\Rules\Variables;

function checkVariableName($string)
{
    if (\Linter\Rules\General\isWithUnderScores($string)) {
        return 'Variable name MUST NOT include underscores';
    }
    if (!\Linter\Rules\General\isCamelCase($string)) {
        return 'Variable name MUST be in camelCase';
    }
}

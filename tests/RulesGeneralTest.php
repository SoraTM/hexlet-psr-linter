<?php

namespace Linter;

class RulesGeneralTest extends \PHPUnit_Framework_TestCase
{
    public function testValidFunctionName()
    {
        $this->assertTrue(\Linter\Rules\General\isCamelCase('camelCase'));
        $this->assertFalse(\Linter\Rules\General\isCamelCase('NotCamelCase'));
        $this->assertTrue(\Linter\Rules\General\isWithUnderScores('with_under_scores'));
        $this->assertFalse(\Linter\Rules\General\isWithUnderScores('withunderscores'));
    }
}

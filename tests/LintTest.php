<?php
namespace Linter;

use function \Linter\lint;

class LintTest extends \PHPUnit_Framework_TestCase
{
    public function testFileConvert()
    {
        $this->assertTrue(lint());
    }
}

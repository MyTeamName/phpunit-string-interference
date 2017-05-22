<?php

use PHPUnit\Framework\TestCase;

class FooTest extends TestCase
{
    /**
     * This test fails in order to demonstrate string interference.
     *
     * Expected:
     * Failed asserting that 'this is foobar' does not contain "this is foobar".
     *
     * Actual:
     * Failed asserting that 'this not is not foobar' does not contain "this not is not foobar".
     */
    public function test_interferes_with_string()
    {
        $expected = 'this is foobar';

        $actual = (new Foo)->bar();

        $this->assertNotContains($expected, $actual);
    }
}

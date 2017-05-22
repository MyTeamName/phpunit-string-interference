# phpunit string interference

Using `assertNotContains` in a failing condition injects `not` into both the expected and actual strings.

See https://github.com/sebastianbergmann/phpunit/issues/2688

Consider this class:

```php
class Foo
{
    public function bar()
    {
        return 'this is foobar';
    }
}
```

When executing this test:

```php
class FooTest extends TestCase
{
    public function test_interferes_with_string()
    {
        $expected = 'this is foobar';

        $actual = (new Foo)->bar();

        $this->assertNotContains($expected, $actual);
    }
}
```

Expected output:
> Failed asserting that 'this is foobar' does not contain "this is foobar".

Actual output:
> Failed asserting that 'this ***not*** is ***not*** foobar' does not contain "this ***not*** is ***not*** foobar".

## Steps to reproduce:

    composer install
    ./vendor/bin/phpunit FooTest.php

Complete Output:

>     PHPUnit 6.1.4 by Sebastian Bergmann and contributors.
>     
>     F                                                                   1 / 1 (100%)
>     
>     Time: 16 ms, Memory: 4.00MB
>     
>     There was 1 failure:
>     
>     1) FooTest::test_interferes_with_string
>     Failed asserting that 'this not is not foobar' does not contain "this not is not foobar".
>     
>     /home/xenial/scratch/phpunit-string-interference/FooTest.php:22
>     
>     FAILURES!
>     Tests: 1, Assertions: 1, Failures: 1.
>     

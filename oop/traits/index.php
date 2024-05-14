<?php


trait test
{
    public function hello()
    {
        return 'hello';
    }

    public function bye()
    {
        return 'bye';
    }
}

trait newTest
{
    public static function test()
    {
        return 'this is a test trait';
    }
}

class a
{
    use test, newTest;
}

class b
{
    use test, newTest;
}

echo b::test();

echo '<br>';

$b = new b;
echo $b->hello();

class c
{
    use test;
}

<?php


abstract class car
{
    public static $name = '';

    abstract public function engine();
    abstract public function color();

    public static function show()
    {
        return self::$name;
    }
}

car::$name = 'kuch bhi';
// echo car::show();

class BMW extends car
{
    public function engine()
    {
        return 'V8';
    }

    public function color()
    {
        return 'red';
    }
}

class honda extends car
{
    public function engine()
    {
        return 'V12';
    }

    public function color()
    {
        return 'grey';
    }
}


echo honda::show();

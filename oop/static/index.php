<?php

class myClass
{
    public static $name = '';

    public static function show()
    {
        return self::$name;
    }
}

class childClass extends myClass
{
    public static $name = 'Bilal';
    public static function show()
    {
        return self::$name;
    }
}


myClass::$name = 'Ahmed';
// echo myClass::show();
// echo childClass::showDetails();

echo childClass::show();

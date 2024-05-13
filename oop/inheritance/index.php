<?php

// public, private, protected

class parentClass
{
    private $name = 'Ahmed';

    public function show()
    {
        return $this->name;
    }
}


class childClass extends parentClass
{
    // public $name = 'Bilal';

    public function show()
    {
        return $this->name;
    }
}


// $childClass = new childClass;
// echo $childClass->show();


$parentClass = new parentClass;
echo $parentClass->name;

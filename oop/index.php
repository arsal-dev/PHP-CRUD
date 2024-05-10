<?php

class calculation
{
    public $num1 = 0;
    public $num2 = 0;

    public function __construct($num1, $num2)
    {
        $this->num1 = $num1;
        $this->num2 = $num2;
    }

    public function multiply()
    {
        return $this->num1 * $this->num2;
    }

    public function addition()
    {
        return $this->num1 + $this->num2;
    }

    public function __destruct()
    {
        echo 'class has finished';
    }
}

class calculation2 extends calculation
{
    public function subtract()
    {
        return $this->num1 - $this->num2;
    }
}

// $cal1 = new calculation;
// $cal1->num1 = 10;
// $cal1->num2 = 20;

// echo $cal1->multiply();
// echo '<br>';
// echo $cal1->addition();


// echo '<br>';

// $cal2 = new calculation;
// $cal2->num1 = 565;
// $cal2->num2 = 876;

// echo $cal2->multiply();
// echo $cal2->addition();


// $cal3 = new calculation(50, 80);
// echo $cal3->multiply();
// echo $cal3->addition();


$calculation2 = new calculation2(50, 100);
echo $calculation2->addition();
echo $calculation2->subtract();

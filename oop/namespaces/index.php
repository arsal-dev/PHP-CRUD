<?php

include './myclass.php';
include './testclass.php';


$myclass = new \ns\mycls\myclass;
echo $myclass->hello();

echo '<br>';

$myclass2 = new \ns\testcls\myclass;
echo $myclass2->hello();

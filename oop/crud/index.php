<?php


class crud
{
    private $conn;

    public function __construct($server, $username, $password, $db_name)
    {
        $this->conn = new mysqli($server, $username, $password, $db_name);
    }

    public function get($table, $values = '*')
    {
        if ($values == '*') {
            $sql = "SELECT * FROM $table";
        } else {
            $valueString = implode(',', $values);
            $sql = "SELECT $valueString FROM $table";
        }
        $result = $this->conn->query($sql);

        return $result->fetch_all();
    }

    public function create($table, $values)
    {
        $arrayKeys = array_keys($values);
        $arrayKeys = implode("`,`", $arrayKeys);

        $arrayValues = implode("','", array_values($values));

        $sql = "INSERT INTO `$table`(`$arrayKeys`) VALUES ('$arrayValues')";

        if ($this->conn->query($sql)) {
            return 'data saved into the database';
        } else {
            return false;
        }
    }
}


$crud = new crud('localhost', 'root', '', 'php_oop_crud');
// print_r($crud->get('users'));
// print_r($crud->get('students', ['name', 'address']));

print_r($crud->create('students', ['name' => 'asdas', 'email' => 'asdasd@asdas.com', 'address' => 'sdlfjhsdk ']));

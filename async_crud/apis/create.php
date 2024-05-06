<?php

include '../db_connection.php';


$data = file_get_contents('php://input');
$data = json_decode($data);

$sql = "INSERT INTO `students`(`name`, `email`, `phone`, `address`) VALUES ('$data->name','$data->email','$data->phone','$data->address')";

$conn->query($sql);

echo json_encode(['status' => 200, 'response' => 'data saved into database']);

<?php

include '../db_connection.php';

$id = $_GET['id'];

$sql = "DELETE FROM students WHERE id = $id";

$result = $conn->query($sql);


header('Location: ../index.html');


echo json_encode(['status' => 200, 'result' => 'Data Deleted Successfully']);

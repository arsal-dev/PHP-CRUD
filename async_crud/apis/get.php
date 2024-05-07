<?php

include '../db_connection.php';

$sql = "SELECT * FROM students";

$result = $conn->query($sql);

$result = $result->fetch_all();

echo json_encode($result);

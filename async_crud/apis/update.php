<?php

include '../db_connection.php';

$data = file_get_contents('php://input');

$updated_data = json_decode($data);

$id = $updated_data->id;
$name = $updated_data->updated_name;
$email = $updated_data->updated_email;
$phone = $updated_data->updated_phone;
$address = $updated_data->updated_address;

$sql = "UPDATE `students` SET `name`='$name',`email`='$email',`phone`='$phone',`address`='$address' WHERE id = $id";

if ($conn->query($sql)) {
    echo json_encode(['status' => 200, 'result' => 'data was updated successfully']);
} else {
    echo json_encode(['status' => 400, 'result' => 'something went wrong please contact administration']);
}

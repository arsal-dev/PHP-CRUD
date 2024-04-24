<?php

include './db_connect.php';

$image = $_GET['image'];

unlink("./uploads/$image");

$id = $_GET['id'];

$sql = "DELETE FROM contact WHERE id = $id";

$conn->query($sql);

header('Location: index.php');

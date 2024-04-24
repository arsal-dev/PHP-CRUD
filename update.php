<?php

include './db_connect.php';

$id = $_GET['id'];

$sql = "SELECT * FROM contact WHERE id = $id";

$result = $conn->query($sql);

$contact = $result->fetch_assoc();


if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $old_image = $_POST['old_image'];
    $image = $_FILES['image'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $from = $_FILES['image']['tmp_name'];
    $filename = $_FILES['image']['full_path'];

    $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

    $newFileName = uniqid() . '.' . $extension;

    $destination = "uploads/$newFileName";

    if (empty($image['name'])) {
        $newFileName = $old_image;
    } else {
        unlink("./uploads/$old_image");

        if (!file_exists('uploads/')) {
            mkdir('uploads/');
        }

        move_uploaded_file($from, $destination);
    }

    $sql = "UPDATE `contact` SET `name`='$name',`email`='$email',`subject`='$subject',`image`='$newFileName',`message`='$message' WHERE id = $id";

    $conn->query($sql);

    header('Location: index.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Contact</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>

    <div class="container mt-5">
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" value="<?php echo $contact['id'] ?>" name="id">
            <input type="hidden" value="<?php echo $contact['image'] ?>" name="old_image">
            <div class="form-group row">
                <div class="col-sm-12 col-lg-6">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" value="<?php echo $contact['name'] ?>">
                </div>
                <div class="col-sm-12 col-lg-6">
                    <label for="email">email</label>
                    <input type="email" id="email" name="email" class="form-control" value="<?php echo $contact['email'] ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="subject">subject</label>
                <input type="text" id="subject" name="subject" value="<?php echo $contact['subject'] ?>" class="form-control">
            </div>

            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" id="image" name="image" class="form-control">
            </div>

            <p>Image: </p>
            <img src="./uploads/<?php echo $contact['image'] ?>" width="200px">
            <div class="form-group">
                <label for="message">Message</label>
                <textarea id="message" cols="30" rows="10" name="message" class="form-control"><?php echo $contact['message'] ?></textarea>
            </div>

            <input type="submit" name="submit" class="btn btn-primary mt-3">
        </form>
    </div>

</body>

</html>
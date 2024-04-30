<?php


session_start();


if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
}


include './db_connect.php';


$sql = "SELECT * FROM contact";

$result = $conn->query($sql);

$erros = [];

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $from = $_FILES['image']['tmp_name'];
    $size = $_FILES['image']['size'];
    $filename = $_FILES['image']['full_path'];

    $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

    $newFileName = uniqid() . '.' . $extension;

    $destination = "uploads/$newFileName";

    $allowedExtenstions = ['png', 'jpg', 'jpeg', 'gif'];

    $image_bool = true;
    $error = true;

    if (!in_array($extension, $allowedExtenstions)) {
        $erros['file'] = 'This File is Not Supported Please Select From png, jpg, jpeg and gif';
        $image_bool = false;
    }

    if ($size > 5000000) {
        $erros['file'] = 'file must be smaller then 5 MB';
        $image_bool = false;
    }

    if (empty($name)) {
        $erros['name'] = 'Please Enter Your Name';
        $error = false;
    } else {
        $error = true;
    }

    if (empty($email)) {
        $erros['email'] = 'Please Enter Your Email';
        $error = false;
    } else {
        $error = true;
    }

    if (empty($subject)) {
        $erros['subject'] = 'Please Enter Your Subject';
        $error = false;
    } else {
        $error = true;
    }

    if (empty($message)) {
        $erros['message'] = 'Please Enter Your Message';
        $error = false;
    } else {
        $error = true;
    }

    if ($error == true) {
        if ($image_bool == true) {
            if (!file_exists('uploads/')) {
                mkdir('uploads/');
            }

            move_uploaded_file($from, $destination);

            $sql = "INSERT INTO `contact`(`name`, `email`, `subject`, `image`, `message`) VALUES ('$name','$email','$subject','$newFileName','$message')";

            $results = $conn->query($sql);

            if ($results != true) {
                echo 'data not added to the database please check with system administrator';
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Validation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="./index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./logout.php">logout</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>


    <?php if (count($erros) > 0) : ?>
        <div class="container mt-5">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong>

                <ul>
                    <?php foreach ($erros as $error) : ?>
                        <li><?php echo $error ?></li>
                    <?php endforeach ?>
                </ul>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    <?php endif ?>



    <div class="container mt-5">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group row">
                <div class="col-sm-12 col-lg-6">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" value="<?php echo $name ?? '' ?>">
                </div>
                <div class="col-sm-12 col-lg-6">
                    <label for="email">email</label>
                    <input type="email" id="email" name="email" class="form-control" value="<?php echo $email ?? '' ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="subject">subject</label>
                <input type="text" id="subject" name="subject" value="<?php echo $subject ?? '' ?>" class="form-control">
            </div>

            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" id="image" name="image" class="form-control">
            </div>

            <div class="form-group">
                <label for="message">Message</label>
                <textarea id="message" cols="30" rows="10" name="message" class="form-control"><?php echo $message ?? '' ?></textarea>
            </div>

            <input type="submit" name="submit" class="btn btn-primary mt-3">
        </form>
    </div>

    <div class="container mt-5">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Subject</th>
                    <th scope="col">Message</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <tr>
                        <th><?php echo $row['id'] ?></th>
                        <td><img src="./uploads/<?php echo $row['image'] ?>" width="50px"></td>
                        <td><?php echo $row['name'] ?></td>
                        <td><?php echo $row['email'] ?></td>
                        <td><?php echo $row['subject'] ?></td>
                        <td><?php echo $row['message'] ?></td>
                        <td><a href="delete.php?id=<?php echo $row['id']; ?>&image=<?php echo $row['image']; ?>" class="btn btn-danger">DELETE</a> <a href="./update.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">UPDATE</a></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>

</html>
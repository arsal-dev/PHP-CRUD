<?php


session_start();


if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
}

$user_id = $_SESSION['user_id'];

include './db_connect.php';


$sql = "SELECT * FROM contact WHERE user_id = '$user_id'";

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

    if (!preg_match("_^[-!#-'*+/-9=?A-Z^-~]+(\.[-!#-'*+/-9=?A-Z^-~]+)*@[0-9A-Za-z]([-0-9A-Za-z]{0,61}[0-9A-Za-z])?(\.[0-9A-Za-z]([-0-9A-Za-z]{0,61}[0-9A-Za-z])?)*\$_", $email)) {
        $erros['email'] = 'Email must be a valid email address';
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

            $sql = "INSERT INTO `contact`(`name`, `email`, `subject`, `image`, `message`, `user_id`) VALUES ('$name','$email','$subject','$newFileName','$message', '$user_id')";

            $results = $conn->query($sql);

            if ($results != true) {
                echo 'data not added to the database please check with system administrator';
            }
        }
    }
}

?>

<?php include './includes/header.php' ?>


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
                <input type="text" id="email" name="email" class="form-control" value="<?php echo $email ?? '' ?>">
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

    <?php include './includes/footer.php' ?>
<?php include './includes/header.php' ?>

<?php

include './db_connect.php';

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    session_start();

    $user_id = $_SESSION['user_id'];

    $sql = "UPDATE users SET `email` = '$email', `password` = '$hashed_password' WHERE id = '$user_id'";

    $conn->query($sql);

    echo 'user details have been updated';
}

?>

<div class="container mt-5">
    <form action="" method="POST">
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control">
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>

        <input type="submit" name="submit" class="btn btn-primary mt-3">
    </form>
</div>

<?php include './includes/footer.php' ?>
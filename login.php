<?php

include './db_connect.php';

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = '$email'";

    $res = $conn->query($sql);

    if ($res->num_rows > 0) {
        $res = $res->fetch_assoc();
        $db_password = $res['password'];

        if (password_verify($password, $db_password)) {

            session_start();

            $_SESSION['user_id'] = $res['id'];

            header('Location: index.php');
        } else {
            echo 'Provided Credentials Do not Match';
        }
    } else {
        echo 'Provided Credentials Do not Match';
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>

    <div class="container mt-5 d-flex justify-content-center">

        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Login</h5>
                <form action="" method="POST">
                    <div>
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                    <div>
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary mt-3">
                </form>
                <a href="./register.php" class="card-link">Don't have an Account?</a>
            </div>
        </div>
    </div>

</body>

</html>
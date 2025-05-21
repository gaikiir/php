<?php
session_start();
require('../db/connectdb.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"] ?? "";
    $email = $_POST["email"] ?? "";
    $password = $_POST["password"] ?? "";
    $role = $_POST["role"] ?? "";

    //GET THE USER DETAILS FROM THE DATABASE

    try {
        // $stmt = "SELECT *FROM users WHERE email = ?";
        $stmt = "SELECT username,email,password,role FROM users WHERE email = ?";
        $sql = $connectdb->prepare($stmt);
        $sql->bindParam(1, $email);
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        if ($result && password_verify($password, $result["password"])) {
            // Valid credentials: Set session variables
            $_SESSION["username"] = $result["username"];
            $_SESSION["email"] = $result["email"];
            $_SESSION["role"] = $result["role"];
            // Redirect based on role
            if ($_SESSION["role"] === "admin") {
                header("location: ../admin/dashboard.php");
            } else {
                header("location: ../user/userdashboard.php");
            }
            exit;
        } else {
            // Invalid credentials
            echo "Invalid credentials";
        }
    } catch (PDOException $err) {
        echo "Error: " . $err->getMessage();
    }
}
// else{
//     echo "Invalid request";
// }


?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>

<body>
    <section class="w-25 mx-auto mb-4 p-3">
        <h4 class="text-center text-uppercase mb-3">Login</h4>
        <form action="" method="POST">
            <div class="form-floating mb-3">
                <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">email</label>
            </div ">
            <div class=" form-floating">
            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Password</label>
            </div>
            <button type="submit" class="w-100 mt-3 btn btn-primary">login</button>

        </form>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>

</html>
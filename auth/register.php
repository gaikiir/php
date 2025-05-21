<?php
session_start();
require_once('../db/connectdb.php');
require_once '../db/connectdb.php';
//empty array to store the validation error
    $error  =[];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"] ?? "";
    $email = $_POST["email"] ?? "";
    $password = $_POST["password"] ?? "";
    $role = "user";


    //INSERT RECORDS INTO DATABASE 
    try {
        $hashedpassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $connectdb->prepare("INSERT INTO users(username,email, password,role) VALUES(:username, :email, :password,:role)");
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $hashedpassword);
        $stmt->bindParam(":role", $role);
        $result = $stmt->execute();
        if (!$result) {
            throw new Exception("an error occurred while inserting");
        } else {
            header("location: ../auth/login.php");
        }
    } catch (PDOException $err) {
        echo "Error: " . $err->getMessage();
    }
}
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
        <h4 class="text-center text-uppercase mb-3">Register</h4>
        <form action="" method="POST" >
          
            <div class="form-floating mb-3">
                <input type="text" name="username" class="form-control" id="floatingText" placeholder="username">
                <label for="floatingText">username</label>
            </div>
            <div class="form-floating mb-3">
                <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">email</label>
            </div ">
            <div class="form-floating">
                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>
            <button type="submit" class="w-100 mt-3 btn btn-primary">Register Now</button>

        </form>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>

</html>
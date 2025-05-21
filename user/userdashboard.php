<?php
session_start();
include '../db/connectdb.php';
?>

<?php require('./include/header.php'); ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Writer Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>

    <div class="bg-gray-50 text-gray-500 max-w-7xl pt-5 mx-auto">
        <h1 class="text-center uppercase underline">welcome writer</h1>

        <!-- footer section -->
        <button class="  p-2 text-light capitalize rounded-md bg-blue-500 hover:bg-blue-700 text-white font-bold">
            <a href="./article/article.php">Create Article</a>
        </button>
    </div>


</body>

</html>
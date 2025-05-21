<?php
session_start();
//using the abosolute path to navigate to db
require($_SERVER['DOCUMENT_ROOT'] . '/form/db/connectdb.php');
 require('../include/header.php'); 
 
 if($_SERVER["REQUEST_METHOD"] === "POST"){
    $title = $_POST["title"] ?? "";
    $description = $_POST["description"] ?? "";
    try{
        //creating and preparing the statement 
        $stmt = $connectdb->prepare("INSERT INTO articles(title,description) VALUES(:title,:description)");
        $stmt->bindParam(":title",$title);
        $stmt->bindParam(":description",$description);
        $sql = $stmt->execute();
        //check for the if the article inserted successfully to the database 
        if(!$sql){
            throw new Exception("An error occurred while creating records");
        }else{
            echo "new record created successfully";
        }
    }catch(PDOException $err){
        die("Invalid request" .$err);
    }

 }
 ?>

<div class="max-w-md mx-auto p-6 bg-white shadow-md rounded-lg mt-10">
    <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Hello,user</h1>
    <form action="" method="post" class="space-y-4">
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700">Article Title</label>
            <input type="text" name="title" id="title"
                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Article Description</label>
            <input type="text" name="description" id="description"
                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <button type="submit"
                class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition duration-200">Create
                Article</button>
        </div>
    </form>
</div>
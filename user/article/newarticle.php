
<?php
session_start(); 
//connect to database
include '../../db/connectdb.php';
//getting articles from database 
    try{
         $stmt = $connectdb->query("SELECT * FROM articles ORDER BY id ASC");
        $stmt->fetchAll(PDO::FETCH_ASSOC);
        $articles = $stmt->execute();
        //loops through the fetched data 
        // foreach($articles as $article){
            
        // }
    } catch(PDOException $err){
        echo "an error occurred while fetching data from server" .$err->getMessage();
    }
?>


//var dumpping the data




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NewsFlash Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="font-sans bg-gray-100">
    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">


        <!-- Recent Articles Section -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden mb-8">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Recent Articles</h2>
            </div>
            <div class="divide-y divide-gray-200">
                <div class="px-6 py-4 hover:bg-gray-50 transition duration-150">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-md font-medium text-gray-900">Global Summit Addresses Climate Change Concerns</h3>
                            <p class="text-sm text-gray-500 mt-1">Published: 2 hours ago | Category: World News</p>
                        </div>
                        <div class="flex space-x-2">
                            <button class="text-blue-600 hover:text-blue-800">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="text-red-600 hover:text-red-800">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="px-6 py-4 hover:bg-gray-50 transition duration-150">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-md font-medium text-gray-900">Tech Giant Unveils New AI Assistant</h3>
                            <p class="text-sm text-gray-500 mt-1">Published: 5 hours ago | Category: Technology</p>
                        </div>
                        <div class="flex space-x-2">
                            <button class="text-blue-600 hover:text-blue-800">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="text-red-600 hover:text-red-800">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="px-6 py-4 hover:bg-gray-50 transition duration-150">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-md font-medium text-gray-900">Local Team Wins Championship Title</h3>
                            <p class="text-sm text-gray-500 mt-1">Published: Yesterday | Category: Sports</p>
                        </div>
                        <div class="flex space-x-2">
                            <button class="text-blue-600 hover:text-blue-800">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="text-red-600 hover:text-red-800">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-6 py-4 bg-gray-50 text-right">
                <a href="#view-all" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View all articles →</a>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Add New Article -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Add New Article</h3>
                <p class="text-sm text-gray-500 mb-4">Create and publish a new news article</p>
                <button class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium transition duration-300">
                    <i class="fas fa-plus mr-2"></i> New Article
                </button>
            </div>

            <!-- Manage Categories -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Manage Categories</h3>
                <p class="text-sm text-gray-500 mb-4">Add, edit or remove news categories</p>
                <button class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm font-medium transition duration-300">
                    <i class="fas fa-tags mr-2"></i> Categories
                </button>
            </div>

            <!-- User Management -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-medium text-gray-900 mb-4">User Management</h3>
                <p class="text-sm text-gray-500 mb-4">View and manage user accounts</p>
                <button class="w-full bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-md text-sm font-medium transition duration-300">
                    <i class="fas fa-users-cog mr-2"></i> Manage Users
                </button>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 mt-12">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <p class="text-base text-gray-400">
                    &copy; 2023 NewsFlash Admin Dashboard. All rights reserved.
                </p>
                <div class="flex space-x-6">
                    <a href="#" class="text-gray-400 hover:text-white">
                        <i class="fab fa-github"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white">
                        <i class="fas fa-question-circle"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>
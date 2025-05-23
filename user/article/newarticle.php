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
        <div class="bg-white shadow-md rounded-lg overflow-hidden mt-16">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Recent Articles</h2>
            </div>

            <div class="divide-y divide-gray-200">
                <div class="px-6 py-4 hover:bg-gray-50 transition duration-150">
                    <?php
                    session_start();
                    //connect to database
                    include '../../db/connectdb.php';

                    //getting articles from database 
                    try {
                        $stmt = $connectdb->query("SELECT * FROM articles ORDER BY id ASC");
                        $articles =  $stmt->fetchAll(PDO::FETCH_ASSOC);
                        if (count($articles) === 0) {
                            echo "<li>No article Found </li>";
                        } else {
                            foreach ($articles as $article) {
                                echo <<<HTML
                                <div class="flex items-center justify-between py-3 mb-3 article-item">
                                <!-- <span data-id="{$article['id']}">{$article['id']}</span> -->
                                    <div>
                                        <h3 class="text-md font-medium text-gray-900">{$article['title']}</h3>
                                        <p class="text-sm text-gray-500 mt-1">{$article['description']}</p>
                                        
                                    </div>
                                    <!-- /Edit for update content  -->
                                    <div class="flex space-x-2">
                                    <a href="update.php?id={$article['id']}" class="text-blue-600 edit-btn hover:text-blue-800">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <!-- deleting existing data from database -->
                                        <form action="delete_article.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this article?');">
                                          <input type="hidden" name="delete_id" value="{$article['id']}">
                                    <button type="submit" class="text-red-600 hover:text-red-800">
                                     <i class="fas fa-trash"></i>
                                </button>
                            </form>

                                    </div>
                                </div>
                            HTML;
                            }
                        }
                    } catch (PDOException $err) {
                        echo "an error occurred while fetching data from server" . $err->getMessage();
                    }

                    //UPDTATE ARTICLE 
                    // try{
                    //     $stmt = $connectdb->query("UPDATE articles SET 
                    //     title = 'new title', description = 'new description' WHERE id = ?");
                    // }
                    // 
                    ?>
                </div>
            </div>
            <div class="px-6 py-4 bg-gray-50 text-right">
                <a href="#view-all" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View all articles →</a>
            </div>
        </div>


    </div>


    <!-- Footer -->
    <footer class="bg-gray-800 mt-12 fixed bottom-0 right-0 left-0">
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
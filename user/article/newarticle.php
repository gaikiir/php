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
                                <div class="flex items-center justify-between py-3 mb-3 ">
                                <!-- <span data-id="{$article['id']}">{$article['id']}</span> -->
                                    <div>
                                        <h3 class="text-md font-medium text-gray-900">{$article['title']}</h3>
                                        <p class="text-sm text-gray-500 mt-1">{$article['description']}</p>
                                        
                                    </div>
                                    <div class="flex space-x-2">
                                        <button class="text-blue-600 hover:text-blue-800">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <div class="edit-form hidden mt-3">
                                        <input type="text" class="w-full p-2 border rounded title-input" value="{$article['title']}">
                                            <textarea class="w-full p-2 border rounded mt-2 description-input">{$article['description']}</textarea>
                                            <button class="save-btn mt-2 px-4 py-2 bg-blue-500 text-white rounded">Save</button>
                                            <button class="cancel-btn mt-2 px-4 py-2 bg-gray-500 text-white rounded ml-2">Cancel</button>
                                        </div>
                                        <button class="text-red-600 hover:text-red-800">
                                            <i class="fas fa-trash"></i>
                                        </button>

                                    </div>
                                </div>
                            HTML;
                            }
                        }
                    } catch (PDOException $err) {
                        echo "an error occurred while fetching data from server" . $err->getMessage();
                    }
                    ?>
                </div>
            </div>
            <div class="px-6 py-4 bg-gray-50 text-right">
                <a href="#view-all" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View all articles →</a>
            </div>
        </div>


    </div>

    <script>
        // get all elements with class "edit-form"

        document.addEventListener("DOMContentLoaded", () => {
            document.querySelectorAll('.edit-btn').forEach(button => {
                //handling the edit button
                button.addEventListener('click', function() {
                    const articleItem = this.closest('.article-item');
                    const editForm = articleItem.querySelector('.edit-form');
                    editForm.classList.toggle('hidden');
                });
            })

            //handle the save button
            document.querySelectorAll('.save-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const articleItem = this.closest('.article-item');
                    const articleId = articleItem.dataset.id;
                    const titleInput = articleItem.querySelector('.title-input').value;
                    const descriptionInput = articleItem.querySelector('.description-input').value;
                });
            });
            // Handle Cancel Button Click
            document.querySelectorAll('.cancel-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const articleItem = this.closest('.article-item');
                    const editForm = articleItem.querySelector('.edit-form');
                    editForm.classList.add('hidden');
                });
            });
        });
    </script>

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
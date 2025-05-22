<?php
// update.php
require($_SERVER['DOCUMENT_ROOT'] . '/form/db/connectdb.php'); // Verify this path is correct

// Check if ID is provided and valid
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid or missing article ID.");
}
$id = (int)$_GET['id']; // Cast to integer for safety

// Fetch the article to edit
try {
    $stmt = $connectdb->prepare("SELECT * FROM articles WHERE id = ?");
    $stmt->execute([$id]);
    $article = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if article exists
    if (!$article) {
        die("Article not found.");
    }
} catch (PDOException $e) {
    die("Error fetching article: " . $e->getMessage());
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate inputs
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');

    if (empty($title) || empty($description)) {
        die("Title and description are required.");
    }

    try {
        $stmt = $connectdb->prepare("UPDATE articles SET title = ?, description = ? WHERE id = ?");
        $stmt->execute([$title, $description, $id]);

        // Store success message in session
        $_SESSION['success_message'] = "Article updated successfully.";
        header("Location: newarticle.php");
        exit();
    } catch (PDOException $e) {
        die("Error updating article: " . $e->getMessage());
    }
}

// Generate CSRF token
session_start();
$csrf_token = bin2hex(random_bytes(32));
$_SESSION['csrf_token'] = $csrf_token;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="font-sans bg-gray-100">
    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Updating existing data from the database -->
        <form method="POST" class="mt-3">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token) ?>">
            <input type="text" class="w-full p-2 border rounded title-input" name="title" value="<?= htmlspecialchars($article['title']) ?>" required>
            <textarea class="w-full p-2 border rounded mt-2 description-input" name="description" required><?= htmlspecialchars($article['description']) ?></textarea>
            <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded">Save</button>
        </form>
    </div>
    <!-- Footer -->
    <footer class="bg-gray-800 mt-12 fixed bottom-0 w-full">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <p class="text-base text-gray-400">
                    © <?= date('Y') ?> NewsFlash Admin Dashboard. All rights reserved.
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
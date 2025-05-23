<?php
session_start();
include '../../db/connectdb.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $articleId = $_POST['delete_id'];

    try {
        $stmt = $conn->prepare("DELETE FROM articles WHERE id = :id");
        $stmt->bindParam(':id', $articleId, PDO::PARAM_INT);
        $stmt->execute();
        header("Location: ./user/dashboard.php?deleted=success");
        exit;
    } catch (PDOException $e) {
        echo "Error deleting article: " . $e->getMessage();
    }
} else {
    header("Location: ../writers/dashboard.php");
    exit;
}
?>

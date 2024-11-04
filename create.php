<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = $_SESSION['user_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $content = $_POST['content'];
    $createDate = date('Y-m-d');
    $updateDate = date('Y-m-d');

    $stmt = $pdo->prepare("INSERT INTO posts (userId, title, description, content, createDate, updateDate) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$userId, $title, $description, $content, $createDate, $updateDate]);
    header("Location: index.php");
}

$userStmt = $pdo->query("SELECT * FROM users");
$users = $userStmt->fetchAll();

$stmt = $pdo->query("SELECT * FROM posts INNER JOIN users ON posts.userId = users.userId");
$posts = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Article</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Create Article</h1>
        <form method="POST">
            <div class="form-group">
                <input type="text" name="title" class="form-control" placeholder="Article Title" required>
            </div>
            <div class="form-group">
                <textarea name="description" class="form-control" placeholder="Article Description" required></textarea>
            </div>
            <div class="form-group">
                <textarea name="content" class="form-control" placeholder="Article Content" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
            <a href="index.php" class="btn btn-secondary">Back to Articles</a>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-

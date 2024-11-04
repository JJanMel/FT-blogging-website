<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'db.php';

$stmt = $pdo->query("SELECT * FROM posts");
$posts = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Blog</h1>
        <a href="create.php" class="btn btn-primary mb-3">Create New Article</a>
        <a href="logout.php" class="btn btn-danger mb-3">Logout</a>
        <div class="list-group">
            <?php foreach ($posts as $post): ?>
                <div class="list-group-item">
                    <h3>Title: <?php echo htmlspecialchars($post['title']); ?></h3>
                    <h5>Description: <?php echo htmlspecialchars($post['description']); ?></h5>
                    <p><?php echo htmlspecialchars($post['content']); ?></p>
                    <p>Created: <?php echo htmlspecialchars($post['createDate']); ?></p>
                    <p>Post by: <?php echo htmlspecialchars($post['userId']); ?></p>
                    <a href="edit.php?id=<?php echo $post['id']; ?>" class="btn btn-warning">Edit</a>
                    <a href="delete.php?id=<?php echo $post['id']; ?>" class="btn btn-danger">Delete</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
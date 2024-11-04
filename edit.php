<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'db.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
$stmt->execute([$id]);
$post = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $content = $_POST['content'];
    $updateDate = date('m-d-Y');

    $stmt = $pdo->prepare("UPDATE posts SET title = ?, description = ?, content = ?, updateDate = ? WHERE id = ?");
    $stmt->execute([$title, $description, $content, $updateDate, $id]);
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Article</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Article</h1>
        <form method="POST">
            <div class="form-group">
                <input type="text" name="userId" class="form-control" value="<?php echo htmlspecialchars($post['userId']); ?>" required>
            </div>
            <div class="form-group">
                <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($post['title']); ?>" required>
            </div>
            <div class="form-group">
                <textarea name="description" class="form-control" required><?php echo htmlspecialchars($post['description']); ?></textarea>
            </div>
            <div class="form-group">
                <textarea name="content" class="form-control" required><?php echo htmlspecialchars($post['content']); ?></textarea>
            </div>
            <div class="form-group">
               <p>Created: <?php echo htmlspecialchars($post['createDate']); ?></p>
            </div>
            <div class="form-group">
                <p>Last Updated: <?php echo htmlspecialchars($post['updateDate']); ?></p>
            </div>
            <button type="submit" class="btn btn-warning">Update</button>
            <a href="index.php" class="btn btn-secondary">Back to Articles</a>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

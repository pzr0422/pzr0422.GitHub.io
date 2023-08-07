<?php
// 启动会话
session_start();

// 检查用户是否已登录，如果未登录则重定向到登录页面
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// 获取当前登录用户ID
$user_id = $_SESSION['user_id'];

// 处理博客创建表单提交
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create'])) {
    // 连接到MySQL数据库
    $conn = new mysqli('localhost', 'root', '20040629pzr', 'blog');

    // 检查数据库连接
    if ($conn->connect_error) {
        die("连接失败: " . $conn->connect_error);
    }

    // 获取表单提交的数据
    $title = $_POST['title'];
    $content = $_POST['content'];

    // 插入博客数据到'blogs'表中
    $sql = "INSERT INTO blogs (user_id, title, content) VALUES ('$user_id', '$title', '$content')";
    if ($conn->query($sql) === TRUE) {
        // 重定向到主页
        header('Location: index.php');
        exit();
    } else {
        echo '<p>博客创建失败。请重试。</p>';
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Blog</title>
    <link rel="stylesheet" href="create.css">
</head>
<body>
    <header>
        <h1>Create Your Own Blog</h1>
    </header>
    <main>
        <form method="POST">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>
            <label for="content">Content:</label>
            <textarea id="content" name="content" required></textarea>
            <button type="submit" name="create">Create Blog</button>
        </form>
    </main>
    <footer>
        <p>This website is made by Anthony Pan from NJUPT</p>
    </footer>
</body>
</html>

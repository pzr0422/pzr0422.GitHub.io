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

// 连接到MySQL数据库
$conn = new mysqli('localhost', 'root', '20040629pzr', 'blog');

// 检查数据库连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

// 查询用户已创建的博客标题
$sql = "SELECT blog_id, title FROM blogs WHERE user_id='$user_id'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Blog</title>
    <link rel="stylesheet" href="modify.css">
</head>
<body>
    <header>
        <h1>Modify Your Blog</h1>
    </header>
    <main>
        <form method="POST">
            <label for="blog_id">Select Blog to Modify:</label>
            <select id="blog_id" name="blog_id" required>
                <?php
                // 循环遍历查询结果，生成选项列表
                while ($row = $result->fetch_assoc()) {
                    $blog_id = $row['blog_id'];
                    $title = $row['title'];
                    echo "<option value='$blog_id'>$title</option>";
                }
                ?>
            </select>
            <label for="new_content">New Content:</label>
            <textarea id="new_content" name="new_content" required></textarea>
            <button type="submit" name="modify">Modify Blog</button>
        </form>
    </main>
    <footer>
        <p>This website is made by Anthony Pan from NJUPT</p>
    </footer>
</body>
</html>

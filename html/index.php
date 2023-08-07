<?php
// 启动会话
session_start();

// 连接到MySQL数据库
$conn = new mysqli('localhost', 'root', '20040629pzr', 'blog');

// 检查数据库连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

// 查询所有用户创建的博客标题和内容
$sql = "SELECT user_id, title, content FROM blogs";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage of my blog</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="create.php">Create your own blog!</a></li>
                <li><a href="modify.php">Modify your own blog!</a></li>
            </ul>
        </nav>
    </header>
    <main>
    <?php
        // 循环遍历查询结果，生成博客标题列表
        while ($row = $result->fetch_assoc()) {
            $user_id = $row['user_id'];
            $title = $row['title'];
            $content = $row['content'];
            echo "<div class='blog-title'>
                    <h2>$title</h2>
                    <p>By: User $user_id</p>
                    <button class='read-more-button' onclick='toggleContent($user_id)'>Read More</button>
                    <div class='blog-content' id='content$user_id'>$content</div>
                  </div>";
        }
        ?>
    </main>
    <script>
        // JavaScript function to toggle content visibility
        function toggleContent(userId) {
            var contentElement = document.getElementById(`content${userId}`);
            contentElement.style.display = contentElement.style.display === 'none' ? 'block' : 'none';
        }
    </script>
    <footer>
        <p>This website is made by Anthony Pan from NJUPT</p>
    </footer>
</body>
</html>

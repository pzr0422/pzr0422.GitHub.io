<?php
// 启动会话
session_start();

// 处理用户登录表单提交
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    // 连接到MySQL数据库
    $conn = new mysqli('localhost', 'root', '20040629pzr', 'blog');

    // 检查数据库连接
    if ($conn->connect_error) {
        die("连接失败: " . $conn->connect_error);
    }

    // 获取表单提交的数据
    $user_id = $_POST['User_ID'];
    $password = $_POST['psw'];

    // 查询数据库验证用户凭据
    $sql = "SELECT password FROM users WHERE user_id='$user_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];

        // 验证密码
        if (password_verify($password, $hashed_password)) {
            // 登录成功后，设置会话变量以记录用户登录状态
            $_SESSION['user_id'] = $user_id;
            header('Location: index.php'); // 重定向到主页面
            exit();
        } else {
            echo '<p>登录失败。请检查您的用户ID和密码。</p>';
        }
    } else {
        echo '<p>登录失败。请检查您的用户ID和密码。</p>';
    }

    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login part</title>
    <link rel="stylesheet" href="register.css">
</head>
<body>
    <h1>My first program: A simple blog system</h1>
    <h2>Here's the "login" part:</h2>
    <div>
        <form method="POST" novalidate>
            <fieldset>
                <legend>Enter your account information</legend>
                <div>
                    <label for="User ID">User ID *</label>
                    <input type="text" id="User ID" name="User ID" />
                </div>
                <div>
                    <label for="psw">Password *</label>
                    <input type="text" id="psw" name="psw" />
                </div>
                <button type="submit" name="login"><strong>log in</strong></button>
                <p>还没有账号？<a href="register.php">立即注册</a></p>
            </fieldset>
        </form>
    </div>
</body>
</html>

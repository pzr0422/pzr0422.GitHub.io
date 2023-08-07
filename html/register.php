<?php
// 启动会话
session_start();

// 处理用户注册表单提交
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) 
{
    // 连接到MySQL数据库
    $conn = new mysqli('localhost', 'root', '20040629pzr', 'blog');

    // 检查数据库连接
    if ($conn->connect_error) {
        die("连接失败: " . $conn->connect_error);
    }

    // 获取表单提交的数据
    $user_id = $_POST['User_ID'];
    $password = $_POST['psw'];
    $email = $_POST['E-mail'];
    $age = $_POST['age'];

    // 对密码进行哈希处理以增加安全性（在实际应用中，可以使用更高级的哈希机制）
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // 将用户数据插入到'users'表中
    $sql = "INSERT INTO users (user_id, password, email, age) VALUES ('$user_id', '$hashed_password', '$email', '$age')";
    if ($conn->query($sql) === TRUE) {
        // 注册成功后，设置会话变量以记录用户登录状态
        $_SESSION['user_id'] = $user_id;
        header('Location: index.php'); // 重定向到主页面
        exit();
    } else {
        echo '<p>注册失败。请重试。</p>';
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
    <script src="register.js" async></script>
</head>
<body>
    <h1>My first program: A simple blog system</h1>
    <h2>Here's the "register" part:</h2>
    <div>
        <form method="POST" novalidate>
            <fieldset>
                <legend>Feedback Form</legend>
                <div>
                    <label for="User ID">User ID *</label>
                    <input type="text" id="User ID" name="User ID" required/>
                    <span></span>
                    <span class="error-ID"></span>
                </div>
                <div>
                    <label for="psw">Password *</label>
                    <input type="text" id="psw" name="psw" required/>
                    <span></span>
                    <span class="error-psw"></span>
                </div>
                <div>
                    <label for="E-mail">E-mail *</label>
                    <input type="email" id="E-mail" name="E-mail" required>
                    <span></span>
                    <span class="error-email"></span>
                </div>
                <div>
                    <label for="age">Age(precisely or just ignore it)</label>
                    <input type="text" id="age" name="age" />
                    
                </div>
                <button type="submit" name="submit"><strong>Register</strong></button>
            </fieldset>
        </form>
    </div>
</body>
</html>

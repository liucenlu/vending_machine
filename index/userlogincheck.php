<?php
// userlogincheck.php
session_start(); // 启动会话

if (!isset($_POST["text1"])) {
    header("Location: adminlogin.html");
    exit(); // 确保脚本停止执行
} else {
    require 'database.php'; // 使用包含的数据库连接文件

    $uid = $_POST["text1"];
    $pwd = $_POST["password1"];

    try {
        // 使用准备好的语句防止 SQL 注入
        $qry = $pdo->prepare("SELECT password FROM users WHERE username = ?");
        $qry->execute([$uid]);

        if ($qry->rowCount() > 0) {
            $row = $qry->fetch(PDO::FETCH_ASSOC);
            $hashed_password = $row['password'];

            echo "输入的密码: " . $pwd . "<br>";
            echo "数据库中的密码: " . $hashed_password . "<br>";

            // 临时明文比较
            if ($pwd === $hashed_password) {
                // 设置会话变量
                $_SESSION['username'] = $uid;
                $_SESSION['logged_in'] = true;
                header("Location: userview.php?tn=" . urlencode($uid) . "&gn=user");  
                exit();
            } else {
                echo "<script>alert('密码错误!'); window.location.href = 'adminlogin.html';</script>";
            }
        } else {
            echo "<script>alert('用户不存在!'); window.location.href = 'adminlogin.html';</script>";
        }
    } catch (PDOException $e) {
        die("查询失败: " . $e->getMessage());
    }
}
?>

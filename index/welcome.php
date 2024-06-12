<?php  
session_start(); // 启动会话  
ob_start(); // 开始输出缓冲  
  
// 连接数据库  
$con = new mysqli("localhost", "root", "root", "vending_machine");  
  
if ($con->connect_error) {  
    die("连接失败: " . $con->connect_error);  
}  
  
// 获取用户名和身份  
$uid = isset($_GET["tn"]) ? $_GET["tn"] : null;  
$identity = isset($_GET["gn"]) ? $_GET["gn"] : null;  
  
// 检查用户身份  
if ($identity === "user") {  
    // 防止SQL注入  
    $stmt = $con->prepare("SELECT name FROM users WHERE username = ?");  
    $stmt->bind_param("s", $uid);  
  
    if ($stmt->execute()) {  
        $stmt->bind_result($name);  
        $stmt->fetch();  
  
        // 转义输出  
        $safe_name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');  
   
    } else {  
        // 处理查询错误  
        die("查询失败: " . $stmt->error);  
    }  
} else if($identity === "admin"){  
    // 处理管理员身份  
    // 防止SQL注入  
    $stmt = $con->prepare("SELECT name FROM administrators WHERE username = ?");  
    $stmt->bind_param("s", $uid);  
  
    if ($stmt->execute()) {  
        $stmt->bind_result($name);  
        $stmt->fetch();  
  
        // 转义输出  
        $safe_name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');  
   
    } else {  
        // 处理查询错误  
        die("查询失败: " . $stmt->error);  
    }     
}  
  
// 输出HTML  
?>  
<div class="welcome-box">  
    <p>欢迎进入  
        <br>SZTU自动售卖机在线系统  
        <br><span style="font-family: Comic Sans MS; font-size: 50px;color:#a5604e;"><?php echo $safe_name ?? '访客'; ?></span>  
    </p>  
</div>  
<?php  
// 在关闭输出缓冲  
ob_end_flush();  
?>
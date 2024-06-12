<?php  
// getMachine.php  
session_start(); // 启动会话  
error_reporting(E_ALL);  
ini_set('display_errors', 1);  
  
header('Content-Type: application/json');  
  
// 数据库连接文件  
require 'database.php';  
  
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {  
    echo json_encode(["error" => "请先登录"]);  
    exit();  
}  
  
try {  
    // 查询售卖机信息  
    $sql = "SELECT * FROM machine";  
    $stmt = $pdo->prepare($sql);  
  
    // 执行查询  
    $stmt->execute();  
    $machines = $stmt->fetchAll(PDO::FETCH_ASSOC);  
  
    echo json_encode(["machines" => $machines]); // 使用一个数组来包装结果，这样返回的数据结构更清晰  
} catch (PDOException $e) {  
    // 输出一般错误信息  
    echo json_encode(["error" => "查询失败，请稍后再试"]);  
}  
?>

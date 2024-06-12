<?php
// 启动会话
session_start();

// 启用错误报告
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');

// 数据库连接
require 'database.php';

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {  
    echo json_encode(["error" => "请先登录"]);  
    exit();  
}

// 处理传递过来的参数
$dID = $_GET['dID'];
$quantity = $_GET['quantity'];
$vendingMachine = $_GET['vendingMachine'];

try {
    // 更新 includes 表中的库存
    $stmt = $pdo->prepare("UPDATE includes SET inventory = inventory + ? WHERE dID = ? AND vID = ?");
    $stmt->execute([$quantity, $dID, $vendingMachine]);
    
    if ($stmt->rowCount() > 0) {
        // 更新 machine 表中的总库存
        $stmt = $pdo->prepare("UPDATE machine SET Total_inventory = Total_inventory + ? WHERE vID = ?");
        $stmt->execute([$quantity, $vendingMachine]);

        if ($stmt->rowCount() > 0) {
            echo json_encode(["success" => "补货成功"]);
        } else {
            echo json_encode(["error" => "未能成功更新总库存"]);
        }
    } else {
        echo json_encode(["error" => "未能成功补货"]);
    }
} catch (PDOException $e) {
    echo json_encode(["error" => "补货失败: " . $e->getMessage()]);
}
?>

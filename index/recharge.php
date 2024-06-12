<?php
// 启动会话
session_start();

// 启用错误报告
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');

// 包含数据库连接文件
require 'database.php';

$uid = isset($_SESSION['username']) ? $_SESSION['username'] : '';
$balance = isset($_SESSION['balance']) ? $_SESSION['balance'] : '';

if (empty($uid) || empty($balance)) {
    echo json_encode(["error" => "No user ID or balance provided"]);
    exit();
}

// 从客户端获取充值金额
$data = json_decode(file_get_contents('php://input'), true);
$newBalance = $balance + $data['money'];

try {
    // 更新用户余额users表
    $stmt = $pdo->prepare("UPDATE users SET balance = ? WHERE username = ?");
    $stmt->execute([$newBalance, $uid]);

    // 检查是否成功更新
    if ($stmt->rowCount() > 0) {
        echo json_encode(["success" => "充值成功", "newBalance" => $newBalance]);
    } else {
        echo json_encode(["error" => "未能更新用户余额"]);
    }
} catch (PDOException $e) {
    echo json_encode(["error" => "充值失败: " . $e->getMessage()]);
}
?>

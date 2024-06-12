<?php
session_start(); // 启动会话

// 启用错误报告
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');

// 包含数据库连接文件
require 'database.php';

$uid = isset($_SESSION['username']) ? $_SESSION['username'] : '';

if (empty($uid)) {
    echo json_encode(["error" => "无法获取用户id"]);
    exit();
}

try {
    // 查询订单信息
    $stmt = $pdo->prepare("SELECT o.o_id,o.consumer,d.name,o.quantity,o.time FROM orderform o,drink d WHERE consumer = ?");
    $stmt->execute([$uid]);
    $forms = $stmt->fetchAll();

    echo json_encode($forms);
} catch (PDOException $e) {
    echo json_encode(["error" => "Query failed: " . $e->getMessage()]);
}
?>

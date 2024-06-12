<?php
session_start(); // 启动会话
// 启用错误报告
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');

// 包含数据库连接文件
require 'database.php';

$vID = isset($_GET['vID']) ? $_GET['vID'] : '';

if (empty($vID)) {
    echo json_encode(["error" => "No vending machine ID provided"]);
    exit();
}

try {
    // 查询饮料信息
    $sql = "SELECT drink.name, drink.price, drink.Shelf_life,drink.dID,includes.inventory
            FROM includes 
            JOIN drink ON includes.dID = drink.dID 
            WHERE includes.vID = ?";
    $stmt = $pdo->prepare($sql);

    $stmt->execute([$vID]);
    $drinks = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($drinks);
} catch (PDOException $e) {
    echo json_encode(["error" => "Query failed: " . $e->getMessage()]);
}
?>

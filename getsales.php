<?php
// 启动会话
session_start();

// 启用错误报告
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');

// 包含数据库连接文件
require 'database.php';

try {
    // 查询饮料销售量
    $sql_drinks = "SELECT d.dID, d.name, SUM(o.quantity) AS total_sales
                   FROM orderform o
                   JOIN drink d ON o.dID = d.dID
                   GROUP BY d.dID, d.name";

    // 执行饮料销售量查询
    $stmt_drinks = $pdo->prepare($sql_drinks);
    $stmt_drinks->execute();
    $results_drinks = $stmt_drinks->fetchAll(PDO::FETCH_ASSOC);

    // 查询售卖机销售量
    $sql_machines = "SELECT vID, SUM(o.quantity) AS total_sales
                     FROM orderform o
                     GROUP BY vID";

    // 执行售卖机销售量查询
    $stmt_machines = $pdo->prepare($sql_machines);
    $stmt_machines->execute();
    $results_machines = $stmt_machines->fetchAll(PDO::FETCH_ASSOC);

    // 返回结果
    $combined_results = [
        "drinks" => $results_drinks,
        "machines" => $results_machines
    ];
    echo json_encode($combined_results);

} catch (PDOException $e) {
    echo json_encode(["error" => "查询失败: " . $e->getMessage()]);
}
?>

<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');

require 'database.php';

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {  
    echo json_encode(["error" => "请先登录"]);  
    exit();  
}

try {
    $sql = "SELECT vID, places FROM machine";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $machines = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(["machines" => $machines]);
} catch (PDOException $e) {
    echo json_encode(["error" => "获取售卖机信息失败，请稍后再试"]);
}
?>

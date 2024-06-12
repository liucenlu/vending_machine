<?php
// submitOrder.php
// 启动会话
session_start();

// 检查用户是否已登录，如果未登录则重定向到登录页面
if (!isset($_SESSION['username']) || $_SESSION['logged_in'] !== true) {   
    header("Location: userlogin.php");
    exit(); 
}  
// 包含数据库连接文件
require 'database.php';
// 从会话中获取当前用户的用户名
$username = $_SESSION['username'];

// 从客户端获取订单数据
$data = json_decode(file_get_contents('php://input'), true);



try {
    // 查询订单表以获取订单号
    $sql = "SELECT MAX(CAST(o_id AS UNSIGNED)) AS max_id FROM orderform";
    $stmt = $pdo->query($sql);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $o_id = $row["max_id"] + 1; 
    if ($o_id === null) {
        $o_id = 10000; // 如果订单表为空，初始订单号为 10000
    }

    // 获取订单时间
    $time = date('Y-m-d H:i:s');

    // 查询 users 表以获取用户余额
    $sql = "SELECT balance FROM users WHERE username = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        echo json_encode(["error" => "无法找到用户信息"]);
        exit();
    }
    $userBalance = $row["balance"];

    $vID = $data['vID']; // 获取售卖机编号
    $dID = $data['dID']; // 获取饮品编号

    // 查询 machine 表以获取售卖机库存
    $sql = "SELECT Total_inventory FROM machine WHERE vID = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$vID]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        echo json_encode(["error" => "无法找到售卖机信息 - vID: $vID"]);
        exit();
    }
    $machineInventory = $row["Total_inventory"]; // 确保字段名称正确

    // 查询 includes 表以获取饮料库存
    $sql = "SELECT inventory FROM includes WHERE vID = ? AND dID = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$vID, $dID]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        echo json_encode(["error" => "无法找到饮料库存信息 - vID: $vID"]);
        exit();
    }
    $drinkInventory = $row["inventory"]; // 确保字段名称正确

    // 计算订单总额
    $total = $data['price'] * $data['quantity'];

    // 检查库存是否足够
    if ($data['quantity'] > $drinkInventory) {
        echo json_encode(["error" => "库存不足"]);
        exit();
    }

    // 更新用户余额
    $newBalance = $userBalance - $total;
    $sql = "UPDATE users SET balance = ? WHERE username = ?";
    $stmt = $pdo->prepare($sql);
    if (!$stmt->execute([$newBalance, $username])) {
        echo json_encode(["error" => "更新用户余额失败"]);
        exit();
    }

    // 更新售卖机库存 machine 表
    $newInventory = $machineInventory - $data['quantity'];
    $sql = "UPDATE machine SET Total_inventory = ? WHERE vID = ?";
    $stmt = $pdo->prepare($sql);
    if (!$stmt->execute([$newInventory, $vID])) {
        echo json_encode(["error" => "更新售卖机库存失败"]);
        exit();
    }

    // 更新售卖机中某饮料库存 includes 表
    $newdrinkInventory = $drinkInventory - $data['quantity'];
    $sql = "UPDATE includes SET inventory = ? WHERE vID = ? AND dID = ?";
    $stmt = $pdo->prepare($sql);
    if (!$stmt->execute([$newdrinkInventory, $vID, $dID])) {
        echo json_encode(["error" => "更新售卖机库存失败"]);
        exit();
    }

    // 将订单信息记录到订单表中
    $sql = "INSERT INTO orderform (o_id, dID, vID, consumer, quantity, time) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    if (!$stmt->execute([$o_id, $dID, $vID, $username, $data['quantity'], $time])) {
        echo json_encode(["error" => "记录订单信息失败"]);
        exit();
    }

    // 返回响应
    $response = array(
        "message" => "支付成功，感谢购买！！您的余额: ¥$newBalance", // 返回成功信息和更新后的用户余额
        "price" => $data['price'],
        "shelfLife" => $data['shelfLife'],
        "o_id" => $o_id,
        "time" => $time,
        "drink" => $data['name'],
        "quantity" => $data['quantity'],
        "total" => $total
    );
    echo json_encode($response);

} catch (PDOException $e) {
    echo json_encode(["error" => "连接失败: " . $e->getMessage()]);
    exit();
}
?>

<?php  
// getMachine.php  
session_start(); // 启动会话  
// 启用错误报告  
error_reporting(E_ALL);  
ini_set('display_errors', 1);  
  
header('Content-Type: application/json');  
  
// 包含数据库连接文件  
require 'database.php';  
  
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {  
    echo json_encode(["error" => "请先登录"]);  
    exit();  
}  

// 检查是否通过POST方法传递了需要的参数
if (!isset($_POST['machineId']) || !isset($_POST['location']) || !isset($_POST['inventory'])) {
    echo json_encode(["error" => "缺少参数"]);
    exit();
}

$machineId = $_POST['machineId'];
$location = $_POST['location'];
$inventory = $_POST['inventory'];

try {  
    // 插入售卖机信息
    $sql = "INSERT INTO machine(vID, places, Total_inventory) VALUES (?,?,?)";  
    $stmt = $pdo->prepare($sql);  
    $stmt->execute([$machineId, $location, $inventory]);  

    // 查询所有售卖机信息
    $sql = "SELECT * FROM machine";  
    $stmt = $pdo->prepare($sql);
    $stmt->execute();  
    $machines = $stmt->fetchAll(PDO::FETCH_ASSOC);  
  
    echo json_encode(["machines" => $machines]); // 使用一个数组来包装结果，这样返回的数据结构更清晰  
} catch (PDOException $e) {  
    // 输出一般错误信息  
    echo json_encode(["error" => "添加失败，请稍后再试"]);  
}  
?>

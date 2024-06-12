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

if (!isset($_POST['vendingMachineId']) || !isset($_POST['drinkId']) || !isset($_POST['name']) || !isset($_POST['price']) || !isset($_POST['shelfLife']) || !isset($_POST['productionDate'])) {
    echo json_encode(["error" => "缺少参数"]);
    exit();
}

$vendingMachineId = $_POST['vendingMachineId'];
$drinkId = $_POST['drinkId'];
$name = $_POST['name'];
$price = $_POST['price'];
$shelfLife = $_POST['shelfLife'];
$productionDate = $_POST['productionDate'];

try {
    // 检查饮料是否已经存在
    $sql = "SELECT * FROM drink WHERE dID = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$drinkId]);
    $drink = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($drink) {
        try {
            $sql = "INSERT INTO includes (dID, vID, inventory) VALUES (?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$drinkId, $vendingMachineId, 0]); // 假设初始库存为0，可以根据需要调整
        } catch (PDOException $e) {
            if ($e->errorInfo[1] == 1062) {
                // 处理唯一约束违例错误
                echo "记录已存在，不允许重复插入相同的dID和vID。";
            } else {
                // 处理其他类型的数据库错误
                throw $e;
            }
        }       
    } else {
        // 如果饮料不存在，先在drink表中插入数据
        $sql = "INSERT INTO drink (dID, name, price, Shelf_life, `Production-date`) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$drinkId, $name, $price, $shelfLife, $productionDate]);

        // 然后在includes表中插入数据
        $sql = "INSERT INTO includes (dID, vID, inventory) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$drinkId, $vendingMachineId, 0]); // 假设初始库存为0，可以根据需要调整
    }

    echo json_encode(["success" => "饮料添加成功"]);
} catch (PDOException $e) {
    echo json_encode(["error" => "添加失败，请稍后再试"]);
}
?>

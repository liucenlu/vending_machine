<?php
// PHP 代码
// 获取到 $name, $account, $balance 等变量的值
// 启动会话
session_start();
// 包含数据库连接文件
require 'database.php';

// 获取用户名
$uid = isset($_GET["tn"]) ? $_GET["tn"] : null;

// 验证用户名
if (empty($uid)) {
    die("用户名未提供或无效。");
}

try {
    // 使用预处理语句查询用户信息
    $stmt = $pdo->prepare("SELECT name, username, balance FROM users WHERE username = ?");
    $stmt->execute([$uid]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // 检查是否找到用户
    if (!$user) {
        die("找不到用户。");
    }

    // 从查询结果中获取用户信息
    $name = $user['name'];
    $account = $user['username'];
    $balance = $user['balance'];
    //设置会话变量 
    $_SESSION['balance'] = $balance;
  }
    catch (PDOException $e) {
      die("查询失败: " . $e->getMessage());
  }
// 设置样式
?>
<style>  
/* CSS 样式 */ 
td {
  padding: 15px;
}
.tableform {  
  display: flex;  
  justify-content: center;  
  align-items: center;   
  margin-left: 400px; 
  font-size: 30px;   
}
.basic_box { 
  border: 1px solid #ccc;
  border-radius: 15px;
  width: 500px;
  padding: 50px;
  box-shadow: 0 10px 20px rgba(0,0,0,0.19);
} 
.nice-button {  
  margin-left:400px;
  margin-top:50px;
  /* 布局和尺寸 */  
  display: inline-block;  
  padding: 10px 20px; /* 内边距，增加点击区域 */  
  font-size: 16px; /* 字体大小 */ 
  line-height: 1.5; /* 行高，保持文本垂直居中 */  
    
  /* 边框和背景 */  
  border-color: #333; /* 去除默认边框 */  
  border-radius: 4px; /* 圆角 */  
  background-color: #fff; /* 背景颜色 */  
  color: #333; /* 文本颜色 */  
    
  /* 鼠标悬停效果 */  
  &:hover {  
    background-color: rgba(231, 198, 189); /* 悬停时背景颜色 */  
      cursor: pointer; /* 鼠标指针变为小手 */  
  }   
}
</style>  
<div class="tableform">  
  <table class="basic_box">  
    <tr>  
      <td colspan="2"><p style="font-size: 38px; text-align: center;"><b>信息卡片</b></p></td>  
    </tr>  
    <tr>  
      <td><b>姓名: </b></td>  
      <td><?php echo htmlspecialchars($name); ?><br></td>  
    </tr>  
    <tr>  
      <td><b>账号: </b></td>  
      <td><?php echo htmlspecialchars($account); ?><br></td>
    </tr>  
    <tr>  
      <td><b>余额: </b></td>  
      <td><?php echo htmlspecialchars($balance); ?> 元<br></td>  
    </tr>  
  </table>  
</div>
<div>
<button class="nice-button" onclick="checkHistory()">查询购买记录</button>
<button class="nice-button recharge" onclick="rechargeFunction()">充值</button>
<input type="number" id="amount" placeholder="请输入充值金额" required>
</div>
<div id="orders"></div>

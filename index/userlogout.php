<?php  
// 开始会话  
session_start();  
  
// 销毁会话  
session_destroy();  
  
// 清除所有会话变量 
$_SESSION = array();  
$identity = isset($_GET["gn"]) ? $_GET["gn"] : null;  
  
//可以设置一个消息告诉用户他们已经注销  
$logoutMessage = "您已成功退出系统。";  


if($identity === "user"){
    // 重定向用户到登录页面 
header("Location: ../index/userlogin.php?logout=" . urlencode($logoutMessage));  
exit; // 确保重定向后停止脚本执行 
} else{
    // 重定向管理员登录页面  
header("Location: ../index/adminlogin.php?logout=" . urlencode($logoutMessage));  
exit; 
}
?>
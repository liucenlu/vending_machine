<?php
session_start();
// 读取原文件的内容
$original_content = file_get_contents("dw.html");

// 要追加的内容，包括内联的 CSS
$additional_content = '
    <link href="../styles/login.css" rel="stylesheet" />
    <div class="container">
        <section id="content">
            <form action="../index/userlogincheck.php" method="post">
                <h1>用户登录</h1>
                <div>
                    <input type="text" placeholder="请输入你的学号" required="" id="username" name="text1" />
                </div>
                <div>
                    <input type="password" placeholder="密码" required="" id="password" name="password1" />
                </div>
                <div>
                    <input type="submit" value="登录" />
                    <a href="forgotpassword.php">忘记密码</a>
                    <a href="changesec.php">Update Security.</a>  
                </div>
            </form>
        </section>
    </div>
';

// 找到特定位置（例如 </header> 标记后）并插入追加的内容
$position = strpos($original_content, '</header>');
if ($position !== false) {
    $modified_content = substr_replace($original_content, $additional_content, $position + strlen('</header>'), 0);
    
    // 将修改后的内容输出到浏览器
    echo $modified_content;
} else {
    echo "特定位置未找到，无法插入内容。";
}
?>

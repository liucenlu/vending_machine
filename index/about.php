<?php
// 读取原文件的内容
$original_content = file_get_contents("dw.html");

// 要追加的内容，包括内联的 CSS
$additional_content = '
    <style>
    .pabout{
        text-align: center;
        margin-top: 50px;
        font-family:STSong;
    }
    .ullist {
        list-style-type: none;
        padding-left: 0; /* 可选，用于去除默认的左侧缩进 */
        font: size 30px;
    }   
    </style>
    <div class="pabout">
    <h2>自动售卖机管理系统主要实现以下功能：</h2>
    <ul class="ullist">
        <li>1.管理员通过计算机管理分布在学校各处的售卖机，调整<br>饮品结构，增加饮品库存，适应师生需求。</li>
        <li>2.管理员对师生的需求情况能做好全面掌握，及时获取历史销售记录。</li>
        <li>3.管理员根据历史销售记录及时进行补货，<br>实现对饮品的销售管理。</li>
        <li>4.用户可以通过清晰的可视化界面购买到想要的饮料，方便快捷。</li>
    </ul>
    </div>
';

// 找到特定位置（例如 </header> 标记后）并插入追加的内容
$position = strpos($original_content, '</header>');
if ($position !== false) {
    $modified_content = substr_replace($original_content, $additional_content, $position + strlen('<section>'), 0);
    // 将修改后的内容输出到浏览器
    echo $modified_content;
} else {
    echo "特定位置未找到，无法插入内容。";
}
?>

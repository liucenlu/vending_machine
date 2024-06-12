<?php
// 读取原文件的内容
$original_content = file_get_contents("dw.html");

// 要追加的内容，包括内联的 CSS
$additional_content = '
    <style>
    .pabout{
        text-align: center;
        margin-top: 30px;
        font-family:STSong;
    } 
    .ullist {
        list-style-type: none;
        padding-left: 0; 
    }  
    .ullist li{
        margin-top:10px;
        font-size:30px;
    } 
    </style>
    <div class="pabout">
    <i class="fa-solid fa-phone"><span style="font-size:40px;">请拨打以下电话：</span></i>
    <ul class="ullist">
        <li>李工：19056892058</li>
        <li>赵工：18896752486</li>
        <li>王工：15569827543</li>
        <li>孙工：13825934567</li>
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

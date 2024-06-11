<?php
session_start(); // 启动会话 
?>

    <style>
    .all {
        font-family: Arial, sans-serif; /* 设置全局字体 */
        margin: 0; /* 去除页面默认的边距 */
        padding: 0; /* 去除页面默认的内边距 */
        background-color: #ffffff; /* 设置背景颜色 */
    }
    #drinkContainer {
        width: 100%;  
    height: 100%;  
    margin: 0;  
    padding: 0; /* 如果需要的话，设置内部间距 */  
    box-sizing: border-box; /* 确保padding和border不会增加容器的总尺寸 */ 
    }
label{
    margin-left:400px;
    font-size:25px;
}
    #vendingMachine {
        font-size: 16px; /* 设置下拉菜单的字体大小 */
        padding: 8px; /* 增加下拉菜单的内边距 */
        margin-bottom: 20px; /* 增加下拉菜单与其他内容的间距 */
    }

    .drink {
    display: inline-block;
    margin: 10px;
    text-align: center;
    background-color: rgba(231, 198, 189, 0.3);  /* 设置饮料容器的背景颜色 */
    padding: 20px; /* 增加饮料容器的内边距 */
    border-radius: 5px; /* 设置饮料容器的边框圆角 */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* 增加饮料容器的阴影效果 */
    width: 160px; /* 设置容器的宽度 */
    height: 220px; /* 设置容器的高度 */
    vertical-align: top; /* 将容器垂直对齐到顶部 */
}
    .drink img {
        width: 100px;
        height: 100px;
        border-radius: 50%; /* 设置饮料图片的圆角 */
    }
    table{
        margin-left:200px;
    }
    button{  
        font-size: 1rem; 
        line-height: 1.5;
        background-color: #fff; /* 背景颜色 */  
        color: #333; /* 文本颜色 */  
    
  /* 鼠标悬停效果 */  
    &:hover {  
        background-color: rgba(231, 198, 189); /* 悬停时背景颜色 */  
        cursor: pointer; /* 鼠标指针变为小手 */  
    } 
    }
</style>
<div class="all">
<label for="vendingMachine">请选择售卖机位置</label>
<select id="vendingMachine" name="vendingMachine" onchange="fetchDrinks()">
        <option value="">Select a machine</option>
</select>
<div id="drinkContainer"></div>
</div>
<div id="orderInfoContainer" style="display: none;width: 100%; margin: 0 auto;">
<h2 style="margin:10px 0 0 200px;">感谢购买</h2>
<p style="margin:6px 0 6px 200px;">以下是您的订单信息，请查阅</p>
<table width="100%" border="1" style="border-collapse: collapse; margin-left:200px; font-family: Arial, sans-serif;">  
    <tbody>  
        <tr>  
            <th colspan="2" style="background-color: #333; color: #fff; padding: 10px; text-align: center;"><span id="header1">标题</span></th>  
        </tr>  
        <tr>  
            <td style="padding: 8px; border: 1px solid #ddd; text-align: center;"><span id="cell1-1">价格</span></td>  
            <td style="padding: 8px; border: 1px solid #ddd; text-align: center;"><span id="cell1-2"></span></td>  
            <tr>
                <td style="padding: 8px; border: 1px solid #ddd; text-align: center;"><span id="cell2-1">保质期</span></td>
                <td style="padding: 8px; border: 1px solid #ddd; text-align: center;"><span id="cell2-2"></span></td>
            </tr>
            <tr>
                <td style="padding: 8px; border: 1px solid #ddd; text-align: center;"><span id="cell3-1">订单号</span></td>
                <td style="padding: 8px; border: 1px solid #ddd; text-align: center;"><span id="cell3-2"></span></td>
            </tr>
            <tr>
                <td style="padding: 8px; border: 1px solid #ddd; text-align: center;"><span id="cell4-1">下单时间</span></td>
                <td style="padding: 8px; border: 1px solid #ddd; text-align: center;"><span id="cell4-2"></span></td>
            </tr>
            <tr>
                <td style="padding: 8px; border: 1px solid #ddd; text-align: center;"><span id="cell5-1">购买数量</span></td>
                <td style="padding: 8px; border: 1px solid #ddd; text-align: center;"><span id="cell5-2"></span></td>
            </tr>
            <tr>
                <td style="padding: 8px; border: 1px solid #ddd; text-align: center;"><span id="cell6-1">订单总额</span></td>
                <td style="padding: 8px; border: 1px solid #ddd; text-align: center;"><span id="cell6-2"></span></td>
            </tr>
        </tbody>
    </table>
</div>



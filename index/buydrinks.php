<?php
session_start(); // 启动会话 
?>

    <style>
    .all {
        font-family: Arial, sans-serif; 
        margin: 0; 
        padding: 0; 
        background-color: #ffffff; 
    }
    #drinkContainer {
        width: 100%;  
    height: 100%;  
    margin: 0;  
    padding: 0; 
    box-sizing: border-box;
    }
label{
    margin-left:400px;
    font-size:25px;
}
    #vendingMachine {
        font-size: 16px; 
        padding: 8px;
        margin-bottom: 20px; 
    }

    .drink {
    display: inline-block;
    margin: 10px;
    text-align: center;
    background-color: rgba(231, 198, 189, 0.3); 
    padding: 20px; 
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); 
    width: 160px; 
    height: 220px;
    vertical-align: top; 
}
    .drink img {
        width: 100px;
        height: 100px;
        border-radius: 50%; 
    }
    table{
        margin-left:200px;
    }
    button{  
        font-size: 1rem; 
        line-height: 1.5;
        background-color: #fff; 
        color: #333; 
    &:hover {  
        background-color: rgba(231, 198, 189);  
        cursor: pointer;  
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



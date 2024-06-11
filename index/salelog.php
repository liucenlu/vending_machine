<?php
// salelog.php
session_start();
?>
<style>
    #drinkSalesChart, #machineSalesChart{
        height:80vh;
        width:auto;
        margin-left:30px;
    }
</style>
<div class="chart-container">
    <canvas id="drinkSalesChart"></canvas>
    <canvas id="machineSalesChart"></canvas>
</div>
<div id=salesContainer></div>
<script>
    fetchSales(); // 调用 fetchSales 函数加载统计数据
</script>

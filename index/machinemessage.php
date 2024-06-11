    <style>
        #machineContainer{
            width:1500px;
        }
        .machine {
            padding-left: 30px;
            padding-top:10px;
            padding-bottom:10px;
            margin:50px 0 10px 40px;
            width:95%;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
}

.machine:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.machine p {
    margin: 5px 0;
}

.machine p:first-child {
    font-size: 18px;
    font-weight: bold;
    color: #333;
}

.machine p:nth-child(2) {
    color: #666;
}

.machine p:last-child {
    color: #999;
}

.machine-wrapper {
    display: flex;
    align-items: center; /* 垂直居中 */
}

.machine-info {
    flex: 1; /* 平均分配剩余空间 */
}

.machine-detail {
    flex: none; /* 不拉伸 */
}
.machine-detail button {
    margin-right: 30px;
    background-color: #fff;
    border: 2px solid #333; /* 添加边框 */
    border-radius: 5px; /* 圆角 */
    padding: 10px 20px; /* 调整内边距 */
    font-size: 16px; /* 调整字体大小 */
    font-weight: bold; /* 加粗字体 */
    color: #333; /* 文字颜色 */
    transition: background-color 0.3s, color 0.3s, border-color 0.3s; /* 添加过渡效果 */
}

.machine-detail button:hover {
    background-color: #333; /* 悬停时背景色变暗 */
    color: #fff; /* 文字颜色变亮 */
    border-color: #333; /* 边框颜色变暗 */
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
    #addmachineContainer{
        width:95%;
        height:50px;
        margin:50px 0 10px 40px;
        padding-left: 30px;
        padding-top:10px;
        padding-bottom:10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f9f9f9;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        text-align: center;
    }
    #addmachineContainer i{
        display: inline-block;
        transform: scale(2);
    }
    .add{  
    /* 移除背景色和边框 */  
    background-color: transparent;  
    border: none;  
      
    /* 移除内边距和外边距（如果需要） */  
    padding: 0;  
    margin: 0;  
      
    /* 如果需要，可以添加自定义样式 */  
    cursor: pointer; /* 鼠标悬停时变为手形图标 */  
    color: inherit; /* 继承父元素的文字颜色 */  
    /* ...其他样式... */  
}
.adddrink{
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
.adddrink i{
        display: inline-block;
        transform: scale(4);
        margin-top:60px;
    }
    </style>
    <script src="../scripts/adminview.js"></script>
<body>
    <div id="machineContainer"></div>
    <div id="addmachineContainer">
        <button class="add" onclick="showPrompt()"><i class="fa-solid fa-plus"></i></button>
    </div>
    <div id="drinkContainer"></div>
    <script>
        fetchMachines();
    </script>
</body>


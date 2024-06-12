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
    align-items: center; 
}

.machine-info {
    flex: 1; 
}

.machine-detail {
    flex: none; 
}
.machine-detail button {
    margin-right: 30px;
    background-color: #fff;
    border: 2px solid #333; 
    border-radius: 5px; 
    padding: 10px 20px;
    font-size: 16px;
    font-weight: bold; 
    color: #333;
    transition: background-color 0.3s, color 0.3s, border-color 0.3s; 
}

.machine-detail button:hover {
    background-color: #333; 
    color: #fff; 
    border-color: #333; 
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
    background-color: transparent;  
    border: none;  
      
    padding: 0;  
    margin: 0;  
      
    cursor: pointer; 
    color: inherit;  
}
.adddrink{
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


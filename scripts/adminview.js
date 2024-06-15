// machines.js
function fetchMachines() {
    // 使用 AJAX 调用 PHP 脚本    
    fetch('../index/getMachine.php')    
        .then(response => response.text()) 
        .then(text => {  // 修正括号位置
            console.log('Response text:', text);
            try {
                const data = JSON.parse(text);
                let machineContainer = document.getElementById('machineContainer');    
                machineContainer.innerHTML = ''; // 清空 div 内容

                // 如果返回的数据中包含错误信息
                if (data.error) {
                    // 在容器中显示错误信息
                    machineContainer.innerHTML = `<p>${data.error}</p>`;
                    return;
                }

                // 如果返回的数据包含售卖机信息
                if (data.machines && data.machines.length > 0) {
                    // 遍历售卖机信息并创建相应的 HTML 元素显示在页面上
                    data.machines.forEach(machine => {
                        const machineDiv = document.createElement('div');  
                        machineDiv.className = 'machine';  
                        machineDiv.innerHTML = `  
                            <div class="machine-wrapper">
                                <div class="machine-info">
                                    <p>${machine.vID}号售卖机</p>  
                                    <p>位置: ${machine.places}</p>  
                                    <p>总库存: ${machine.Total_inventory}</p>
                                </div>
                                <div class="machine-detail">
                                    <button onclick="showDetail('${machine.vID}')">详情</button>
                                </div>
                            </div>
                        `;  
                        machineContainer.appendChild(machineDiv); 
                    });
                } else {
                    // 如果没有售卖机信息可用，显示相应消息
                    machineContainer.innerHTML = '<p>No machines available.</p>';
                }
            } catch (e) {
                // 如果解析 JSON 数据出错，显示相应错误消息并记录到控制台
                console.error('Error parsing JSON:', e);
                machineContainer.innerHTML = `<p>Error parsing JSON. Check the console for more details.</p>`;
            }             
        }).catch(error => {
            machineContainer.innerHTML = `<p>Error fetching machines: ${error.message}</p>`;
            console.error('Error fetching machines:', error);
        });
};
function showDetail(vendingMachine) {
    const addmachineContainer = document.getElementById('addmachineContainer');
    const machineContainer = document.getElementById('machineContainer');
    const drinkContainer = document.getElementById('drinkContainer');
    machineContainer.innerHTML = ''; 
    addmachineContainer.style.display = 'none';
    
    if (vendingMachine) {
        fetch(`getDrinks.php?vID=${vendingMachine}`)
            .then(response => response.json()) // 解析JSON格式的响应
            .then(data => {
                drinkContainer.innerHTML = ''; // 清空饮料容器

                if (data.error) {
                    drinkContainer.innerHTML = `<p>${data.error}</p>`;
                    return;
                }

                if (data.length > 0) {
                    data.forEach(drink => {
                        const drinkDiv = document.createElement('div');
                        drinkDiv.className = 'drink';
                        drinkDiv.innerHTML = `
                            <img src="../images/${drink.name}.jpg" alt="${drink.name}">
                            <p>${drink.name}</p>
                            <p>库存: ${drink.inventory}</p>
                            <button onclick="addDrink('${drink.dID}', '${vendingMachine}')">补货</button>
                        `;
                        drinkContainer.appendChild(drinkDiv);
                    });

                    // 添加按钮和模态框
                    const adddrinkDiv = document.createElement('div');
                    adddrinkDiv.className = 'adddrink';
                    adddrinkDiv.innerHTML = `
                        <button id="myBtn"><i class="fa-solid fa-plus" style="color: #66758f;"></i></button>
                        <div id="myModal" class="modal">
                            <div class="modal-content">
                                <span class="close">&times;</span>
                                <p>请输入以下信息:</p>
                                <label for="vendingMachineId">售卖机编号:</label>
                                <input type="text" id="vendingMachineId"><br><br>

                                <label for="drinkId">饮料编号:</label>
                                <input type="text" id="drinkId"><br><br>

                                <label for="name">名称:</label>
                                <input type="text" id="name"><br><br>

                                <label for="price">价格:</label>
                                <input type="text" id="price"><br><br>

                                <label for="shelfLife">保质期:</label>
                                <input type="text" id="shelfLife"><br><br>

                                <label for="productionDate">生产日期 (格式: YYYY-MM-DD):</label>
                                <input type="text" id="productionDate"><br><br>

                                <button id="submitBtn">添加</button>
                            </div>
                        </div>
                    `;
                    drinkContainer.appendChild(adddrinkDiv);

                    // 获取模态框元素
                    const modal = document.getElementById('myModal');
                    const modalBtn = document.getElementById('myBtn');
                    const closeBtn = document.getElementsByClassName('close')[0];

                    // 点击按钮打开模态框
                    modalBtn.onclick = function() {
                        modal.style.display = 'block';
                    }

                    // 点击关闭按钮关闭模态框
                    closeBtn.onclick = function() {
                        modal.style.display = 'none';
                    }

                    // 点击模态框外部区域关闭模态框
                    window.onclick = function(event) {
                        if (event.target == modal) {
                            modal.style.display = 'none';
                        }
                    }

                    // 处理表单提交
                    document.getElementById('submitBtn').addEventListener('click', function() {
                        let vendingMachineId = document.getElementById('vendingMachineId').value;
                        let drinkId = document.getElementById('drinkId').value;
                        let name = document.getElementById('name').value;
                        let price = document.getElementById('price').value;
                        let shelfLife = document.getElementById('shelfLife').value;
                        let productionDate = document.getElementById('productionDate').value;

                        addNewdrink(vendingMachineId, drinkId, name, price, shelfLife, productionDate);

                        // 关闭模态框
                        modal.style.display = 'none';
                    });

                } else {
                    // 如果没有饮料，则显示添加按钮
                    const adddrinkDiv = document.createElement('div');
                    adddrinkDiv.className = 'adddrink';
                    adddrinkDiv.innerHTML = `
                        <button id="myBtn"><i class="fa-solid fa-plus" style="color: #66758f;"></i></button>
                        <div id="myModal" class="modal">
                            <div class="modal-content">
                                <span class="close">&times;</span>
                                <p>请输入以下信息:</p>
                                <label for="vendingMachineId">售卖机编号:</label>
                                <input type="text" id="vendingMachineId"><br><br>

                                <label for="drinkId">饮料编号:</label>
                                <input type="text" id="drinkId"><br><br>

                                <label for="name">名称:</label>
                                <input type="text" id="name"><br><br>

                                <label for="price">价格:</label>
                                <input type="text" id="price"><br><br>

                                <label for="shelfLife">保质期:</label>
                                <input type="text" id="shelfLife"><br><br>

                                <label for="productionDate">生产日期 (格式: YYYY-MM-DD):</label>
                                <input type="text" id="productionDate"><br><br>

                                <button id="submitBtn">添加</button>
                            </div>
                        </div>
                    `;
                    drinkContainer.appendChild(adddrinkDiv);

                    // 获取模态框元素
                    const modal = document.getElementById('myModal');
                    const modalBtn = document.getElementById('myBtn');
                    const closeBtn = document.getElementsByClassName('close')[0];

                    // 点击按钮打开模态框
                    modalBtn.onclick = function() {
                        modal.style.display = 'block';
                    }

                    // 点击关闭按钮关闭模态框
                    closeBtn.onclick = function() {
                        modal.style.display = 'none';
                    }

                    // 点击模态框外部区域关闭模态框
                    window.onclick = function(event) {
                        if (event.target == modal) {
                            modal.style.display = 'none';
                        }
                    }

                    // 处理表单提交
                    document.getElementById('submitBtn').addEventListener('click', function() {
                        let vendingMachineId = document.getElementById('vendingMachineId').value;
                        let drinkId = document.getElementById('drinkId').value;
                        let name = document.getElementById('name').value;
                        let price = document.getElementById('price').value;
                        let shelfLife = document.getElementById('shelfLife').value;
                        let productionDate = document.getElementById('productionDate').value;

                        addNewdrink(vendingMachineId, drinkId, name, price, shelfLife, productionDate);

                        // 关闭模态框
                        modal.style.display = 'none';
                    });
                }
            })
            .catch(error => {
                drinkContainer.innerHTML = `<p>Error fetching drinks: ${error.message}</p>`;
                console.error('Error fetching drinks:', error);
            });
    } else {
        drinkContainer.innerHTML = '';
    }
}
function addDrink(dID, vendingMachine) {
    // 弹出提示框，让用户输入补货数量
    const quantity = prompt('请输入补货数量：', '1');

    // 检查用户是否点击了取消按钮或输入了空值
    if (quantity === null || quantity.trim() === '') {
        alert('补货已取消。');
        return;
    }

    // 发送 AJAX 请求到 addDrinks.php
    fetch(`addDrinks.php?dID=${dID}&quantity=${quantity}&vendingMachine=${vendingMachine}`)
        .then(response => response.json())
        .then(data => {
            // 检查是否成功补货
            if (data.success) {
                // 补货成功，弹出成功提示信息
                alert('补货成功！');
            } else {
                // 补货失败，弹出错误提示信息
                alert('补货失败，请稍后重试。');
            }
        })
        .catch(error => {
            console.error('Error adding drinks:', error);
            alert('补货失败，请稍后重试。');
        });
}
function fetchSales() {
    console.log('fetchSales function called');
    fetch('../index/getsales.php')
        .then(response => {
            console.log('Fetch response received:', response);
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log('Received Data:', data);
            
            // // 获取页面上的容器元素
            // let salesContainer = document.getElementById('salesContainer');
            // salesContainer.innerHTML = ''; // 清空容器内容

            // // 创建饮料销售数据的 HTML 内容
             if (data.drinks && data.drinks.length > 0) {

                const drinkLabels = data.drinks.map(drink => drink.name);
                const drinkSalesData = data.drinks.map(drink => drink.total_sales);
                createChart('drinkSalesChart', 'Drink Sales', drinkLabels, drinkSalesData);
            } else {
                salesContainer.innerHTML += '<p>No drink sales data available.</p>';
            }

            // 创建售卖机销售数据的 HTML 内容
            if (data.machines && data.machines.length > 0) {
                const machineLabels = data.machines.map(machine => machine.vID);
                const machineSalesData = data.machines.map(machine => machine.total_sales);
                createChart('machineSalesChart', 'Machine Sales', machineLabels, machineSalesData);
            } else {
                salesContainer.innerHTML += '<p>No machine sales data available.</p>';
            }
        })
        .catch(error => {
            let salesContainer = document.getElementById('salesContainer');
            salesContainer.innerHTML = `<p>Error fetching sales data: ${error.message}</p>`;
            console.error('Error fetching data:', error);
        });
}

function createChart(canvasId, chartTitle, labels, data) {
    const ctx = document.getElementById(canvasId).getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: chartTitle,
                data: data,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}
function showPrompt() {
    let machineId = prompt("请输入售卖机编号:");
    if (machineId === null) return;  // 用户点击取消

    let location = prompt("请输入位置:");
    if (location === null) return;

    let inventory = prompt("请输入库存:");
    if (inventory === null) return;

    addMachine(machineId, location, inventory);
}

function addMachine(machineId, location, inventory) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "addMachine.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            alert("售卖机添加成功!");
        } else if (xhr.readyState === 4) {
            alert("添加失败: " + xhr.status);
        }
    };

    const data = `machineId=${encodeURIComponent(machineId)}&location=${encodeURIComponent(location)}&inventory=${encodeURIComponent(inventory)}`;
    xhr.send(data);
}

function addNewdrink(vendingMachineId, drinkId, name, price, shelfLife, productionDate) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "addNewdrink.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                // 处理服务器响应
                const responseText = xhr.responseText;
                if (responseText.includes("记录已存在")) {
                    alert("该饮料已存在，不允许重复添加");
                } else {
                    try {
                        const response = JSON.parse(responseText);
                        if (response.error) {
                            alert("错误: " + response.error);
                        } else {
                            alert("饮料添加成功!");
                        }
                    } catch (error) {
                        alert("处理响应时出错: " + error.message);
                    }
                }
            } else {
                alert("添加失败: " + xhr.status);
            }
        }
    };

    const data = `vendingMachineId=${encodeURIComponent(vendingMachineId)}&drinkId=${encodeURIComponent(drinkId)}&name=${encodeURIComponent(name)}&price=${encodeURIComponent(price)}&shelfLife=${encodeURIComponent(shelfLife)}&productionDate=${encodeURIComponent(productionDate)}`;
    xhr.send(data);
}

function fetchDrinks() {
    const vendingMachine = document.getElementById('vendingMachine').value;
    const drinkContainer = document.getElementById('drinkContainer');

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
                            <p>价格: ¥${drink.price}</p>
                            <p>库存: ${drink.inventory}</p>
                            <button onclick="showOrderForm('${drink.name}', ${drink.price}, '${drink.Shelf_life}', '${drink.dID}', '${vendingMachine}')">下单</button>
                        `;
                        drinkContainer.appendChild(drinkDiv);
                    });
                } else {
                    drinkContainer.innerHTML = '<p>No drinks available for this vending machine.</p>';
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
function showQuantityModal(name, price, shelfLife, dID, vendingMachine) {
    $('#quantityModal').modal('show');

    // 提交数量表单
    $('#quantityForm').submit(function(event) {
        event.preventDefault();
        const quantity = $('#quantityInput').val();
        $('#quantityModal').modal('hide');
        showOrderDetailModal(name, price, shelfLife, dID, vendingMachine, quantity);
    });
}

// 显示订单详情模态框
function showOrderDetailModal(name, price, shelfLife, dID, vendingMachine, quantity) {
    const orderInfo = `
        <p>饮料名: ${name}</p>
        <p>价格: ¥${price}</p>
        <p>保质期: ${shelfLife}</p>
        <p>订单编号: 此处为服务器返回的订单编号</p>
        <p>下单时间: 此处为服务器返回的下单时间</p>
        <p>购买数量: ${quantity}</p>
    `;
    $('#orderDetailContent').html(orderInfo);
    $('#orderDetailModal').modal('show');
}
// 显示订单表单
function showOrderForm(name, price, shelfLife, dID, vendingMachine) {
    const drinkContainer = document.getElementById('drinkContainer');
    drinkContainer.innerHTML = ''; // 清空现有内容

    const form = document.createElement('form');
    
    form.addEventListener('submit', function(event) {
        event.preventDefault(); 
        submitOrder(form, name, price, shelfLife, dID, vendingMachine); 
    });

    const quantityInput = document.createElement('input');
    quantityInput.type = 'number';
    quantityInput.name = 'quantity';
    quantityInput.placeholder = '购买数量';
    quantityInput.required = true;

    const confirmButton = document.createElement('button');
    confirmButton.type = 'submit';
    confirmButton.textContent = '确认订单';
    
    form.style.margin = "10px 0 10px 500px";
    form.appendChild(quantityInput);
    form.appendChild(confirmButton);

    // 创建一个隐藏的input元素用于存储饮品编号dID
    const dIDInput = document.createElement('input');
    dIDInput.type = 'hidden';
    dIDInput.name = 'dID';
    dIDInput.value = dID;
    form.appendChild(dIDInput);

    // 创建一个隐藏的input元素用于存储售卖机编号vID
    const vIDInput = document.createElement('input');
    vIDInput.type = 'hidden';
    vIDInput.name = 'vID';
    vIDInput.value = vendingMachine;
    form.appendChild(vIDInput);

    drinkContainer.appendChild(form);
}

// 提交订单
// 提交订单
function submitOrder(form, name, price, shelfLife, dID, vendingMachine) {
    const quantity = form.querySelector('input[name="quantity"]').value;

    const order = {
        name: name,
        price: price,
        shelfLife: shelfLife,
        quantity: quantity,
        dID: dID, // 饮品编号
        vID: vendingMachine, // 售卖机编号
    };

    fetch('submitOrder.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(order),
    })
    .then(response => response.json())
    .then(data => {
        if (data.error) {
            alert(data.error); // 显示服务器返回的错误消息
        } else {
            // 渲染订单信息到表格中
            const orderInfoContainer = document.getElementById('orderInfoContainer');
            orderInfoContainer.style.display = 'block';
            document.getElementById('header1').textContent = data.drink;
            document.getElementById('cell1-2').textContent = `¥${data.price}`;
            document.getElementById('cell2-2').textContent = data.shelfLife;
            document.getElementById('cell3-2').textContent = data.o_id;
            document.getElementById('cell4-2').textContent = data.time;
            document.getElementById('cell5-2').textContent = data.quantity;
            document.getElementById('cell6-2').textContent = `¥${data.total}`;
        }
    })
    .catch(error => {
        console.error('Error submitting order:', error);
        alert('Error submitting order. Please try again later.');
    });
}

//充值
function rechargeFunction() {  
    // 获取充值金额
    var amount = document.getElementById('amount').value;
    
    if (!amount || amount <= 0) {
        alert('请输入有效的充值金额');
        return;
    }
    
    // 发送POST请求到recharge.php
    fetch('recharge.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ money: parseFloat(amount) })
    })
    .then(response => response.json())
    .then(data => {
        if (data.error) {
            alert('充值失败: ' + data.error);
        } else {
            alert('充值成功，新的余额为: ' + data.newBalance);
        }
    })
    .catch(error => {
        alert('请求失败: ' + error.message);
    });
}
//查询记录
let currentPage = 1;
const recordsPerPage = 4;
let ordersData = [];

function checkHistory() {
    fetch('gethistory.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.error) {
            alert('错误: ' + data.error);
        } else {
            ordersData = data;
            currentPage = 1;
            renderTable();
        }
    })
    .catch(error => {
        alert('请求失败: ' + error.message);
    });
}

function renderTable() {
    const ordersDiv = document.getElementById('orders');
    ordersDiv.innerHTML = '';

    // 创建表格
    const table = document.createElement('table');
    table.style.width = '100%';
    table.border = '1';
    table.style.margin = '20px 0 10px 200px';

    // 创建表头
    const header = table.createTHead();
    const headerRow = header.insertRow(0);
    header.style.backgroundColor='#333';
    header.style.color='#fff';

    const headers = ['订单编号', '消费者', '购买数量', '时间'];
    headers.forEach(headerText => {
        const cell = headerRow.insertCell();
        cell.textContent = headerText;
    });

    // 创建表体
    const body = table.createTBody();

    // 计算当前页的数据
    const startIndex = (currentPage - 1) * recordsPerPage;
    const endIndex = Math.min(startIndex + recordsPerPage, ordersData.length);
    const pageData = ordersData.slice(startIndex, endIndex);

    // 填充表格内容
    pageData.forEach(order => {
        const row = body.insertRow();
        
        Object.values(order).forEach(value => {
            const cell = row.insertCell();
            cell.textContent = value;
        });
    });

    ordersDiv.appendChild(table);

    // 添加分页控件
    const paginationDiv = document.createElement('div');
    paginationDiv.style.marginLeft = '1100px';

    const prevButton = document.createElement('button');
    prevButton.textContent = '上一页';
    prevButton.disabled = currentPage === 1;
    prevButton.addEventListener('click', () => {
        currentPage--;
        renderTable();
    });

    const nextButton = document.createElement('button');
    nextButton.textContent = '下一页';
    nextButton.disabled = endIndex >= ordersData.length;
    nextButton.addEventListener('click', () => {
        currentPage++;
        renderTable();
    });

    paginationDiv.appendChild(prevButton);
    paginationDiv.appendChild(nextButton);

    ordersDiv.appendChild(paginationDiv);
}
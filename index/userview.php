<?php
// 启动会话
session_start();
?>
<!DOCTYPE html>
<html lang="zh">
  <head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../styles/userview.css" />
    <link rel="icon" href="../images/饮料图标.jpg" type="image/png">
    <title>User_View_Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/67183b7a94.js" crossorigin="anonymous"></script>
  </head>
  <body>
    <header><br /><i class="fas fa-wine-bottle" > <span styles="font-family:Impact;"> SZTU 自动售卖机在线系统</span></i></header><br />
    <div class="container">
      <div class="left">
        <nav id="navbar">
          <ul>
          <li>  
              <a href="../index/welcome.php?tn=<?php echo urlencode(htmlspecialchars($_GET['tn'], ENT_QUOTES, 'UTF-8')); ?>&gn=<?php echo urlencode(htmlspecialchars($_GET['gn'], ENT_QUOTES, 'UTF-8')); ?>" class="nav-link">首页</a>  
              <br />  
          </li>
            <li>
              <a href="../index/buydrinks.php?tn=<?php echo htmlspecialchars($_GET['tn'], ENT_QUOTES, 'UTF-8'); ?>" class="nav-link buy-drinks">购买饮料</a>
              <br />
            </li>
            <li>
              <a href="../index/personalmessage.php?tn=<?php echo htmlspecialchars($_GET['tn'], ENT_QUOTES, 'UTF-8'); ?>" class="nav-link">个人信息</a>
              <br />
            </li>
            <li>
              <a href="../index/userlogout.php?gn=user" class="nav-link log_out">退出</a>
              <br />
            </li>
          </ul>
        </nav>
      </div>
      <div class="main-doc">
        <section class="main-section" id="introduction">

        </section>
      </div>
    </div>
    <script>
  document.addEventListener('DOMContentLoaded', function() {
    // 加载首页内容
    loadHomePage();

    // 获取所有导航链接
    var navLinks = document.querySelectorAll('.nav-link');

    // 为每个导航链接添加点击事件
    navLinks.forEach(function(link) {
        // 检查链接是否是退出按钮
        if (!link.classList.contains('log_out')) {
            link.addEventListener('click', function(event) {
                // 阻止默认的链接跳转行为
                event.preventDefault();
                
                // 获取被点击链接的目标地址
                var targetUrl = this.getAttribute('href');

                // 使用 AJAX 加载目标页面内容
                var xhr = new XMLHttpRequest();
                xhr.open('GET', targetUrl, true);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        // 将目标页面内容替换到当前页面的主内容区域
                        document.querySelector('.main-doc').innerHTML = xhr.responseText;
                    }
                };
                xhr.send();
            });
        }
    });

    // 获取购买饮料按钮
    var buyDrinksButton = document.querySelector('.buy-drinks');
    if (buyDrinksButton) {
        buyDrinksButton.addEventListener('click', function(event) {
            event.preventDefault();
            fetchMachines();
        });
    }
});

// 加载首页内容的函数
function loadHomePage() {
    var targetUrl = "../index/welcome.php?tn=<?php echo urlencode(htmlspecialchars($_GET['tn'], ENT_QUOTES, 'UTF-8')); ?>&gn=<?php echo urlencode(htmlspecialchars($_GET['gn'], ENT_QUOTES, 'UTF-8')); ?>";

    var xhr = new XMLHttpRequest();
    xhr.open('GET', targetUrl, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // 将目标页面内容替换到当前页面的主内容区域
            document.querySelector('.main-doc').innerHTML = xhr.responseText;
        }
    };
    xhr.send();
}

// 获取售卖机信息的函数
function fetchMachines() {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "selectMachine.php", true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            if (response.error) {
                alert("错误: " + response.error);
            } else {
                populateMachineOptions(response.machines);
            }
        }
    };
    xhr.send();
}

// 将售卖机信息填充到下拉菜单的函数
function populateMachineOptions(machines) {
    const select = document.getElementById('vendingMachine');
    select.innerHTML = '<option value="">Select a machine</option>';
    machines.forEach(machine => {
        const option = document.createElement('option');
        option.value = machine.vID;
        option.textContent = machine.places;
        select.appendChild(option);
    });
}
</script>
<script src="../scripts/bd.js"></script>
 </body>
</html>
<?php
// adminview.php
// 启动会话
session_start();
?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8" />
    <link rel="icon" href="../images/饮料图标.jpg" type="image/png">
    <link rel="stylesheet" href="../styles/adminview.css" />
    <title>Admin_View_Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/67183b7a94.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <header><br /><i class="fas fa-wine-bottle">SZTU 自动售卖机后台在线管理系统</i></header><br />
    <div class="container">
        <div class="left">
            <nav id="navbar">
                <ul>
                    <li>
                        <a href="../index/welcome.php?tn=<?php echo urlencode(htmlspecialchars($_GET['tn'], ENT_QUOTES, 'UTF-8')); ?>&gn=<?php echo urlencode(htmlspecialchars($_GET['gn'], ENT_QUOTES, 'UTF-8')); ?>" class="nav-link">首页</a><br />
                    </li>
                    <li>
                        <a href="../index/machinemessage.php?tn=<?php echo htmlspecialchars($_GET['tn'], ENT_QUOTES, 'UTF-8'); ?>" class="nav-link">售卖机管理</a><br />
                    </li>
                    <li><a href="../index/salelog.php?tn=<?php echo htmlspecialchars($_GET['tn'], ENT_QUOTES, 'UTF-8'); ?>" class="nav-link">销售统计</a><br /></li>
                    <li><a href="../index/userlogout.php?gn=admin" class="nav-link log_out">退出</a><br /></li>
                </ul>
            </nav>
        </div>
        <div class="main-doc" id="mainContent">
            <section class="main-section" id="introduction"></section>
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
                    if (xhr.readyState == 4) {
                        if (xhr.status == 200) {
                            // 将目标页面内容替换到当前页面的主内容区域
                            document.getElementById('mainContent').innerHTML = xhr.responseText;

                            // 手动执行嵌入的 <script> 标签
                            var scriptElements = document.getElementById('mainContent').getElementsByTagName('script');
                            for (var i = 0; i < scriptElements.length; i++) {
                                eval(scriptElements[i].innerText);
                            }
                        } else {
                            console.error('Error loading page:', xhr.status, xhr.statusText);
                            document.getElementById('mainContent').innerHTML = '<p>加载页面时出错，请稍后重试。</p>';
                        }
                    }
                };
                xhr.send();
            });
        }
    });
});

// 加载首页内容的函数
function loadHomePage() {
    var targetUrl = "../index/welcome.php?tn=<?php echo urlencode(htmlspecialchars($_GET['tn'], ENT_QUOTES, 'UTF-8')); ?>&gn=<?php echo urlencode(htmlspecialchars($_GET['gn'], ENT_QUOTES, 'UTF-8')); ?>";

    var xhr = new XMLHttpRequest();
    xhr.open('GET', targetUrl, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                // 将目标页面内容替换到当前页面的主内容区域
                document.getElementById('mainContent').innerHTML = xhr.responseText;
            } else {
                console.error('Error loading home page:', xhr.status, xhr.statusText);
                document.getElementById('mainContent').innerHTML = '<p>加载首页内容时出错，请稍后重试。</p>';
            }
        }
    };
    xhr.send();
}
    </script>
    <script src="../scripts/adminview.js"></script>

</body>
</html>

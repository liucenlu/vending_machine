$(document).ready(function() {  
    // 假设当前页面URL是可以通过某种方式获取的，这里只是模拟  
    var currentPage = window.location.pathname.split('/').pop().split('.')[0]; // 获取当前页面名（不包括扩展名）  
      
    // 移除所有active类  
    $('nav ul li a').removeClass('active');  
      
    // 根据当前页面给对应的链接添加active类  
    $('nav ul li a').each(function() {  
        var href = $(this).attr('href');  
        if (href.indexOf(currentPage) !== -1) { // 假设href与页面名直接相关，这里只是简单匹配  
            $(this).addClass('active');  
            return false; // 找到后退出循环  
        }  
    });  
      
    // 监听链接点击事件，并更新active类  
    $('nav ul li a').on('click', function(e) {  
        e.preventDefault(); // 阻止默认行为，即跳转  
        var href = $(this).attr('href');  
          
        // 移除所有active类  
        $('nav ul li a').removeClass('active');  
          
        // 给点击的链接添加active类  
        $(this).addClass('active');  
          
        // 模拟页面跳转（这里只是刷新页面，实际中你可能需要使用AJAX或其他方式）  
        window.location.href = href;  
    });  
});
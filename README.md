
# 饮料自动售卖机管理系统

涉及工具：

编辑器：VScode；前端开发：html，css，JavaScript；后端开发：php，mySQL

## 系统需求

本系统需满足以下需求：

1. 管理员通过计算机管理分布在学校各处的售卖机，调整饮品结构，增加饮品库存，适应师生需求。

2. 管理员对师生的需求情况能做好全面掌握，及时获取历史销售记录。

3. 管理员及时进行补货。

4. 对饮品的销售管理。

![image-20240611230833607](./%E9%A5%AE%E6%96%99%E8%87%AA%E5%8A%A8%E5%94%AE%E5%8D%96%E6%9C%BA%E7%AE%A1%E7%90%86%E7%B3%BB%E7%BB%9F.assets/image-20240611230833607-1718118519683-3.png)

## 基本功能

![image-20240611231656512](./%E9%A5%AE%E6%96%99%E8%87%AA%E5%8A%A8%E5%94%AE%E5%8D%96%E6%9C%BA%E7%AE%A1%E7%90%86%E7%B3%BB%E7%BB%9F.assets/image-20240611231656512-1718119026653-9-1718119028814-11.png)

## 数据库设计

<img width="931" alt="image" src="https://github.com/liucenlu/vending_machine/assets/121762292/761b50e1-22bc-4035-8fe5-44672676d538">

## 整体框架

![image-20240611231800068](./%E9%A5%AE%E6%96%99%E8%87%AA%E5%8A%A8%E5%94%AE%E5%8D%96%E6%9C%BA%E7%AE%A1%E7%90%86%E7%B3%BB%E7%BB%9F.assets/image-20240611231800068-1718119081296-13.png)

## 项目部署

1. 要配置此 Web 应用程序，请确保服务器上安装了 PHP 和 PHPMyAdmin。
2. 接下来打开PHPMyAdmin，导入位于database/的.sql文件。这将在服务器上的数据库中生成表。
3. 我创建的管理员用户有一个用户名 cen，账号是202212345，密码是 888888。（请在数据库中确认或手动创建一个。）
4. 打开index/database.php文件并添加 PHPMyAdmin 的 ID 和密码的详细信息以访问你的数据库。
5. 完成此操作后，转到您网站的 url（比如```http://localhost/vending_machine/index/dw.html```，系统应该已启动并运行。

## 操作演示

[操作演示视频](https://github.com/liucenlu/vending_machine/blob/main/%E6%93%8D%E4%BD%9C%E6%BC%94%E7%A4%BA.mp4)

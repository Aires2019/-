<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>企业销售系统</title>
 <link rel="stylesheet" href="../css/add.css">
 <style type="text/css">
 	body{background-image:url(../picture/bg1.jpeg);
	background-repeat:no-repeat;
	background-size:100%;}
 </style>
</head>

<body>
<?php
	session_start();
	if (!isset($_SESSION['username'])||$_SESSION['username']==null)
	{
		echo "<script>alert('请先登录！');window.location.href='../index.html';</script>";	
	}
	else
	{
		if(!isset($_SESSION['status'])||($_SESSION['status']==null))
		{
			echo "<script>alert('您没有权限！');history.go(-1);</script>";	
		}	
		else
		{
			require("../compoents/coon.php");	
			require("menu.html");	
			$warehouselist=array(1=>"1号仓库（桌子）",2=>"2号仓库（椅子）",3=>"3号仓库（沙发）",4=>"4号仓库（柜子）",5=>"其他");
		}	
	}
?>
 <h3>发布产品信息</h3>
 <div id="left">
   <form action="execaddproducts.php" method="post" enctype="multipart/form-data">
   <table>
    <tr>
            <th class="info"></th>
            <th class="input"></th>
        </tr>
        <tr>
            <td class="info">产品编号</td>
            <td class="input"><input type="text" name="productid" id="productid"></td>
        </tr>
        <tr>
            <td class="info">产品名</td>
            <td class="input"><input type="text" name="productname" id="productname"></td>
        </tr>
        <tr>
            <td class="info">放置仓库</td>
            <td class="input">
                <select name="warehouseid" id="warehouseid">
                <?php
                    foreach ($warehouselist as $k=>$v)
                    {
                        echo "<option value='$k'>$v</option>";
                    }
                ?>
                </select>

            </td>
        </tr>
        <tr>
            <td class="info">生产日期</td>
            <td class="input"><input type="date" name="prdate" id="prdate"></td>
        </tr>
        <tr>
            <td class="info">数量</td>
            <td class="input"><input type="text" name="number" id="number"></td>
        </tr>
        <tr>
            <td class="info">单价</td>
            <td class="input"><input type="text" name="price" id="price"></td>
        </tr>
        <tr>
            <td class="info">图片</td>
            <input type="hidden" name="MAX_FILE_SIZE" value="10000000000"/>
            <td class="input"><input type="file" name="filename" id="filename"/></td>
        </tr>
        <tr>
            <td></td>
            <td class="input">
               <input type="submit" value="添加" id="submit" onclick="mysubmit()">

            <input type="reset" value="重置" id="reset"></td>
        </tr>
        </table>
      </form>
    </div>
</body>
</html>
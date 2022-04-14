<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>企业销售管理系统</title>
<style type="text/css">
	table{
		width:75%;
		margin: 70px auto;
		border-collapse: collapse;/*让靠在一起的单元格只显示一个边框，边框不进行叠加*/
		}
			
	table tr th{
		border: solid 1px #000;
		height: 30px;
		width: 200px;
		background-color: #eee;
    }
			
    table tr td{
        border: solid 1px #000;
        height: 30px;
        text-align: center;
    }
    
    table tr:hover
    {
        background-color:#c0bcbc;/*hover:鼠标移上去就会变成红色*/
    }
    a{
        font-size:23px;
        text-decoration:none;
        color:white;
    }
    a:hover{color:orange}
</style>
<style type="text/css">
 	body{background-image:url(../picture/beihua.jpg);
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
			$orderid=$_GET['orderid'];
			$sql="select orders.orderid,usercart.userid, username,storage.productid,productname,ordernumber,tel,addr,orderdate,finishdate,storage.price
            from orders,orderinfo,storage,users,usercart
            where orders.orderid=$orderid and orders.orderid=usercart.orderid and orders.userid=users.userid 
            and orders.userid=usercart.userid and orders.orderid=orderinfo.orderid 
            and users.userid=usercart.userid and orderinfo.productid=storage.productid";
			$res=mysqli_query($link,$sql);
			$row=mysqli_fetch_assoc($res);
            echo "<h2 align='center'>用户订单详情如下</h2>";
            //print_r($row);
		}	
	}
?>

<table>
<tr><th>列名</th><th>详情</th></tr>
<tr><td>订单号</td><td><?php echo $row['orderid']?></td></tr>
<tr><td>客户号</td><td><?php echo $row['userid']?></td></tr>
<tr><td>客户名</td><td><?php echo $row['username']?></td></tr>
<tr><td>产品编号</td><td><?php echo $row['productid']?></td></tr>
<tr><td>产品名称</td><td><?php echo $row['productname']?></td></tr>
<tr><td>价格</td><td><?php echo $row['price']?></td></tr>
<tr><td>订购数量</td><td><?php echo $row['ordernumber']?></td></tr>
<tr><td>订购时间</td><td><?php echo $row['orderdate']?></td></tr>
<tr><td>完成时间</td><td><?php echo $row['finishdate']?></td></tr>
<tr><td>电话号码</td><td><?php echo $row['tel']?></td></tr>
<tr><td>配送地址</td><td><?php echo $row['addr']?></td></tr>
</table>
<div style="border: dashed 1px white;width:60px;">
<a href="elookuporders.php">返回</a>
</div>
</body>
</html>

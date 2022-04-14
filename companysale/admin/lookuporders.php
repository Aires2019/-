<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>企业销售管理系统</title>
<style type="text/css">
		table{
			width:75%;
				margin: 100px auto;
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
		a{text-decoration:none;}
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
			require("menu.html");
			$sql="
				select orders.orderid,usercart.userid, username,productname,ordernumber,tel,addr,orderdate 
				from orders,orderinfo,storage,users,usercart
				where orders.orderid=usercart.orderid and orders.userid=users.userid and orders.userid=usercart.userid and orders.orderid=orderinfo.orderid and users.userid=usercart.userid and orderinfo.productid=storage.productid
				ORDER BY orders.orderid
			";
			$res=mysqli_query($link,$sql);	
		}
	}
?>
<table>
<tr>
<th>订单号</th>
<th>用户名</th>
<th>产品名</th>
<th>下单数量</th>
<th>下单时间</th>
<th>联系电话</th>
<th>收货地址</th>
<th>&nbsp;</th>
<th>&nbsp;</th>
</tr>
<?php
	while($row=mysqli_fetch_assoc($res))
	{
		echo "
			<tr>
				<td>{$row['orderid']}</td>
				<td>{$row['username']}</td>
				<td>{$row['productname']}</td>
				<td>{$row['ordernumber']}</td>
				<td>{$row['orderdate']}</td>
				<td>{$row['tel']}</td>
				<td>{$row['addr']}</td>
				<td><a href='lookupordersinfo.php?orderid={$row['orderid']}'>详情</a></td>
				<td><a href='deleteorders.php?orderid={$row['orderid']}'>删除</a></td>
			</tr>
		";	
	}
?>
</table>
</body>
</html>
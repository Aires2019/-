<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>用户管理</title>	
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
 	body{background-image:url(../picture/bg8.jpeg);
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
			$res=mysqli_query($link,"select * from employees");	
		}	
	}
?>
<table>
<tr>
<th>员工名</th>
<th>密码</th>
<th>性别</th>
<th>联系方式</th>
<th>地址</th>
<th>入职时间</th>
<th>&nbsp;</th>
<th>&nbsp;</th>
</tr>
<?php
	while($row=mysqli_fetch_assoc($res))
	{
		echo "
			<tr>
				<td>{$row['employeename']}</td>
				<td>{$row['password']}</td>
				<td>{$row['sex']}</td>
				<td>{$row['tel']}</td>
				<td>{$row['addr']}</td>
                <td>{$row['empdate']}</td>
				<td><a href='deleteemp.php?employeeid={$row['employeeid']}'>删除</a></td>
				<td><a href='updateemp.php?employeeid={$row['employeeid']}'>修改</a></td>
			</tr>
		";
	}
?>
</table>
</body>
</html>
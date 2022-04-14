<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>产品销售情况</title>
<style type="text/css">
		table{
				width:60%;
				margin: 50px auto;
				border-collapse: collapse;/*让靠在一起的单元格只显示一个边框，边框不进行叠加*/
			}
			
			table tr th{
				font-size:20px;
				border: solid 1px #000;
				height: 30px;
				width: 200px;
				background-color: #eee;
			}
			
			table tr td{
				font-size:20px;
				border: solid 1px #000;
				height: 30px;
				text-align: center;
			}
			
			table tr:hover
			{
				background-color:#c0bcbc;/*hover:鼠标移上去就会变成红色*/
			}
</style>
<style type="text/css">
 	body{background-image:url(../picture/bg2.jpeg);
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
			$sql="SELECT employeeid,employeename,sum(actualtotal) total,sum(totalnumber) totalnumber
            FROM sale,employees
            WHERE employeeid=casherid
            GROUP BY employeeid
            ORDER BY employeeid";
			$res=mysqli_query($link,$sql);
		}	
	}
?>
<table>
<tr>
<th>员工编号</th>
<th>员工姓名</th>
<th>销售额</th>
<th>销售数量</th>
</tr>
<?php
	while($row=mysqli_fetch_assoc($res))
	{
		echo "
			<tr>
				<td>{$row['employeeid']}</td>
				<td>{$row['employeename']}</td>
				<td>{$row['total']}</td>
                <td>{$row['totalnumber']}</td>
				</tr>
			";	
	}
?>
</table>
</body>
</html>
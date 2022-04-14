<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>员工信息修改</title>
<link rel="stylesheet" href="../css/add.css">
<style type="text/css">
 	body{background-image:url(../picture/bg.jpg);
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
			$employeeid=$_GET['employeeid'];
			$sql="select * from employees where employeeid=$employeeid";
			$res=mysqli_query($link,$sql);	
		}
	}
?>
<h3>修改员工信息</h3>
<?php
	while($row=mysqli_fetch_assoc($res))
	{
		echo "
		<div id='left'>
   		<form action='execupdateemp.php?employeeid={$employeeid}' method='post'>
   		<table>
			<tr>
            	<td class='info'>用户名</td>
            	<td class='input'>{$row['employeename']}</td>
			</tr>
			<tr>
            	<td class='info'>密码</td>
            	<td class='input'><input type='text' name='password' value='{$row['password']}' ></td>
        	</tr>
			<tr>
            	<td class='info'>性别</td>
            	<td class='input'><input type='text' name='sex' value='{$row['sex']}' ></td>
        	</tr>
			<tr>
				<td class='info'>电话号码</td>
				<td class='input'><input type='text' name='tel' value='{$row['tel']}' ></td>
			</tr>
			<tr>
				<td class='info'>家庭住址</td>
				<td class='input'><input type='text' name='addr' value='{$row['addr']}' ></td>
			</tr>
            <tr>
				<td class='info'>入职时间</td>
				<td class='input'><input type='text' name='empdate' value='{$row['empdate']}' ></td>
			</tr>
		";	
	}   
?>
<tr>
            <td></td>
            <td class="input">
            <input type="submit" value="修改" id="submit">

            <input type="reset" value="重置" id="reset"></td>
        </tr>
        </table>
      </form>
</body>
</html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>员工信息修改</title>
<link rel="stylesheet" href="../css/add.css">
<style type="text/css">
 	body{background-image:url(../picture/bg7.jpeg);
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
		}
	}
?>
<h3>添加员工信息</h3>

<div id='left'>
<form action='execaddemp.php' method='post'>
<table>
    <tr>
        <td class='info'>员工名</td>
        <td class='input'><input type='text' name='employeename'  ></td>
    </tr>
    <tr>
        <td class='info'>密码</td>
        <td class='input'><input type='text' name='password'></td>
    </tr>
    <tr>
        <td class='info'>性别</td>
        <td class='input'><input type='text' name='sex'></td>
    </tr>
    <tr>
        <td class='info'>电话号码</td>
        <td class='input'><input type='text' name='tel'></td>
    </tr>
    <tr>
        <td class='info'>家庭住址</td>
        <td class='input'><input type='text' name='addr'></td>
    </tr>
    <tr>
        <td class='info'>入职时间</td>
        <td class='input'><input type='text' name='empdate'></td>
    </tr>
<tr>
            <td></td>
            <td class="input">
            <input type="submit" value="添加" id="submit">

            <input type="reset" value="重置" id="reset"></td>
        </tr>
        </table>
      </form>
</body>
</html>
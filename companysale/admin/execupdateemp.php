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
			$password=$_POST['password'];
			$sex=$_POST['sex'];
			$tel=$_POST['tel'];
			$addr=$_POST['addr'];
            $empdate=$_POST['empdate'];
			$sql="update employees set password='{$password}',tel='{$tel}',sex='{$sex}',addr='{$addr}',empdate='{$empdate}' where employeeid=$employeeid";
			$res=mysqli_query($link,$sql);
			header("Location:employeemanage.php");
		}
	}
?>
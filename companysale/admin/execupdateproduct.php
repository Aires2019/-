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
			$storageid=$_GET['storageid'];
			$number=$_POST['number'];
			$price=$_POST['price'];
			$sql="update storage set number=$number,price=$price where storageid=$storageid";
			$res=mysqli_query($link,$sql);
			header("Location:manage.php");
		}
	}
?>

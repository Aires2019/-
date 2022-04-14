<?php
	session_start();
	require("../compoents/coon.php");
	 if(@$_POST['username']==null)
	{
		echo "<script>alert('用户名不能为空!');window.location.href='../index.html';</script>";
	}
	else if($_POST['password']==null)
	{
		echo "<script>alert('密码不能为空!');window.location.href='../index.html';</script>";
	}
	else
	{
		$id=$_POST['id'];
		if($id=='1')
		{
			$username=$_POST['username'];
			$password=$_POST['password'];
			$sql="select * from users where username='{$username}' and password='{$password}'";
			$res=mysqli_query($link,$sql);
			$row=mysqli_fetch_assoc($res);
			$num=mysqli_num_rows($res);
			if($num>0)
			{
				$_SESSION['username']=$username;
				$_SESSION['userid']=$row['userid'];
				echo "<script>window.location.href='../show.php';</script>";
			}
			else
			{
				echo "<script>alert('用户名或密码错误!');history.go(-1);</script>";
			}		
		}
		else if($id=='2')
		{
			$username=$_POST['username'];
			$password=$_POST['password'];
			$sql="select * from admins where account='{$username}' and password='{$password}'";
			$res=mysqli_query($link,$sql);
			$row=mysqli_fetch_assoc($res);
			$num=mysqli_num_rows($res);
			if($num>0)
			{
				$_SESSION['username']=$username;
				$_SESSION['status']='admin';
				echo "<script>window.location.href='manage.php';</script>";
			}
			else
			{
				echo "<script>alert('用户名或密码错误!');history.go(-1);</script>";
			}
		}
		else
		{
			$username=$_POST['username'];
			$password=$_POST['password'];
			$sql="select * from employees where employeename='{$username}' and password='{$password}'";
			$res=mysqli_query($link,$sql);
			$row=mysqli_fetch_assoc($res);
			$num=mysqli_num_rows($res);
			if($num>0)
			{
				$_SESSION['username']=$username;
				$_SESSION['status']='admin';
				$_SESSION['employeeid']=$row['employeeid'];
				echo "<script>window.location.href='../employee/emanage.php';</script>";
			}
			else
			{
				echo "<script>alert('用户名或密码错误!');history.go(-1);</script>";
			}
		}
	}
?>

<?php
	session_start();
	if(!isset($_SESSION['username'])||($_SESSION['username']==null))
	{
		echo "<script>alert('请先登录！');window.location.href='../index.html';</script>";
	}
	else
	{
		require("../compoents/coon.php");
		$userid=$_SESSION['userid'];
		$productid=$_GET['productid'];
		$sql="select orders.orderid,productid from orders,orderinfo where userid=$userid and productid='{$productid}' and orders.orderid=orderinfo.orderid";
		$res=mysqli_query($link,$sql);
		$row=mysqli_fetch_assoc($res);
		$orderid=$row['orderid'];

		// $sql="select orderid from orders where userid=$userid and productid=$productid";
		// $res=mysqli_query($link,$sql);
		// $row=mysqli_fetch_assoc($res);
		// $orderid=$row['orderid'];
		$sql="delete from orders where orderid=$orderid";
		$res=mysqli_query($link,$sql);
		$sql="delete from orderinfo where orderid=$orderid and productid='{$productid}'";
		$res=mysqli_query($link,$sql);
		$sql="delete from usercart where userid=$userid and orderid=$orderid";
		$res=mysqli_query($link,$sql);
		header('location:../mycart.php');
	}
?>
<?php
	session_start();
	if(!isset($_SESSION['username'])||($_SESSION['username']==null))
	{
		echo "<script>alert('请先登录！');window.location.href='index.html';</script>";
	}
	require("../compoents/coon.php");
	$productid=$_GET['productid'];
	$ordernumber=$_GET['num'];
	$userid=$_SESSION['userid'];

	$sql="select ordernumber,orders.orderid,productid from orders,orderinfo where userid=$userid and productid='{$productid}' and orders.orderid=orderinfo.orderid";
	$res1=mysqli_query($link,$sql);
	$row1=mysqli_fetch_assoc($res1);
	$orderid=$row1['orderid'];
	$onumber=$row1['ordernumber'];

	$sql="select number from storage where productid='{$productid}'";
	$res=mysqli_query($link,$sql);
	$row=mysqli_fetch_assoc($res);
	$number=$row['number'];
	if(($onumber+$ordernumber)==0)//数量为0 直接删除
	{
		$sql="delete from orders where orderid={$orderid}";
		$res=mysqli_query($link,$sql);
		header('location:../mycart.php');
	}
	else if(($onumber+$ordernumber)>$number)
	{
		echo "<script>alert('产品库存不足，请联系管理员补货');window.location.href='../mycart.php';</script>";
	}
	else{

	$sql="select price from storage where productid='{$productid}'";
	$res=mysqli_query($link,$sql);
	$row=mysqli_fetch_assoc($res);
	$price=$row['price'];
	//mysqli_query($link,"update orders set orderdate={$orderdate},finishdate={$finishdate} where userid='{$userid}'");
	//$res=mysqli_query($link,$sql);

	// $sql="select orders.orderid,productid from orders,orderinfo where userid=$userid and productid='{$productid}' and orders.orderid=orderinfo.orderid";
	// $res=mysqli_query($link,$sql);
	// $row=mysqli_fetch_assoc($res);
	// $orderid=$row['orderid'];

	// $sql="select orderid from orders where userid='{$userid}'";
	// $res=mysqli_query($link,$sql);
	// $row=mysqli_fetch_assoc($res);
	// $orderid=$row['orderid'];

	$sql="update orderinfo set ordernumber=ordernumber+{$ordernumber},total=total+{$ordernumber}*{$price}
		where productid='{$productid}' and orderid='{$orderid}'";
	$res=mysqli_query($link,$sql);
	header('location:../mycart.php');	
	}
?>

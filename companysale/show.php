<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>企业销售系统</title>
<link href="css/show.css" rel="stylesheet" />
<style>
	a
	{text-decoration:none;}
	div#menu
	{
    width: 175px;
    height: 100%;
    float:left;
    background-color: navajowhite;
	text-align:center;
	font-size:20px;
	}
	div#imgs
	{
		width:160px;
		margin-top:20px;
		margin-left:15px;
	}
</style>
</head>

<body>
<?php
	session_start();
	if(!isset($_SESSION['username'])||($_SESSION['username']==null))
	{
		echo "<script>alert('请先登录！');window.location.href='index.html';</script>";
	}
?>
<?php
	require("compoents/coon.php");
	$userid=$_SESSION['userid'];
	//找到当前用户名
	$sql="select username,usertype from users where userid=$userid";
	$res1=mysqli_query($link,$sql);
	$row1=mysqli_fetch_assoc($res1);
	$username=$row1['username'];
	$usertype=$row1['usertype'];
?>
<form action="search.php" method="post">
<div id="nav">
<form action="search.php" method="post">
			<label>请输入要搜索的内容</label>
			<input type="text" name="content" />
			<button type="submit" value="搜索">搜索</button>
            <a id='one' href="show.php">浏览商品</a>
            <a id="one" href="test.php">我的订单</a>
            <a id="one" href="userupdate.php">修改信息</a>
</div>

</form>
<div id="menu">
	<div id="imgs">
	<a href="userupdate.php"><img src="./picture/cute.jpeg" width="100px" alt="failed"/></a>
	<br><br>
</div>
用户名:<?php echo $username;?><br><br>
用户类型：<?php echo $usertype;?><br><br>
<a href="logout.php?action=logout">退出登录</a><br>
</div>
<?php
    $res=mysqli_query($link,"select * from storage");
	while($row=mysqli_fetch_assoc($res))
	{
		echo"
		<div id='container'>
			<img src='picture/{$row['pic']}'>
			<p>产品名:{$row['productname']}</p>
			<p>生产日期:{$row['prdate']}</p>
			<p>库存:{$row['number']}件</p>
			<label>价格:{$row['price']}</label>
			<br><br><a href='admin/addcart.php?productid={$row['productid']}'>加入我的订单</a>
		</div>
		"; 
	}
?>
</body>

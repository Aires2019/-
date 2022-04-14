<?php
	session_start();
	if(!isset($_SESSION['username'])||($_SESSION['username']==null))
	{
		echo "<script>alert('请先登录！');window.location.href='index.html';</script>";
	}
	else
	{
		require("../compoents/coon.php");
		$userid=$_SESSION['userid'];
		$productid=$_GET['productid'];

		$sql="select number from storage where productid=$productid";
		$res1=mysqli_query($link,$sql);
		$row1=mysqli_fetch_assoc($res1);
		$number=$row1['number'];
		if($number<1)
		{
			echo "<script>alert('产品库存不足，请联系管理员补货');window.location.href='../show.php';</script>";
		}
		else{
		//寻找当前客户的订购产品
		$sql="select productid from orderinfo,orders where userid=$userid and orders.orderid=orderinfo.orderid";
		$res=mysqli_query($link,$sql);
		$status=false;
		//循环匹配
		while($row=mysqli_fetch_assoc($res))
		{
			// if(strncmp($productid,$row['productid'])==0)
			// {
			// 	$status=true;	
			// }
			if($productid==$row['productid'])
			{
				$status=true;	
			}	
		}
		//若已经订购该产品
		if($status)
		{
			//mysqli_query($link,"insert into orders(orderdate,finishdate,userid) values('2021-12-18','2021-12-20',$userid)");
			$sql="select orders.orderid,productid from orders,orderinfo where userid=$userid and productid='{$productid}' and orders.orderid=orderinfo.orderid";
			$res=mysqli_query($link,$sql);
			$row=mysqli_fetch_assoc($res);
			$orderid=$row['orderid'];
			$sql="update orderinfo set ordernumber=ordernumber+1,total=total+
			(select price from storage where productid='{$productid}')
			where orderid=$orderid and productid='{$productid}'";
			$res=mysqli_query($link,$sql);
			header('location:../show.php');	
		}
		else
		{
			//mysqli_query($link,"insert into orders(orderdate,finishdate,userid) values('2021-12-30','2022-01-01',$userid)");
			$sql="select price from storage where productid='{$productid}'";
			$res=mysqli_query($link,$sql);
			$row=mysqli_fetch_assoc($res);
			$total=$row['price'];
			//数据插入orders中	
			$orderdate=date("Y-m-d");
			$finishdate=date("Y-m-d",mktime(0,0,0,date("m"),date("d")+3,date("Y")));
			//mysqli_query($link,"insert into orders(orderdate,finishdate,userid) values('2021-12-30','2022-01-01',$userid)");
			$sql="insert into orders(orderdate,finishdate,userid) values('{$orderdate}','{$finishdate}',$userid)";
			$res=mysqli_query($link,$sql);
			//获取当前orderid
			$sql="select max(orderid) orderid from orders";
			$res=mysqli_query($link,$sql);
			$row=mysqli_fetch_assoc($res);
			$orderid=$row['orderid'];

			//数据插入orderinfo中
			$sql="insert into orderinfo(orderid,productid,ordernumber,price,total) values($orderid,'{$productid}',1,$total,$total)";	
			$res=mysqli_query($link,$sql);

			//插入到购物车表
			// $sql="select orderid from orders where userid=$userid and productid=$productid";
			// $res=mysqli_query($link,$sql);
			// $row=mysqli_fetch_assoc($res);
			// $orderid=$row['orderid'];
			$sql="insert into usercart values($userid,$orderid)";
			$res=mysqli_query($link,$sql);
			header('location:../show.php');
		}
	}
}
?>
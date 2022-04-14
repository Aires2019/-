<?php
	session_start();
	if(!isset($_SESSION['username'])||($_SESSION['username']==null))
	{
		echo "<script>alert('请先登录！');window.location.href='index.html';</script>";
	}
	else
	{
		require("../compoents/coon.php");
		$userid=$_GET['userid'];
		$employeeid=$_GET['employeeid'];
		echo $employeeid;

		$sql="select usertype from users where userid=$userid";
		$res2=mysqli_query($link,$sql);
		$row2=mysqli_fetch_assoc($res2);
		$usertype=$row2['usertype'];
		echo $usertype;

		$sql="select productid,ordernumber,price from usercart,orders,orderinfo where usercart.userid=$userid and
		orders.userid=$userid and usercart.userid=orders.userid and usercart.orderid=orders.orderid and orders.orderid=orderinfo.orderid";
		$res1=mysqli_query($link,$sql);

		$sql="select productid,ordernumber,price from usercart,orders,orderinfo where usercart.userid=$userid and
		orders.userid=$userid and usercart.userid=orders.userid and usercart.orderid=orders.orderid and orders.orderid=orderinfo.orderid";
		$res11=mysqli_query($link,$sql);
		$date=date("Y-m-d",mktime(0,0,0,date("m"),date("d"),date("Y")));

		$sql="select saleid from sale where userid=$userid and saledate='{$date}' and cahserid=$employeeid";
		$result=mysqli_query($link,$sql);
		$r=mysqli_fetch_assoc($result);
		$saleid1=$r['saleid'];
		echo $saleid1;
		//先寻找该用户是否在当天多次购买，若不是则直接插入
		if($saleid1==null)
		{
			//得到sale内的totalnumber（总数）和total（总钱数）
			$sql="select sum(ordernumber) totalnumber,sum(total) total from orders,orderinfo where userid=$userid and orders.orderid=orderinfo.orderid ";
			$res3=mysqli_query($link,$sql);
			$row3=mysqli_fetch_assoc($res3);
			print_r($row3);
			$totalnumber=$row3['totalnumber'];
			$total=$row3['total'];
			//若为普通客户
			if($usertype=="普通")
			{
				//插入sale
				$sql="insert into sale(casherid,total,totalnumber,userid,discount,actualtotal,saledate) values({$employeeid},{$total},{$totalnumber},{$userid},0,{$total},'{$date}')";
				$res4=mysqli_query($link,$sql);
				echo "hahahha";
			}
			//若为VIP客户
			else
			{
				//插入sale
				$sql="insert into sale(casherid,total,totalnumber,userid,discount,actualtotal,saledate) values({$employeeid},{$total},{$totalnumber},{$userid},0.75,0.75*{$total},'{$date}')";
				$res4=mysqli_query($link,$sql);
				
			}
		}
		//已经存在
		else
		{
			while($row=mysqli_fetch_assoc($res1))
			{
				print_r($row);
				//找到当前商品的价格
				// $sql="select price from saleinfo where saleid=$saleid1 and productid='{$row['productid']}' ";
				// $res4=mysqli_query($link,$sql);
				// $row4=mysqli_fetch_assoc($res4);
				// $price1=$row4['price'];
				// echo $price1;
				//更新sale表
				if($usertype=="普通")
				{
					$sql="update sale set total=total+{$row['ordernumber']}*{$row['price']},totalnumber=totalnumber+{$row['ordernumber']},actualtotal=actualtotal+{$row['ordernumber']}*{$row['price']} where saleid=$saleid1";
					$res5=mysqli_query($link,$sql);
					echo $res5;
				}
				else
				{
					$sql="update sale set total=total+{$row['ordernumber']}*{$row['price']},totalnumber=totalnumber+{$row['ordernumber']},actualtotal=actualtotal+{$row['ordernumber']}*{$row['price']}*0.75 where saleid=$saleid1";
					$res5=mysqli_query($link,$sql);
				}
			}
		}
		while($rowrow=mysqli_fetch_assoc($res11))
		{
			print_r($rowrow);
			//查看该用户是否在今天购买过该商品
			$sql="select sale.saleid from sale,saleinfo where userid=$userid and productid='{$rowrow['productid']}' and saledate='{$date}' and sale.saleid=saleinfo.saleid";
			$res2=mysqli_query($link,$sql);
			$row2=mysqli_fetch_assoc($res2);
			$saleid=$row2['saleid'];
			//$num=mysqli_affected_rows($res2);
			//若没有购买过，则插入
			if($saleid==null)
			{
				//获取当前saleid
				$sql="select max(saleid) saleid from sale";
				$res5=mysqli_query($link,$sql);
				$row5=mysqli_fetch_assoc($res5);
				$saleid=$row5['saleid'];
				echo $saleid;
				//插入saleinfo
				$sql="insert into saleinfo(saleid,productid,number,price,total) values({$saleid},'{$rowrow['productid']}',{$rowrow['ordernumber']},{$rowrow['price']},{$rowrow['ordernumber']}*{$rowrow['price']})";
				$res3=mysqli_query($link,$sql);
				//仓库数量减少
				$sql="update storage set number=number-{$rowrow['ordernumber']} where productid='{$rowrow['productid']}'";
				$res3=mysqli_query($link,$sql);
			}
			//若已经购买过则直接更新表
			else
			{
				$sql="update saleinfo set number=number+{$rowrow['ordernumber']},total=total+{$rowrow['price']}*{$rowrow['ordernumber']} where saleid=$saleid and productid='{$rowrow['productid']}'";
				$res3=mysqli_query($link,$sql);
				echo $rowrow['productid'];
				//然后修改库存
				$sql="update storage set number=number-{$rowrow['ordernumber']} where productid='{$rowrow['productid']}'";
				$res3=mysqli_query($link,$sql);
			}
			//删除购物车、订单、订单明细
			//$sql0="select serialid from orderinfo,(select * from orders where userid=$userid) as orders where orders.orderid=orderinfo.orderid;";
			//$res4=mysqli_query($link,$sql0);
			//$row4=mysqli_fetch_assoc($res4);
			//$serialid=$row4['serialid'];
			$sql1="delete from usercart where userid=$userid";
			//$sql2="delete from orderinfo where serialid=$serialid";
			$sql3="delete from orders where userid=$userid";
			$res3=mysqli_query($link,$sql1);
			//$res3=mysqli_query($link,$sql2);
			$res3=mysqli_query($link,$sql3);
				
		}
		header('location:../mycart.php');
	}
?>

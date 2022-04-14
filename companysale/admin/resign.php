<?php

	require("../compoents/coon.php");
	$msg=array('code'=>1,'msg'=>'sucessfully');
	$username=@$_POST["username"];	//获取各个表单元素的值
	$password=@$_POST["password"];
	$usertype=@$_POST['usertype'];
	if($usertype=='1') $usertype='普通';
	else $usertype='VIP';
	$tel=@$_POST['tel'];
	$addr=@$_POST['addr'];
	$ps=@$_POST['ps'];
	//$zcdate=date("Y-m-d");
	$sql="select userid from users where username='$username'";
	$res=mysqli_query($link,$sql);
	$row=mysqli_fetch_assoc($res);
	
	/*if(!empty($row)){
               
		$userid= $row['userid'];
	   }else{
		$userid= '';
	   }*/

	$userid=$row['userid'];
	if($userid)
	{
		$msg['code']=0;
		$msg['msg']="the user has existed";	
	}
	else if(!preg_match('/^[_0-9a-z]{6,16}$/',$password))
	{
		
		$msg['code']=0;
		$msg['msg']="The password is 6 to 16 digits long and can only contain numbers or letters";	
	}
	else if(!preg_match("/^1[345789]\d{9}$/",$tel))
	{
		$msg['code']=0;
		$msg['msg']="error tel";	
	}
	else
	{
		$sql="
			insert into users(username,password,usertype,tel,addr,ps)
			values('$username','$password','$usertype','$tel','$addr','$ps')
		";
		$res=mysqli_query($link,$sql);
		$userid=mysqli_insert_id($link);
		if(!$userid)
		{
		  $msg['code']=0;
		  $msg['msg']="failed";	
		}	
	}
	 echo json_encode($msg);
?>

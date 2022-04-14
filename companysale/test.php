
<!-- <form name="form1" enctype="multipart/form-data" method="post" action="mycart.php"> 
<label> 
<select name="select"> 
<option value="1">北北</option> 
<option value="2">新濛</option> 
<option value="3">丁一</option> 
<option value="4">向东</option> 
<option value="5">郭帅</option> 
</select> 
</label> 
<label> 
<input type="submit" name="Submit" value="提交"> 
</label> 
</form>  -->
<!DOCTYPE html>
<html>
<head>
<meta charset=" utf-8">
<meta name="author" content="http://www.softwhy.com/" />
<title>选择销售人员</title>
<style type="text/css">
body{background-image:url(picture/bg.jpeg);
	background-repeat:no-repeat;
	background-size:100%;}
.select_style{
  width:240px; 
  height:30px; 
  overflow:hidden; 
  background:url(picture/bg8.jpeg) no-repeat 215px; 
  border:1px solid #ccc; 
  -moz-border-radius:5px; /* Gecko browsers */ 
  -webkit-border-radius:5px; /* Webkit browsers */ 
  border-radius:5px; 
  
} 
.select_style select{ 
  padding:5px;
  background:transparent; 
  width:268px; 
  font-size:16px; 
  border:none; 
  height:30px; 
  -webkit-appearance:none; /*for Webkit browsers*/ 
}
.btn{
    width:140px;
    height:36px;
    line-height:18px;
    font-size:18px;
    color:#FFF;
    padding-bottom:4px;
    background:url("picture/bg8.jpeg");
    margin-top:20px ;}  
</style>
</head>
<body>
    <h2>请选择销售人员</h2>
<form name="form1" enctype="multipart/form-data" method="post" action="mycart.php">
<div class="select_style"> 
  <select name="select"> 
    <option value="1">北北</option> 
    <option value="2">新濛</option> 
    <option value="3">丁一</option> 
    <option value="4">向东</option> 
    <option value="5">郭帅</option> 
  </select> 
</div> 
<input type="submit" name="Submit" class="btn" value="提交"> 
</form>
</body>
</html>


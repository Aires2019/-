<?php
session_start();

//退出登录登录
if($_GET['action'] == "logout"){
    unset($_SESSION['userid']);
    unset($_SESSION['username']);
    echo '退出登录成功！点击此处 <a href="index.html">登录</a>';
    exit;
    //header('location:../login.php');
}
?>
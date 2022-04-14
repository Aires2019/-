<?php
    session_start();
    require("../compoents/coon.php");
    //查询代码
    $sql = "select productid,sum(number) num from saleinfo group by productid having sum(number)>1 order by num desc;";
    $result = mysqli_query($link, $sql);

    $data = array();
    $as = "";
    class User
    {
        public $pro;
        public $num;
    }

    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $user = new User();
        $user->pro = $row['productid'];
        $user->num = $row['num'];
        $data[] = $user;
    }
    echo json_encode($data);
    //mysqli_close($conn);// 关闭MySQL数据库连接
?>
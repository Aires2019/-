<?php
    session_start();
    require("../compoents/coon.php");
    //查询代码
    $sql = "select salemonth,sum(totalnumber) num from sale_view group by salemonth order by salemonth";
    $result = mysqli_query($link, $sql);

    $data = array();
    $as = "";
    class User
    {
        public $smonth;
        public $num;
    }

    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $user = new User();
        $user->smonth = $row['salemonth'];
        $user->num = $row['num'];
        $data[] = $user;
    }
    echo json_encode($data);
    //mysqli_close($conn);// 关闭MySQL数据库连接
?>
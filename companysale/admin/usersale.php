<?php
    session_start();
    require("../compoents/coon.php");
    //查询代码
    $sql = "select username,sum(actualtotal) num from sale_view,users where users.userid=sale_view.userid group by username order by num";
    $result = mysqli_query($link, $sql);

    $data = array();
    $as = "";
    class User
    {
        public $sid;
        public $num;
    }

    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $user = new User();
        $user->sid = $row['username'];
        $user->num = $row['num'];
        $data[] = $user;
    }
    echo json_encode($data);
    //mysqli_close($conn);// 关闭MySQL数据库连接
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>echarts</title>
    <script src="https://cdn.bootcss.com/echarts/4.2.1-rc1/echarts.min.js" type="text/javascript"></script>
    <script src="https://cdn.staticfile.org/echarts/4.3.0/echarts.min.js"></script>
    <script src="https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
    <style type="text/css">
        body{background-image:url(../picture/bg3.jpeg);
        background-repeat:no-repeat;
        background-size:100%;}
    </style>
    <style>
        a{
            font-size:23px;
            text-decoration:none;
        }
    </style>
</head>
<body>
    <div>
    <div id="main1" style="width: 50%;height:400px;float:left;"></div>
    <div id="main2" style="width:50%;height:400px;float:left;"></div>
    <div id="main3" style="width:50%;height:400px;float:left;"></div>
    <div id="main4" style="width:50%;height:400px;float:left;"></div>
</div>

<a href="manage.php">返回主页面</a>

<script type="text/javascript">
    var arr = new Array();//数字
    var res = new Array();//名字
    var option;

    function getNumber() {
        $.ajax({
            type: "post",
            async: false, //异步执行
            url: "monthsale.php", //SQL数据库文件
            data: {}, //发送给数据库的数据
            dataType: "json", //json类型

            success: function(result) {
                if (result) {
                    for (var i = 0; i < result.length; i++) {
                        res.push(result[i].smonth);
                        arr.push(result[i].num);
                    }
                }
            },
            error: function() {
                alert('Ajax request 发生错误');
            }
        })
        return res, arr;
    }
    //执行异步请求
    getNumber();
    var myChart = echarts.init(document.getElementById('main1'));
    var option = {
        title:{
            text:'2021年每月销售数量'
        },
        tooltip:{
            show:true
        },
        legend:{
            data:['销售数量']
        },
        xAxis: [{
            type: 'category',
            data: res,
            name: '月份',
        }],
        yAxis:[ {
            type: 'value',
            name: '销售数量'
        }],
        series: [{
            name:'销售数量',
            data: arr,
            type: 'bar'
        }]
    };
    myChart.setOption(option);
</script>

<script>
    var arr = new Array();//数字
    var res = new Array();//名字
    var ses=[];
    function getNumber() {
        $.ajax({
            type: "post",
            async: false, //异步执行
            url: "usersale.php", //SQL数据库文件
            data: {}, //发送给数据库的数据
            dataType: "json", //json类型

            success: function(result) {
                if (result) {
                    for (var i = 0; i < result.length; i++) {
                        ses.push({
                        name: result[i].sid,
                        value: result[i].num});

                        // res.push(result[i].sid);
                        // arr.push(result[i].num);
                    }
                }
            },
            error: function() {
                alert('Ajax request 发生错误');
            }
        })
        //return res, arr;
        return ses;
    }
    //执行异步请求
    getNumber();
    var myChart = echarts.init(document.getElementById('main4'));

    // 指定图表的配置项和数据
    var option = {
            title:{
                text:'2021年用户购买情况'
            },
            legend: {
                type: 'scroll',
                orient: 'vertical',
                show: true,
                right: 0,
                top: 20,
                bottom: 20,
                textStyle: {
                fontSize: 10
                },
                data: ses.name
            },
            tooltip: {//提示框组件
                trigger: 'item', //item数据项图形触发，主要在散点图，饼图等无类目轴的图表中使用。
                axisPointer: {
                // 坐标轴指示器，坐标轴触发有效
                type: 'shadow' // 默认为直线，可选为：'line' | 'shadow'
                },
                formatter: '{a} <br/>{b} : {c} <br/>百分比 : {d}%' //{a}（系列名称），{b}（数据项名称），{c}（数值）, {d}（百分比）
            },
            series : [
                {
                    name: '用户购买情况',
                    type: 'pie',
                    radius: '55%',
                    roseType: 'raduis',
                    data:ses,
                    label:{
                        normal:{
                            show:true,
                            formatter:'{b}:{d}%'
                        }
                    },
                    itemStyle: {
                        normal: {
                            color:function(params){
                                    var colorList=[
                                        '#F3DB5D','#009AFF','#F77474','#28DCCF','#FF5937'
                                ];
                            return colorList[params.dataIndex]
                            },
                            }
                        }
                }
            ]
        };

    // 使用刚指定的配置项和数据显示图表。
    myChart.setOption(option);
</script>

<script type="text/javascript">
    /*
	 * @todo 加载echarts方法
	 * @url:异步请求路径
	 * @chartId:请求的echart的id
	 * @title:标题
	 * @legend_name:图例名
	*/
    var arr = new Array();//数字
    var res = new Array();//名字
    var option;
    function getNumber(){
        $.ajax({//Ajax请求你要展现的数据
            url :"product.php",
            type : 'post',
            dataType : 'json',
            async:false,	//改为同步
            data : {},	//查看方式
            success: function(result) {
                    if (result) {
                        for (var i = 0; i < result.length; i++) {
                            res.push(result[i].pro);
                            arr.push(result[i].num);
                        }
                    }
                },
            error : function() {
                alert('Ajax request 发生错误')
            }
        })
        return res, arr;
        //Ajax模拟数据前台暂时写死
        // var data = getStaticJsonData();
        // chartTool.registerFunnelChart( chartId,data.textname, legend_name, data.yAxisData, data.seriesData);
    }
    getNumber();
    var myChart = echarts.init(document.getElementById('main2'));
    var option = {
        color:['#3398DB'],
        title: {
            text:'产品销售情况',	// '注册转化漏斗(总体转化率10%)',
        },
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'shadow'
            }
        },
        legend: {
            data: ['购买产品数'], //['用户数']

        },
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        },
        xAxis: {
            type: 'value',
            boundaryGap: [0, 0.01]
        },
        yAxis: {
            type: 'category',
            name: '客户编号',
            data: res,	//['后续操作(3%)','完成注册(98%)','点击注册']
        },
        series: [
            {
                name: '购买产品数', 	//'用户数',
                barWidth: 15,		//设置柱子宽度
                type: 'bar',
                data: arr, //[ 104970, 131744, 630230]
            }
        ]
    };
    // 使用刚指定的配置项和数据显示图表。
    myChart.setOption( option );
 
    //模拟AJax请求获取返回的json数据
    // function getStaticJsonData() {
    //     var data = '{"textname":"注册转化漏斗(总体转化率40%)","yAxisData":["已消费(50%)","已登录(80%)","已注册"],"seriesData":[20,40,50]}';
    //     data = eval('(' + data + ')');
    //     return data;
    // }
 
    // dayComment('Ajax请求的路径', 'consume_y_bar', '用户数');
</script>

<script type="text/javascript">
    var arr = new Array();//数字
    var res = new Array();//名字
    var option;

    function getNumber() {
        $.ajax({
            type: "post",
            async: false, //异步执行
            url: "totalsale.php", //SQL数据库文件
            data: {}, //发送给数据库的数据
            dataType: "json", //json类型

            success: function(result) {
                if (result) {
                    for (var i = 0; i < result.length; i++) {
                        res.push(result[i].smonth);
                        arr.push(result[i].num);
                    }
                }
            },
            error: function() {
                alert('Ajax request 发生错误');
            }
        })
        return res, arr;
    }
    //执行异步请求
    getNumber();
    var myChart = echarts.init(document.getElementById('main3'));
    var option = {
        title:{
            text:'2021年每月销售额'
        },
        tooltip:{
            trigger : 'axis',
            axisPointer : { // 坐标轴指示器，坐标轴触发有效
                type : 'shadow' // 默认为直线，可选为：'line' | 'shadow'
            }
        },
        legend:{
            data:['销售额']
        },
        grid : {
            left : '3%',
            right : '20%',
            bottom : '20%',
            containLabel : true
			},
        xAxis: [{
            type: 'category',
            data: res,
            name:'月份'
        }],
        yAxis:[ {
            type: 'value',
            name: '销售额'
        }],
        series: [{
            name:'销售额',
            data: arr,
            type: 'line'
        }]
    };
    myChart.setOption(option);
</script>

</body>
</html>
 
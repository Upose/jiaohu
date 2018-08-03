<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>fankui</title>
    <link rel="stylesheet" href="/Public/Doc/css/allmap.css" media="all">
    <script src="/Public/static/jquery-2.0.3.min.js"></script>
    <script src="/Public/static/vue.min.js"></script>
    <script src="/Public/static/echarts.min.js"></script>
</head>

<body>  
    <div class="new">
        <div class="new_up">
            <div>
                <p class="tit">提交项目</p>
                <div class="echar_div" id="echar_div1"></div>
            </div>
            <div>
                <p class="tit">问题处理情况</p>
                <div class="echar_div" id="echar_div2"></div>
            </div>
            <div class="right_box">
                <p class="tit">处理周期</p>
                <div class="echar_div" id="echar_div3"></div>
            </div>
        </div>
        <div class="new_bottom">
            <div class="bottom_left">
                <div class="bottom_left_top">
                    <div class="bottom_left_top_left">
                        <p class="tit">紧急程度</p>
                        <div class="echar_div" id="echar_div4"></div>
                    </div>
                    <div class="bottom_left_top_right">
                        <p class="tit">处理进度</p>
                        <div class="echar_div" id="echar_div5"></div>
                    </div>
                </div>
                <div class="bottom_left_bottom">
                    <p class="tit">问题类型</p>
                    <div class="echar_div" id="echar_div6"></div>
                </div>
            </div>
            <div class="bottom_right">
                <p class="tit">处理方式</p>
                <div class="echar_div">
                    <div class="bottom_right_top">
                        <div class="biao1" id="echar_div7"></div>
                        <div class="biao2" id="echar_div8"></div>
                    </div>
                    <div class="bottom_right_bottom">
                        <ul>
                            <li>
                                <p>问题总数</p>
                                <p><span>23</span>个</p>     
                            </li>
                            <li>
                                <p>已解决数</p>
                                <p><span>123</span>个</p>     
                            </li>
                            <li>
                                <p>涵盖产品</p>
                                <p><span>13</span>个</p>     
                            </li>
                            <li>
                                <p>提问人数</p>
                                <p><span>23</span>个</p>     
                            </li>
                            <li>
                                <p>问题类型</p>
                                <p><span>12</span>类</p>     
                            </li>
                            <li>
                                <p>解决方案</p>
                                <p><span>53</span>个</p>     
                            </li>
                            <li>
                                <p>使用教程</p>
                                <p><span>123</span>篇</p>     
                            </li>
                        </ul>  
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    var app = new Vue({
        el: '.new',
        data: {
        },
        created: function () {
            this.subxm(); //提交项目
            this.handleBasic(); //问题处理情况
            this.handleState();//问题处理情况
            this.emergency(); //紧急程度
            this.handlePro(); //处理进度
            this.proType(); //问题类型
            this.biao1(); //处理方式表1
            this.biao2(); //处理方式表2
        },
        methods: {
            //提交项目
            subxm (){
                var chartSsubxm = echarts.init(document.getElementById('echar_div1'));
                    option = {
                        tooltip : {
                            trigger: 'axis',
                            axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                                type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
                            }
                        },
                        legend: {
                            data: ['直接访问', '邮件营销'], 
                            x:"center", 
                            // y:"bottom",
                            // // margin:6
                            //  verticalAlign: 'top',
                            //  x: 30,
                            // verticalAlign: 'top',
                            y: 30,
                        },
                        grid: {
                            left: '3%',
                            right: '4%',
                            bottom: '3%',
                            containLabel: true
                        },
                        xAxis:  {
                            type: 'value'
                        },
                        yAxis: {
                            type: 'category',
                            data: ['分类四','分类三','分类二','分类一']
                        },
                        series: [
                            {
                                name: '直接访问',
                                type: 'bar',
                                stack: '总量',
                                barWidth :25,
                                label: {
                                    normal: {
                                        show: true,
                                        position: 'insideRight'
                                    }
                                },
                                data: [320, 302, 301, 334],
                                itemStyle:{
									normal:{color:'rgb(58,160,255)'}
								}

                            },
                            {
                                name: '邮件营销',
                                type: 'bar',
                                stack: '总量',
                                label: {
                                    normal: {
                                        show: true,
                                        position: 'insideRight'
                                    }
                                },
                                data: [120, 132, 101, 134],
                                 itemStyle:{
									normal:{color:'rgb(78,203,115)'}
								}
                            }
                        ]
                    };
                chartSsubxm.setOption(option, true);
            },
            //问题处理情况
            handleBasic(){
                 var handleBasic = echarts.init(document.getElementById('echar_div2'));
                    var myData = ['stock', 'dodo', 'eagles', 'stock','eagles']
                    var databeast = {
                        1: [389, 259, 262, 324,156]
                    }
                    var databeauty = {
                        1: [121, 308, 233, 309,222]
                    }
                    var timeLineData = [1]

                    var option = {
                        baseOption: {
                            backgroundColor: '#fff',
                            timeline: {
                                show: false,
                                top: 0,
                                data: []
                            },
                            legend: {
                                show: false
                            },
                            tooltip: {
                                show: true,
                                trigger: 'axis',
                                formatter: '{b}<br/>{a}: {c}人',
                                axisPointer: {
                                    type: 'shadow'
                                }
                            },

                                 grid: [{
                                    show: false,
                                    left: '8%',
                                    top: 0,
                                    bottom: 0,
                                    containLabel: true,
                                    width: '35%'
                                }, {
                                    show: false,
                                    left: '52%',
                                    top: 0,
                                    bottom: 0,
                                    width: '5%'
                                }, {
                                    show: false,
                                    right: '8%',
                                    top: 0,
                                    bottom: 0,
                                    containLabel: true,
                                    width: '35%'
                                }],

                            xAxis: [{
                                type: 'value',
                                inverse: true,
                                axisLine: {
                                    show: false
                                },
                                axisTick: {
                                    show: false
                                },
                                position: 'top',
                                axisLabel: {
                                    show: false
                                },
                                splitLine: {
                                    show: false
                                }
                            }, {
                                gridIndex: 1,
                                show: false
                            }, {
                                gridIndex: 2,
                                nameTextStyle: {
                                    color: '#50afff',
                                    fontSize: 14
                                },
                                axisLine: {
                                    show: false
                                },
                                axisTick: {
                                    show: false
                                },
                                position: 'top',
                                axisLabel: {
                                    show: false
                                },
                                splitLine: {
                                    show: false
                                }
                            }],
                            yAxis: [{
                                type: 'category',
                                inverse: true,
                                position: 'right',
                                axisLine: {
                                    show: false
                                },
                                axisTick: {
                                    show: false
                                },
                                axisLabel: {
                                    show: false
                                },
                                data: myData
                            }, {
                                gridIndex: 1,
                                type: 'category',
                                inverse: true,
                                position: 'left',
                                axisLine: {
                                    show: false
                                },
                                axisTick: {
                                    show: false
                                },
                                axisLabel: {
                                    show: true,
                                    textStyle: {
                                        color: '#50afff',
                                        fontSize: 14
                                    }

                                },
                                data: myData.map(function(value) {
                                    return {
                                        value: value,
                                        textStyle: {
                                            align: 'center'
                                        }
                                    }
                                })
                            }, {
                                gridIndex: 2,
                                type: 'category',
                                inverse: true,
                                position: 'left',
                                axisLine: {
                                    show: false
                                },
                                axisTick: {
                                    show: false
                                },
                                axisLabel: {
                                    show: false

                                },
                                data: myData
                            }],
                            series: []

                        },
                        options: []
                    }

                    option.baseOption.timeline.data.push(timeLineData[0])
                    option.options.push({
                        tooltip: {
                            trigger: 'axis',
                            formatter: '{b}<br/>{c} {a}'
                        },
                        series: [{
                            name: '座',
                            type: 'bar',
                            barWidth: 10,
                            label: {
                                normal: {
                                    show: true,
                                    position: 'left',
                                    offset: [0, 0],
                                    textStyle: {
                                        color: '#fff',
                                        fontSize: 14
                                    }
                                }
                            },
                            itemStyle: {
                                normal: {
                                    color: '#4ca8f6',
                                    barBorderRadius: 50
                                }
                            },

                            data: databeast[timeLineData[0]]
                        }, {
                            name: '万延米',
                            type: 'bar',
                            barWidth: 10,
                            xAxisIndex: 2,
                            yAxisIndex: 2,
                            label: {
                                normal: {
                                    show: true,
                                    position: 'right',
                                    offset: [0, 0],
                                    textStyle: {
                                        color: '#fff',
                                        fontSize: 14
                                    }
                                }
                            },
                            itemStyle: {
                                normal: {
                                    color: '#00d484',
                                    barBorderRadius: 50
                                }
                            },
                            data: databeauty[timeLineData[0]]
                        }]
                    })
                 handleBasic.setOption(option, true);
            },
            //问题处理周期
            handleState(){
                   var handleState = echarts.init(document.getElementById('echar_div3'));
                    option = {
                        title : {
                            text: '',
                            subtext: '',
                            x:'center'
                        },
                        tooltip : {
                            trigger: 'item',
                            formatter: "{a} <br/>{b} : {c} ({d}%)"
                        },
                        color:['rgb(243,100,124)', 'rgb(251,212,56)','rgb(55,204,204)','rgb(59,161,255)'],
                        legend: {
                            // orient: 'vertical',
                             x: 'center',
                              y: 33,
                            data: ['1天以上','1-3天','3-7天','7天以上']
                        },
                        series : [
                            {
                                name: '访问来源',
                                type: 'pie',
                                radius: ['40%', '60%'],
                                center: ['50%', '55%'],
                                data:[
                                    {value:335, name:'1天以上'},
                                    {value:310, name:'1-3天'},
                                    {value:234, name:'3-7天'},
                                    {value:135, name:'7天以上'},
                                ],
                                itemStyle: {
                                    emphasis: {
                                        shadowBlur: 10  ,
                                        shadowOffsetX: 0,
                                        shadowColor: 'rgba(0, 0, 0, 0.5)'
                                    }
                                },
                            }
                        ]
                    };
                 handleState.setOption(option, true);
            },
            //紧急程度
            emergency(){
                 var emergency = echarts.init(document.getElementById('echar_div4'));
                    option = {
                        title : {
                            text: '',
                            subtext: '',
                            x:'center'
                        },
                        tooltip : {
                            trigger: 'item',
                            formatter: "{a} <br/>{b} : {c} ({d}%)"
                        },
                        color:['rgb(59,161,255)', 'rgb(251,212,56)','rgb(243,100,124)'],
                        legend: {
                            // orient: 'vertical',
                             x: 'center',
                              y: 33,
                            data: ['优化','常规','紧急']
                        },
                        series : [
                            {
                                name: '访问来源',
                                type: 'pie',
                                // radius: ['50%', '70%'],
                                radius : '55%',
                                center: ['50%', '70%'],
                                data:[
                                    {value:335, name:'优化'},
                                    {value:310, name:'常规'},
                                    {value:234, name:'紧急'},
                                ],
                                itemStyle: {
                                    emphasis: {
                                        shadowBlur: 10  ,
                                        shadowOffsetX: 0,
                                        shadowColor: 'rgba(0, 0, 0, 0.5)'
                                    }
                                },
                            }
                        ]
                    };
                 emergency.setOption(option, true);
            },
            //处理进度
            handlePro(){
                 var handlePro = echarts.init(document.getElementById('echar_div5'));
                 option = {
                    title: {
                        text: ''
                    },
                    tooltip : {
                        trigger: 'axis',
                        axisPointer: {
                            type: 'cross',
                            label: {
                                backgroundColor: '#6a7985'
                            }
                        }
                    },
                    legend: {
                        data:['已提交','已处理'],
                        y: 28,
                    },
                    grid: {
                        left: '3%',
                        right: '4%',
                        bottom: '3%',
                        containLabel: true
                    },
                    xAxis : [
                        {
                            type : 'category',
                            boundaryGap : false,
                            data : ['周一','周二','周三','周四','周五','周六','周日']
                        }
                    ],
                    yAxis : [
                        {
                            type : 'value'
                        }
                    ],
                    series : [
                        {
                            name:'已提交',
                            type:'line',
                            stack: '总量',
                            areaStyle: {normal: {}},
                            data:[120, 132, 101, 134, 90, 230, 210],
                            itemStyle:{  
                                normal:{  
                                    barBorderColor:'#000',  
                                    color:'rgb(28,146,255)'
                                },
                            }
                        },
                        {
                            name:'已处理',
                            type:'line',
                            stack: '总量',
                            areaStyle: {normal: {}},
                            data:[220, 182, 191, 234, 290, 330, 310],
                              itemStyle:{  
                                normal:{  
                                    barBorderColor:'#000',  
                                    color:'rgb(50,195,255)'
                                },
                            }
                        }
                    ]
                };
                 handlePro.setOption(option, true);
            },
            //问题类型
            proType(){
                 var proType = echarts.init(document.getElementById('echar_div6'));
                    option = {
                        color: ['#3398DB'],
                        tooltip : {
                            trigger: 'axis',
                            axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                                type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
                            }
                        },
                        grid: {
                            left: '3%',
                            right: '4%',
                            bottom: '3%',
                            containLabel: true
                        },
                        xAxis : [
                            {
                                type : 'category',
                                data : ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                                axisTick: {
                                    alignWithLabel: true
                                }
                            }
                        ],
                        yAxis : [
                            {
                                type : 'value'
                            }
                        ],
                        series : [
                            {
                                name:'直接访问',
                                type:'bar',
                                barWidth: '60%',
                                data:[10, 52, 200, 334, 390, 330, 220]
                            }
                        ]
                    };
                 proType.setOption(option, true);
            },
            //处理方式表1
            biao1(){
                 var biao1 = echarts.init(document.getElementById('echar_div7'));
                    option = {
                        tooltip : {
                            formatter: "{a} <br/>{b} : {c}%"
                        },
                        toolbox: {
                        },
                        series: [
                            {
                                name: '水表',
                                type: 'gauge',
                                center: ['25%', '40%'],
                                radius: '60%',
                                detail: {formatter:'{value}%'},
                                data: [{value:60, name: '完成率'}],
                                axisLine: { // 坐标轴线
                                    lineStyle: { // 属性lineStyle控制线条样式
                                        color: [
                                            [0.09, 'lime'],//9处的颜色
                                            [0.82, '#1e90ff'],//82处的颜色
                                            [1, '#ff4500']//100%处的颜色
                                        ],
                                        width: 13,
                                    }
                                },
                                 title: {   //仪表盘标题
                                    show: true,
                                    offsetCenter: ['0', '40'],
                                    textStyle: {
                                        color: '#444A56',
                                        fontSize: 16,
                                        fontFamily: 'Microsoft YaHei'
                                    }
                                },
                                detail: {
                                    formatter : "{score|{value}%}",
                                    offsetCenter: [0, "40%"],
                                    color: '#000',
                                    height:-70,
                                    rich : {
                                        score : {
                                            color : "#000",
                                            fontFamily : "微软雅黑",
                                            fontSize : 32
                                        }
                                    }
                                },
                                pointer : { //指针样式
                                    length: '45%'
                                },
                                splitLine: { // 分隔线
                                    length: 10, // 属性length控制线长
                                    lineStyle: { // 属性lineStyle（详见lineStyle）控制线条样式
                                        width: 3,
                                        color: '#fff',
                                        shadowColor: '#fff', //默认透明
                                        shadowBlur: 1
                                    }
                                },
                            }
                        ]
                    };
                        option.series[0].data[0].value = 60;
                        biao1.setOption(option, true); 
            },
            //处理方式表2
            biao2(){
                 var biao2 = echarts.init(document.getElementById('echar_div8'));
                     option = {
                        tooltip : {
                            formatter: "{a} <br/>{b} : {c}%"
                        },
                        toolbox: {
                        },
                        series: [
                            {
                                name: '业务指标',
                                type: 'gauge',
                                center: ['70%', '40%'],
                                radius: '60%',
                                detail: {formatter:'{value}%'},
                                data: [{value:20, name: '完成率'}],
                                axisLine: { // 坐标轴线
                                    lineStyle: { // 属性lineStyle控制线条样式
                                        color: [
                                            [0.09, 'lime'],//9处的颜色
                                            [0.82, '#1e90ff'],//82处的颜色
                                            [1, '#ff4500']//100%处的颜色
                                        ],
                                        width: 13,
                                    }
                                },
                                 title: {   //仪表盘标题
                                    show: true,
                                    offsetCenter: ['0', '40'],
                                    textStyle: {
                                        color: '#444A56',
                                        fontSize: 16,
                                        fontFamily: 'Microsoft YaHei'
                                    }
                                },
                                detail: {
                                    formatter : "{score|{value}%}",
                                    offsetCenter: [0, "40%"],
                                    color: '#000',
                                    height:-70,
                                    rich : {
                                        score : {
                                            color : "#000",
                                            fontFamily : "微软雅黑",
                                            fontSize : 32
                                        }
                                    }
                                },
                                pointer : { //指针样式
                                    length: '45%'
                                },
                                splitLine: { // 分隔线
                                    length: 10, // 属性length控制线长
                                    lineStyle: { // 属性lineStyle（详见lineStyle）控制线条样式
                                        width: 3,
                                        color: '#fff',
                                        shadowColor: '#fff', //默认透明
                                        shadowBlur: 1
                                    }
                                },
                            }
                        ]
                    };
                        option.series[0].data[0].value = 20;
                         biao2.setOption(option, true); 
            }
        }
    });

</script>

</html>
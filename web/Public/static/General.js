
    var myChart = echarts.init(document.getElementById('xmfl_echarts'));
    var data = [
    [
        [
            33,
            0.14224137931034483,
            232,
            "计算机科学与教育软件学院",
            "15届"
        ],
        [
            99,
            0.668918918918919,
            148,
            "地理科学学院",
            "15届"
        ],
        [
            57,
            0.15447154471544716,
            369,
            "机械与电气工程学院",
            "15届"
        ],
        [
            368,
            0.6996197718631179,
            526,
            "经济与统计学院",
            "15届"
        ],
        [
            66,
            0.1935483870967742,
            341,
            "土木工程学院",
            "15届"
        ],
        [
            300,
            0.7537688442211056,
            398,
            "新闻与传播学院",
            "15届"
        ],
        [
            236,
            0.8939393939393939,
            264,
            "外国语学院",
            "15届"
        ],
        [
            230,
            0.888030888030888,
            259,
            "人文学院",
            "15届"
        ],
        [
            89,
            0.5493827160493827,
            162,
            "数学与信息科学学院",
            "15届"
        ],
        [
            334,
            0.6693386773547094,
            499,
            "工商管理学院",
            "15届"
        ],
        [
            131,
            0.7443181818181818,
            176,
            "法学院",
            "15届"
        ],
        [
            120,
            0.7361963190184049,
            163,
            "公共管理学院",
            "15届"
        ],
        [
            3,
            1.0,
            3,
            "卫斯理安学院",
            "15届"
        ],
        [
            14,
            0.6666666666666666,
            21,
            "政治与公民教育学院",
            "15届"
        ],
        [
            153,
            0.7846153846153846,
            195,
            "旅游学院",
            "15届"
        ],
        [
            158,
            0.7821782178217822,
            202,
            "教育学院",
            "15届"
        ],
        [
            46,
            0.4842105263157895,
            95,
            "环境科学与工程学院",
            "15届"
        ],
        [
            118,
            0.5728155339805825,
            206,
            "化学化工学院",
            "15届"
        ],
        [
            37,
            0.22424242424242424,
            165,
            "物理与电子工程学院",
            "15届"
        ],
        [
            67,
            0.4785714285714286,
            140,
            "建筑与城市规划学院",
            "15届"
        ],
        [
            167,
            0.5921985815602837,
            282,
            "美术与设计学院",
            "15届"
        ],
        [
            67,
            0.6146788990825688,
            109,
            "生命科学学院",
            "15届"
        ],
        [
            7,
            0.07142857142857142,
            98,
            "体育学院",
            "15届"
        ],
        [
            101,
            0.7769230769230769,
            130,
            "音乐舞蹈学院",
            "15届"
        ]
    ],
    [
        [
            83,
            0.47701149425287354,
            174,
            "地理科学学院",
            "14届"
        ],
        [
            30,
            0.08356545961002786,
            359,
            "机械与电气工程学院",
            "14届"
        ],
        [
            6,
            0.6666666666666666,
            9,
            "工商管理学院",
            "14届"
        ],
        [
            98,
            0.6901408450704225,
            142,
            "法学院",
            "14届"
        ],
        [
            101,
            0.6121212121212121,
            165,
            "公共管理学院",
            "14届"
        ],
        [
            79,
            0.48466257668711654,
            163,
            "数学与信息科学学院",
            "14届"
        ],
        [
            33,
            0.25384615384615383,
            130,
            "环境科学与工程学院",
            "14届"
        ],
        [
            76,
            0.4342857142857143,
            175,
            "化学化工学院",
            "14届"
        ],
        [
            127,
            0.7650602409638554,
            166,
            "教育学院",
            "14届"
        ],
        [
            35,
            0.33653846153846156,
            104,
            "计算机科学与教育软件学院",
            "14届"
        ],
        [
            10,
            0.7692307692307693,
            13,
            "经济与统计学院",
            "14届"
        ],
        [
            51,
            0.20647773279352227,
            247,
            "土木工程学院",
            "14届"
        ],
        [
            40,
            0.2185792349726776,
            183,
            "物理与电子工程学院",
            "14届"
        ],
        [
            51,
            0.4214876033057851,
            121,
            "建筑与城市规划学院",
            "14届"
        ],
        [
            136,
            0.7640449438202247,
            178,
            "旅游学院",
            "14届"
        ],
        [
            157,
            0.6356275303643725,
            247,
            "美术与设计学院",
            "14届"
        ],
        [
            168,
            0.835820895522388,
            201,
            "人文学院",
            "14届"
        ],
        [
            47,
            0.2974683544303797,
            158,
            "生命科学学院",
            "14届"
        ],
        [
            16,
            0.15384615384615385,
            104,
            "体育学院",
            "14届"
        ],
        [
            165,
            0.8918918918918919,
            185,
            "外国语学院",
            "14届"
        ],
        [
            235,
            0.7704918032786885,
            305,
            "新闻与传播学院",
            "14届"
        ],
        [
            90,
            0.8108108108108109,
            111,
            "音乐舞蹈学院",
            "14届"
        ]
    ],
    [
        [
            64,
            0.44755244755244755,
            143,
            "地理科学学院",
            "13届"
        ],
        [
            101,
            0.7372262773722628,
            137,
            "法学院",
            "13届"
        ],
        [
            147,
            0.7616580310880829,
            193,
            "教育学院",
            "13届"
        ],
        [
            113,
            0.6848484848484848,
            165,
            "公共管理学院",
            "13届"
        ],
        [
            55,
            0.3525641025641026,
            156,
            "环境科学与工程学院",
            "13届"
        ],
        [
            4,
            0.8,
            5,
            "工商管理学院",
            "13届"
        ],
        [
            69,
            0.3150684931506849,
            219,
            "化学化工学院",
            "13届"
        ],
        [
            48,
            0.2222222222222222,
            216,
            "物理与电子工程学院",
            "13届"
        ],
        [
            5,
            0.053763440860215055,
            93,
            "计算机科学与教育软件学院",
            "13届"
        ],
        [
            23,
            0.0749185667752443,
            307,
            "机械与电气工程学院",
            "13届"
        ],
        [
            130,
            0.6701030927835051,
            194,
            "旅游学院",
            "13届"
        ],
        [
            152,
            0.9047619047619048,
            168,
            "外国语学院",
            "13届"
        ],
        [
            2,
            1.0,
            2,
            "经济与统计学院",
            "13届"
        ],
        [
            51,
            0.38636363636363635,
            132,
            "建筑与城市规划学院",
            "13届"
        ],
        [
            82,
            0.5616438356164384,
            146,
            "数学与信息科学学院",
            "13届"
        ],
        [
            172,
            0.6539923954372624,
            263,
            "美术与设计学院",
            "13届"
        ],
        [
            175,
            0.8293838862559242,
            211,
            "人文学院",
            "13届"
        ],
        [
            213,
            0.7526501766784452,
            283,
            "新闻与传播学院",
            "13届"
        ],
        [
            72,
            0.35467980295566504,
            203,
            "生命科学学院",
            "13届"
        ],
        [
            47,
            0.1649122807017544,
            285,
            "土木工程学院",
            "13届"
        ],
        [
            12,
            0.10909090909090909,
            110,
            "体育学院",
            "13届"
        ],
        [
            86,
            0.7962962962962963,
            108,
            "音乐舞蹈学院",
            "13届"
        ]
    ]
];
isShowCollege2 = 0
isShowCollege3 = 0
isShowCollege4 = 0
option = {
    tooltip: {
        trigger: "item",
        formatter: function(params) {
            return params.value[3] + ":" + parseInt(params.value[1] * 1000) / 10 + "%"
        }
    },
    grid: {
        top:'12%',
        left: '2%;',
        right: '2%',
        bottom: '2%',
        containLabel: true
    },
    toolbox: {
        left: "160",
        feature: {
            saveAsImage: {
                show: true
            },
            myshowcollege2: {
                show: true,
                icon: "image://http://omudx2uw8.bkt.clouddn.com/ring0.jpg",
                title: "显示15届学院名称",
                onclick: function() {
                    // alert("好")
                    if (isShowCollege2 == 0) {
                        myChart.setOption({
                            series: [{
                                label: {
                                    normal: {
                                        formatter: function(param) {
                                            return param.data[3];
                                        }
                                    }
                                }
                            }]
                        })
                        isShowCollege2 = 1
                    } else {
                        myChart.setOption({
                            series: [{
                                label: {
                                    normal: {
                                        formatter: ""
                                    }
                                }
                            }]
                        })
                        isShowCollege2 = 0
                    }
                }
            },
            myshowcollege3: {
                show: true,
                icon: "image://http://omudx2uw8.bkt.clouddn.com/ring0.jpg",
                title: "显示14届学院名称",
                onclick: function() {
                    // alert("好")
                    if (isShowCollege3 == 0) {
                        myChart.setOption({
                            series: [{}, {
                                label: {
                                    normal: {
                                        formatter: function(param) {
                                            return param.data[3];
                                        }
                                    }
                                }
                            }]
                        })
                        isShowCollege3 = 1
                    } else {
                        myChart.setOption({
                            series: [{}, {
                                label: {
                                    normal: {
                                        formatter: ""
                                    }
                                }
                            }]
                        })
                        isShowCollege3 = 0
                    }
                }
            },
            myshowcollege4: {
                show: true,
                icon: "image://http://omudx2uw8.bkt.clouddn.com/ring0.jpg",
                title: "显示13届学院名称",
                onclick: function() {
                    if (isShowCollege4 == 0) {
                        myChart.setOption({
                            series: [{}, {}, {
                                label: {
                                    normal: {
                                        formatter: function(param) {
                                            return param.data[3];
                                        }
                                    }
                                }
                            }]
                        })
                        isShowCollege4 = 1
                    } else {
                        myChart.setOption({
                            series: [{}, {}, {
                                label: {
                                    normal: {
                                        formatter: ""
                                    }
                                }
                            }]
                        })
                        isShowCollege4 = 0
                    }
                }
            }
        }
    },
    backgroundColor: new echarts.graphic.RadialGradient(0, 0, 0, [{
        offset: 0,
        color: '#FFF'
    },
     {
        offset: 1,
        color: '#cdd0d5'
    }]),
    legend: {
        top:'-2%',
        right: 10,
        data: ['15届', '14届', "13届"]
    },
    xAxis: {
        name: "女生数量",
        splitLine: {
            lineStyle: {
                type: 'dashed'
            }
        }
    },
    yAxis: {
        name: "女生占比",
        splitLine: {
            lineStyle: {
                type: 'dashed'
            }
        },
        scale: true
    },
    series: [{
        name: '15届',
        data: data[0],
        type: 'scatter',
        symbolSize: function(data) {
            return Math.sqrt(data[2]) * 2;
        },
        label: {
            normal: {
                show: true,
                formatter: "",
                position: 'top',

            },
            emphasis: {
                show: true,
                formatter: function(param) {
                    return param.data[3];
                },
                position: 'top'
            }
        },
        itemStyle: {
            normal: {
                shadowBlur: 10,
                shadowColor: 'rgba(120, 36, 50, 0.5)',
                shadowOffsetY: 5,
                color: new echarts.graphic.RadialGradient(0.4, 0.3, 1, [{
                    offset: 0,
                    color: 'rgb(251, 118, 123)'
                }, {
                    offset: 1,
                    color: 'rgb(204, 46, 72)'
                }])
            }
        }
    }, {
        name: '14届',
        data: data[1],
        type: 'scatter',
        symbolSize: function(data) {
            return Math.sqrt(data[2]) * 2;
        },
        label: {
            normal: {
                show: true,
                formatter: "",
                position: 'top'
            },
            emphasis: {
                show: true,
                formatter: function(param) {
                    return param.data[3];
                },
                position: 'top'
            }
        },
        itemStyle: {
            normal: {
                shadowBlur: 10,
                shadowColor: 'rgba(25, 100, 150, 0.5)',
                shadowOffsetY: 5,
                color: new echarts.graphic.RadialGradient(0.4, 0.3, 1, [{
                    offset: 0,
                    color: 'rgb(129, 227, 238)'
                }, {
                    offset: 1,
                    color: 'rgb(25, 183, 207)'
                }])
            }
        }
    }, {
        name: '13届',
        data: data[2],
        type: 'scatter',
        symbolSize: function(data) {
            return Math.sqrt(data[2]) * 2;
        },
        label: {
            normal: {
                show: true,
                formatter: "",
                position: 'top'
            },
            emphasis: {
                show: true,
                formatter: function(param) {
                    return param.data[3];
                },
                position: 'top'
            }
        },
        itemStyle: {
            normal: {
                shadowBlur: 10,
                shadowColor: 'rgba(25, 100, 150, 0.5)',
                shadowOffsetY: 5,
                color: new echarts.graphic.RadialGradient(0.4, 0.3, 1, [{
                    offset: 0,
                    color: 'rgb(52, 128, 256)'
                }, {
                    offset: 1,
                    color: 'rgb(52, 52, 207)'
                }])
            }
        }
    }]
};
    myChart.setOption(option);


    var myChart1 = echarts.init(document.getElementById('jfxmry_echarts'));
option1 = {
    tooltip: {
        trigger: 'item',
        formatter: "{b} : {d}% <br/> {c}"
    },
    legend: {
        orient: 'horizontal',
        icon: 'circle',
        top: '-2%',
        x: 'center',
        textStyle: {
            color: ['#0E7CE2', '#FF8352', '#E271DE', '#F8456B', '#00FFFF', '#4AEAB0']
        },
        data: ['五保', '低保', '残疾', '失独', '重点优抚', '突出贡献']
    },
    series: [{
        type: 'pie',
        radius: ['40%', '50%'],
        center: ['50%', '50%'],
        color: ['#0E7CE2', '#FF8352', '#E271DE', '#F8456B', '#00FFFF', '#4AEAB0'],
        data: [{
                value: 335,
                name: '五保'
            },
            {
                value: 310,
                name: '低保'
            },
            {
                value: 234,
                name: '残疾'
            },
            {
                value: 235,
                name: '失独'
            },
            {
                value: 254,
                name: '重点优抚'
            },
            {
                value: 174,
                name: '突出贡献'
            }
        ],
        labelLine: {
            normal: {
                show: true,
                length: 10,
                length2: 10,
                lineStyle: {
                    color: '#12EABE',
                    width: 2
                }
            }
        },
        label: {
            normal: {
                formatter: '{c|{c}}\n{hr|}\n{d|{d}%}',
                rich: {
                    b: {
                        fontSize: 20,
                        color: '#12EABE',
                        align: 'left',
                        padding: 4
                    },
                    hr: {
                        borderColor: '#12EABE',
                        width: '100%',
                        borderWidth: 2,
                        height: 0
                    },
                    d: {
                        fontSize: 20,
                        color: ['#0E7CE2', '#FF8352', '#E271DE', '#F8456B', '#00FFFF', '#4AEAB0'],
                        align: 'left',
                        padding: 4
                    },
                    c: {
                        fontSize: 20,
                        color: ['#0E7CE2', '#FF8352', '#E271DE', '#F8456B', '#00FFFF', '#4AEAB0'],
                        align: 'left',
                        padding: 4
                    }
                }
            }
        }
    }]
};
myChart1.setOption(option1);


    var myChart2 = echarts.init(document.getElementById('xmntbqs_echarts'));
    var symbolSize = 10;
var data = [
    ['Jan', 100],
    ['Feb', 90],
    ['Mar', 310],
    ['Apr', 190],
    ['May', 200],
    ['Jun', 160]
];

option2 = {
    tooltip: {
        trigger: 'axis'
    },
    legend: {
        x: 'right',                         
        y: '0',  
        // orient: 'vertical',
        data: ['Current Year', 'Last Year']
    },
    grid: {
        top:'10%',
        left: '2%;',
        right: '2%',
        bottom: '2%',
        containLabel: true
    },
    xAxis: {
        type: 'category',
        boundaryGap: false,
        data: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun']
    },
    yAxis: {
        type: 'value'
    },
    series: [{
        id: 'a',
        name: 'Current Year',
        type: 'line',
        smooth: true,
        symbolSize: symbolSize,
        data: data
    }, {
        name: 'Last Year',
        type: 'line',
        smooth: true,
        data: [
            ['Jan', 250],
            ['Feb', 340],
            ['Mar', 250],
            ['Apr', 340],
            ['May', 250],
            ['Jun', 270]
        ]
    }]
}

myChart.on('dataZoom', updatePosition);

function updatePosition() {
    myChart.setOption({
        graphic: echarts.util.map(data, function(item, dataIndex) {
            return {
                position: myChart.convertToPixel('grid', item)
            };
        })
    });
}

function showTooltip(dataIndex) {
    myChart.dispatchAction({
        type: 'showTip',
        seriesIndex: 0,
        dataIndex: dataIndex
    });
}

function hideTooltip(dataIndex) {
    myChart.dispatchAction({
        type: 'hideTip'
    });
}

function onPointDragging(dataIndex, dx, dy) {
    var value = myChart.convertFromPixel('grid', this.position);
    data[dataIndex][1] = value[1].toFixed(0);
    // Update data
    myChart.setOption({
        series: [{
            id: 'a',
            data: data
        }]
    });
}
    myChart2.setOption(option2);


    var myChart3 = echarts.init(document.getElementById('jfxmryqs_echarts'));
    var generateData = function() {
    return Array.apply(null, {
        length: 7
    }).map(function(item, index) {
        return Math.round(Math.random() * 25 + 5);
    });
}
option3 = {
    grid: {
        top:'10%',
        left: '0%',
        right: '0%',
        bottom: '2%',
        containLabel: true
    },
    legend: {
        top:'0',
        right:'5%',
        data: ['流失人员', '流入人员']
    },
    xAxis: {
        boundaryGap: false,
        data: ['1月', '2月', '3月', '4月', '5月', '6月', '7月']
    },
    yAxis: {
        axisLabel: {
            formatter: function(value) {
                return value ? value + 'GB' : ''
            }
        },
        axisTick: {
            show: false
        },
        splitLine: {
            show:false,
            lineStyle: {
                color: "#063374",
            }
        }
    },
    tooltip: {
        trigger: 'axis'
    },
    series: [{
        name: '流失人员',
        type: 'line',
        itemStyle: {
            normal: {
                color: 'rgba(30,202,204,1)'
            }
        },
        areaStyle: {
            normal: {
                color: 'rgba(30,202,204,0.9)'
            }
        },
        data: generateData()
    }, {
        name: '流入人员',
        type: 'line',
        itemStyle: {
            normal: {
                color: 'rgba(187,166,287,1)'
            }
        },
        areaStyle: {
            normal: {
                color: 'rgba(187,166,287,0.9)'
            }
        },
        data: generateData()
    }]
};
myChart3.setOption(option3);


    // 类型切换
    $(".xxx_module>span").click(function(){
        $(this).siblings('span').removeClass();
        $(this).addClass('xxx_type');
    })
    var myChart4 = echarts.init(document.getElementById('xxx_echarts'));
    option4 = {
    grid: {
        top:'5%',
        left: '0%',
        right: '0%',
        bottom: '2%',
        containLabel: true
    },
    xAxis: [{
        type: 'category',
        data: ['分组一',
            '分组二',
            '分组三',
            '分组四',
            '分组五',
            '分组六'
        ],
        axisLine: {
            show: false,
            lineStyle: {
                color: "#063374",
                width: 1,
                type: "solid"
            }
        },
        axisTick: {
            show: false
        },
        axisLabel: {
            show: true,
            textStyle: {
                color: "#595959",
            }
        },
    }],
    yAxis: [{
        type: 'value',
        axisLabel: {
            formatter: '{value} %'
        },
        axisLine: {
            show: false,
            lineStyle: {
                color: "#00c7ff",
                width: 1,
                type: "solid"
            },
        },
        axisTick: {
            show: false
        },
        splitLine: {
            show:false,
            lineStyle: {
                color: "#063374",
            }
        }
    }],
    series: [{
        type: 'bar',
        data: [20, 50, 80, 58, 83, 68],
        barWidth: 35, //柱子宽度
        barGap: 1, //柱子之间间距
        itemStyle: {
            normal: {
                color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
                    offset: 0,
                    color: '#00fcae'
                }, {
                    offset: 1,
                    color: '#006388'
                }]),
                opacity: 1,
            }
        }
    }]
};
    myChart4.setOption(option4);



var myChart5 = echarts.init(document.getElementById('ditu'));
option5 = {
    tooltip: {
            trigger: 'item',
            triggerOn: 'mousemove',
            backgroundColor:'rgba(0,0,0,.8)',
            borderColor: '#3574c8',
            borderWidth: '2',
            extraCssText: 'padding:10px;box-shadow: 0 0 3px rgba(0, 0, 0, 0.3);',
            show: true,
            formatter: function(params) {
                var res;
                if (params.value > 0) {
                	res = params.data.value2 + '<br/>';
                    res += params.data.value3;
                } else {
                    res = '';
                }
                return res;
            }
        
    },
    visualMap: {
        min: 0,
        max: 7,
        left: 'left',
        top: 'bottom',
        text: ['高', '低'],
        calculable: true,
        show:false,
        inRange: {
            color: ['#ffffff', '#ffc188', '#479fd2', '#fba853', '#48c7c0', '#fa8737', '#4bbdd6', '#ff6f5b']
        }
        //北京：1      四川：2    河南：3     内蒙：4     安徽：5    新疆：6     福建：7 
    },
    geo: {
        map: 'china',
        zoom: 1.2,
        label: {
            normal: {
                show: true,
                color: '#333'
            },
            emphasis: {
                show: true,
                color: '#fff'
            }
        },
        itemStyle: {
            normal: {
                areaColor: '#fbfbfb',
                borderColor: '#fff',
            },
            emphasis: {
                areaColor: '#3574c8'
            }
        }
    },
    series: [ {
        type: 'map',
        mapType: 'china',
        geoIndex: 0,
        label: {
            normal: {
                show: true
            },
            emphasis: {
                show: true
            }
        },
        data: [{
            name: '北京',
            value: 1,
            value2:'京津冀地区',
            value3:'包括北京、天津、河北（环京津部分）。<br />选择自然条件较为优越、年均降水量在 600 毫米左右的适宜区域，<br />发展杨树、刺槐、榆树、柳树等乡土树种用材林和落叶松、<br />樟子松、油松、侧柏等珍稀树种和大径级用材林。'
        }, {
            name: '天津',
            value: 1,
            value2:'京津冀地区',
            value3:'包括北京、天津、河北（环京津部分）。<br />选择自然条件较为优越、年均降水量在 600 毫米左右的适宜区域，<br />发展杨树、刺槐、榆树、柳树等乡土树种用材林和落叶松、<br />樟子松、油松、侧柏等珍稀树种和大径级用材林。'
        }, {
            name: '河北',
            value: 1,
            value2:'京津冀地区',
            value3:'包括北京、天津、河北（环京津部分）。<br />选择自然条件较为优越、年均降水量在 600 毫米左右的适宜区域，<br />发展杨树、刺槐、榆树、柳树等乡土树种用材林和落叶松、<br />樟子松、油松、侧柏等珍稀树种和大径级用材林。'
        }, {
            name: '重庆',
            value: 2,
            value2:'西南适宜地区',
            value3:'自然条件较为优越，年均降水量在 800 毫米以上。<br />在适宜地区培育桢楠、红椿、降香黄檀、铁刀木<br />等珍稀树种和大径级用材林。'
        }, {
            name: '云南',
            value: 2,
            value2:'西南适宜地区',
            value3:'自然条件较为优越，年均降水量在 800 毫米以上。<br />在适宜地区培育桢楠、红椿、降香黄檀、铁刀木<br />等珍稀树种和大径级用材林。'
        }, {
            name: '贵州',
            value: 2,
            value2:'西南适宜地区',
            value3:'自然条件较为优越，年均降水量在 800 毫米以上。<br />在适宜地区培育桢楠、红椿、降香黄檀、铁刀木<br />等珍稀树种和大径级用材林。'
        }, {
            name: '四川',
            value: 2,
            value2:'西南适宜地区',
            value3:'自然条件较为优越，年均降水量在 800 毫米以上。<br />在适宜地区培育桢楠、红椿、降香黄檀、铁刀木<br />等珍稀树种和大径级用材林。'
        }, {
            name: '河南',
            value: 3,
            value2:'黄淮海地区',
            value3:'自然条件较为优越，年均降水量多在 600-800 毫米<br />之间。主要培育适宜该区域生长的毛白杨、欧美杨<br />等浆纸和人造板工业原料林，发展栎类、榉树等珍稀树种和<br />大径级用材林。'
        }, {
            name: '山东',
            value: 3,
            value2:'黄淮海地区',
            value3:'自然条件较为优越，年均降水量多在 600-800 毫米<br />之间。主要培育适宜该区域生长的毛白杨、欧美杨<br />等浆纸和人造板工业原料林，发展栎类、榉树等珍稀树种和<br />大径级用材林。'
        },{
            name: '辽宁',
            value: 4,
            value2:'东北地区',
            value3:'选择自然条件较为优越、年均降水量在 400-600 毫米<br />的适宜区域，发展杨树、樟子松、落叶松等中短周期用材林<br />和红松、水曲柳等珍稀树种和大径级用材林。'
        }, {
            name: '黑龙江',
            value: 4,
            value2:'东北地区',
             value3:'选择自然条件较为优越、年均降水量在 400-600 毫米<br />的适宜区域，发展杨树、樟子松、落叶松等中短周期用材林<br />和红松、水曲柳等珍稀树种和大径级用材林。'
        }, {
            name: '内蒙古',
            value: 4,
            value2:'东北地区',
             value3:'选择自然条件较为优越、年均降水量在 400-600 毫米<br />的适宜区域，发展杨树、樟子松、落叶松等中短周期用材林<br />和红松、水曲柳等珍稀树种和大径级用材林。'
        }, {
            name: '吉林',
            value: 4,
            value2:'东北地区',
             value3:'选择自然条件较为优越、年均降水量在 400-600 毫米<br />的适宜区域，发展杨树、樟子松、落叶松等中短周期用材林<br />和红松、水曲柳等珍稀树种和大径级用材林。'
        },{
            name: '湖南',
            value: 5,
            value2:'长江中下游地区',
            value3:'自然条件优越，年均降水量在 1000 毫米以上。<br />主要培育欧美杨和松类、杉类、竹类为主的中短周期用材林，<br />适地适树发展周期较长的楠木、红豆杉、红椿、樟树等<br />珍稀树种和大径级用材林。'
        }, {
            name: '安徽',
            value: 5,
            value2:'长江中下游地区',
            value3:'自然条件优越，年均降水量在 1000 毫米以上。<br />主要培育欧美杨和松类、杉类、竹类为主的中短周期用材林，<br />适地适树发展周期较长的楠木、红豆杉、红椿、樟树等<br />珍稀树种和大径级用材林。'
        }, {
            name: '浙江',
            value: 5,
            value2:'长江中下游地区',
            value3:'自然条件优越，年均降水量在 1000 毫米以上。<br />主要培育欧美杨和松类、杉类、竹类为主的中短周期用材林，<br />适地适树发展周期较长的楠木、红豆杉、红椿、樟树等<br />珍稀树种和大径级用材林。'
        }, {
            name: '江西',
            value: 5,
            value2:'长江中下游地区',
            value3:'自然条件优越，年均降水量在 1000 毫米以上。<br />主要培育欧美杨和松类、杉类、竹类为主的中短周期用材林，<br />适地适树发展周期较长的楠木、红豆杉、红椿、樟树等<br />珍稀树种和大径级用材林。'
        }, {
            name: '湖北',
            value: 5,
            value2:'长江中下游地区',
            value3:'自然条件优越，年均降水量在 1000 毫米以上。<br />主要培育欧美杨和松类、杉类、竹类为主的中短周期用材林，<br />适地适树发展周期较长的楠木、红豆杉、红椿、樟树等<br />珍稀树种和大径级用材林。'
        }, {
            name: '江苏',
            value: 5,
            value2:'长江中下游地区',
            value3:'自然条件优越，年均降水量在 1000 毫米以上。<br />主要培育欧美杨和松类、杉类、竹类为主的中短周期用材林，<br />适地适树发展周期较长的楠木、红豆杉、红椿、樟树等<br />珍稀树种和大径级用材林。'
        }, {
            name: '新疆',
            value: 6,
            value2:'西北地区',
            value3:'选择自然条件较为优越、年均降水量在 200-600毫米<br />或具有灌溉基础的绿洲适宜区域，发展杨树、榆树、落叶松、夏橡等<br />中短周期用材林，云杉、水曲柳等珍稀树种和大径级用材林。'
        }, {
            name: '甘肃',
            value: 6,
            value2:'西北地区',
            value3:'选择自然条件较为优越、年均降水量在 200-600毫米<br />或具有灌溉基础的绿洲适宜区域，发展杨树、榆树、落叶松、夏橡等<br />中短周期用材林，云杉、水曲柳等珍稀树种和大径级用材林。'
        }, {
            name: '山西',
            value: 6,
            value2:'西北地区',
            value3:'选择自然条件较为优越、年均降水量在 200-600毫米<br />或具有灌溉基础的绿洲适宜区域，发展杨树、榆树、落叶松、夏橡等<br />中短周期用材林，云杉、水曲柳等珍稀树种和大径级用材林。'
        }, {
            name: '青海',
            value: 6,
            value2:'西北地区',
            value3:'选择自然条件较为优越、年均降水量在 200-600毫米<br />或具有灌溉基础的绿洲适宜区域，发展杨树、榆树、落叶松、夏橡等<br />中短周期用材林，云杉、水曲柳等珍稀树种和大径级用材林。'
        }, {
            name: '陕西',
            value: 6,
            value2:'西北地区',
            value3:'选择自然条件较为优越、年均降水量在 200-600毫米<br />或具有灌溉基础的绿洲适宜区域，发展杨树、榆树、落叶松、夏橡等<br />中短周期用材林，云杉、水曲柳等珍稀树种和大径级用材林。'
        }, {
            name: '宁夏',
            value: 6,
            value2:'西北地区',
            value3:'选择自然条件较为优越、年均降水量在 200-600毫米<br />或具有灌溉基础的绿洲适宜区域，发展杨树、榆树、落叶松、夏橡等<br />中短周期用材林，云杉、水曲柳等珍稀树种和大径级用材林。'
        },{
            name: '广西',
            value: 7,
            value2:'西北地区',
            value3:'选择自然条件较为优越、年均降水量在 200-600毫米<br />或具有灌溉基础的绿洲适宜区域，发展杨树、榆树、落叶松、夏橡等<br />中短周期用材林，云杉、水曲柳等珍稀树种和大径级用材林。'
        },  {
            name: '福建',
            value: 7,
            value2:'西北地区',
            value3:'选择自然条件较为优越、年均降水量在 200-600毫米<br />或具有灌溉基础的绿洲适宜区域，发展杨树、榆树、落叶松、夏橡等<br />中短周期用材林，云杉、水曲柳等珍稀树种和大径级用材林。'
        },  {
            name: '广东',
            value: 7,
            value2:'西北地区',
            value3:'选择自然条件较为优越、年均降水量在 200-600毫米<br />或具有灌溉基础的绿洲适宜区域，发展杨树、榆树、落叶松、夏橡等<br />中短周期用材林，云杉、水曲柳等珍稀树种和大径级用材林。'
        }, {
            name: '海南',
            value: 7,
            value2:'西北地区',
            value3:'选择自然条件较为优越、年均降水量在 200-600毫米<br />或具有灌溉基础的绿洲适宜区域，发展杨树、榆树、落叶松、夏橡等<br />中短周期用材林，云杉、水曲柳等珍稀树种和大径级用材林。'
        }, {
            name: '上海',
            value: 0
        }, {
            name: '西藏',
            value: 0
        }, {
            name: '台湾',
            value: 0
        }, {
            name: '香港',
            value: 0
        }, {
            name: '澳门',
            value: 0
        }, {
            name: '南海诸岛',
            value: 0
        }]
    }]
};
myChart5.setOption(option5);


   

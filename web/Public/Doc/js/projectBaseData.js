/*
 * @Description: 数据部分js
 * @Author: tianjie
 * @LastEditors: Please set LastEditors
 * @Date: 2019-04-09 10:29:02
 * @LastEditTime: 2019-04-09 14:52:26
 */


/**
 * @description: 表格部分
 * @param {type} 
 * @return: 
 */ 
layui.use('table', function(){
  var table = layui.table;
  //客户关系
  table.render({
    elem: '#userrelationship',
    url: '/demo/table/user/',
    page: false,
    cols: [[ //表头
      {field: 'id', title: '单位', width:240, fixed: 'left'},
      {field: 'username', title: '职责', width:100},
      {field: 'sex', title: '类型', width:100},
      {field: 'city', title: '姓名',width:100},
      {field: 'sign', title: '电话' ,width:160},
      {field: 'email', title: '邮箱',width:160},
      {field: 'other', title: '备注' ,width:100},
    ]]
  })
  //风险管理
  table.render({
    elem: '#danger',
    url: '/demo/table/user/',
    page: false,
    cols: [[ //表头
      {field: 'id', title: '内容',  sort: false, fixed: 'left'},
      {field: 'username', title: '等级', width:80},
      {field: 'sex', title: '类别', sort: false},
      {field: 'city', title: '结果'},
      {field: 'sign', title: '时间' },
    ]]
  })
  //需求管理
  table.render({
    elem: '#demand',
    url: '/demo/table/user/',
    page: false,
    cols: [[ 
      {field: 'id', title: '名称',  sort: false, fixed: 'left'},
      {field: 'username', title: '内容', width:80},
      {field: 'sex', title: '类别', sort: false},
      {field: 'city', title: '级别'},
      {field: 'sign', title: '阶段'},
      {field: 'oyher', title: '附件'},
    ]]
  })

  //会议管理
  table.render({
    elem: '#meeting',
    url: '/demo/table/user/',
    page: false,
    cols: [[
      {field: 'id', title: '主题',  sort: false, fixed: 'left'},
      {field: 'username', title: '时间', width:80},
      {field: 'sex', title: '内容', sort: false},
      {field: 'oyher', title: '附件'},
    ]]
  })

  //重大事件
  table.render({
    elem: '#major',
    url: '/demo/table/user/',
    page: false,
    cols: [[ 
      {field: 'id', title: '名称',  sort: false, fixed: 'left'},
      {field: 'username', title: '内容', width:80},
      {field: 'sex', title: '类别', sort: false},
      {field: 'city', title: '级别'},
      {field: 'sign', title: '阶段'},
      {field: 'oyher', title: '附件'},
    ]]
  })
})

/**
 * @description: echarts部分
 * @param {type} 
 * @return: 
 */

 //折线图
function getLineChart() {
  let lineChart = echarts.init(document.getElementById('line'));
  let option = {
    xAxis: {
      type: 'category',
      axisTick:{
        show:false
      },
      axisLine: {
        show: true,
        lineStyle:{
          type:'dashed',
          color: '#ccc',
        },
      },
      boundaryGap: false,
      data: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']
    },
    yAxis: {
      type: 'value',
      axisTick:{
        show:false
      },
      splitLine:{
        show:true,
      },
      axisLine: {
        show: false,
        lineStyle:{
          color: '#ccc',
        }
      }
    },
    grid: {
      left: '2%',
      top:"8%",
      right: '2%',
      bottom: '3%',
      containLabel: true
    },
    series: [{
      data: [820, 932, 901, 934, 1290, 1330, 1320],
      type: 'line',
      areaStyle: {
        color: '#E8F5F4'
      },
    itemStyle : { 
        normal : { 
        color:'#8cd5c2', //改变折线点的颜色
        lineStyle:{ 
          color:'#8cd5c2' //改变折线颜色
        } 
      } 
    },
    }]
  };
  lineChart.setOption(option);
}

//饼图
function getPieChart(){
  let pieChart = echarts.init(document.getElementById('pie'));
  
  let option = {
    tooltip : {
        trigger: 'item',
        formatter: "{a} <br/>{b} : {c} ({d}%)"
    },
    legend: {
        orient: 'vertical',
        right:"30%",
        top:"22%",
        data: ['直接访问','邮件营销','联盟广告','视频广告','搜索引擎']
    },
    series : [
        {
            name: '访问来源',
            type: 'pie',
            radius : '75%',
            center: ['40%', '55%'],
            data:[
                {value:335, name:'直接访问'},
                {value:310, name:'邮件营销'},
                {value:234, name:'联盟广告'},
                {value:135, name:'视频广告'},
                {value:1548, name:'搜索引擎'}
            ],
            itemStyle: {
                emphasis: {
                    shadowBlur: 10,
                    shadowOffsetX: 0,
                    shadowColor: 'rgba(0, 0, 0, 0.5)'
                },
                normal: {
                  borderColor: '#fff',
                  borderWidth: 1,
                  label: {
                      show: true,
                      position: 'outer'
                  },
                  labelLine: {
                      show: true,
                      length: 2,
                      lineStyle: {
                          width: 1,
                          type: 'solid'
                      }
                  }
               },
            },
        }
    ]
  };
  pieChart.setOption(option);
}

getLineChart();
getPieChart();



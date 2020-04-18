// ============================================================== 
// Radar chart option
// ============================================================== 
var radarChart = echarts.init(document.getElementById('radar-chart'));

// specify chart configuration item and data

option = {
    
    tooltip : {
        trigger: 'axis'
    },
    legend: {
        orient : 'vertical',
        x : 'right',
        y : 'bottom',
        data:['Allocated Budget','Actual Spending']
    },
    toolbox: {
        show : true,
        feature : {
            dataView : {show: true, readOnly: false},
            restore : {show: true},
            saveAsImage : {show: true}
        }
    },
    polar : [
       {
           indicator : [
               { text: 'sales', max: 6000},
               { text: 'Administration', max: 16000},
               { text: 'Information Techology', max: 30000},
               { text: 'Customer Support', max: 38000},
               { text: 'Development', max: 52000},
               { text: 'Marketing', max: 25000}
            ]
        }
    ],
    color: ["#13aeb0", "#F14656"],
    calculable : true,
    series : [
        {
            name: 'Budget vs spending',
            type: 'radar',
            data : [
                {
                    value : [4300, 10000, 28000, 35000, 50000, 19000],
                    name : 'Allocated Budget'
                },
                 {
                    value : [5000, 14000, 28000, 31000, 42000, 21000],
                    name : 'Actual Spending'
                }
            ]
        }
    ]
};
                    
                    
                    

// use configuration item and data specified to show chart
radarChart.setOption(option, true), $(function() {
            function resize() {
                setTimeout(function() {
                    radarChart.resize()
                }, 100)
            }
            $(window).on("resize", resize), $(".sidebartoggler").on("click", resize)
        });




// ============================================================== 
// Gauge chart option
// ============================================================== 
var gaugeChart = echarts.init(document.getElementById('gauge-chart'));

// specify chart configuration item and data
option = {
  
    toolbox: {
        show : true,
        feature : {
            restore : {show: true},
            saveAsImage : {show: true}
        }
    },

    series : [
        {
            name:'Speed',
            type:'gauge',
            detail : {formatter:'{value}%'},
            data:[{value: 50, name: 'Speed'}],
            axisLine: {            // 坐标轴线
                lineStyle: {       // 属性lineStyle控制线条样式
                    color: [[0.2, '#13aeb0'],[0.8, '#F14656'],[1, '#f62d51']], 
                    
                }
            },
            
        }
    ]
};
timeTicket = setInterval(function (){
    option.series[0].data[0].value = (Math.random()*100).toFixed(2) - 0;
    gaugeChart.setOption(option, true);
},2000);
                                   

// use configuration item and data specified to show chart
gaugeChart.setOption(option, true), $(function() {
            function resize() {
                setTimeout(function() {
                    gaugeChart.resize()
                }, 100)
            }
            $(window).on("resize", resize), $(".sidebartoggler").on("click", resize)
        });
		
	
 


// ============================================================== 
// Line chart
// ============================================================== 
var dom = document.getElementById("main");
var mytempChart = echarts.init(dom);
var app = {};
option = null;
option = {
   
    tooltip : {
        trigger: 'axis'
    },
    legend: {
        data:['max temp','min temp']
    },
    toolbox: {
        show : true,
        feature : {
            magicType : {show: true, type: ['line', 'bar']},
            restore : {show: true},
            saveAsImage : {show: true}
        }
    },
    color: ["#55ce63", "#009efb"],
    calculable : true,
    xAxis : [
        {
            type : 'category',

            boundaryGap : false,
            data : ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']
        }
    ],
    yAxis : [
        {
            type : 'value',
            axisLabel : {
                formatter: '{value} Â°C'
            }
        }
    ],

    series : [
        {
            name:'max temp',
            type:'line',
            color:['#000'],
            data:[11, 11, 15, 13, 12, 13, 10],
            markPoint : {
                data : [
                    {type : 'max', name: 'Max'},
                    {type : 'min', name: 'Min'}
                ]
            },
            itemStyle: {
                normal: {
                    lineStyle: {
                        shadowColor : 'rgba(0,0,0,0.3)',
                        shadowBlur: 10,
                        shadowOffsetX: 8,
                        shadowOffsetY: 8 
                    }
                }
            },        
            markLine : {
                data : [
                    {type : 'average', name: 'Average'}
                ]
            }
        },
        {
            name:'min temp',
            type:'line',
            data:[1, -2, 2, 5, 3, 2, 0],
            markPoint : {
                data : [
                    {name : 'Week minimum', value : -2, xAxis: 1, yAxis: -1.5}
                ]
            },
            itemStyle: {
                normal: {
                    lineStyle: {
                        shadowColor : 'rgba(0,0,0,0.3)',
                        shadowBlur: 10,
                        shadowOffsetX: 8,
                        shadowOffsetY: 8 
                    }
                }
            }, 
            markLine : {
                data : [
                    {type : 'average', name : 'Average'}
                ]
            }
        }
    ]
};

if (option && typeof option === "object") {
    mytempChart.setOption(option, true), $(function() {
            function resize() {
                setTimeout(function() {
                    mytempChart.resize()
                }, 100)
            }
            $(window).on("resize", resize), $(".sidebartoggler").on("click", resize)
        });
}

// ============================================================== 
// Pie chart option
// ============================================================== 

 
  
  // ============================================================== 
// Pie chart option
// ============================================================== 
var pieChart = echarts.init(document.getElementById('pie-chart'));

// specify chart configuration item and data
option = {
   
    tooltip : {
        trigger: 'item',
        formatter: "{a} <br/>{b} : {c} ({d}%)"
    },
    legend: {
        x : 'center',
        y : 'bottom',
        data:['rose1','rose2','rose3','rose4','rose5','rose6','rose7','rose8']
    },
    toolbox: {
        show : true,
        feature : {
            
            dataView : {show: true, readOnly: false},
            magicType : {
                show: true, 
                type: ['pie', 'funnel']
            },
            restore : {show: true},
            saveAsImage : {show: true}
        }
    },
    color: ["#85c5e3", "#dddddd","#85a9e3", "#858de3","#b585e3", "#e385d7","#e3a385", "#e3bf85"],
    calculable : true,
    series : [
        {
            name:'Radius mode',
            type:'pie',
            radius : [0, 110],
            center : ['50%', 200],
            roseType : 'radius',
            width: '40%',       // for funnel
            max: 40,            // for funnel
            itemStyle : {
                normal : {
                    label : {
                        show : false
                    },
                    labelLine : {
                        show : false
                    }
                },
                emphasis : {
                    label : {
                        show : true
                    },
                    labelLine : {
                        show : true
                    }
                }
            },
            data:[
                {value:10, name:'rose1'},
                {value:5, name:'rose2'},
                {value:15, name:'rose3'},
                {value:25, name:'rose4'},
                {value:20, name:'rose5'},
                {value:35, name:'rose6'},
                {value:30, name:'rose7'},
                {value:40, name:'rose8'}
            ]
        },
            
    ]
};
                    
                    

// use configuration item and data specified to show chart
pieChart.setOption(option, true), $(function() {
            function resize() {
                setTimeout(function() {
                    pieChart.resize()
                }, 100)
            }
            $(window).on("resize", resize), $(".sidebartoggler").on("click", resize)
        });

 

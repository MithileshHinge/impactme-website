/*
Template Name: Srgit  UX Admin
Author: 

File: js
*/
$(function () {
    "use strict";
	
	 var chart = c3.generate({
        bindto: '#income-year',
        data: {
            columns: [
                ['Growth Income', 300, 200, 100, 300, 200, 100, 300],
                ['Net Income', 230, 100, 140, 200, 180, 80, 200]
            ],
            type: 'bar'
        },
         bar: {
            space: 0.2,
            // or
            width: 15 // this makes bar width 100px
        },
        axis: {
            y: {
            tick: {
                count : 5,
                
                outer: false
                }
            }
        },
        legend: {
          hide: true
          //or hide: 'data1'
          //or hide: ['data1', 'data2']
        },
        size: {
            height: 375
        },
        grid: {
        x: {
            show: false
        },
        y: {
            show: true
        }
    },
        color: {
              pattern: [ '#6772e5', '#6772e5']
        }
    });
    // ============================================================== 
    // Sales Different
    // ============================================================== 
	
    // ============================================================== 
    // Our Visitor
    // ============================================================== 
    
    var chart = c3.generate({
        bindto: '#visitor',
        data: {
            columns: [
                ['Other', 30],
                ['Desktop', 10],
                ['Tablet', 40],
                ['Mobile', 50],
            ],
            
            type : 'donut',
            onclick: function (d, i) { console.log("onclick", d, i); },
            onmouseover: function (d, i) { console.log("onmouseover", d, i); },
            onmouseout: function (d, i) { console.log("onmouseout", d, i); }
        },
        donut: {
            label: {
                show: false
              },
            title:"Visits",
            width:20,
            
        },
        
        legend: {
          hide: true
          //or hide: 'data1'
          //or hide: ['data1', 'data2']
        },
        color: {
              pattern: ['#eceff1', '#13aeb0', '#115e8c', '#f14656']
        }
    });
    // ============================================================== 
    // Our Income
    // ==============================================================
    var chart = c3.generate({
        bindto: '#income',
        data: {
            columns: [
                ['Growth Income', 100, 200, 100, 300],
                ['Net Income', 130, 100, 140, 200]
            ],
            type: 'bar'
        },
         bar: {
            space: 0.2,
            // or
            width: 15 // this makes bar width 100px
        },
        axis: {
            y: {
            tick: {
                count : 4,
                
                outer: false
                }
            }
        },
        legend: {
          hide: true
          //or hide: 'data1'
          //or hide: ['data1', 'data2']
        },
        grid: {
        x: {
            show: false
        },
        y: {
            show: true
        }
    },
        size: {
            height: 290
        },
        color: {
              pattern: [ '#13aeb0', '#f14656']
        }
    });
    
    // ============================================================== 
    // Sales Different
    // ============================================================== 
    
    var chart = c3.generate({
        bindto: '#sales',
        data: {
            columns: [
                ['One+', 50],
                ['T', 60],
                ['Samsung', 20],
                
            ],
            type : 'donut',
            onclick: function (d, i) { console.log("onclick", d, i); },
            onmouseover: function (d, i) { console.log("onmouseover", d, i); },
            onmouseout: function (d, i) { console.log("onmouseout", d, i); }
        },
        donut: {
            label: {
                show: false
              },
            title:"",
            width:18,
            
        },
        size: {
            height: 150
        },
        legend: {
          hide: true
          //or hide: 'data1'
          //or hide: ['data1', 'data2']
        },
        color: {
              pattern: ['#F14656', '#716ACA', '#115e8c', '#f14656']
        }
    });
	
	
	// ============================================================== 
    // Sales Different
    // ============================================================== 
    
    var chart = c3.generate({
        bindto: '#sales-2',
        data: {
            columns: [
                ['One+', 80],
                ['T', 30],
                ['Samsung', 60],
                
            ],
            
            type : 'donut',
            onclick: function (d, i) { console.log("onclick", d, i); },
            onmouseover: function (d, i) { console.log("onmouseover", d, i); },
            onmouseout: function (d, i) { console.log("onmouseout", d, i); }
        },
        donut: {
            label: {
                show: false
              },
            title:"",
            width:18,
            
        },
        size: {
            height: 150
        },
        legend: {
          hide: true
          //or hide: 'data1'
          //or hide: ['data1', 'data2']
        },
        color: {
              pattern: ['#F14656', '#716ACA', '#115e8c', '#f14656']
        }
    });
	
	
	
    // ============================================================== 
    // Sales Prediction
    // ============================================================== 
    
     var chart = c3.generate({
        bindto: '#prediction',
        data: {
            columns: [
                ['One+', 50],
                ['T', 30],
                ['Samsung', 50],
                
            ],
            
            type : 'donut',
            onclick: function (d, i) { console.log("onclick", d, i); },
            onmouseover: function (d, i) { console.log("onmouseover", d, i); },
            onmouseout: function (d, i) { console.log("onmouseout", d, i); }
        },
        donut: {
            label: {
                show: false
              },
            title:"",
            width:18,
            
        },
        size: {
            height: 150
        },
        legend: {
          hide: true
          //or hide: 'data1'
          //or hide: ['data1', 'data2']
        },
        color: {
               pattern: ['#115e8c', '#716ACA', '#F14656', '#f14656']
        }
    });
	

$(document).ready(function() {
  $("#sparkline12").sparkline([8,6,9,8,9,8,7,10], {
        type: 'bar',
        height: '50',
        barWidth: 5,
        barSpacing: 3,
        barColor: '#6772e5'
        });

$("#sparkline8").sparkline([1,8,5,6,8,5,8,5,6,8 ], {
            type: 'line',
            width: '100',
            height: '50',
            lineColor: '#1308e8',
            highlightSpotColor: undefined,
  
         
        });
  $('#sparkline11').sparkline([20, 40, 30, 10], {
            type: 'pie',
            height: '50',
            resize: true,
            sliceColors: ['#f39517', '#f34b89', '#6ae53d', '#65baf1']
        });
  
           $("#sparkline14").sparkline([0, 23, 43, 35, 44, 45, 56, 37, 40, 45, 56, 7], {
            type: 'line',
            width: '100',
            height: '50',
            barWidth: 5,
            barSpacing: 3,
            lineColor: '#69bbf5',
            fillColor: 'transparent',
            spotColor: '#f19413',
            minSpotColor: undefined,
            maxSpotColor: undefined,
            highlightSpotColor: undefined,
            highlightLineColor: undefined
        }); 

});
 
        })

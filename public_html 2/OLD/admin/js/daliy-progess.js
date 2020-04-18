// Extra chart
 Morris.Area({
        element: 'sales-chart',
         data: [{
                period: '2011',
                Sales: 10,
                Earning: 80,
				Marketing: 20
           
            }, {
                period: '2012',
                Sales: 130,
                Earning: 100,
				Marketing: 120
             
            }, {
                period: '2013',
                Sales: 80,
                Earning: 60,
				Marketing: 100
               
            }, {
                period: '2014',
                Sales: 70,
                Earning: 200,
				Marketing: 50
           
            }, {
                period: '2015',
                Sales: 180,
                Earning: 150,
				Marketing: 100
            
            }, {
                period: '2016',
                Sales: 105,
                Earning: 100,
				Marketing: 20
              
            },
            {
                period: '2017',
                Sales: 250,
                Earning: 150,
				Marketing: 20
            
            }
        ],
                      xkey: 'period',
        ykeys: ['Sales', 'Earning', 'Marketing'],
        labels: ['Sales', 'Earning', 'Touch'],
        pointSize: 3,
        fillOpacity: 0,
        pointStrokeColors:['#3576db', '#ff4c79', '#115E8C'],
        behaveLikeLine: true,
        gridLineColor: '#e0e0e0',
        lineWidth: 3,
        hideHover: 'auto',
        lineColors: ['#3576db', '#ff4c79', '#115E8C'],
        resize: true
        
    });       
   ////////////////////////
// LINE CHART
var line = new Morris.Line({
element: 'morris-line-chart',
resize: true,
data: [
{y: '2011 Q1', item1: 2666},
{y: '2011 Q2', item1: 2778},
{y: '2011 Q3', item1: 4912},
{y: '2011 Q4', item1: 3767},
{y: '2012 Q1', item1: 6810},
{y: '2012 Q2', item1: 5670},
{y: '2012 Q3', item1: 4820},
{y: '2012 Q4', item1: 15073},
{y: '2013 Q1', item1: 10687}

],
xkey: 'y',
ykeys: ['item1'],
labels: ['Item 1'],
gridLineColor: '#f2f4f7',
lineColors: ['#ff4c79'],
lineWidth: 3,
hideHover: 'auto'
});
////////////////////////



 Morris.Donut({
        element: 'morris-donut-chart',
        data: [{
            label: "Working Hours",
            value: 12,

        }, {
            label: "Working Hours",
            value: 30
        }, {
            label: "Working Hours",
            value: 20
        }],
        resize: true,
        colors:['#ff80ab', '#f50057', '#ff4081']
    });     
        

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("chartdiv2", am4charts.XYChart);

// Export
chart.exporting.menu = new am4core.ExportMenu();

// Data for both series
var data = [ {
  "year": "2013",
  "income": 23.5,
  "expenses": 21.1
}, {
  "year": "2014",
  "income": 26.2,
  "expenses": 30.5
}, {
  "year": "2015",
  "income": 30.1,
  "expenses": 34.9
}, {
  "year": "2016",
  "income": 29.5,
  "expenses": 31.1
}, {
  "year": "2017",
  "income": 30.6,
  "expenses": 28.2,
  "lineDash": "5,5",
}, {
  "year": "2018",
  "income": 34.1,
  "expenses": 32.9,
  "columnDash": "5,5",
  "additional": "(projection)"
}, {
  "year": "2019",
  "income": 34.1,
  "expenses": 32.9,
  "columnDash": "5,5",
  "additional": "(projection)"
}

 ];

/* Create axes */
var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "year";
categoryAxis.renderer.minGridDistance = 30;

/* Create value axis */
var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

/* Create series */
var columnSeries = chart.series.push(new am4charts.ColumnSeries());
columnSeries.name = "Income";
columnSeries.dataFields.valueY = "income";
columnSeries.dataFields.categoryX = "year";

columnSeries.columns.template.tooltipText = "[#fff font-size: 15px]{name} in {categoryX}:\n[/][#fff font-size: 20px]{valueY}[/] [#fff]{additional}[/]"
columnSeries.columns.template.propertyFields.fillOpacity = "fillOpacity";
columnSeries.columns.template.propertyFields.stroke = "stroke";
columnSeries.columns.template.propertyFields.strokeWidth = "strokeWidth";
columnSeries.columns.template.propertyFields.strokeDasharray = "columnDash";
columnSeries.tooltip.label.textAlign = "middle";

var lineSeries = chart.series.push(new am4charts.LineSeries());
lineSeries.name = "Expenses";
lineSeries.dataFields.valueY = "expenses";
lineSeries.dataFields.categoryX = "year";

lineSeries.stroke = am4core.color("#ffc700");
lineSeries.strokeWidth = 3;
lineSeries.propertyFields.strokeDasharray = "lineDash";
lineSeries.tooltip.label.textAlign = "middle";

var bullet = lineSeries.bullets.push(new am4charts.Bullet());
bullet.fill = am4core.color("#ffc700"); // tooltips grab fill from parent by default
bullet.tooltipText = "[#fff font-size: 13px]{name} in {categoryX}:\n[/][#fff font-size: 16px]{valueY}[/] [#fff]{additional}[/]"
var circle = bullet.createChild(am4core.Circle);
circle.radius = 4;
circle.fill = am4core.color("#ffc700");
circle.strokeWidth = 1;

chart.data = data;

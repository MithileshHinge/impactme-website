
// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end


// Create chart instance
var chart = am4core.create("chartdiv", am4charts.XYChart);
chart.scrollbarX = new am4core.Scrollbar();

// Add data
chart.data = [{
  "country": "USA",
  "visits": 3025
}, {
  "country": "China",
  "visits": 1882
}, {
  "country": "Japan",
  "visits": 1809
}, {
  "country": "Germany",
  "visits": 1322
}, {
  "country": "UK",
  "visits": 1122
}, {
  "country": "France",
  "visits": 1114
}, {
  "country": "India",
  "visits": 984
}, {
  "country": "Spain",
  "visits": 711
}, {
  "country": "Netherlands",
  "visits": 665
}, {
  "country": "Russia",
  "visits": 580
}, {
  "country": "South Korea",
  "visits": 443
}, {
  "country": "Canada",
  "visits": 441
}];

// Create axes
var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "country";
categoryAxis.renderer.grid.template.location = 0;
categoryAxis.renderer.minGridDistance = 30;
categoryAxis.renderer.labels.template.horizontalCenter = "right";
categoryAxis.renderer.labels.template.verticalCenter = "middle";
categoryAxis.renderer.labels.template.rotation = 270;
categoryAxis.tooltip.disabled = true;
categoryAxis.renderer.minHeight = 110;

var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis.renderer.minWidth = 50;

// Create series
var series = chart.series.push(new am4charts.ColumnSeries());
series.sequencedInterpolation = true;
series.dataFields.valueY = "visits";
series.dataFields.categoryX = "country";
series.tooltipText = "[{categoryX}: bold]{valueY}[/]";
series.columns.template.strokeWidth = 0;

series.tooltip.pointerOrientation = "vertical";

series.columns.template.column.cornerRadiusTopLeft = 10;
series.columns.template.column.cornerRadiusTopRight = 10;
series.columns.template.column.fillOpacity = 0.8;

// on hover, make corner radiuses bigger
let hoverState = series.columns.template.column.states.create("hover");
hoverState.properties.cornerRadiusTopLeft = 0;
hoverState.properties.cornerRadiusTopRight = 0;
hoverState.properties.fillOpacity = 1;

series.columns.template.adapter.add("fill", (fill, target)=>{
  return chart.colors.getIndex(target.dataItem.index);
})

// Cursor
chart.cursor = new am4charts.XYCursor();











//CUP
 
var iconPath = "M421.976,136.204h-23.409l-0.012,0.008c-0.19-20.728-1.405-41.457-3.643-61.704l-1.476-13.352H5.159L3.682,74.507 C1.239,96.601,0,119.273,0,141.895c0,65.221,7.788,126.69,22.52,177.761c7.67,26.588,17.259,50.661,28.5,71.548  c11.793,21.915,25.534,40.556,40.839,55.406l4.364,4.234h206.148l4.364-4.234c15.306-14.85,29.046-33.491,40.839-55.406  c11.241-20.888,20.829-44.96,28.5-71.548c0.325-1.127,0.643-2.266,0.961-3.404h44.94c49.639,0,90.024-40.385,90.024-90.024  C512,176.588,471.615,136.204,421.976,136.204z M421.976,256.252h-32c3.061-19.239,5.329-39.333,6.766-60.048h25.234  c16.582,0,30.024,13.442,30.024,30.024C452,242.81,438.558,256.252,421.976,256.252z"

var chart = am4core.create("chartdiv2", am4charts.SlicedChart);
chart.hiddenState.properties.opacity = 0; // this makes initial fade in effect
chart.paddingLeft = 10;

chart.data = [{
    "name": "B",
    "value": 40,
    "disabled":true
}, {
    "name": "A",
    "value": 60
}];

var series = chart.series.push(new am4charts.PictorialStackedSeries());
series.dataFields.value = "value";
series.dataFields.category = "name";
series.alignLabels = true;
// this makes only A label to be visible
series.labels.template.propertyFields.disabled = "disabled";
series.ticks.template.propertyFields.disabled = "disabled";

series.maskSprite.path = iconPath;
series.ticks.template.locationX = 1;
series.ticks.template.locationY = 0;

series.labelsContainer.width = 0;

chart.legend = new am4charts.Legend();
chart.legend.position = "top";
chart.legend.paddingRight = 10;
chart.legend.paddingBottom = 0;
let marker = chart.legend.markers.template.children.getIndex(0);
chart.legend.markers.template.width = 27;
chart.legend.markers.template.height = 27;
marker.cornerRadius(20,20,20,20);
//CUP






//Solid Gauge
// Create chart instance
var chart = am4core.create("chartdiv3", am4charts.RadarChart);

// Add data
chart.data = [{
  "category": "Research",
  "value": 80,
  "full": 100
}, {
  "category": "Marketing",
  "value": 35,
  "full": 100
}, {
  "category": "Distribution",
  "value": 92,
  "full": 100
}, {
  "category": "Human Resources",
  "value": 68,
  "full": 100
}];

// Make chart not full circle
chart.startAngle = -90;
chart.endAngle = 180;
chart.innerRadius = am4core.percent(20);

// Set number format
chart.numberFormatter.numberFormat = "#.#'%'";

// Create axes
var categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "category";
categoryAxis.renderer.grid.template.location = 0;
categoryAxis.renderer.grid.template.strokeOpacity = 0;
categoryAxis.renderer.labels.template.horizontalCenter = "right";
categoryAxis.renderer.labels.template.fontWeight = 500;
categoryAxis.renderer.labels.template.adapter.add("fill", function(fill, target) {
  return (target.dataItem.index >= 0) ? chart.colors.getIndex(target.dataItem.index) : fill;
});
categoryAxis.renderer.minGridDistance = 10;

var valueAxis = chart.xAxes.push(new am4charts.ValueAxis());
valueAxis.renderer.grid.template.strokeOpacity = 0;
valueAxis.min = 0;
valueAxis.max = 100;
valueAxis.strictMinMax = true;

// Create series
var series1 = chart.series.push(new am4charts.RadarColumnSeries());
series1.dataFields.valueX = "full";
series1.dataFields.categoryY = "category";
series1.clustered = false;
series1.columns.template.fill = new am4core.InterfaceColorSet().getFor("alternativeBackground");
series1.columns.template.fillOpacity = 0.08;
series1.columns.template.cornerRadiusTopLeft = 20;
series1.columns.template.strokeWidth = 0;
series1.columns.template.radarColumn.cornerRadius = 20;

var series2 = chart.series.push(new am4charts.RadarColumnSeries());
series2.dataFields.valueX = "value";
series2.dataFields.categoryY = "category";
series2.clustered = false;
series2.columns.template.strokeWidth = 0;
series2.columns.template.tooltipText = "{category}: [bold]{value}[/]";
series2.columns.template.radarColumn.cornerRadius = 20;

series2.columns.template.adapter.add("fill", function(fill, target) {
  return chart.colors.getIndex(target.dataItem.index);
});

// Add cursor
chart.cursor = new am4charts.RadarCursor();
//Solid Gauge



//Chord diagram
var chart = am4core.create("chartdiv4", am4charts.ChordDiagram);
chart.hiddenState.properties.opacity = 0;

chart.data = [
    { from: "A", to: "D", value: 10 },
    { from: "B", to: "D", value: 8 },
    { from: "B", to: "E", value: 4 },
    { from: "B", to: "C", value: 2 },
    { from: "C", to: "E", value: 14 },
    { from: "E", to: "D", value: 8 },
    { from: "C", to: "A", value: 4 },
    { from: "G", to: "A", value: 7 },
    { from: "D", to: "B", value: 1 }
];

chart.dataFields.fromName = "from";
chart.dataFields.toName = "to";
chart.dataFields.value = "value";

// make nodes draggable
var nodeTemplate = chart.nodes.template;
nodeTemplate.readerTitle = "Click to show/hide or drag to rearrange";
nodeTemplate.showSystemTooltip = true;
nodeTemplate.cursorOverStyle = am4core.MouseCursorStyle.pointer
//Chord diagram



//Radial bar chart
var chart = am4core.create("chartdiv5", am4charts.RadarChart);
chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

let data = []
for(let i = 0; i < 10; i++){
  data.push({category:i, value1:Math.round(Math.random() * 10), value2:Math.round(Math.random() * 10), value3:Math.round(Math.random() * 10), value4:Math.round(Math.random() * 10)})
}

chart.data = data;
chart.radius = am4core.percent(100);

var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "category";
categoryAxis.renderer.labels.template.location = 0.5;
categoryAxis.renderer.tooltipLocation = 0.5;
categoryAxis.renderer.grid.template.disabled = true;
categoryAxis.renderer.labels.template.disabled = true;

var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis.tooltip.disabled = true;
valueAxis.renderer.labels.template.horizontalCenter = "left";
valueAxis.renderer.grid.template.disabled = true;

var series1 = chart.series.push(new am4charts.RadarColumnSeries());
series1.name = "Series 1";
series1.dataFields.categoryX = "category";
series1.dataFields.valueY = "value2";
series1.stroke = am4core.color("#ffffff");
series1.columns.template.strokeOpacity = 0.2;
series1.stacked = true;
series1.sequencedInterpolation = true;
series1.columns.template.width = am4core.percent(100);
series1.columns.template.tooltipText = "{valueY}";

var series2 = chart.series.push(series1.clone());
series2.name = "Series 2";
series2.fill = chart.colors.next();
series2.dataFields.valueY = "value2";

var series3 = chart.series.push(series1.clone());
series3.name = "Series 3";
series3.fill = chart.colors.next();

series3.dataFields.valueY = "value3";

var series4 = chart.series.push(series1.clone());
series4.name = "Series 4";
series4.fill = chart.colors.next();
series4.dataFields.valueY = "value4";

chart.seriesContainer.zIndex = -1;

chart.scrollbarX = new am4core.Scrollbar();
chart.scrollbarX.exportable = false;
chart.scrollbarY = new am4core.Scrollbar();
chart.scrollbarY.exportable = false;

chart.cursor = new am4charts.RadarCursor();
chart.cursor.xAxis = categoryAxis;
chart.cursor.fullWidthXLine = true;
chart.cursor.lineX.strokeOpacity = 0;
chart.cursor.lineX.fillOpacity = 0.1;
chart.cursor.lineX.fill = am4core.color("#000000");
//Radial bar chart



// Create chart instance
var chart = am4core.create("chartdiv6", am4charts.XYChart);
// Add data
chart.data = [{
  "year": "2016",
  "europe": 2.5,
  "namerica": 2.5,
  "asia": 2.1,
  "lamerica": 0.3,
  "meast": 0.2,
  "africa": 0.1
}, {
  "year": "2017",
  "europe": 2.6,
  "namerica": 2.7,
  "asia": 2.2,
  "lamerica": 0.3,
  "meast": 0.3,
  "africa": 0.1
}, {
  "year": "2018",
  "europe": 2.8,
  "namerica": 2.9,
  "asia": 2.4,
  "lamerica": 0.3,
  "meast": 0.3,
  "africa": 0.1
}];

chart.legend = new am4charts.Legend();
chart.legend.position = "right";

// Create axes
var categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "year";
categoryAxis.renderer.grid.template.opacity = 0;

var valueAxis = chart.xAxes.push(new am4charts.ValueAxis());
valueAxis.min = 0;
valueAxis.renderer.grid.template.opacity = 0;
valueAxis.renderer.ticks.template.strokeOpacity = 0.5;
valueAxis.renderer.ticks.template.stroke = am4core.color("#495C43");
valueAxis.renderer.ticks.template.length = 5;
valueAxis.renderer.line.strokeOpacity = 0.5;
valueAxis.renderer.baseGrid.disabled = true;
valueAxis.renderer.minGridDistance = 10;

// Create series
function createSeries(field, name) {
  var series = chart.series.push(new am4charts.ColumnSeries());
  series.dataFields.valueX = field;
  series.dataFields.categoryY = "year";
  series.stacked = true;
  series.name = name;
  
  var labelBullet = series.bullets.push(new am4charts.LabelBullet());
  labelBullet.locationX = 0.5;
  labelBullet.label.text = "{valueX}";
  labelBullet.label.fill = am4core.color("#fff");
}

createSeries("europe", "Europe");
createSeries("namerica", "North America");
createSeries("asia", "Asia");
createSeries("lamerica", "Latin America");
createSeries("meast", "Middle East");
createSeries("africa", "Africa");




// Create chart instance
var chart = am4core.create("chartdiv9", am4charts.XYChart);

// Add data
chart.data = [{
  "year": "2007",
  "value1": 1691,
  "value2": 737
}, {
  "year": "2008",
  "value1": 1098,
  "value2": 680,
  "value3": 910
}, {
  "year": "2009",
  "value1": 975,
  "value2": 664,
  "value3": 670
}, {
  "year": "2010",
  "value1": 1246,
  "value2": 648,
  "value3": 930
}, {
  "year": "2011",
  "value1": 1218,
  "value2": 637,
  "value3": 1010
}, {
  "year": "2012",
  "value1": 1913,
  "value2": 133,
  "value3": 1770
}, {
  "year": "2013",
  "value1": 1299,
  "value2": 621,
  "value3": 820
}, {
  "year": "2014",
  "value1": 1110,
  "value2": 10,
  "value3": 1050
}, {
  "year": "2015",
  "value1": 765,
  "value2": 232,
  "value3": 650
}, {
  "year": "2016",
  "value1": 1145,
  "value2": 219,
  "value3": 780
}, {
  "year": "2017",
  "value1": 1163,
  "value2": 201,
  "value3": 700
}, {
  "year": "2018",
  "value1": 1780,
  "value2": 85,
  "value3": 1470
}, {
  "year": "2019",
  "value1": 1580,
  "value2": 285
}];

// Create axes
var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "year";
categoryAxis.renderer.grid.template.disabled = true;
categoryAxis.renderer.minGridDistance = 30;
categoryAxis.startLocation = 0.5;
categoryAxis.endLocation = 0.5;
categoryAxis.renderer.minLabelPosition = 0.05;
categoryAxis.renderer.maxLabelPosition = 0.95;


var categoryAxisTooltip = categoryAxis.tooltip.background;
categoryAxisTooltip.pointerLength = 0;
categoryAxisTooltip.fillOpacity = 0.3;
categoryAxisTooltip.filters.push(new am4core.BlurFilter).blur = 5;
categoryAxis.tooltip.dy = 5;


var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis.renderer.inside = true;
valueAxis.renderer.grid.template.disabled = true;
valueAxis.renderer.minLabelPosition = 0.05;
valueAxis.renderer.maxLabelPosition = 0.95;

var valueAxisTooltip = valueAxis.tooltip.background;
valueAxisTooltip.pointerLength = 0;
valueAxisTooltip.fillOpacity = 0.3;
valueAxisTooltip.filters.push(new am4core.BlurFilter).blur = 5;


// Create series
var series1 = chart.series.push(new am4charts.LineSeries());
series1.dataFields.categoryX = "year";
series1.dataFields.valueY = "value1";
series1.fillOpacity = 1;
series1.stacked = true;

var blur1 = new am4core.BlurFilter();
blur1.blur = 20;
series1.filters.push(blur1);

var series2 = chart.series.push(new am4charts.LineSeries());
series2.dataFields.categoryX = "year";
series2.dataFields.valueY = "value2";
series2.fillOpacity = 1;
series2.stacked = true;

var blur2 = new am4core.BlurFilter();
blur2.blur = 20;
series2.filters.push(blur2);

var series3 = chart.series.push(new am4charts.LineSeries());
series3.dataFields.categoryX = "year";
series3.dataFields.valueY = "value3";
series3.stroke = am4core.color("#fff");
series3.strokeWidth = 2;
series3.strokeDasharray = "3,3";
series3.tooltipText = "{categoryX}\n---\n[bold font-size: 20]{valueY}[/]";
series3.tooltip.pointerOrientation = "vertical";
series3.tooltip.label.textAlign = "middle";

var bullet3 = series3.bullets.push(new am4charts.CircleBullet())
bullet3.circle.radius = 8;
bullet3.fill = chart.colors.getIndex(3);
bullet3.stroke = am4core.color("#fff");
bullet3.strokeWidth = 3;

var bullet3hover = bullet3.states.create("hover");
bullet3hover.properties.scale = 1.2;

var shadow3 = new am4core.DropShadowFilter();
series3.filters.push(shadow3);

chart.cursor = new am4charts.XYCursor();
chart.cursor.lineX.disabled = true;
chart.cursor.lineY.disabled = true;


//curved-columns

var chart = am4core.create("chartdiv7", am4charts.XYChart);
chart.hiddenState.properties.opacity = 0; // this makes initial fade in effect

chart.data = [{
  "country": "One",
  "value": 3025
}, {
  "country": "Two",
  "value": 1882
}, {
  "country": "Three",
  "value": 1809
}, {
  "country": "Four",
  "value": 1322
}, {
  "country": "Five",
  "value": 1122
}, {
  "country": "Six",
  "value": -1114
}, {
  "country": "Seven",
  "value": -984
}, {
  "country": "Eight",
  "value": 711
}, {
  "country": "Nine",
  "value": 665
}, {
  "country": "Ten",
  "value": -580
}, {
  "country": "Eleven",
  "value": 443
}, {
  "country": "Twelve",
  "value": 441
}];


var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.renderer.grid.template.location = 0;
categoryAxis.dataFields.category = "country";
categoryAxis.renderer.minGridDistance = 40;

var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

var series = chart.series.push(new am4charts.CurvedColumnSeries());
series.dataFields.categoryX = "country";
series.dataFields.valueY = "value";
series.tooltipText = "{valueY.value}"
series.columns.template.strokeOpacity = 0;

series.columns.template.fillOpacity = 0.75;



chart.cursor = new am4charts.XYCursor();

// Add distinctive colors for each column using adapter
series.columns.template.adapter.add("fill", (fill, target) => {
  return chart.colors.getIndex(target.dataItem.index);
});

chart.scrollbarX = new am4core.Scrollbar();

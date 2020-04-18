// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

/**
 * Define SVG path for target icon
 */
var targetSVG = "M9,0C4.029,0,0,4.029,0,9s4.029,9,9,9s9-4.029,9-9S13.971,0,9,0z M9,15.93 c-3.83,0-6.93-3.1-6.93-6.93S5.17,2.07,9,2.07s6.93,3.1,6.93,6.93S12.83,15.93,9,15.93 M12.5,9c0,1.933-1.567,3.5-3.5,3.5S5.5,10.933,5.5,9S7.067,5.5,9,5.5 S12.5,7.067,12.5,9z";

// Create map instance
var chart = am4core.create("capitals-map", am4maps.MapChart);

// Set map definition
chart.geodata = am4geodata_worldLow;

// Set projection
chart.projection = new am4maps.projections.Miller();

// Create map polygon series
var polygonSeries = chart.series.push(new am4maps.MapPolygonSeries());

// Exclude Antartica
polygonSeries.exclude = ["AQ"];

// Make map load polygon (like country names) data from GeoJSON
polygonSeries.useGeodata = true;

// Configure series
var polygonTemplate = polygonSeries.mapPolygons.template;
polygonTemplate.fill = chart.colors.getIndex(0).brighten(0.5).saturate(0.2);
polygonTemplate.strokeOpacity = 0.5;
polygonTemplate.strokeWidth = 0.5;

// create capital markers
var imageSeries = chart.series.push(new am4maps.MapImageSeries());

// define template
var imageSeriesTemplate = imageSeries.mapImages.template;
var circle = imageSeriesTemplate.createChild(am4core.Sprite);
circle.scale = 0.6;
circle.fill = chart.colors.getIndex(3).saturate(0.1).lighten(-0.5)
circle.path = targetSVG;
// what about scale...

// set propertyfields
imageSeriesTemplate.propertyFields.latitude = "latitude";
imageSeriesTemplate.propertyFields.longitude = "longitude";

imageSeriesTemplate.horizontalCenter = "middle";
imageSeriesTemplate.verticalCenter = "middle";
imageSeriesTemplate.align = "center";
imageSeriesTemplate.valign = "middle";
imageSeriesTemplate.width = 8;
imageSeriesTemplate.height = 8;
imageSeriesTemplate.nonScaling = true;
imageSeriesTemplate.tooltipText = "{title}";
imageSeriesTemplate.fill = am4core.color("#a4b9c3");
imageSeriesTemplate.background.fillOpacity = 0;
imageSeriesTemplate.background.fill = "#fff";
imageSeriesTemplate.setStateOnChildren = true;
imageSeriesTemplate.states.create("hover");

imageSeries.data = [{
  "title": "Berlin",
  "latitude": 52.5235,
  "longitude": 13.4115
}, {
  "title": "Athens",
  "latitude": 37.9792,
  "longitude": 23.7166
}, {
  "title": "Budapest",
  "latitude": 47.4984,
  "longitude": 19.0408
}, {
  "title": "Reykjavik",
  "latitude": 64.1353,
  "longitude": -21.8952
}, {
  "title": "Dublin",
  "latitude": 53.3441,
  "longitude": -6.2675
}, {
  "title": "Rome",
  "latitude": 41.8955,
  "longitude": 12.4823
}, {
  "title": "Riga",
  "latitude": 56.9465,
  "longitude": 24.1049
}, {
  "title": "Vaduz",
  "latitude": 47.1411,
  "longitude": 9.5215
}, {
  "title": "Vilnius",
  "latitude": 54.6896,
  "longitude": 25.2799
}, {
  "title": "Luxembourg",
  "latitude": 49.61,
  "longitude": 6.1296
}, {
  "title": "Skopje",
  "latitude": 42.0024,
  "longitude": 21.4361
}, {
  "title": "Valletta",
  "latitude": 35.9042,
  "longitude": 14.5189
}, {
  "title": "Chisinau",
  "latitude": 47.0167,
  "longitude": 28.8497
}, 
{
  "title": "Vientiane",
  "latitude": 17.9689,
  "longitude": 102.6137
}, {
  "title": "Beyrouth / Beirut",
  "latitude": 33.8872,
  "longitude": 35.5134
}, {
  "title": "Kuala Lumpur",
  "latitude": 3.1502,
  "longitude": 101.7077
}, {
  "title": "Ulan Bator",
  "latitude": 47.9138,
  "longitude": 106.922
}, {
  "title": "Pyinmana",
  "latitude": 19.7378,
  "longitude": 96.2083
}, {
  "title": "Kathmandu",
  "latitude": 27.7058,
  "longitude": 85.3157
}, {
  "title": "Muscat",
  "latitude": 23.6086,
  "longitude": 58.5922
}, {
  "title": "Islamabad",
  "latitude": 33.6751,
  "longitude": 73.0946
}, {
  "title": "Manila",
  "latitude": 14.579,
  "longitude": 120.9726
}, {
  "title": "Doha",
  "latitude": 25.2948,
  "longitude": 51.5082
}, {
  "title": "Riyadh",
  "latitude": 24.6748,
  "longitude": 46.6977
}, {
  "title": "Singapore",
  "latitude": 1.2894,
  "longitude": 103.85
}, {
  "title": "Seoul",
  "latitude": 37.5139,
  "longitude": 126.9828
}, {
  "title": "Damascus",
  "latitude": 33.5158,
  "longitude": 36.2939
}, {
  "title": "Taipei",
  "latitude": 25.0338,
  "longitude": 121.5645
}, {
  "title": "Dushanbe",
  "latitude": 38.5737,
  "longitude": 68.7738
}, {
  "title": "Bangkok",
  "latitude": 13.7573,
  "longitude": 100.502
}, {
  "title": "Dili",
  "latitude": -8.5662,
  "longitude": 125.588
}, {
  "title": "Ankara",
  "latitude": 39.9439,
  "longitude": 32.856
}, {
  "title": "Ashgabat",
  "latitude": 37.9509,
  "longitude": 58.3794
}, {
  "title": "Abu Dhabi",
  "latitude": 24.4764,
  "longitude": 54.3705
}, {
  "title": "Santiago",
  "latitude": -33.4691,
  "longitude": -70.642
}, {
  "title": "Bogota",
  "latitude": 4.6473,
  "longitude": -74.0962
}, {
  "title": "San Jose",
  "latitude": 9.9402,
  "longitude": -84.1002
}, {
  "title": "Havana",
  "latitude": 23.1333,
  "longitude": -82.3667
}, {
  "title": "Roseau",
  "latitude": 15.2976,
  "longitude": -61.39
}, {
  "title": "Santo Domingo",
  "latitude": 18.479,
  "longitude": -69.8908
}, {
  "title": "Quito",
  "latitude": -0.2295,
  "longitude": -78.5243
}, {
  "title": "San Salvador",
  "latitude": 13.7034,
  "longitude": -89.2073
}, {
  "title": "Guatemala",
  "latitude": 14.6248,
  "longitude": -90.5328
}, {
  "title": "Ciudad de Mexico",
  "latitude": 19.4271,
  "longitude": -99.1276
}, {
  "title": "Managua",
  "latitude": 12.1475,
  "longitude": -86.2734
}, {
  "title": "Panama",
  "latitude": 8.9943,
  "longitude": -79.5188
}, {
  "title": "Asuncion",
  "latitude": -25.3005,
  "longitude": -57.6362
}, {
  "title": "Lima",
  "latitude": -12.0931,
  "longitude": -77.0465
}, {
  "title": "Castries",
  "latitude": 13.9972,
  "longitude": -60.0018
}, {
  "title": "Paramaribo",
  "latitude": 5.8232,
  "longitude": -55.1679
}, {
  "title": "Washington D.C.",
  "latitude": 38.8921,
  "longitude": -77.0241
}, {
  "title": "Montevideo",
  "latitude": -34.8941,
  "longitude": -56.0675
}, {
  "title": "Caracas",
  "latitude": 10.4961,
  "longitude": -66.8983
}, {
  "title": "Oranjestad",
  "latitude": 12.5246,
  "longitude": -70.0265
}, {
  "title": "Cayenne",
  "latitude": 4.9346,
  "longitude": -52.3303
}, {
  "title": "Plymouth",
  "latitude": 16.6802,
  "longitude": -62.2014
}, {
  "title": "San Juan",
  "latitude": 18.45,
  "longitude": -66.0667
}, {
  "title": "Algiers",
  "latitude": 36.7755,
  "longitude": 3.0597
}, {
  "title": "Luanda",
  "latitude": -8.8159,
  "longitude": 13.2306
}, {
  "title": "Porto-Novo",
  "latitude": 6.4779,
  "longitude": 2.6323
}, {
  "title": "Gaborone",
  "latitude": -24.657,
  "longitude": 25.9089
}, {
  "title": "Ouagadougou",
  "latitude": 12.3569,
  "longitude": -1.5352
}, {
  "title": "Bujumbura",
  "latitude": -3.3818,
  "longitude": 29.3622
}, {
  "title": "Yaounde",
  "latitude": 3.8612,
  "longitude": 11.5217
}, {
  "title": "Bangui",
  "latitude": 4.3621,
  "longitude": 18.5873
}, {
  "title": "Brazzaville",
  "latitude": -4.2767,
  "longitude": 15.2662
}, {
  "title": "Kinshasa",
  "latitude": -4.3369,
  "longitude": 15.3271
}, {
  "title": "Yamoussoukro",
  "latitude": 6.8067,
  "longitude": -5.2728
}, {
  "title": "Djibouti",
  "latitude": 11.5806,
  "longitude": 43.1425
}, {
  "title": "Cairo",
  "latitude": 30.0571,
  "longitude": 31.2272
}, {
  "title": "Asmara",
  "latitude": 15.3315,
  "longitude": 38.9183
}, {
  "title": "Addis Abeba",
  "latitude": 9.0084,
  "longitude": 38.7575
}, {
  "title": "Libreville",
  "latitude": 0.3858,
  "longitude": 9.4496
}, {
  "title": "Banjul",
  "latitude": 13.4399,
  "longitude": -16.6775
}, {
  "title": "Accra",
  "latitude": 5.5401,
  "longitude": -0.2074
}, {
  "title": "Conakry",
  "latitude": 9.537,
  "longitude": -13.6785
}, {
  "title": "Bissau",
  "latitude": 11.8598,
  "longitude": -15.5875
}, {
  "title": "Nairobi",
  "latitude": -1.2762,
  "longitude": 36.7965
}, {
  "title": "Maseru",
  "latitude": -29.2976,
  "longitude": 27.4854
}, {
  "title": "Monrovia",
  "latitude": 6.3106,
  "longitude": -10.8047
}, {
  "title": "Tripoli",
  "latitude": 32.883,
  "longitude": 13.1897
}, {
  "title": "Antananarivo",
  "latitude": -18.9201,
  "longitude": 47.5237
}, {
  "title": "Lilongwe",
  "latitude": -13.9899,
  "longitude": 33.7703
}, {
  "title": "Bamako",
  "latitude": 12.653,
  "longitude": -7.9864
}, {
  "title": "Nouakchott",
  "latitude": 18.0669,
  "longitude": -15.99
}, {
  "title": "Port Louis",
  "latitude": -20.1654,
  "longitude": 57.4896
}, {
  "title": "Rabat",
  "latitude": 33.9905,
  "longitude": -6.8704
}, {
  "title": "Maputo",
  "latitude": -25.9686,
  "longitude": 32.5804
}, {
  "title": "Windhoek",
  "latitude": -22.5749,
  "longitude": 17.0805
}, {
  "title": "Niamey",
  "latitude": 13.5164,
  "longitude": 2.1157
}, {
  "title": "Abuja",
  "latitude": 9.058,
  "longitude": 7.4891
}, {
  "title": "Kigali",
  "latitude": -1.9441,
  "longitude": 30.0619
}, {
  "title": "Dakar",
  "latitude": 14.6953,
  "longitude": -17.4439
}, {
  "title": "Freetown",
  "latitude": 8.4697,
  "longitude": -13.2659
}, {
  "title": "Mogadishu",
  "latitude": 2.0411,
  "longitude": 45.3426
}, {
  "title": "Pretoria",
  "latitude": -25.7463,
  "longitude": 28.1876
}, {
  "title": "Mbabane",
  "latitude": -26.3186,
  "longitude": 31.141
}, {
  "title": "Dodoma",
  "latitude": -6.167,
  "longitude": 35.7497
}, {
  "title": "Lome",
  "latitude": 6.1228,
  "longitude": 1.2255
}, {
  "title": "Tunis",
  "latitude": 36.8117,
  "longitude": 10.1761
}];














// Create map instance
var chart = am4core.create("globe", am4maps.MapChart);

// Set map definition
chart.geodata = am4geodata_worldLow;

// Set projection
chart.projection = new am4maps.projections.Orthographic();

// Create map polygon series
var polygonSeries = chart.series.push(new am4maps.MapPolygonSeries());

// Make map load polygon (like country names) data from GeoJSON
polygonSeries.useGeodata = true;

// Configure series
var polygonTemplate = polygonSeries.mapPolygons.template;
polygonTemplate.tooltipText = "{name}";
polygonTemplate.fill = chart.colors.getIndex(0);

// Create hover state and set alternative fill color
var hs = polygonTemplate.states.create("hover");
hs.properties.fill = chart.colors.getIndex(0).brighten(-0.5);





//drill-down-map//

// Create map instance
var chart = am4core.create("drill-down-map", am4maps.MapChart);

// Set projection
chart.projection = new am4maps.projections.Mercator();

var restoreContinents = function(){
  hideCountries();
  chart.goHome();
};

// Zoom control
chart.zoomControl = new am4maps.ZoomControl();

var homeButton = new am4core.Button();
homeButton.events.on("hit", restoreContinents);

homeButton.icon = new am4core.Sprite();
homeButton.padding(7, 5, 7, 5);
homeButton.width = 20;
homeButton.icon.path = "M16,8 L14,8 L14,16 L10,16 L10,10 L6,10 L6,16 L2,16 L2,8 L0,8 L8,0 L16,8 Z M16,8";
homeButton.marginBottom = 10;
homeButton.parent = chart.zoomControl;
homeButton.insertBefore(chart.zoomControl.plusButton);

// Shared
var hoverColorHex = "#9a7bca";
var hoverColor = am4core.color(hoverColorHex);
var hideCountries = function() {
  countryTemplate.hide();
  labelContainer.hide();
};

// Continents 
var continentsSeries = chart.series.push(new am4maps.MapPolygonSeries());
continentsSeries.geodata = am4geodata_continentsLow;
continentsSeries.useGeodata = true;
continentsSeries.exclude = ["antarctica"];

var continentTemplate = continentsSeries.mapPolygons.template;
continentTemplate.tooltipText = "{name}";
continentTemplate.properties.fillOpacity = 0.8; // Reduce conflict with back to continents map label
continentTemplate.propertyFields.fill = "color";
continentTemplate.events.on("hit", function(event){
  if ( ! countriesSeries.visible) countriesSeries.visible = true;
  chart.zoomToMapObject(event.target);
  countryTemplate.show();
  labelContainer.show();
});

var contintentHover = continentTemplate.states.create("hover");
contintentHover.properties.fill = hoverColor;
contintentHover.properties.stroke = hoverColor;

continentsSeries.dataFields.zoomLevel = "zoomLevel";
continentsSeries.dataFields.zoomGeoPoint = "zoomGeoPoint";

continentsSeries.data = [ {
  "id": "africa",
  "color": chart.colors.getIndex(0)
}, {
  "id": "asia",
  "color": chart.colors.getIndex(1),
  "zoomLevel": 2,
  "zoomGeoPoint": {
    "latitude": 46,
    "longitude": 89
  }
}, {
  "id": "oceania",
  "color": chart.colors.getIndex(2)
}, {
  "id": "europe",
  "color": chart.colors.getIndex(3)
}, {
  "id": "northAmerica",
  "color": chart.colors.getIndex(4)
}, {
  "id": "southAmerica",
  "color": chart.colors.getIndex(5)
}];


// Countries
var countriesSeries = chart.series.push(new am4maps.MapPolygonSeries());
var countries = countriesSeries.mapPolygons;
countriesSeries.visible = false; // start off as hidden
countriesSeries.exclude = ["AQ"];
countriesSeries.geodata = am4geodata_worldLow;
countriesSeries.useGeodata = true;
// Hide each country so we can fade them in
countriesSeries.events.once("inited", function(){
  hideCountries();
});

var countryTemplate = countries.template;
countryTemplate.applyOnClones = true;
countryTemplate.fill = am4core.color("#a791b4");
countryTemplate.fillOpacity = 0.3; // see continents underneath, however, country shapes are more detailed than continents.
countryTemplate.strokeOpacity = 0.3;
countryTemplate.tooltipText = "{name}";
countryTemplate.events.on("hit", function(event){
  chart.zoomToMapObject(event.target);
});

var countryHover = countryTemplate.states.create("hover");
countryHover.properties.fill = hoverColor;
countryHover.properties.fillOpacity = 0.8; // Reduce conflict with back to continents map label
countryHover.properties.stroke = hoverColor;
countryHover.properties.strokeOpacity = 1;

var labelContainer = chart.chartContainer.createChild(am4core.Container);
labelContainer.hide();
labelContainer.config = {cursorOverStyle: [
  {
    "property": "cursor",
    "value": "pointer"
  }
]};
labelContainer.isMeasured = false;
labelContainer.layout = "horizontal";
labelContainer.verticalCenter = "bottom";
labelContainer.contentValign = "middle";
labelContainer.y = am4core.percent(100);
labelContainer.dx = 10;
labelContainer.dy = -25;
labelContainer.background.fill = "#fff";
labelContainer.background.fillOpacity = 0; // Hack to ensure entire area of labelContainer, e.g. between icon path, is clickable
labelContainer.setStateOnChildren = true;
labelContainer.states.create("hover");
labelContainer.events.on("hit", restoreContinents);

var globeIcon = labelContainer.createChild(am4core.Sprite);
globeIcon.valign = "bottom";
globeIcon.verticalCenter = "bottom";
globeIcon.width = 29;
globeIcon.height = 29;
globeIcon.marginRight = 7;
globeIcon.path = "M16,1.466C7.973,1.466,1.466,7.973,1.466,16c0,8.027,6.507,14.534,14.534,14.534c8.027,0,14.534-6.507,14.534-14.534C30.534,7.973,24.027,1.466,16,1.466zM27.436,17.39c0.001,0.002,0.004,0.002,0.005,0.004c-0.022,0.187-0.054,0.37-0.085,0.554c-0.015-0.012-0.034-0.025-0.047-0.036c-0.103-0.09-0.254-0.128-0.318-0.115c-0.157,0.032,0.229,0.305,0.267,0.342c0.009,0.009,0.031,0.03,0.062,0.058c-1.029,5.312-5.709,9.338-11.319,9.338c-4.123,0-7.736-2.18-9.776-5.441c0.123-0.016,0.24-0.016,0.28-0.076c0.051-0.077,0.102-0.241,0.178-0.331c0.077-0.089,0.165-0.229,0.127-0.292c-0.039-0.064,0.101-0.344,0.088-0.419c-0.013-0.076-0.127-0.256,0.064-0.407s0.394-0.382,0.407-0.444c0.012-0.063,0.166-0.331,0.152-0.458c-0.012-0.127-0.152-0.28-0.24-0.318c-0.09-0.037-0.28-0.05-0.356-0.151c-0.077-0.103-0.292-0.203-0.368-0.178c-0.076,0.025-0.204,0.05-0.305-0.015c-0.102-0.062-0.267-0.139-0.33-0.189c-0.065-0.05-0.229-0.088-0.305-0.088c-0.077,0-0.065-0.052-0.178,0.101c-0.114,0.153,0,0.204-0.204,0.177c-0.204-0.023,0.025-0.036,0.141-0.189c0.113-0.152-0.013-0.242-0.141-0.203c-0.126,0.038-0.038,0.115-0.241,0.153c-0.203,0.036-0.203-0.09-0.076-0.115s0.355-0.139,0.355-0.19c0-0.051-0.025-0.191-0.127-0.191s-0.077-0.126-0.229-0.291c-0.092-0.101-0.196-0.164-0.299-0.204c-0.09-0.579-0.15-1.167-0.15-1.771c0-2.844,1.039-5.446,2.751-7.458c0.024-0.02,0.048-0.034,0.069-0.036c0.084-0.009,0.31-0.025,0.51-0.059c0.202-0.034,0.418-0.161,0.489-0.153c0.069,0.008,0.241,0.008,0.186-0.042C8.417,8.2,8.339,8.082,8.223,8.082S8.215,7.896,8.246,7.896c0.03,0,0.186,0.025,0.178,0.11C8.417,8.091,8.471,8.2,8.625,8.167c0.156-0.034,0.132-0.162,0.102-0.195C8.695,7.938,8.672,7.853,8.642,7.794c-0.031-0.06-0.023-0.136,0.14-0.153C8.944,7.625,9.168,7.708,9.16,7.573s0-0.28,0.046-0.356C9.253,7.142,9.354,7.09,9.299,7.065C9.246,7.04,9.176,7.099,9.121,6.972c-0.054-0.127,0.047-0.22,0.108-0.271c0.02-0.015,0.067-0.06,0.124-0.112C11.234,5.257,13.524,4.466,16,4.466c3.213,0,6.122,1.323,8.214,3.45c-0.008,0.022-0.01,0.052-0.031,0.056c-0.077,0.013-0.166,0.063-0.179-0.051c-0.013-0.114-0.013-0.331-0.102-0.203c-0.089,0.127-0.127,0.127-0.127,0.191c0,0.063,0.076,0.127,0.051,0.241C23.8,8.264,23.8,8.341,23.84,8.341c0.036,0,0.126-0.115,0.239-0.141c0.116-0.025,0.319-0.088,0.332,0.026c0.013,0.115,0.139,0.152,0.013,0.203c-0.128,0.051-0.267,0.026-0.293-0.051c-0.025-0.077-0.114-0.077-0.203-0.013c-0.088,0.063-0.279,0.292-0.279,0.292s-0.306,0.139-0.343,0.114c-0.04-0.025,0.101-0.165,0.203-0.228c0.102-0.064,0.178-0.204,0.14-0.242c-0.038-0.038-0.088-0.279-0.063-0.343c0.025-0.063,0.139-0.152,0.013-0.216c-0.127-0.063-0.217-0.14-0.318-0.178s-0.216,0.152-0.305,0.204c-0.089,0.051-0.076,0.114-0.191,0.127c-0.114,0.013-0.189,0.165,0,0.254c0.191,0.089,0.255,0.152,0.204,0.204c-0.051,0.051-0.267-0.025-0.267-0.025s-0.165-0.076-0.268-0.076c-0.101,0-0.229-0.063-0.33-0.076c-0.102-0.013-0.306-0.013-0.355,0.038c-0.051,0.051-0.179,0.203-0.28,0.152c-0.101-0.051-0.101-0.102-0.241-0.051c-0.14,0.051-0.279-0.038-0.355,0.038c-0.077,0.076-0.013,0.076-0.255,0c-0.241-0.076-0.189,0.051-0.419,0.089s-0.368-0.038-0.432,0.038c-0.064,0.077-0.153,0.217-0.19,0.127c-0.038-0.088,0.126-0.241,0.062-0.292c-0.062-0.051-0.33-0.025-0.367,0.013c-0.039,0.038-0.014,0.178,0.011,0.229c0.026,0.05,0.064,0.254-0.011,0.216c-0.077-0.038-0.064-0.166-0.141-0.152c-0.076,0.013-0.165,0.051-0.203,0.077c-0.038,0.025-0.191,0.025-0.229,0.076c-0.037,0.051,0.014,0.191-0.051,0.203c-0.063,0.013-0.114,0.064-0.254-0.025c-0.14-0.089-0.14-0.038-0.178-0.012c-0.038,0.025-0.216,0.127-0.229,0.012c-0.013-0.114,0.025-0.152-0.089-0.229c-0.115-0.076-0.026-0.076,0.127-0.025c0.152,0.05,0.343,0.075,0.622-0.013c0.28-0.089,0.395-0.127,0.28-0.178c-0.115-0.05-0.229-0.101-0.406-0.127c-0.179-0.025-0.42-0.025-0.7-0.127c-0.279-0.102-0.343-0.14-0.457-0.165c-0.115-0.026-0.813-0.14-1.132-0.089c-0.317,0.051-1.193,0.28-1.245,0.318s-0.128,0.19-0.292,0.318c-0.165,0.127-0.47,0.419-0.712,0.47c-0.241,0.051-0.521,0.254-0.521,0.305c0,0.051,0.101,0.242,0.076,0.28c-0.025,0.038,0.05,0.229,0.191,0.28c0.139,0.05,0.381,0.038,0.393-0.039c0.014-0.076,0.204-0.241,0.217-0.127c0.013,0.115,0.14,0.292,0.114,0.368c-0.025,0.077,0,0.153,0.09,0.14c0.088-0.012,0.559-0.114,0.559-0.114s0.153-0.064,0.127-0.166c-0.026-0.101,0.166-0.241,0.203-0.279c0.038-0.038,0.178-0.191,0.014-0.241c-0.167-0.051-0.293-0.064-0.115-0.216s0.292,0,0.521-0.229c0.229-0.229-0.051-0.292,0.191-0.305c0.241-0.013,0.496-0.025,0.444,0.051c-0.05,0.076-0.342,0.242-0.508,0.318c-0.166,0.077-0.14,0.216-0.076,0.292c0.063,0.076,0.09,0.254,0.204,0.229c0.113-0.025,0.254-0.114,0.38-0.101c0.128,0.012,0.383-0.013,0.42-0.013c0.039,0,0.216,0.178,0.114,0.203c-0.101,0.025-0.229,0.013-0.445,0.025c-0.215,0.013-0.456,0.013-0.456,0.051c0,0.039,0.292,0.127,0.19,0.191c-0.102,0.063-0.203-0.013-0.331-0.026c-0.127-0.012-0.203,0.166-0.241,0.267c-0.039,0.102,0.063,0.28-0.127,0.216c-0.191-0.063-0.331-0.063-0.381-0.038c-0.051,0.025-0.203,0.076-0.331,0.114c-0.126,0.038-0.076-0.063-0.242-0.063c-0.164,0-0.164,0-0.164,0l-0.103,0.013c0,0-0.101-0.063-0.114-0.165c-0.013-0.102,0.05-0.216-0.013-0.241c-0.064-0.026-0.292,0.012-0.33,0.088c-0.038,0.076-0.077,0.216-0.026,0.28c0.052,0.063,0.204,0.19,0.064,0.152c-0.14-0.038-0.317-0.051-0.419,0.026c-0.101,0.076-0.279,0.241-0.279,0.241s-0.318,0.025-0.318,0.102c0,0.077,0,0.178-0.114,0.191c-0.115,0.013-0.268,0.05-0.42,0.076c-0.153,0.025-0.139,0.088-0.317,0.102s-0.204,0.089-0.038,0.114c0.165,0.025,0.418,0.127,0.431,0.241c0.014,0.114-0.013,0.242-0.076,0.356c-0.043,0.079-0.305,0.026-0.458,0.026c-0.152,0-0.456-0.051-0.584,0c-0.127,0.051-0.102,0.305-0.064,0.419c0.039,0.114-0.012,0.178-0.063,0.216c-0.051,0.038-0.065,0.152,0,0.204c0.063,0.051,0.114,0.165,0.166,0.178c0.051,0.013,0.215-0.038,0.279,0.025c0.064,0.064,0.127,0.216,0.165,0.178c0.039-0.038,0.089-0.203,0.153-0.166c0.064,0.039,0.216-0.012,0.331-0.025s0.177-0.14,0.292-0.204c0.114-0.063,0.05-0.063,0.013-0.14c-0.038-0.076,0.114-0.165,0.204-0.254c0.088-0.089,0.253-0.013,0.292-0.115c0.038-0.102,0.051-0.279,0.151-0.267c0.103,0.013,0.243,0.076,0.331,0.076c0.089,0,0.279-0.14,0.332-0.165c0.05-0.025,0.241-0.013,0.267,0.102c0.025,0.114,0.241,0.254,0.292,0.279c0.051,0.025,0.381,0.127,0.433,0.165c0.05,0.038,0.126,0.153,0.152,0.254c0.025,0.102,0.114,0.102,0.128,0.013c0.012-0.089-0.065-0.254,0.025-0.242c0.088,0.013,0.191-0.026,0.191-0.026s-0.243-0.165-0.331-0.203c-0.088-0.038-0.255-0.114-0.331-0.241c-0.076-0.127-0.267-0.153-0.254-0.279c0.013-0.127,0.191-0.051,0.292,0.051c0.102,0.102,0.356,0.241,0.445,0.33c0.088,0.089,0.229,0.127,0.267,0.242c0.039,0.114,0.152,0.241,0.19,0.292c0.038,0.051,0.165,0.331,0.204,0.394c0.038,0.063,0.165-0.012,0.229-0.063c0.063-0.051,0.179-0.076,0.191-0.178c0.013-0.102-0.153-0.178-0.203-0.216c-0.051-0.038,0.127-0.076,0.191-0.127c0.063-0.05,0.177-0.14,0.228-0.063c0.051,0.077,0.026,0.381,0.051,0.432c0.025,0.051,0.279,0.127,0.331,0.191c0.05,0.063,0.267,0.089,0.304,0.051c0.039-0.038,0.242,0.026,0.294,0.038c0.049,0.013,0.202-0.025,0.304-0.05c0.103-0.025,0.204-0.102,0.191,0.063c-0.013,0.165-0.051,0.419-0.179,0.546c-0.127,0.127-0.076,0.191-0.202,0.191c-0.06,0-0.113,0-0.156,0.021c-0.041-0.065-0.098-0.117-0.175-0.097c-0.152,0.038-0.344,0.038-0.47,0.19c-0.128,0.153-0.178,0.165-0.204,0.114c-0.025-0.051,0.369-0.267,0.317-0.331c-0.05-0.063-0.355-0.038-0.521-0.038c-0.166,0-0.305-0.102-0.433-0.127c-0.126-0.025-0.292,0.127-0.418,0.254c-0.128,0.127-0.216,0.038-0.331,0.038c-0.115,0-0.331-0.165-0.331-0.165s-0.216-0.089-0.305-0.089c-0.088,0-0.267-0.165-0.318-0.165c-0.05,0-0.19-0.115-0.088-0.166c0.101-0.05,0.202,0.051,0.101-0.229c-0.101-0.279-0.33-0.216-0.419-0.178c-0.088,0.039-0.724,0.025-0.775,0.025c-0.051,0-0.419,0.127-0.533,0.178c-0.116,0.051-0.318,0.115-0.369,0.14c-0.051,0.025-0.318-0.051-0.433,0.013c-0.151,0.084-0.291,0.216-0.33,0.216c-0.038,0-0.153,0.089-0.229,0.28c-0.077,0.19,0.013,0.355-0.128,0.419c-0.139,0.063-0.394,0.204-0.495,0.305c-0.102,0.101-0.229,0.458-0.355,0.623c-0.127,0.165,0,0.317,0.025,0.419c0.025,0.101,0.114,0.292-0.025,0.471c-0.14,0.178-0.127,0.266-0.191,0.279c-0.063,0.013,0.063,0.063,0.088,0.19c0.025,0.128-0.114,0.255,0.128,0.369c0.241,0.113,0.355,0.217,0.418,0.367c0.064,0.153,0.382,0.407,0.382,0.407s0.229,0.205,0.344,0.293c0.114,0.089,0.152,0.038,0.177-0.05c0.025-0.09,0.178-0.104,0.355-0.104c0.178,0,0.305,0.04,0.483,0.014c0.178-0.025,0.356-0.141,0.42-0.166c0.063-0.025,0.279-0.164,0.443-0.063c0.166,0.103,0.141,0.241,0.23,0.332c0.088,0.088,0.24,0.037,0.355-0.051c0.114-0.09,0.064-0.052,0.203,0.025c0.14,0.075,0.204,0.151,0.077,0.267c-0.128,0.113-0.051,0.293-0.128,0.47c-0.076,0.178-0.063,0.203,0.077,0.278c0.14,0.076,0.394,0.548,0.47,0.638c0.077,0.088-0.025,0.342,0.064,0.495c0.089,0.151,0.178,0.254,0.077,0.331c-0.103,0.075-0.28,0.216-0.292,0.47s0.051,0.431,0.102,0.521s0.177,0.331,0.241,0.419c0.064,0.089,0.14,0.305,0.152,0.445c0.013,0.14-0.024,0.306,0.039,0.381c0.064,0.076,0.102,0.191,0.216,0.292c0.115,0.103,0.152,0.318,0.152,0.318s0.039,0.089,0.051,0.229c0.012,0.14,0.025,0.228,0.152,0.292c0.126,0.063,0.215,0.076,0.28,0.013c0.063-0.063,0.381-0.077,0.546-0.063c0.165,0.013,0.355-0.075,0.521-0.19s0.407-0.419,0.496-0.508c0.089-0.09,0.292-0.255,0.268-0.356c-0.025-0.101-0.077-0.203,0.024-0.254c0.102-0.052,0.344-0.152,0.356-0.229c0.013-0.077-0.09-0.395-0.115-0.457c-0.024-0.064,0.064-0.18,0.165-0.306c0.103-0.128,0.421-0.216,0.471-0.267c0.051-0.053,0.191-0.267,0.217-0.433c0.024-0.167-0.051-0.369,0-0.457c0.05-0.09,0.013-0.165-0.103-0.268c-0.114-0.102-0.089-0.407-0.127-0.457c-0.037-0.051-0.013-0.319,0.063-0.345c0.076-0.023,0.242-0.279,0.344-0.393c0.102-0.114,0.394-0.47,0.534-0.496c0.139-0.025,0.355-0.229,0.368-0.343c0.013-0.115,0.38-0.547,0.394-0.635c0.013-0.09,0.166-0.42,0.102-0.497c-0.062-0.076-0.559,0.115-0.622,0.141c-0.064,0.025-0.241,0.127-0.446,0.113c-0.202-0.013-0.114-0.177-0.127-0.254c-0.012-0.076-0.228-0.368-0.279-0.381c-0.051-0.012-0.203-0.166-0.267-0.317c-0.063-0.153-0.152-0.343-0.254-0.458c-0.102-0.114-0.165-0.38-0.268-0.559c-0.101-0.178-0.189-0.407-0.279-0.572c-0.021-0.041-0.045-0.079-0.067-0.117c0.118-0.029,0.289-0.082,0.31-0.009c0.024,0.088,0.165,0.279,0.19,0.419s0.165,0.089,0.178,0.216c0.014,0.128,0.14,0.433,0.19,0.47c0.052,0.038,0.28,0.242,0.318,0.318c0.038,0.076,0.089,0.178,0.127,0.369c0.038,0.19,0.076,0.444,0.179,0.482c0.102,0.038,0.444-0.064,0.508-0.102s0.482-0.242,0.635-0.255c0.153-0.012,0.179-0.115,0.368-0.152c0.191-0.038,0.331-0.177,0.458-0.28c0.127-0.101,0.28-0.355,0.33-0.444c0.052-0.088,0.179-0.152,0.115-0.253c-0.063-0.103-0.331-0.254-0.433-0.268c-0.102-0.012-0.089-0.178-0.152-0.178s-0.051,0.088-0.178,0.153c-0.127,0.063-0.255,0.19-0.344,0.165s0.026-0.089-0.113-0.203s-0.192-0.14-0.192-0.228c0-0.089-0.278-0.255-0.304-0.382c-0.026-0.127,0.19-0.305,0.254-0.19c0.063,0.114,0.115,0.292,0.279,0.368c0.165,0.076,0.318,0.204,0.395,0.229c0.076,0.025,0.267-0.14,0.33-0.114c0.063,0.024,0.191,0.253,0.306,0.292c0.113,0.038,0.495,0.051,0.559,0.051s0.33,0.013,0.381-0.063c0.051-0.076,0.089-0.076,0.153-0.076c0.062,0,0.177,0.229,0.267,0.254c0.089,0.025,0.254,0.013,0.241,0.179c-0.012,0.164,0.076,0.305,0.165,0.317c0.09,0.012,0.293-0.191,0.293-0.191s0,0.318-0.012,0.433c-0.014,0.113,0.139,0.534,0.139,0.534s0.19,0.393,0.241,0.482s0.267,0.355,0.267,0.47c0,0.115,0.025,0.293,0.103,0.293c0.076,0,0.152-0.203,0.24-0.331c0.091-0.126,0.116-0.305,0.153-0.432c0.038-0.127,0.038-0.356,0.038-0.444c0-0.09,0.075-0.166,0.255-0.242c0.178-0.076,0.304-0.292,0.456-0.407c0.153-0.115,0.141-0.305,0.446-0.305c0.305,0,0.278,0,0.355-0.077c0.076-0.076,0.151-0.127,0.19,0.013c0.038,0.14,0.254,0.343,0.292,0.394c0.038,0.052,0.114,0.191,0.103,0.344c-0.013,0.152,0.012,0.33,0.075,0.33s0.191-0.216,0.191-0.216s0.279-0.189,0.267,0.013c-0.014,0.203,0.025,0.419,0.025,0.545c0,0.053,0.042,0.135,0.088,0.21c-0.005,0.059-0.004,0.119-0.009,0.178C27.388,17.153,27.387,17.327,27.436,17.39zM20.382,12.064c0.076,0.05,0.102,0.127,0.152,0.203c0.052,0.076,0.14,0.05,0.203,0.114c0.063,0.064-0.178,0.14-0.075,0.216c0.101,0.077,0.151,0.381,0.165,0.458c0.013,0.076-0.279,0.114-0.369,0.102c-0.089-0.013-0.354-0.102-0.445-0.127c-0.089-0.026-0.139-0.343-0.025-0.331c0.116,0.013,0.141-0.025,0.267-0.139c0.128-0.115-0.189-0.166-0.278-0.191c-0.089-0.025-0.268-0.305-0.331-0.394c-0.062-0.089-0.014-0.228,0.141-0.331c0.076-0.051,0.279,0.063,0.381,0c0.101-0.063,0.203-0.14,0.241-0.165c0.039-0.025,0.293,0.038,0.33,0.114c0.039,0.076,0.191,0.191,0.141,0.229c-0.052,0.038-0.281,0.076-0.356,0c-0.075-0.077-0.255,0.012-0.268,0.152C20.242,12.115,20.307,12.013,20.382,12.064zM16.875,12.28c-0.077-0.025,0.025-0.178,0.102-0.229c0.075-0.051,0.164-0.178,0.241-0.305c0.076-0.127,0.178-0.14,0.241-0.127c0.063,0.013,0.203,0.241,0.241,0.318c0.038,0.076,0.165-0.026,0.217-0.051c0.05-0.025,0.127-0.102,0.14-0.165s0.127-0.102,0.254-0.102s0.013,0.102-0.076,0.127c-0.09,0.025-0.038,0.077,0.113,0.127c0.153,0.051,0.293,0.191,0.459,0.279c0.165,0.089,0.19,0.267,0.088,0.292c-0.101,0.025-0.406,0.051-0.521,0.038c-0.114-0.013-0.254-0.127-0.419-0.153c-0.165-0.025-0.369-0.013-0.433,0.077s-0.292,0.05-0.395,0.05c-0.102,0-0.228,0.127-0.253,0.077C16.875,12.534,16.951,12.306,16.875,12.28zM17.307,9.458c0.063-0.178,0.419,0.038,0.355,0.127C17.599,9.675,17.264,9.579,17.307,9.458zM17.802,18.584c0.063,0.102-0.14,0.431-0.254,0.407c-0.113-0.027-0.076-0.318-0.038-0.382C17.548,18.545,17.769,18.529,17.802,18.584zM13.189,12.674c0.025-0.051-0.039-0.153-0.127-0.013C13.032,12.71,13.164,12.725,13.189,12.674zM20.813,8.035c0.141,0.076,0.339,0.107,0.433,0.013c0.076-0.076,0.013-0.204-0.05-0.216c-0.064-0.013-0.104-0.115,0.062-0.203c0.165-0.089,0.343-0.204,0.534-0.229c0.19-0.025,0.622-0.038,0.774,0c0.152,0.039,0.382-0.166,0.445-0.254s-0.203-0.152-0.279-0.051c-0.077,0.102-0.444,0.076-0.521,0.051c-0.076-0.025-0.686,0.102-0.812,0.102c-0.128,0-0.179,0.152-0.356,0.229c-0.179,0.076-0.42,0.191-0.509,0.229c-0.088,0.038-0.177,0.19-0.101,0.216C20.509,7.947,20.674,7.959,20.813,8.035zM14.142,12.674c0.064-0.089-0.051-0.217-0.114-0.217c-0.12,0-0.178,0.191-0.103,0.254C14.002,12.776,14.078,12.763,14.142,12.674zM14.714,13.017c0.064,0.025,0.114,0.102,0.165,0.114c0.052,0.013,0.217,0,0.167-0.127s-0.167-0.127-0.204-0.127c-0.038,0-0.203-0.038-0.267,0C14.528,12.905,14.65,12.992,14.714,13.017zM11.308,10.958c0.101,0.013,0.217-0.063,0.305-0.101c0.088-0.038,0.216-0.114,0.216-0.229c0-0.114-0.025-0.216-0.077-0.267c-0.051-0.051-0.14-0.064-0.216-0.051c-0.115,0.02-0.127,0.14-0.203,0.14c-0.076,0-0.165,0.025-0.14,0.114s0.077,0.152,0,0.19C11.117,10.793,11.205,10.946,11.308,10.958zM11.931,10.412c0.127,0.051,0.394,0.102,0.292,0.153c-0.102,0.051-0.28,0.19-0.305,0.267s0.216,0.153,0.216,0.153s-0.077,0.089-0.013,0.114c0.063,0.025,0.102-0.089,0.203-0.089c0.101,0,0.304,0.063,0.406,0.063c0.103,0,0.267-0.14,0.254-0.229c-0.013-0.089-0.14-0.229-0.254-0.28c-0.113-0.051-0.241-0.28-0.317-0.331c-0.076-0.051,0.076-0.178-0.013-0.267c-0.09-0.089-0.153-0.076-0.255-0.14c-0.102-0.063-0.191,0.013-0.254,0.089c-0.063,0.076-0.14-0.013-0.217,0.012c-0.102,0.035-0.063,0.166-0.012,0.229C11.714,10.221,11.804,10.361,11.931,10.412zM24.729,17.198c-0.083,0.037-0.153,0.47,0,0.521c0.152,0.052,0.241-0.202,0.191-0.267C24.868,17.39,24.843,17.147,24.729,17.198zM20.114,20.464c-0.159-0.045-0.177,0.166-0.304,0.306c-0.128,0.141-0.267,0.254-0.317,0.241c-0.052-0.013-0.331,0.089-0.242,0.279c0.089,0.191,0.076,0.382-0.013,0.472c-0.089,0.088,0.076,0.342,0.052,0.482c-0.026,0.139,0.037,0.229,0.215,0.229s0.242-0.064,0.318-0.229c0.076-0.166,0.088-0.331,0.164-0.47c0.077-0.141,0.141-0.434,0.179-0.51c0.038-0.075,0.114-0.316,0.102-0.457C20.254,20.669,20.204,20.489,20.114,20.464zM10.391,8.802c-0.069-0.06-0.229-0.102-0.306-0.11c-0.076-0.008-0.152,0.06-0.321,0.06c-0.168,0-0.279,0.067-0.347,0C9.349,8.684,9.068,8.65,9.042,8.692C9.008,8.749,8.941,8.751,9.008,8.87c0.069,0.118,0.12,0.186,0.179,0.178s0.262-0.017,0.288,0.051C9.5,9.167,9.569,9.226,9.712,9.184c0.145-0.042,0.263-0.068,0.296-0.119c0.033-0.051,0.263-0.059,0.263-0.059S10.458,8.861,10.391,8.802z";

var globeHover = globeIcon.states.create("hover");
globeHover.properties.fill = hoverColor;

var label = labelContainer.createChild(am4core.Label);
label.valign = "bottom";
label.verticalCenter = "bottom";
label.dy = -5;
label.text = "Back to continents map";
label.states.create("hover").properties.fill = hoverColor;

//drill-down-map//
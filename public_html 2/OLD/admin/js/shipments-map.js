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




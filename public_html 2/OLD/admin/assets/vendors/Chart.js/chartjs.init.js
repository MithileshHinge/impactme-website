$(document).ready(function() {

    var ctx = document.getElementById('myChart1');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });


    new Chart(document.getElementById("myChart2"), {
        "type": "line",
        "data": {
            "labels": ["Day 1", "Day 2", "Day 3", "Day 4", "Day 5", "Day 6", "Day 7"],
            "datasets": [{
                "label": "My First Dataset",
                "data": [65, 59, 80, 81, 56, 55, 40],
                "fill": false,
                "borderColor": "#025A83",
                "lineTension": 0.3
            }]
        },
        "options": {}
    });


    new Chart(document.getElementById("myChart3"), {
        "type": "radar",
        "data": {
            "labels": ["Eating", "Drinking", "Sleeping", "Designing", "Coding", "Cycling", "Running"],
            "datasets": [{
                "label": "My First Dataset",
                "data": [65, 59, 90, 81, 56, 55, 40],
                "fill": true,
                "backgroundColor": "rgba(255, 99, 132, 0.2)",
                "borderColor": "rgb(255, 99, 132)",
                "pointBackgroundColor": "rgb(255, 99, 132)",
                "pointBorderColor": "#fff",
                "pointHoverBackgroundColor": "#fff",
                "pointHoverBorderColor": "rgb(255, 99, 132)"
            }, {
                "label": "My Second Dataset",
                "data": [28, 48, 40, 19, 96, 27, 100],
                "fill": true,
                "backgroundColor": "rgba(54, 162, 235, 0.2)",
                "borderColor": "rgb(54, 162, 235)",
                "pointBackgroundColor": "rgb(54, 162, 235)",
                "pointBorderColor": "#fff",
                "pointHoverBackgroundColor": "#fff",
                "pointHoverBorderColor": "rgb(54, 162, 235)"
            }]
        },
        "options": {
            "elements": {
                "line": {
                    "tension": 0,
                    "borderWidth": 3
                }
            }
        }
    });


    new Chart(document.getElementById("myChart4"), {
        "type": "doughnut",
        "data": {
            "labels": ["Red", "Blue", "Yellow"],
            "datasets": [{
                "label": "My First Dataset",
                "data": [300, 50, 100],
                "backgroundColor": ["#D4EDDA", "#F8D7DA", "#B2CAF7"]
            }]
        }
    });

    new Chart(document.getElementById("myChart5"), {
        "type": "polarArea",
        "data": {
            "labels": ["Blue", "Green", "Pink", "Peach", "Turqoise"],
            "datasets": [{
                "label": "My First Dataset",
                "data": [11, 16, 7, 3, 14],
                "backgroundColor": ["#B2CAF7", "#D4EDDA", "#F8D7DA", "#FFF3CD", "#D1ECF1"]
            }]
        }

    });


    new Chart(document.getElementById("myChart6"), {
        "type": "bubble",
        "data": {
            "datasets": [{
                "label": "First Dataset",
                "data": [{
                    "x": 30,
                    "y": 30,
                    "r": 15
                }, {
                    "x": 30,
                    "y": 20,
                    "r": 15
                }, {
                    "x": 50,
                    "y": 22,
                    "r": 15
                }, {
                    "x": 40,
                    "y": 10,
                    "r": 15
                }, {
                    "x": 20,
                    "y": 10,
                    "r": 10
                }],
                "backgroundColor": "#FFE7D7"
            }]
        }
    });




});
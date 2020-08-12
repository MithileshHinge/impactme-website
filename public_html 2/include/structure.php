<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<div class="container boss" style="border-bottom: 1px solid #c3c1c18f;">
    <h2>Low , Simple and Transparent Fees Structure</h2>
    <div class="col-md-1"></div>
    <div class="row">
        <div class="col-md-4 upload" style="margin: 32px auto;">
                <!--canvas id="fee-struct-canvas"></canvas-->
                <h2 class="percentages">5%</h2>
                <p style="text-align: center;" class="step-screen">platform fees on recurring payments</p>
        </div>
        <div class="col-md-4 upload" style="margin: 32px auto;">
                <!--canvas id="one-time-struct-canvas"></canvas-->
                <h2 class="percentages">8%</h2>
                <p style="text-align: center;" class="step-screen">platform fees on one-time payments</p>
        </div>
    </div>

    <p style="width:100%; text-align:center; margin-top:90px" class="step-screen">Please read the <a href="<?=BASEPATH?>/terms-conditions#terms_fees" style="text-decoration:underline;">Fees section</a> of our Terms for more details.</p>
    
</div>
    <!--script type="text/javascript">
    var inView = false;

    function isScrolledIntoView(elem)
    {
        var docViewTop = $(window).scrollTop();
        var docViewBottom = docViewTop + $(window).height();

        var elemTop = $(elem).offset().top;
        var elemBottom = elemTop + $(elem).height();

        return ((elemTop <= docViewBottom) && (elemBottom >= docViewTop));
    }

    $(window).scroll(function() {
        if (isScrolledIntoView('#fee-struct-canvas')) {
            if (inView) { return; }
            inView = true;
            var ctx = document.getElementById("fee-struct-canvas").getContext("2d");
            var feeChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    datasets: [{
                        data: [5, 5, 90],
                        backgroundColor: [
                            '#2ecc71',
                            '#f39c12',
                            '#3a9cb5'
                        ]
                    }],

                    labels: ["ImpactMe", "Max. Transaction Fees", "You"]
                },

                options: {
                    tooltips: {
                      callbacks: {
                        label: function(tooltipItem, data) {
                          return data['labels'][tooltipItem['index']] + ': ' + data['datasets'][0]['data'][tooltipItem['index']] + '%';
                        }
                      }
                    }
                }

            });

        } else {
            inView = false;  
        }
    });
    </script-->
    
    <div class="col-md-12 terms">
     
        <div class="col-md-1"></div>
        <div class="col-md-10 upload">
           <!--  <img src="images/piechart.png" class="fact"> -->
           
            <h2>Are you ready to <br>create on your own terms?</h2>
            <a href="<?=BASEPATH?>/sign-up/?ut=create&type=<?=md5(rand())?>" class="mty create">Create My Page</a>
        </div>
    </div>
<?php
ob_start();
session_start();
require_once("config.php"); // include confog file
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
include_once(MYSQL_CLASS_DIR."DBConnection.php"); // to stablish database connection
include(PHP_FUNCTION_DIR."function.database.php"); // to use user define function like execute query
$dbObj = new DBConnection(); // to make connection onject
if(!isset($_SESSION['is_user_login']) && !isset($_SESSION['user_id'])){
	$_SESSION['loginerror'] = 'Please Login...';
	header('Location:login.php');
	exit();
}

$dbObj->dbQuery = "SELECT * FROM ".PREFIX."users WHERE id='".sc_mysql_escape($_SESSION['user_id'])."'"; 
$dbUser = $dbObj->SelectQuery('edithome.php','aboutEdit()');
?>
<!DOCTYPE html>

<html>


<head>

    <title>Welcome to Impactme</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale = 1.0, maximum-scale=1.0, user-scalable=no" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="css/normalize.css"/>

    <link rel="stylesheet" href="css/jquery.sidr.light.css"/>

	<link rel="stylesheet" href="css/animate.min.css"/>

	<link rel="stylesheet" href="css/md-slider.css"/>

    <link rel="stylesheet" href="css/style.css"/>

    <link rel="stylesheet" href="css/responsive.css"/>

    <script type="text/javascript" src="js/raphael-min.js"></script>

    <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>

	<script type="text/javascript" src="js/jquery-migrate-1.2.1.min.js"></script>

    <script type="text/javascript" src="js/jquery.touchwipe.min.js"></script>

	<script type="text/javascript" src="js/md_slider.min.js"></script>

	<script type="text/javascript" src="js/jquery.sidr.min.js"></script>

    <!-- <script type="text/javascript" src="js/jquery.tweet.min.js"></script> -->

    <script type="text/javascript" src="js/pie.js"></script>

    <script type="text/javascript" src="js/script.js"></script>



</head>

<body>

    <div id="wrapper">

         <?php include('header.php');?><!--end: #header -->

    </div>

    <div class="col-md-12 ">



        <img src="images/pizza.png">

        <div class="become-photo"></div>

        <h4 class="become-impact">BECOME A PATRON OF</h4>

        <h3 class="become-pizzi"><a href="#">GioPizzi</a></h3>

        

    </div>

    <div class="clr"></div>



    <section style="background-color: white;">

        <div class="container become-conter">

            <div class="col-md-12 ">



                <div class="col-md-4 become-telegram">

                    <h3 class="livello-1-become">Campione Livello 1 (0.85€)</h3>

                    <h2 class="doller-become">$1</h2>

                    <p class="doller-permonth">PER MONTH</p>

                    <p class="sapevo">"Lo sapevo che eri il mio campione!"</p>

                    <p class="faccio-become">Questa donazione dimostra che tieni alle cose che faccio, quindi il tuo nome verrà pubblicato direttamente nei crediti a fine video!</p>

                    <ul>

                        <li class="support-become"><span style="font-weight: 900;">Ringraziamento pubblico</span>in ogni video come supporter.</li>

                    </ul>

                    <a href="checkout.php" class="select-become" style="    top: 273px;">Select</a>

                </div>



                <div class="col-md-4 become-telegram">

                    <h3 class="livello-1-become">Campione Livello 2 (4 €)</h3>

                    <h2 class="doller-become">$5</h2>

                    <p class="doller-permonth">PER MONTH</p>

                    <p class="sapevo">"Ehy, a questo punto conosciamoci, no?"</p>

                    <p class="faccio-become">Con questa donazione avrai accesso alla <span  style="font-weight: 900;">chat privata</span> dei miei Patrons su <span style="font-weight: 900;">Telegram</span>, dove potrai insultarmi quanto ti pare, restare connesso con me e discutere con tutti gli altri campioni. Inoltre, vedrai tutti i <span style="font-weight: 900;">video in anteprima</span> del mio canale!</p>

                    

                    <ul>

                        <li class="support-become">Partecipa alla mia<span style="font-weight: 900;">chat di gruppo Telegram.</span></li>

                        <li class="support-become"><span style="font-weight: 900;">Anteprima</span>ai video della settimana.</li>

                        <li class="support-become"><span style="font-weight: 900;">Tutti i premi precedenti.</span></li>

                    </ul>

                    <a href="checkout.php" class="select-become" style="    top: 149px;">Select</a>

                </div>



                <div class="col-md-4 become-telegram">

                    <h3 class="livello-1-become">Campione Livello 3 (8 €)</h3>

                    <h2 class="doller-become">$10</h2>

                    <p class="doller-permonth">PER MONTH</p>

                    <p class="sapevo">"Ma questo è amore... davvero amore!"</p>

                    <p class="faccio-become">Il tuo amore è grande. Per questo, oltre ai premi precedenti, avrai anche gli episodi del mio <span  style="font-weight: 900;">podcast settimanale in anteprima</span>(come Fritto Misto o il LowPizzi). </p>



                    <p class="faccio-become" style="padding-top: 0px;"> visto che l'amore è uno spettacolo, avrai l'<span  style="font-weight: 900;">ingresso gratuito ai miei spettacoli. </span>Perché l'amore va ripagato!</p>

                    

                    <ul>

                        <li class="support-become"><span style="font-weight: 900;">Anteprima</span>al mio

                        <span style="font-weight: 900;">podcast settimanale.</span></li>

                        <li class="support-become"><span style="font-weight: 900;">Ingresso gratuito ai miei spettacoli.</span></li>

                        <li class="support-become"><span style="font-weight: 900;">Tutti i miei articoli satirici ed editoriali</span>in anticipo di una settimana.</li>

                        <li class="support-become"><span style="font-weight: 900;">Tutti i premi precedenti.</span></li>

                    </ul>

                    <a href="checkout.php" class="select-become" style="    top: 68px;">Select</a>

                </div>



                <div class="col-md-3 become-telegram">

                    <h3 class="livello-1-become">Campione Livello 4 (17 €)</h3>

                    <h2 class="doller-become">$20</h2>

                    <p class="doller-permonth">PER MONTH</p>

                    <p class="sapevo">"Mi piaci fratello... e ora che vuoi fare?"</p>

                    <p class="faccio-become">Con questa donazione <span  style="font-weight: 900;">avrai accesso a tutto quello che riguarda la mia produzione audio/video,</span>montaggi, anteprime, script e copioni.</p>



                    <p class="faccio-become" style="padding-top: 0px;"> Oltre ad avere la possibilità di<span  style="font-weight: 900;">proporre l'argomento dei vlog</span>della settimana o i temi che più ti piacerebbe fossero affrontati da me!</p>

                    

                    <ul>

                        <li class="support-become"><span style="font-weight: 900;">Accesso a tutto il materiale</span>audio/video di pre-produzione (anteprime, podcast, librerie audio e copioni)

                        </li>

                        <li class="support-become"><span style="font-weight: 900;">Possibilità di proposta dell'argomento</span>o tema dei PizziTalk o dei Podcast.</li>

                       

                        <li class="support-become"><span style="font-weight: 900;">Tutti i premi precedenti.</span></li>

                    </ul>

                    <a href="checkout.php" class="select-become">Select</a>

                </div>



                <div class="col-md-3 become-telegram">

                    <h3 class="livello-1-become">Campione Livello 5 (44 €)</h3>

                    <h2 class="doller-become">$50</h2>

                    <p class="doller-permonth">PER MONTH</p>

                    <p class="sapevo">"Siamo in affari campione!"</p>

                    <p class="faccio-become" > Qui siamo ben oltre il campione, campione.</p>

                    <p class="faccio-become" style="padding-top: 0px;">Con questa donazione diventi un vero e proprio <span  style="font-weight: 900;">produttore</span>per i miei progetti: spettacoli di Stand-Up Comedy, Radio, Vlog e Doppiaggio.</p>

                    

                    <ul>

                        <li class="support-become">Connessione continua per <span style="font-weight: 900;">l'organizzazione e sviluppo di progetti</span>teatrali, eventi, stand-up comedy e non.

                        </li>

                       

                        <li class="support-become"><span style="font-weight: 900;">Tutti i premi precedenti.</span></li>

                    </ul>

                    <a href="checkout.php" class="select-become" style="    top: 159px;">Select</a>

                </div>

            </div>

            <div class="col-md-12">

                <div class="col-md-4"></div>

                <div class="col-md-4 custom-become">

                    <p class="want-become">DON'T WANT TO SELECT A TIER?</p>

                    <a href="checkout.php" class="pledge-become" style="color: red;">Make a custom pledge</a>

                </div>

                <div class="col-md-4"></div>

            </div>

        </div>

    </section>

    

</body>

</html>
<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'impactme');    // DB username
define('DB_PASSWORD', '+G3,[B&d@X](');    // DB password
define('DB_DATABASE', 'asfewtaW');      // DB name
$connection = mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD) or die( "Unable to connect");
$database = mysql_select_db(DB_DATABASE) or die( "Unable to select database");
?>
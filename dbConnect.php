
<?php
 //Defining Constants
 define('HOST','host ip');
 define('USER','username');
 define('PASS','password');
 define('DB','db_name');
 
 //Connecting to Database
 $con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect');
 
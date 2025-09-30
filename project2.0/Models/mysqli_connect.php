       
<?php
    //connect to database 

    $hostname = "localhost";
    $username = "Ayana";
    $password = "D0ntH@ckM3";
    $dbname = "sdc310l";

    $db_conn = mysqli_connect($hostname, $username, $password, $dbname);
    if($db_conn->connect_error){
        die("Connection failed" . $db_conn->connect_error);
    }
    
?>
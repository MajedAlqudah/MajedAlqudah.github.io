<?php

$sname = "localhost";
$uname = "root";
$passord = "";

$db_name = "conference_information_system";

$connection = mysqli_connect($sname ,$uname ,$passord ,$db_name);

if(!$connection)
{
    echo "connection failed";
}
?>
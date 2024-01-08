<?php

$sname = "sql211.infinityfree.com";
$uname = "if0_35750089";
$passord = "2ujfGULeYOmmrqx";

$db_name = "if0_35750089_conference_information_system";

$conn = mysqli_connect($sname ,$uname ,$passord ,$db_name);

if(!$conn)
{
    echo "connection failed";
}
?>
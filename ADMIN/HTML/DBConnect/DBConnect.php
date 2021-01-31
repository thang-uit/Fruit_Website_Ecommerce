<?php
    $DBHost = "localhost";
    $DBUser = "root";
    $DBPass = "";
    $DBName = "fruit";

    $con = mysqli_connect($DBHost, $DBUser, $DBPass, $DBName);

    if($con)
    {
        // echo "Connect Success!";
        mysqli_query($con, "SET NAMES 'utf8'");
    }
    else
    {
        // header('Location: ../404.php');
        echo "Connect Fail!";
        echo mysqli_connect_error();
    }
?>
<?php
    session_start();
    include './DBConnect/DBConnect.php';

    if(isset($_POST['Username']) && !empty($_POST['Username']) && isset($_POST['Password']) && !empty($_POST['Password']))
    {
        $Acc_Username = $_POST['Username'];
        $Acc_Password = md5($_POST['Password']);

        $SQLLogin = "SELECT * FROM `accounts` WHERE `Acc_Role` = 'admin' AND `Acc_Username` = '$Acc_Username' AND `Acc_Password` = '$Acc_Password'";
        $Account = $con->query($SQLLogin);
        $row = $Account->fetch_array();
        
        if(!empty($row))
        {
            echo "OK";
            $_SESSION['loginadmin'] = $row;
        }
        else
        {
            echo "Username or password is not correct!";
        }
    }
?>
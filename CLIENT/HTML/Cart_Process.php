<?php
    session_start();
    include './DBConnect/DBConnect.php';
    
    $numcart = 0;
    $action = isset($_GET['action']) ? $_GET['action'] : 'add';//kiểm tra

    if($action == 'add') 
    {
        if(isset($_POST['ID']) && isset($_POST['Number']))
        {
            $ID = $_POST['ID'];
            $Number = $_POST['Number'];

            $SQL = "SELECT * FROM `products` WHERE `Pro_ID` = $ID";
            $Product = $con->query($SQL);
            $row = mysqli_fetch_array($Product);

            if(!isset($_SESSION['cart']))
            {
                $cart = array();
                $cart[$ID] = array
                (
                    'name' => $row['Pro_Name'],
                    'image' => $row['Pro_Img'],
                    'num' => $Number,
                    'price' => $row['Pro_Price'],
                );
            }
            else
            {
                $cart = $_SESSION['cart'];
                if(array_key_exists($ID, $cart))
                {
                    $cart[$ID] = array
                    (
                        'name' => $row['Pro_Name'],
                        'image' => $row['Pro_Img'],
                        'num' => $cart[$ID]['num'] + $Number,
                        'price' => $row['Pro_Price'],
                    );
                }
                else
                {
                    $cart[$ID] = array
                    (
                        'name' => $row['Pro_Name'],
                        'image' => $row['Pro_Img'],
                        'num' => $Number,
                        'price' => $row['Pro_Price'],
                    );
                }
            }
            $_SESSION['cart'] = $cart;
            // print_r($_SESSION['cart']);
            // die;
            foreach($cart as $key => $value)
            {
                $numcart++;
            }
            echo $numcart;
        }
    }


    if($action == 'update')
    {
        if(isset($_POST['ID']) && isset($_POST['Number']))
        {
            $ID = $_POST['ID'];
            $Number = $_POST['Number']; 
            
            $cart = $_SESSION['cart'];
            if(array_key_exists($ID, $cart))
            {
                if($Number > 0)
                {
                    $cart[$ID] = array
                    (
                        'name' => $cart[$ID]['name'],
                        'image' => $cart[$ID]['image'],
                        'num' => $Number,
                        'price' => $cart[$ID]['price'],
                    );
                }
                else
                {
                    unset($cart[$ID]);
                }
            }
            $_SESSION['cart'] = $cart;
            // print_r($_SESSION['cart']);
            // die;

            foreach($cart as $key => $value)
            {
                $numcart++;
            }
            echo $numcart;
        }
    }
?>
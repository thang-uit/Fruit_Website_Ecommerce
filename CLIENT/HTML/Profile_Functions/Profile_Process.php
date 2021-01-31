<?php
    session_start();
    include '../DBConnect/DBConnect.php';

    $action = isset($_GET['action']) ? $_GET['action'] : 'none';

    if($action == 'update')
    {
        if(isset($_POST['Cus_ID']) && isset($_POST['Cus_Name']) && isset($_POST['Cus_BDay']) && isset($_POST['Cus_Gender']) && isset($_POST['Cus_Email'])  && isset($_POST['Cus_Phone']))
        {
            $current_date = date("Y-m-d H:i:s"); 

            $Cus_ID = $_POST['Cus_ID'];
            $Cus_Name = $_POST['Cus_Name'];
            $Cus_BDay = $_POST['Cus_BDay'];
            $Cus_Gender = $_POST['Cus_Gender'];
            $Cus_Email = $_POST['Cus_Email'];
            $Cus_Phone = $_POST['Cus_Phone'];

            if(empty($Cus_Name) || empty($Cus_BDay) || $Cus_Gender != 0 && $Cus_Gender != 1 || empty($Cus_Email) || empty($Cus_Phone))
            {
                echo "Vui lòng điền đầy đủ thông tin!";
            }
            else
            {
                // Update Into Database
                $SQLCus = "UPDATE `customer` SET `Cus_Name`= '$Cus_Name', `Cus_BDay`= '$Cus_BDay', `Cus_Gender`= '$Cus_Gender', `Cus_Email`= '$Cus_Email', `Cus_Phone`= '$Cus_Phone' WHERE `Cus_ID` = '$Cus_ID'";                   
                $Customer = $con->query($SQLCus);

                if($Customer == true)
                {
                    echo "Cập nhật thành công!";                   
                }
                else
                {
                    echo "Lỗi hệ thống! Cập nhật thông tin thất bại!";
                }
            }
        }
    }


    if($action == 'deleteorder')
    {
        if(isset($_POST['Ord_ID']))
        {
            $ID_Order = $_POST['Ord_ID'];

            $SQLOrder = "DELETE FROM `orders` WHERE `orders`.`Ord_ID` = '$ID_Order'";                   
            $DeleteOD = $con->query($SQLOrder);

            if($DeleteOD == true)
            {
                echo "Xóa đơn hàng thành công!";
            }
            else
            {
                echo "Lỗi hệ thống! Xóa đơn hàng thất bại!";
            }
        }
    }

    if($action == 'none')
    {
        echo "Lỗi hệ thống!";
    }
?>
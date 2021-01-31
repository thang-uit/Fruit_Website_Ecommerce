<?php
    $Cus_ID = $_SESSION['login']['Cus_ID'];

    $SQLOrder1 = "SELECT COUNT(*) AS AMOUNT FROM `orders` WHERE `orders`.`Ord_Status` = '0' AND `orders`.`Cus_ID` = '$Cus_ID'";
    $SQLOrder2 = "SELECT COUNT(*) AS AMOUNT FROM `orders` WHERE `orders`.`Ord_Status` = '1' AND `orders`.`Cus_ID` = '$Cus_ID'";
    $SQLOrder3 = "SELECT COUNT(*) AS AMOUNT FROM `orders` WHERE `orders`.`Ord_Status` = '2' AND `orders`.`Cus_ID` = '$Cus_ID'";
    $SQLOrder4 = "SELECT COUNT(*) AS AMOUNT FROM `orders` WHERE `orders`.`Ord_Status` = '3' AND `orders`.`Cus_ID` = '$Cus_ID'";

    $Query1 = $con->query($SQLOrder1);
    $Query2 = $con->query($SQLOrder2);
    $Query3 = $con->query($SQLOrder3);
    $Query4 = $con->query($SQLOrder4);

    $row1 = $Query1->fetch_array();
    $row2 = $Query2->fetch_array();
    $row3 = $Query3->fetch_array();
    $row4 = $Query4->fetch_array();

    $Result1 = !empty($row1) ? $row1['AMOUNT'] : '0';
    $Result2 = !empty($row2) ? $row2['AMOUNT'] : '0';
    $Result3 = !empty($row3) ? $row3['AMOUNT'] : '0';
    $Result4 = !empty($row4) ? $row4['AMOUNT'] : '0';
?>

<div class="statistic">
    <div class="col">
        <div class="counter bg-primary">
            <p>
                <i class="fa fa-spinner fa-2x"></i>
            </p>
            <h3><?= $Result1 ?></h3>
            <h3>Chưa Xác Nhận</h3>
        </div>
    </div>
        
    <div class="col">
        <div class="counter bg-warning">
            <p>
                <i class="fa fa-tasks fa-2x"></i>
            </p>
            <h3><?= $Result2 ?></h3>
            <h3>Chờ Lấy Hàng</h3>
        </div>
    </div>
    
    <div class="col">
        <div class="counter bg-success">
            <p>
                <i class="fa fa-truck fa-2x"></i>
            </p>
            <h3><?= $Result3 ?></h3>
            <h3>Đang Giao</h3>
        </div>
    </div>
    
    <div class="col">
        <div class="counter bg-danger">
            <p>
                <i class="fa fa-check-circle fa-2x"></i>
            </p>
            <h3><?= $Result4 ?></h3>
            <h3>Đơn Hàng Thành Công</h3>
        </div>
    </div>
</div>
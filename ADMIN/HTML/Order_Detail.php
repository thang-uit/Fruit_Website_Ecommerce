<?php
    include './DBConnect/DBConnect.php';

    $Order_ID = isset($_GET['ODID']) ? $_GET['ODID'] : '0';
    $Cus_ID = isset($_GET['CUSID']) ? $_GET['CUSID'] : '0';

    $num = 1;
    $Total_Price = 0;
    $SQLOrderDT = "SELECT * FROM `orders`, `order_details`, `products` WHERE `orders`.`Ord_ID` = `order_details`.`Ord_ID` AND `order_details`.`Pro_ID` = `products`.`Pro_ID` AND `orders`.`Ord_ID` = '$Order_ID' AND `orders`.`Cus_ID` = '$Cus_ID'";
    $ODDT = $con->query($SQLOrderDT);
?>      
        
<div style="text-align: center; font-family: 'Poppins', sans-serif;">
    <h1>Order ID: <?= $Order_ID ?></h1>
    <table border="1" align="center" cellspacing="0" style="text-align: center;">
        <tr class="table-title">
            <th>Số Thứ Tự</th>
            <th>Ảnh</th>
            <th>Tên Sản Phẩm</th>
            <th>Giá</th>
            <th>Số Lượng</th>
            <th>Thành Tiền</th>
        </tr>

        <?php
            while($row = $ODDT->fetch_array())
            {
        ?>
                <tr>
                    <td>
                        <?= $num++ ?>
                    </td>
                    <td>
                        <a><img style="width: 40%; height: 40%; padding: 0;" src="<?= $row['Pro_Img'] ?>"></a>
                    </td>
                    <td>
                        <?= $row['Pro_Name'] ?>
                    </td>
                    <td>
                        <?= number_format($row['Pro_Price'], 0, ",", ".") ?> <small><strong><u>VNĐ</u></strong></small>
                    </td>
                    <td>
                        <?= $row['Ordd_Amount'] ?>
                    </td>
                    <td>
                        <?php
                            $Total = (int)$row['Pro_Price'] * $row['Ordd_Amount'];
                            $Total_Price += $Total;
                        ?>
                        <?= number_format($Total, 0, ",", ".") ?> <small><strong><u>VNĐ</u></strong></small>
                    </td>
                </tr>
        <?php
            }
        ?>
        <tr>
            <th colspan="5">Tổng Tiền</th>
            <th><?= number_format($Total_Price, 0, ",", ".") ?> <small><strong><u>VNĐ</u></strong></small></th>
        </tr>
    </table>
</div>
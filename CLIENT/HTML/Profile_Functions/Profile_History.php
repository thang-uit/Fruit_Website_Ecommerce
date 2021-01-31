<?php
    if(isset($_SESSION['login']))
    {
        $number = 1;
        $ID_Cus = $_SESSION['login']['Cus_ID'];
        $SQLOrder = "SELECT * FROM `orders` WHERE `orders`.`Ord_Status` = '3' AND `orders`.`Cus_ID` = '$ID_Cus'";
        $Order = $con->query($SQLOrder);

        $total = mysqli_num_rows($Order); 
?>
        <h1 style="padding: 10px; display: flex; justify-content: center; font-size: 50px;">Lịch Sử Mua Hàng</h1>
        <div class="pf-history">
            
            <?php
                if($total <= 0)
                {
                    echo '<h1 style="letter-spacing: 2px;">Bạn chưa mua hàng. Đi mua hàng bạn nhé!</h1><br>';
                }
                else
                {
            ?>
                    <table border="1" cellspacing="0" align="center" id="loadorder">
                        <tr class="table-title">
                            <th>Số Thứ Tự</th>
                            <th>Thông Tin Đơn Hàng</th>
                            <th>Tổng Tiền</th>
                            <th>Ngày Đặt Hàng</th>
                            <th>Ngày Nhận Hàng</th>           
                        </tr>

                        <?php   
                            while($row = $Order->fetch_array())
                            {
                        ?>
                                <tr class="table-content">
                                    <td><?= $number++ ?></td>

                                    <td>
                                        <table border="1" cellspacing="0">
                                            <tr class="table-title">
                                                <th>Số Thứ Tự</th>
                                                <th>Ảnh</th>
                                                <th>Tên Sản Phẩm</th>
                                                <th>Giá</th>
                                                <th>Số Lượng</th>
                                                <th>Đánh giá</th>
                                            </tr>

                                            <?php
                                                $num = 1;
                                        
                                                $ID_Order = $row['Ord_ID'];
                                                $SQLOrderDT = "SELECT * FROM `orders`, `order_details`, `products` WHERE `orders`.`Ord_ID` = `order_details`.`Ord_ID` AND `order_details`.`Pro_ID` = `products`.`Pro_ID` AND `orders`.`Ord_Status` = '3' AND `orders`.`Ord_ID` = '$ID_Order' AND `orders`.`Cus_ID` = '$ID_Cus'";
                                                $ODDT = $con->query($SQLOrderDT);
                                            
                                                while($row_1 = $ODDT->fetch_array())
                                                {
                                            ?>
                                                    <tr>
                                                        <td>
                                                            <?= $num++ ?>
                                                        </td>
                                                        <td>
                                                            <a href="Product_Detail.php?id=<?= $row_1['Pro_ID'] ?>#comment" target="_blank"><img style="width: 40%; height: 40%; padding: 0;" src="<?= $row_1['Pro_Img'] ?>"></a>
                                                        </td>
                                                        <td>
                                                            <?= $row_1['Pro_Name'] ?>
                                                        </td>
                                                        <td>
                                                            <?= number_format($row_1['Pro_Price'], 0, ",", ".") ?> <small><strong><u>VNĐ</u></strong></small>
                                                        </td>
                                                        <td>
                                                            <?= $row_1['Ordd_Amount'] ?>
                                                        </td>
                                                        <td>
                                                            <a href="Product_Detail.php?id=<?= $row_1['Pro_ID'] ?>#comment" target="_blank" style="color: #8516c9; text-decoration: underline;">Viết Đánh Giá</a>
                                                        </td>
                                                    </tr>  
                                            <?php
                                                }                                             
                                            ?>
                                        </table>
                                    </td>

                                    <td>
                                        <h3 style="color: #7824ff"><?= number_format($row['Ord_Total'], 0, ",", ".") ?> <small><strong><u>VNĐ</u></strong></small></h3> 
                                    </td>
                                    <td>
                                        <?= $row['Ord_Date'] ?>
                                    </td>
                                    <td>
                                        <?= $row['Ord_Date_Done'] ?>
                                    </td>                                                               
                                </tr>
                        <?php
                            }
                        ?>

                    </table>                   
            <?php
                }
            ?>
        </div> 

        
    <script type="text/javascript">
    </script>

<?php
    }
?>
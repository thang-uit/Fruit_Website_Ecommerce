
<?php
    if(isset($_SESSION['loginadmin']))
    {
        $item_per_page = 10; // Số sản phẩm trên một trang
        $current_page = !empty($_GET['page']) ? $_GET['page'] : 1; // Trang hiện tại
        $offset = ($current_page - 1) * $item_per_page; // Công thức chia sản phẩm đều ra các trang

        $SQLOrder = "SELECT * FROM `orders`, `customer` WHERE `orders`.`Cus_ID` = `customer`.`Cus_ID` AND `orders`.`Ord_Status` = '3' LIMIT " . $item_per_page . " OFFSET " . $offset;
        $Order = $con->query($SQLOrder);
        
        $total_records = mysqli_query($con, "SELECT * FROM `orders`, `customer` WHERE `orders`.`Cus_ID` = `customer`.`Cus_ID` AND `orders`.`Ord_Status` = '3'");
        $totals = mysqli_num_rows($total_records); // Tổng số sản phẩm
        // var_dump($totals); exit;
        $total_page = ceil($totals / $item_per_page); // Tổng số sản phẩm / Số sản phẩm trên một trang = Tổng số trang (Nếu ra số lẻ sẽ làm tròn)

?>
        <div class="order1">
            <h1><i class="fa fa-check-square-o"></i> Order Success</h1>
            <br>
            <!-- <button id="exportexl"><i class="fa fa-file-excel-o"></i> &nbsp;Export To Excel</button> -->
            <table border="1" cellspacing="0" align="center" id="loadorder">
                <tr class="table-title">
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Order Information</th>
                    <th>Total Money</th>
                    <th>Phone number</th>
                    <th>Delivery Address</th>
                    <th>Order Date</th>
                    <th>Date Of Receipt</th>
                </tr>

                <?php
                    while($row = $Order->fetch_array())
                    {
                ?>
                        <tr>
                            <td><?= $row['Ord_ID'] ?></td>
                            <td><?= $row['Cus_Name'] ?></td>
                            <td><a href="Order_Detail.php?ODID=<?= $row['Ord_ID'] ?>&CUSID=<?= $row['Cus_ID'] ?>" target="_blank" onclick="window.open(this.href, 'order', 'left=500, top=50, width=700, height=600, toolbar=1, resizable=0'); return false;" style="color: #06ba2a;">View Details</a></td>
                            <td><?= number_format($row['Ord_Total'], 0, ",", ".") ?> <br><strong>VND</strong></td>
                            <td><?= $row['Cus_Phone'] ?></td>
                            <td><?= $row['Ord_Address'] ?></td>
                            <td><?= $row['Ord_Date'] ?></td>  
                            <td><?= $row['Ord_Date_Done'] ?></td> 
                        </tr>
                <?php
                    }
                ?>

                <tr>
                    <td colspan="10">
                        <div class="page-btn">
                        <?php
                            if($current_page > 5)
                            {
                                $first_page = 1;                 
                        ?>
                                <a href="?action=order4&page=<?= $first_page ?>"><span><strong>First</strong></span></a>
                        <?php
                            }
                        ?>

                        <?php
                            for($num = 1; $num <= $total_page; $num++)
                            {
                                if($num != $current_page)
                                {
                                    if($num > $current_page - 5 && $num < $current_page + 5)
                                    {
                        ?>
                                        <a href="?action=order4&page=<?= $num ?>"><span><?= $num ?></span></a>
                        <?php
                                    }  
                                }
                                else // Tô màu cho trang đã chọn
                                {
                        ?>
                                    <a href="?action=order4&page=<?= $num ?>"><span class="select"><?= $num ?></span></a>
                        <?php
                                } 
                            }
                        ?>

                        <?php
                            if($current_page < $total_page - 5)
                            {
                                $end_page = $total_page;
                        ?>
                                <a href="?action=order4&page=<?= $end_page ?>"><span><strong>Last</strong></span></a>
                        <?php
                            }
                        ?>
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <script src="../JAVASCRIPT/table2excel.js"></script>
        <script type="text/javascript">
            document.getElementById("exportexl").addEventListener('click', function()
            {
                var table2excel = new Table2Excel();
                table2excel.export(document.querySelectorAll("#loadorder"), "Order_Success");
            });
        </script>
<?php
    }
?>
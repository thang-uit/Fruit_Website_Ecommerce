<?php
    include './DBConnect/DBConnect.php';

    $action = isset($_GET['action']) ? $_GET['action'] : 'none';

    if($action == 'revenue')
    {
        if(isset($_POST['date1']) && isset($_POST['date2']) && !empty($_POST['date1']) && !empty($_POST['date2']))
        {          
            $From = $_POST['date1'];
            $To = $_POST['date2'];

            if($From !== $To)
            {
                if($From > $To)
                {
                    echo "Date 2 must be greater than Date 1!";
                }
                else
                {
                    $NumID = 0;
                    $Revenue = 0;
                    $SQLOrder = "SELECT * FROM `orders`, `customer` WHERE `orders`.`Cus_ID` = `customer`.`Cus_ID` AND `Ord_Status` = '3' AND `Ord_Date_Done` BETWEEN DATE('$From') AND DATE_ADD('$To', INTERVAL 1 DAY)";
                    $Order = $con->query($SQLOrder);
                    
?>
                    <table border="1" cellspacing="0" align="center" id="loadorder">
                        <tr class="table-title">
                            <th>Time</th>
                            <th>Order ID</th>
                            <th>Order Information</th>
                            <th>Total Money</th>
                            <th>Customer ID</th>
                            <th>Customer Name</th>
                        </tr>

                        <?php
                            while($row = $Order->fetch_array())
                            {
                                $NumID++;
                        ?>
                                <tr>
                                    <td><?= $row['Ord_Date_Done'] ?></td> 
                                    <td><?= $row['Ord_ID'] ?></td>                       
                                    <td><a href="Order_Detail.php?ODID=<?= $row['Ord_ID'] ?>&CUSID=<?= $row['Cus_ID'] ?>" target="_blank" onclick="window.open(this.href, 'order', 'left=500, top=50, width=700, height=600, toolbar=1, resizable=0'); return false;" style="color: #06ba2a;">View Details</a></td>
                                    <td>
                                        <?php
                                            $Price = $row['Ord_Total'];
                                            $Revenue += $Price;
                                        ?>
                                        <?= number_format($Price, 0, ",", ".") ?> 
                                        <br><strong>VND</strong>
                                    </td>
                                    <td><?= $row['Cus_ID'] ?></td>
                                    <td><?= $row['Cus_Name'] ?></td>                   
                                </tr>
                            <?php
                                }
                            ?>
                                <tr class="table-title" style="background-color: #0dff4d; font-size: 20px;">
                                    <th>Revenue</th>
                                    <th><?= $NumID ?></th>
                                    <th><?= $NumID ?></th>
                                    <th><?= number_format($Revenue, 0, ",", ".") ?> <strong>VND</strong></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                    </table>
                    <br>
                    <h1>Total Invoice: &nbsp;<?= $NumID ?></h1>
                    <h1>Revenue: &nbsp;<?= number_format($Revenue, 0, ",", ".") ?> <strong>VND</strong></h1>
<?php
                }
            }
            else
            {
                echo "Same day, please enter again!";
            }
        }
        else
        {
            echo "Please enter Date 1 and Date 2!";
        }
    }
?>
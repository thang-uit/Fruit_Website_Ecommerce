<?php
    include './DBConnect/DBConnect.php';
    date_default_timezone_set('Asia/Ho_Chi_Minh');

    $action = isset($_GET['action']) ? $_GET['action'] : 'none';
    switch($action)
    {
        case 'order1':
        {
            if(isset($_POST['Ord_ID']) && !empty($_POST['Ord_ID']))
            {
                $ODID = $_POST['Ord_ID'];
                $SQLUpdate = "UPDATE `orders` SET `Ord_Status` = '1' WHERE `orders`.`Ord_ID` = '$ODID'";                   
                $Confirm = $con->query($SQLUpdate);
                if($Confirm)
                {
                    echo "Comfirm Success!";
                }
                else
                {
                    echo "Comfirm Fail!";
                }
            }
            break;
        }

        case 'order2':
        {
            if(isset($_POST['Ord_ID']) && !empty($_POST['Ord_ID']))
            {
                $ODID = $_POST['Ord_ID'];
                $SQLUpdate = "UPDATE `orders` SET `Ord_Status` = '2' WHERE `orders`.`Ord_ID` = '$ODID'";                   
                $Confirm = $con->query($SQLUpdate);
                if($Confirm)
                {
                    echo "Comfirm Success!";
                }
                else
                {
                    echo "Comfirm Fail!";
                }
            }
            break;
        }

        case 'order3':
        {
            if(isset($_POST['Ord_ID']) && !empty($_POST['Ord_ID']))
            {
                $current_date = date("Y-m-d H:i:s");
                $ODID = $_POST['Ord_ID'];
                $SQLUpdate = "UPDATE `orders` SET `Ord_Status` = '3', `Ord_Date_Done` = '$current_date' WHERE `orders`.`Ord_ID` = '$ODID'";                   
                $Confirm = $con->query($SQLUpdate);
                if($Confirm)
                {
                    echo "Comfirm Success!";
                }
                else
                {
                    echo "Comfirm Fail!";
                }
            }
            break;
        }

        case 'cancel':
        {
            if(isset($_POST['Ord_ID']) && !empty($_POST['Ord_ID']))
            {
                $ODID = $_POST['Ord_ID'];
                $SQLDelete = "DELETE FROM `orders` WHERE `orders`.`Ord_ID` = '$ODID'";
                $Cancel = $con->query($SQLDelete);

                if($Cancel)
                {
                    echo "Cancel Success!";
                }
                else
                {
                    echo "Cancel Fail!";
                }
            }
            break;
        }

        case 'none':
        {
            echo "Error";
            break;
        }

        default:
        {
            echo "Error";
            break;
        }
    }

    if($action == 'search')
    {
        if(isset($_POST['Search']) && !empty($_POST['Search']))
        {
            $Search = $_POST['Search'];
            $SQLOrder = "SELECT * FROM `orders`, `customer` WHERE `orders`.`Cus_ID` = `customer`.`Cus_ID` AND `orders`.`Ord_Status` = '0' AND `customer`.`Cus_Name` LIKE '%$Search%'";
            $Order = $con->query($SQLOrder);
            while($row = $Order->fetch_array())
            {
?>
                <tr>
                    <td><?= $row['Ord_ID'] ?></td>
                    <td><?= $row['Cus_Name'] ?></td>
                    <td><a href="Order_Detail.php?ODID=<?= $row['Ord_ID'] ?>&CUSID=<?= $row['Cus_ID'] ?>" target="_blank" style="color: #06ba2a;">View Details</a></td>
                    <td><?= number_format($row['Ord_Total'], 0, ",", ".") ?> <br><strong>VND</strong></td>
                    <td><?= $row['Cus_Phone'] ?></td>
                    <td><?= $row['Ord_Address'] ?></td>
                    <td><?= $row['Ord_Date'] ?></td>
                    <td>
                        <a class="confirm-od" onclick="Confirm_Order(<?= $row['Ord_ID'] ?>)"><i class="fa fa-check-circle-o"></i></a>
                    </td>
                    <td>
                        <a class="cancel-od" onclick="Cancel_Order(<?= $row['Ord_ID'] ?>)"><i class="fa fa-times-circle"></i></a>
                    </td>
                </tr>
<?php
            }
        }
    }
?>
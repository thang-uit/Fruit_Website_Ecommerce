<?php
    include './DBConnect/DBConnect.php';

    $Cus_ID = isset($_GET['CUSID']) ? $_GET['CUSID'] : '0';

    $SQLCus = "SELECT * FROM `customer`, `accounts` WHERE `customer`.`Cus_ID` = `accounts`.`Cus_ID` AND `customer`.`Cus_ID` = '$Cus_ID'";
    $Customer = $con->query($SQLCus);
    $row = $Customer->fetch_array();
    if(!empty($row))
    {
?>            
        <div style="text-align: center; font-family: 'Poppins', sans-serif;">
            <h1>Customer ID: <?= $Cus_ID ?></h1>
            <table border="1" align="center" cellspacing="0" style="text-align: center;">
                <tr class="table-title">
                    <th>Account ID</th>
                    <td><?= $row['Acc_ID'] ?></td>
                </tr>

                <tr class="table-title">
                    <th>Username</th>
                    <td><?= $row['Acc_Username'] ?></td>
                </tr>

                <tr class="table-title">
                    <th>Password</th>
                    <td><?= $row['Acc_Password'] ?></td>
                </tr>

                <tr class="table-title">
                    <th>Date Created</th>
                    <td><?= $row['Acc_Date'] ?></td>
                </tr>
            </table>
        </div>
<?php
    }
    else
    {
        echo "<h3>This customer has not yet registered for an account.</h3>";
    }
?>
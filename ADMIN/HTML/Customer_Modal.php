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
            <h1>Account ID: <?= $Cus_ID ?></h1>
            <table border="1" align="center" cellspacing="0" style="text-align: center;">
                <tr class="table-title">
                    <th>Customer Name</th>
                    <td><?= $row['Cus_Name'] ?></td>
                </tr>

                <tr class="table-title">
                    <th>Birthday</th>
                    <td><?= $row['Cus_BDay'] ?></td>
                </tr>

                <tr class="table-title">
                    <th>Gender</th>
                    <td><?php if($row['Cus_Gender'] == 1){echo "Nam";} else{echo "Nữ";} ?></td>
                </tr>

                <tr class="table-title">
                    <th>Email</th>
                    <td><?= $row['Cus_Email'] ?></td>
                </tr>

                <tr class="table-title">
                    <th>Phone</th>
                    <td><?= $row['Cus_Phone'] ?></td>
                </tr>
            </table>
        </div>
<?php
    }
    else
    {
        header('Location: 404.php');
    }
?>
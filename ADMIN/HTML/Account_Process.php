<?php
    include './DBConnect/DBConnect.php';
    date_default_timezone_set('Asia/Ho_Chi_Minh');

    $account = isset($_GET['account']) ? $_GET['account'] : 'none';
    $action = isset($_GET['action']) ? $_GET['action'] : 'none';

    if($account == 'admin')
    {
        if($action == 'addac')
        {
            if(isset($_POST['New_account']) && !empty($_POST['New_account']))
            {
                $New_Account = $_POST['New_account'];
                $Acc_Username = $New_Account[0]['value'];
                $Acc_Password = md5($New_Account[1]['value']);

                $SQLUser = "SELECT * FROM `accounts` WHERE `Acc_Username` = '$Acc_Username'";
                $CheckUser = $con->query($SQLUser);
                $row = $CheckUser->fetch_array();

                if(!empty($row))
                {
                    echo "Username '$Acc_Username' already exists. Please choose another username!";
                }
                else
                {
                    $current_date = date("Y-m-d H:i:s");
                    $SQLAcc = "INSERT INTO accounts(Acc_ID, Acc_Username, Acc_Password, Acc_Role, Acc_Status, Acc_Date, Cus_ID) VALUES ('', '$Acc_Username', '$Acc_Password', 'admin', 1, '$current_date', NULL)";
                    $Account = $con->query($SQLAcc);
                    
                    if($Account == true)
                    {
                        echo "New account created successfully!";
                    }
                    else
                    {
                        echo "System error! Account creation failed!";
                    }
                }
            }
        }

        if($action == 'deleteac')
        {
            if(isset($_POST['Acc_ID']) && !empty($_POST['Acc_ID']))
            {
                $Acc_ID = $_POST['Acc_ID'];
                $SQLDelete = "DELETE FROM `accounts` WHERE `Acc_ID` = '$Acc_ID'";
                $Delete = $con->query($SQLDelete);

                if($Delete)
                {
                    echo "Delete Success!";
                }
                else
                {
                    echo "Delete Fail!";
                }
            }
        }   

        if($action == 'search')
        {
            if(isset($_POST['Search']) && !empty($_POST['Search']))
            {
                $Search = $_POST['Search'];
                $SQLAccount = "SELECT * FROM `accounts` WHERE `Acc_Role` = 'admin' AND `Acc_Username` LIKE '%$Search%'";
                $Account = $con->query($SQLAccount);

                while($row = $Account->fetch_array())
                {
?>
                    <tr>
                        <td><?= $row['Acc_ID'] ?></td>
                        <td><?= $row['Acc_Username'] ?></td>
                        <td><?= $row['Acc_Password'] ?> </td>
                        <td><?= $row['Acc_Role'] ?></td>
                        <td><?= $row['Acc_Status'] ?></td>
                        <td><?= $row['Acc_Date'] ?></td>                                                           
                        <td><a class="delete-ac" onclick="Delete(<?= $row['Acc_ID'] ?>)"><i class="fa fa-trash"></i></a></td>
                    </tr>
<?php
                }
            }
            else
            {
                echo "Nothing";
            }
        }
    }

    if($account == 'customer')
    {
        if($action == 'deleteac')
        {
            if(isset($_POST['Acc_ID']) && !empty($_POST['Acc_ID']))
            {
                $Acc_ID = $_POST['Acc_ID'];
                $SQLDelete = "DELETE FROM `accounts` WHERE `Acc_ID` = '$Acc_ID'";
                $Delete = $con->query($SQLDelete);

                if($Delete)
                {
                    echo "Delete Success!";
                }
                else
                {
                    echo "Delete Fail!";
                }
            }
        }   
        
        if($action == 'search')
        {
            if(isset($_POST['Search']) && !empty($_POST['Search']))
            {
                $Search = $_POST['Search'];
                $SQLAccount = "SELECT * FROM `accounts` WHERE `Acc_Role` = 'customer' AND `Acc_Username` LIKE '%$Search%'";
                $Account = $con->query($SQLAccount);

                while($row = $Account->fetch_array())
                {
?>
                    <tr>
                        <td><?= $row['Acc_ID'] ?></td>
                        <td><?= $row['Acc_Username'] ?></td>
                        <td><?= $row['Acc_Password'] ?> </td>
                        <td><?= $row['Acc_Role'] ?></td>
                        <td><?= $row['Acc_Status'] ?></td>
                        <td><?= $row['Acc_Date'] ?></td>
                        <td><a href="Customer_Modal.php?CUSID=<?= $row['Cus_ID'] ?>" target="_blank" onclick="window.open(this.href, 'customer', 'left=500, top=50, width=700, height=600, toolbar=1, resizable=0'); return false;" style="color: #06ba2a;"><?= $row['Cus_ID'] ?></a></td>                                                           
                        <td><a class="delete-ac" onclick="Delete(<?= $row['Acc_ID'] ?>)"><i class="fa fa-trash"></i></a></td>
                    </tr>
<?php
                }
            }
            else
            {
                echo "Nothing";
            }
        }
    }
?>
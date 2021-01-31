<?php
    include './DBConnect/DBConnect.php';
    include 'Cart_Process.php';
    include 'Functions.php';
    date_default_timezone_set('Asia/Ho_Chi_Minh');

    $Cus_ID = "";
    $Cus_Name = "";
    $Cus_BDay = "";
    $Cus_Gender = "";
    $Cus_Email = "";
    $Cus_Phone = "";

    if(isset($_SESSION['login']))
    {
        $ID_Cus = $_SESSION['login']['Cus_ID'];
        $SQLuser = "SELECT * FROM `customer` JOIN `accounts` ON `customer`.`Cus_ID` = `accounts`.`Cus_ID` WHERE `accounts`.`Cus_ID` = '$ID_Cus'";
        $User = $con->query($SQLuser);
        if($User == true)
        {
            $row = $User->fetch_array();

            $Cus_ID = !empty($row['Cus_ID']) ? $row['Cus_ID'] : '';
            $Cus_Name = !empty($row['Cus_Name']) ? $row['Cus_Name'] : '';
            $Cus_BDay = !empty($row['Cus_BDay']) ? $row['Cus_BDay'] : '';
            $Cus_Gender = !empty($row['Cus_Gender']) ? $row['Cus_Gender'] : '';
            $Cus_Email = !empty($row['Cus_Email']) ? $row['Cus_Email'] : '';
            $Cus_Phone = !empty($row['Cus_Phone']) ? $row['Cus_Phone'] : '';
        }
        else
        {
            echo "Lỗi hệ thống!";
        }
    }
    

    $num = 1;
    $i = 0;
    $Total_Price = 0; 

    $html = "<table border='1' align='center'>";
    $html .= "<tr align='center'><th>SỐ THỨ TỰ</th><th>TÊN SẢN PHẨM</th><th>ĐƠN GIÁ</th><th>SỐ LƯỢNG</th><th>THÀNH TIỀN</th></tr>";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../CSS/style.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <title>Giỏ hàng</title>
</head>

<body>  
    <div class="backgroundcolor" id="deleteload">

        <!------ Header ------>
        <?php include 'Header.php'; ?>


        <div class="container">
            <a href="All_Product.php" class="btn"><strong>&#8592; Tiếp tục mua sắm</strong></a></td>
        </div>
        
        <!------ Cart items details ------>
        <div class="small-container cart-page" id="updateload">
            <?php
                if(empty($_SESSION['cart']))
                {
                    echo '<h1 style="letter-spacing: 2px;">Ôi bạn ơi! Giỏ hàng trống là do bạn chưa mua đồ đấy bạn ạ!</h1><br>';
                }
                else
                {
            ?>
                    <table>
                        <tr>
                            <th>SỐ THỨ TỰ</th>
                            <th>THÔNG TIN SẢN PHẨM</th>
                            <th>SỐ LƯỢNG</th>
                            <th>THÀNH TIỀN</th>
                        </tr>
                        <?php
                            foreach($_SESSION['cart'] as $key => $value)
                            {
                        ?>
                                <tr class="cart-detail">
                                    <td style="padding-left: 40px;"><h2><?= $num++ ?></h2></td>
                                    <td>
                                        <div class="cart-info">
                                            <a href="Product_Detail.php?id=<?= $key ?>">
                                                <img src="<?= $value['image'] ?>">
                                                <div>
                                                    <h2><?= $value['name'] ?></h2>
                                            </a>
                                                    <p>Giá: <?= number_format($value['price'], 0, ",", ".") ?> <u>VNĐ</u></p>
                                                    <br>
                                        
                                                <a style="cursor: pointer" onclick="Deletecart(<?= $key ?>)"><p><i class="fa fa-times-circle"></i> Xóa Sản Phẩm</p></a>
                                            </div>
                                        </div>
                                    </td>
                                    <td><input type="number" id="quantity_<?= $key ?>" name="quantity_<?= $key ?>" value="<?= $value['num'] ?>" min="1" max="50" onchange="Updatecart(<?= $key ?>)"></td>
                                    <td>
                                        <h2>
                                            <?php
                                                $Price = $value['price'] * $value['num'];                                    
                                                echo number_format($Price, 0, ",", ".");
                                                $Total_Price += $Price;
                                            ?>
                                            <u>VNĐ</u>
                                        </h2>
                                    </td>
                                </tr> 
                        <?php 
                            $i++;
                                $html .= 
                                "
                                    <tr align='center'>
                                        <td>$i</td>
                                        <td>" . $value['name'] . "</td>
                                        <td>" . number_format($value['price'], 0, ",", ".") . "</td>
                                        <td>" . $value['num'] . "</td>
                                        <td>" . number_format($Price, 0, ",", ".") . "</td>
                                    </tr>                                   
                                ";                    
                            }   
                            $html .= 
                            "
                                    <tr align='center'>
                                        <th colspan='4'>TỔNG TIỀN</th>
                                        <th>"
                                            . number_format($Total_Price, 0, ",", ".") .
                                        "</th>
                                    </tr>
                                </table>
                                
                            ";          
                        ?>
                    </table>


                <div class="total-price">
                    <table>
                        <tr>
                            <td><em><h3>TỔNG CỘNG</h3></em></td>
                            <td><h2><strong style="color: red;"><?= number_format($Total_Price, 0, ",", "."); ?> <u>VNĐ</u></strong></h2></td>
                        </tr>              
                    </table>               
                </div>

                <div class="order-info">
                    <form action="" method="POST">
                        <h1 class="order-title">THÔNG TIN ĐẶT HÀNG</h1>
                        <p>Vui lòng điền đầy đủ và chính xác thông tin dưới đây để hoàn thành đơn hàng.</p>
                        <br>
                        <div class="form-group-1">
                            <h3><i class="fa fa-user"></i> &nbsp;Họ và tên</h3>
                            <input type="text" class="input-order" name="Cus_Name" id="name" value="<?= $Cus_Name ?>" placeholder="Ex: Nguyễn Thị A" maxlength="100" autofocus required>
                
                            <h3><i class="fa fa-transgender"></i> &nbsp;Giới tính</h3>
                            <div class="input-gender">
                                <input type="radio" name="Cus_Gender" value="1" <?php if($Cus_Gender == 1){echo "checked";} ?> required> <span> Nam</span> &nbsp; &nbsp; &nbsp;
                                <input type="radio" name="Cus_Gender" value="0" <?php if($Cus_Gender == 0){echo "checked";} ?> required> <span> Nữ</span>
                            </div>

                            <h3><i class="fa fa-birthday-cake"></i> &nbsp;Ngày sinh</h3>
                            <input type="date" class="input-order" name="Cus_BDay" id="date" value="<?= $Cus_BDay ?>" min="1850-01-01" required>
                        </div>

                        <div class="form-group-2">
                            <h3><i class="fa fa-phone"></i> &nbsp;Số điện thoại</h3>
                            <input type="tel" class="input-order" name="Cus_Phone" id="tel" value="<?= $Cus_Phone ?>" placeholder="Ex: 0961234567" maxlength="15" required>                 

                            <h3><i class="fa fa-envelope"></i> &nbsp;Email</h3>
                            <input type="email" class="input-order" name="Cus_Email" id="email" value="<?= $Cus_Email ?>" placeholder="Ex: abc123@gmail.com" maxlength="100" required>

                            <h3><i class="fa fa-address-card"></i> &nbsp;Địa chỉ nhận hàng</h3>
                            <textarea class="input-order" style="resize: vertical;" name="Ord_Address" id="address" placeholder="Ex: Địa chỉ muốn nhận hàng" maxlength="500" required></textarea>
                        </div>

                        <div class="clear"></div>
                        
                        <hr>
                        
                        <input type="submit" name="addorders" value="Đặt hàng">
                    </form>
                </div>
                
                <?php
                    if(isset($_POST['addorders']) && $_POST['addorders'] == "Đặt hàng")
                    {                          
                        $current_date = date("Y-m-d H:i:s");
                        if(isset($_SESSION['login']) && !empty($_SESSION['login']))
                        {
                            if(isset($_POST['Cus_Name']) && isset($_POST['Cus_BDay']) && isset($_POST['Cus_Gender']) && isset($_POST['Ord_Address']) && isset($_POST['Cus_Email'])  && isset($_POST['Cus_Phone']))
                            {
                                $Name = $_POST['Cus_Name'];
                                $BDay = $_POST['Cus_BDay'];
                                $Gender = $_POST['Cus_Gender'];
                                $Email = $_POST['Cus_Email'];
                                $Phone = $_POST['Cus_Phone'];
                                
                                $SQLUDCus = "UPDATE `customer` SET `Cus_Name`= '$Name', `Cus_BDay`= '$BDay', `Cus_Gender`= '$Gender', `Cus_Email`= '$Email', `Cus_Phone`= '$Phone' WHERE `Cus_ID` = '$Cus_ID'";                   
                                $Customer = $con->query($SQLUDCus);
                            }

                            $Ord_Address = $_POST['Ord_Address'];
                            $data_orders = array
                            (
                                "Ord_ID" => '', 
                                "Ord_Address" => $Ord_Address,
                                "Ord_Date" => $current_date,
                                "Ord_Date_Done" => $current_date,
                                "Ord_Total" => $Total_Price,
                                "Ord_Status" => '0',
                                "Cus_ID" => $Cus_ID
                            );
                            // Insert Orders into Database
                            $ID_Orders = Insert("orders", $data_orders, "addorders"); 
                            
                            foreach($_SESSION['cart'] as $key => $value)
                            {
                                $amount = $value['num'];
                                $SQLOrderDetail = "INSERT INTO order_details(Ord_ID, Pro_ID, Ordd_Amount) VALUES ('$ID_Orders', '$key', '$amount')";
                                $con->query($SQLOrderDetail);
                            }
                                        
                            // echo "ID Customer: " . $ID_Customer . "<br>";
                            // echo "ID Orders: " . $ID_Orders;

                            $username = 'traicaysachtnt@gmail.com';
                            $password = 'admin_123456'; // Nếu bạn thấy dòng này tức là bạn đã biết mật khẩu của Email do mình tạo ra để phục vụ mục đích học tập. Sử dụng Email này cho mục đích học tập bạn nhé! <3
                            $name = 'TNTFRUIT';
                            $email_customer = $Cus_Email;
                            $name_customer = $Cus_Name;

                            if(Send_Email($username, $password, $name, $email_customer, $name_customer, $html) == true)
                            {
                                echo 
                                '
                                    <br>
                                    <h1>
                                        Đã gửi thông tin đơn hàng của bạn qua email. Bạn vui lòng kiểm tra email để xem chi tiết thông tin đơn hàng 
                                        hoặc theo dõi đơn hàng của bạn <a href="Profile.php?action=order" style="color: #ff0000"> Tại Đây </a>.
                                    </h1> 
                                    <br>
                                    <h4>Chúng tôi sẽ sớm liên hệ cho bạn để xác nhận đơn hàng.</h4>
                                ';
                                unset($_SESSION['cart']);
                                unset($_POST);
                            }
                        }
                        else
                        {
                            if(isset($_POST['Cus_Name']) && isset($_POST['Cus_BDay']) && isset($_POST['Cus_Gender']) && isset($_POST['Ord_Address']) && isset($_POST['Cus_Email'])  && isset($_POST['Cus_Phone']))
                            {
                                $data_customer = array
                                (
                                    "Cus_Name" => $_POST['Cus_Name'],
                                    "Cus_BDay" => $_POST['Cus_BDay'],
                                    "Cus_Gender" => $_POST['Cus_Gender'],
                                    "Cus_Email" => $_POST['Cus_Email'],
                                    "Cus_Phone" => $_POST['Cus_Phone']                 
                                );
                                $ID_Customer = Insert("customer", $data_customer, "addorders");

                                $Address = $_POST['Ord_Address'];
                                $data_orders = array
                                (
                                    "Ord_ID" => '', 
                                    "Ord_Address" => $Address,
                                    "Ord_Date" => $current_date,
                                    "Ord_Date_Done" => $current_date,
                                    "Ord_Total" => $Total_Price,
                                    "Ord_Status" => '0',
                                    "Cus_ID" => $ID_Customer                   
                                );
                                // Insert Orders into Database
                                $ID_Orders = Insert("orders", $data_orders, "addorders"); 
                                
                                foreach($_SESSION['cart'] as $key => $value)
                                {
                                    $amount = $value['num'];
                                    $SQLOrderDetail = "INSERT INTO order_details(Ord_ID, Pro_ID, Ordd_Amount) VALUES ('$ID_Orders', '$key', '$amount')";
                                    $con->query($SQLOrderDetail);
                                }
                                            
                                // echo "ID Customer: " . $ID_Customer . "<br>";
                                // echo "ID Orders: " . $ID_Orders;

                                $username = 'traicaysachtnt@gmail.com';
                                $password = 'admin_123456';
                                $name = 'TNTFRUIT';
                                $email_customer = $_POST['Cus_Email'];
                                $name_customer = $_POST['Cus_Name'];

                                if(Send_Email($username, $password, $name, $email_customer, $name_customer, $html) == true)
                                {
                                    echo 
                                    "
                                        <br>
                                        <h1>Đã gửi thông tin đơn hàng của bạn qua email. Bạn vui lòng kiểm tra email để xem chi tiết thông tin đơn hàng.</h1> 
                                        <br>
                                        <p>Chúng tôi sẽ sớm liên hệ cho bạn để xác nhận đơn hàng.</p>
                                    ";
                                    unset($_SESSION['cart']);
                                    unset($_POST);
                                }
                            }
                        }  
                    }                               
                }             
                ?>
        </div>

        
        <!------ Footer ------>
        <?php include 'Footer.php'; ?>   


        <!-- To top-->
        <a rel="external" href="#" class="to-top">
            <i class="fa fa-arrow-circle-up"></i>
        </a>
    </div> <!-- end div backgroundcolor -->


    <script src="../JAVASCRIPT/main.js"></script>
    <script type="text/javascript">
    function Updatecart(id)
    {
        // alert(id);
        $.ajax
        ({
            url: "Cart_Process.php?action=update", // gửi ajax lên server
            type: "post", // chọn phương thức gửi là post
            dateType: "text", // dữ liệu trả về dạng text
            data: 
            { 
                ID: id,
                Number: $("#quantity_" + id).val()
            },
            success: function (result)
            {                         
                $("#updateload").load("Cart.php #updateload");               
            }  
        });
    }

    function Deletecart(id)
    {
        $.ajax
        ({
            url: "Cart_Process.php?action=update", // gửi ajax lên server
            type: "post", // chọn phương thức gửi là post
            dateType: "text", // dữ liệu trả về dạng text
            data: 
            { 
                ID: id,
                Number: 0
            },
            success: function (result)
            {                         
                $("#deleteload").load("Cart.php #deleteload");                
            }  
        });
    }
    </script>

</body>

</html>
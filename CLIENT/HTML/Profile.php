<?php
    session_start();
    include './DBConnect/DBConnect.php';
    include 'Functions.php';
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    
    if(!isset($_SESSION['login']))
    {
        header('Location: Login.php');
    }

    $action = isset($_GET['action']) ? $_GET['action'] : 'info';
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
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <title>
        <?php
            switch($action)
            {
                case 'info':
                {
                    echo 'Thông Tin Khách Hàng';
                    break;
                }
                case 'user':
                {
                    echo 'Hồ Sơ';
                    break;
                }
                case 'order':
                {
                    echo 'Chờ Xác Nhận';
                    break;
                }
                case 'order1':
                {
                    echo 'Chờ Lấy Hàng';
                    break;
                }
                case 'order2':
                {
                    echo 'Đang Giao';
                    break;
                }
                case 'history':
                {
                    echo 'Lịch Sử Mua Hàng';
                    break;
                }
                default:
                {
                    echo 'Thông Tin Khách Hàng';
                    break;
                }
            }
        ?>
    </title>
</head>

<body>  
    <div class="backgroundcolor">
              
        <!------ Header ------>
        <?php include 'Header.php'; ?>

        
        <div class="wrapper">
            <div class="sidebar">
                <h1><i class="fa fa-address-card-o"></i> &nbsp;TNT FRUIT</h1>
                <ul>
                    <li class="choice <?php if($action == 'info'){echo "active";} ?>"><a href="Profile.php?action=info"><i class="fa fa-home"></i> &nbsp;Thông Tin</a></li>
                    <li class="choice <?php if($action == 'user'){echo "active";} ?>"><a href="Profile.php?action=user"><i class="fa fa-user"></i> &nbsp;Hồ Sơ</a></li>
                    <li class="choice <?php if($action == 'order'){echo "active";} ?>"><a href="Profile.php?action=order"><i class="fa fa-cart-arrow-down"></i> &nbsp;Chờ Xác Nhận(<?php if(isset($_SESSION['Order'])){echo $_SESSION['Order'];} else{echo '0';} ?>)</a></li>
                    <li class="choice <?php if($action == 'order1'){echo "active";} ?>"><a href="Profile.php?action=order1"><i class="fa fa-archive"></i> &nbsp;Chờ Lấy Hàng(<?php if(isset($_SESSION['Order1'])){echo $_SESSION['Order1'];} else{echo '0';} ?>)</a></li>
                    <li class="choice <?php if($action == 'order2'){echo "active";} ?>"><a href="Profile.php?action=order2"><i class="fa fa-truck"></i> &nbsp;Đang Giao(<?php if(isset($_SESSION['Order2'])){echo $_SESSION['Order2'];} else{echo '0';} ?>)</a></li>
                    <li class="choice <?php if($action == 'history'){echo "active";} ?>"><a href="Profile.php?action=history"><i class="fa fa-history"></i> &nbsp;Lịch Sử MH</a></li>
                    <li><a href="Login.php?module=logout" style="font-weight: bolder"><i class="fa fa-sign-out"></i> &nbsp;Đăng Xuất</a></li>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>                                      
                </ul> 
                <!-- <div class="social_media">
                    <a href="#"><i class="fa fa-facebook-f"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-instagram"></i></a>
                </div> -->
            </div>

            
            <div class="main_content">
                <div class="header-1">
                    <h3>Chào <?= $_SESSION['login']['Acc_Username'] ?> <i class="fa fa-smile-o"></i>, chúc bạn một ngày mới tốt lành nhé!</h3>
                    <span class="Time" id="Time">              
                        <i class="fa fa-calendar"></i> &nbsp;
                        <?php            
                            $date = getdate();
                            $thu = array
                            (
                                "Monday" => "Thứ 2",
                                "Tuesday" => "Thứ 3",
                                "Wednesday" => "Thứ 4", 
                                "Thursday" => "Thứ 5",
                                "Friday" => "Thứ 6", 
                                "Saturday" => "Thứ 7", 
                                "Sunday" => "Chủ Nhật"
                            );
                            $thutrongtuan = $date['weekday'];
                            echo $thu[$thutrongtuan] . ", ngày " . $date['mday'] . ", tháng " . $date['mon'] . ", năm " . $date['year'];
                        ?>
                    </span>               
                </div>

                
                <div class="info">
                    <div class="content">
                        <?php 
                            if($action == 'info')
                            {
                                include './Profile_Functions/Profile_Info.php';
                            }
                            else if($action == 'user')
                            {
                                include './Profile_Functions/Profile_User.php';
                            }
                            else if($action == 'order')
                            {
                                include './Profile_Functions/Profile_Order.php';
                            }
                            else if($action == 'order1')
                            {
                                include './Profile_Functions/Profile_Order1.php';
                            }
                            else if($action == 'order2')
                            {
                                include './Profile_Functions/Profile_Order2.php';
                            }
                            else if($action == 'history')
                            {
                                include './Profile_Functions/Profile_History.php';
                            }
                            else
                            {
                                include './Profile_Functions/Profile_Info.php';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        



        <!------ Footer ------>
        <?php include 'Footer.php'; ?>


        
        <!-- To top-->
        <a rel="external" href="#" class="to-top">
            <i class="fa fa-arrow-circle-up"></i>
        </a>
    </div> <!-- end div backgroundcolor -->


    <script src="../JAVASCRIPT/main.js"></script>

</body>

</html>
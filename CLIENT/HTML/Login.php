<?php
    session_start();
    ob_start();
    // session_destroy();
    include './DBConnect/DBConnect.php';
    include 'Functions.php';
    date_default_timezone_set('Asia/Ho_Chi_Minh');


    $logout = isset($_GET['module']) ? $_GET['module'] : "";
    if(!empty($logout) && $logout == "logout")
    {
        session_destroy();
        header('Location: Login.php');
    }

    if(isset($_POST['login']) && $_POST['login'] == "Đăng Nhập")
    {
        $username = $_POST['Acc_Username'];
        $password = md5($_POST['Acc_Password']);

        $SQLLogin = "SELECT * FROM `accounts` WHERE `Acc_Role` = 'customer' AND `Acc_Username` = '$username' AND `Acc_Password` = '$password'";
        $Account = $con->query($SQLLogin);
        $row = $Account->fetch_array();
        
        if(!empty($row))
        {
            if(isset($_POST['remember']))
            {
                setcookie("Username", $username);
                setcookie("Password", $_POST['Acc_Password']);
                setcookie("Check", $_POST['remember']);
            }
            else
            {
                setcookie("Check", 0);
            }
            $_SESSION['login'] = $row;
            header('Location: Profile.php');
        } 
    }

    $Username = "";
    $Password = "";
    $check = false;
    if(isset($_COOKIE['Username']) && isset($_COOKIE['Password']) && $_COOKIE['Check'] == 1)
    {
        $Username = $_COOKIE['Username'];
        $Password = $_COOKIE['Password'];
        $check = true;
    }
    else
    {
        $Username = "";
        $Password = "";
        $check = false;
    }
    ob_end_flush(); 
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

    <title>Đăng nhập</title>
</head>

<body>  
    <div class="backgroundcolor">
        
        <!------ Header ------>
        <?php include 'Header.php'; ?>        

        

        <!------ Login page ------>
        <div class="account-page">
            <div class="container">
                <div class="row">

                    <div class="col-2">
                        <img src="../Image/Ảnh bìa/Traicay.png">
                        <h3>Đăng nhập để có thể bình luận<br>và nhận nhiều thông tin khuyến mãi HOT. </h3>
                    </div>
                    
                    <div class="col-2 form-main">
                        <div class="form-container" id="form-load">
                            
                            <div class="form-btn">
                                <span id="title-login" class="title-login" onclick="login()"><i class="fa fa-user"></i> Đăng Nhập</span>
                                <span id="title-register" class="title-register" style="color: rgb(255, 0, 0);" onclick="register()"><i class="fa fa-pencil-square"></i> Đăng Ký</span>
                                <hr id="Indicator">
                            </div>

                            <form id="LoginForm" action="" method="POST">                               
                                <h1>ĐĂNG NHẬP</h1>
                                <br>
                                <i class="fa fa-user"></i> &nbsp;<strong>Tài khoản</strong>
                                <input type="text" class="input-login" value="<?= $Username ?>" name="Acc_Username" placeholder="Ex: thangdeplam" maxlength="100" autocomplete="off" autofocus required>
        

                                <i class="fa fa-lock"></i> &nbsp;<strong>Mật khẩu</strong>
                                <input type="password" class="input-login" value="<?= $Password ?>" name="Acc_Password" id="password" placeholder="Password" maxlength="100" autocomplete="off" required>
                                <i class="password-toggle fa fa-eye-slash" id="password-toggle" onclick="Password_Toggle()"></i>
                                
                                <input type="checkbox" style="cursor: pointer;" <?= ($check) ? "checked" : "" ?> name="remember" value="1"> &nbsp;Nhớ tài khoản
                    
                                <input type="submit" class="btn" name="login" value="Đăng Nhập">

                                <div class="forgot-pass">
                                    <a href="">Quên mật khẩu</a>
                                </div>

                                <br>
                                    
                                <h1>HOẶC</h1>

                                <div style="text-align: center;">
                                    <a class="btn-facebook" href=""><i class="fa fa-facebook"></i> &nbsp;Login with Facebook</a>
                                    <a class="btn-google" href=""><i class="fa fa-google-plus"></i> &nbsp;Login with Google</a>
                                    <a class="btn-zalo" href="">Login with Zalo</a>
                                </div>                                

                            </form>



                            <form id="RegForm" method="POST"> 
                                <div style="text-align: center;">
                                    <h1>ĐĂNG KÝ</h1>
                                </div>                       
                                <br>
                                <p style="font-size: 15px;"><i class="fa fa-exclamation-triangle"></i> Vui lòng điền đầy đủ thông tin dưới đây!</p>
                                <br>


                                <i class="fa fa-user"></i> &nbsp; <strong>Họ và tên</strong>
                                <input type="text" class="input-login" name="Cus_Name" id="name" value="" placeholder="Ex: Nguyễn Thị A" maxlength="100" required>
                                <br>

                                <i class="fa fa-transgender"></i> &nbsp;<strong>Giới tính</strong>
                                <div>
                                    <input type="radio" name="Cus_Gender" value="1" required> <span> Nam</span><br>
                                    <input type="radio" name="Cus_Gender" value="0" required> <span> Nữ</span>
                                </div>
                                <br>

                                <i class="fa fa-birthday-cake"></i> &nbsp;<strong>Ngày sinh</strong>
                                <input type="date" class="input-login" name="Cus_BDay" id="birthday" value="" min="1850-01-01" required>
                                <br>

                                <i class="fa fa-phone"></i> &nbsp;<strong>Số điện thoại</strong>
                                <input type="tel" class="input-login" name="Cus_Phone" id="tel" value="" placeholder="Ex: 0961234567" maxlength="15" required>                 
                                <br>

                                <i class="fa fa-envelope"></i> &nbsp;<strong>Email</strong>
                                <input type="email" class="input-login" name="Cus_Email" id="email" value="" placeholder="Ex: abc123@gmail.com" maxlength="100" required>
                                <br>
                                
                                <i class="fa fa-user"></i> &nbsp;<strong>Tên tài khoản</strong>
                                <input type="text" class="input-login" name="Acc_Username" id="username" placeholder="Ex: thangdeplam" maxlength="100" autocomplete="off" required>
                                <br>

                                <i class="fa fa-lock"></i> &nbsp;<strong>Mật khẩu</strong>
                                <input type="password" class="input-login" name="Acc_Password" id="password" placeholder="Password" maxlength="100" autocomplete="off" required>
                                <br>

                                <i class="fa fa-lock"></i> &nbsp;<strong>Nhập lại mật khẩu</strong>
                                <input type="password" class="input-login" name="Password" id="repassword" placeholder="Password" maxlength="100" autocomplete="off" required>                                                              
                                
                                <input type="submit" class="btn" name="register" value="TẠO TÀI KHOẢN">

                                <small style="color: red;" id="notify"></small>                                                               
                            </form>
                        </div>
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
    <script type="text/javascript">
        $(function()
        {
            $("#RegForm").submit(function(event) 
            {
                event.preventDefault();
                $.ajax
                ({
                    url: "Register_Process.php", // gửi ajax đến file
                    type: "post", // chọn phương thức gửi là post
                    dateType: "text", // dữ liệu trả về dạng text
                    data: 
                    { 
                        register: $(this).serializeArray(),
                    },
                    success: function (result)
                    {                    
                        // $("#form-load").load("Login.php #form-load");   
                        if(result === 'Tạo tài khoản thành công!')    
                        {
                            alert("Tạo tài khoản thành công!");
                        }                                          
                        $("#notify").text(result);                       
                    }
                });
            });             
        });
    </script>
</body>

</html>
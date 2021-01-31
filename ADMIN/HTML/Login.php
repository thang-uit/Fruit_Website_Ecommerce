<?php
    session_start();
    include './DBConnect/DBConnect.php';

    $logout = isset($_GET['module']) ? $_GET['module'] : "";
    if(!empty($logout) && $logout == "logout")
    {
        session_destroy();
        header('Location: Login.php');
    }

    if(isset($_SESSION['loginadmin']) && !empty($_SESSION['loginadmin']))
    {
        header('Location: Admin_Page.php');
    }
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" type="text/css" href="../CSS/style.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <title>Login</title>
</head>

<body>  
    <div class="login-wrapper">
        <form action="" method="POST" class="form" id="loginform">
            <img src="../Image/Logo/ThắngTS.png" alt="Admin">
            <h1>Login</h1>

            <div class="input-group">
                <input type="text" name="Acc_Username" id="loginUser" maxlength="100" autocomplete="off" required>
                <label for="loginUser"><i class="fa fa-user"></i> Username</label>
            </div>

            <div class="input-group">
                <input type="password" name="Acc_Password" id="loginPassword" maxlength="100" required>
                <label for="loginPassword"><i class="fa fa-lock"></i> Password</label>
            </div>
            <p id="status" style="color: #ff0000;"></p>
            <input type="submit" name="login" value="Login" class="submit-btn">
            
            <br>
            <br>

            <a href="#forgot-pw" class="forgot-pw">Forgot Password?</a>
        </form>

        <div id="forgot-pw">
            <form action="" class="form">
                <a href="#" class="close">&times;</a>
                <h2>Reset Password</h2>
                <br>

                <div class="input-group">
                    <input type="email" name="email" id="email" maxlength="100" autocomplete="off" required>
                    <label for="email"><i class="fa fa-envelope"></i> Email</label>
                </div>

                <input type="submit" value="Submit" class="submit-btn">
            </form>
        </div>
  </div>

    <script src="../JAVASCRIPT/main.js"></script>
    <script type="text/javascript">
        $("#loginform").submit(function(event) 
        {
            event.preventDefault();
            $.ajax
            ({
                url: "Login_Process.php", // gửi ajax đến file
                type: "post", // chọn phương thức gửi là get
                dateType: "text", // dữ liệu trả về dạng text
                data: 
                { 
                    Username: $("#loginUser").val(),
                    Password: $("#loginPassword").val(),
                },
                success: function(result)
                {                       
                    if(result === "OK")
                    {
                        location.reload();
                    }
                    else
                    {
                        $("#status").text(result);                       
                    }
                }
            });
        });
    </script>
</body>

</html>

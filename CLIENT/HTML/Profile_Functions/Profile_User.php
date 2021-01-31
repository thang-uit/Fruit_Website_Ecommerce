<?php
    if(isset($_SESSION['login']))
    {
        $Cus_Name = "";
        $Cus_BDay = "";
        $Cus_Gender = "";
        $Cus_Email = "";
        $Cus_Phone = "";
        
        $ID_Cus = $_SESSION['login']['Cus_ID'];

        $Acc_ID = $_SESSION['login']['Acc_ID'];
        $Acc_Username = $_SESSION['login']['Acc_Username'];
        $Acc_Password = $_SESSION['login']['Acc_Password'];

        $SQLuser = "SELECT * FROM `customer` JOIN `accounts` ON `customer`.`Cus_ID` = `accounts`.`Cus_ID` WHERE `accounts`.`Cus_ID` = '$ID_Cus'";
        $User = $con->query($SQLuser);
        if($User == true)
        {
            $row = $User->fetch_array();

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
?>


<div class="pf-user">

    <div class="cus-info">
        <h1>Thông Tin Cá Nhân</h1>       
        <hr style="width: 100%; border: none; background-color: var(--Background_color); border-radius: 3px; height: 3px;">
        <br>

        <div id="load_form">
            <h3><i class="fa fa-user"></i> &nbsp;Họ và tên</h3>
            <input type="text" class="inputcus-info" name="Cus_Name" id="name" value="<?= $Cus_Name ?>" placeholder="Ex: Nguyễn Thị A" maxlength="100" required>

            <h3><i class="fa fa-venus-mars"></i> &nbsp;Giới tính</h3>
            <div class="input-gender">
                <input type="radio" name="Cus_Gender" value="1" <?php if($Cus_Gender == 1){echo "checked";} ?> required> <span> Nam</span> &nbsp; &nbsp; &nbsp;
                <input type="radio" name="Cus_Gender" value="0" <?php if($Cus_Gender == 0){echo "checked";} ?> required> <span> Nữ</span>
            </div>

            <h3><i class="fa fa-birthday-cake"></i> &nbsp;Ngày sinh</h3>
            <input type="date" class="inputcus-info" name="Cus_BDay" id="birthday" value="<?= $Cus_BDay ?>" min="1850-01-01" required>

            <h3><i class="fa fa-phone"></i> &nbsp;Số điện thoại</h3>
            <input type="tel" class="inputcus-info" name="Cus_Phone" id="tel" value="<?= $Cus_Phone ?>" placeholder="Ex: 0961234567" maxlength="15" required>                 

            <h3><i class="fa fa-envelope"></i> &nbsp;Email</h3>
            <input type="email" class="inputcus-info" name="Cus_Email" id="email" value="<?= $Cus_Email ?>" placeholder="Ex: abc123@gmail.com" maxlength="100" required>
        </div>   

        <a id="open-popup-btn" class="btn-update" onclick="Update_Info()">Cập Nhật Thông Tin</a>
    </div>




    <div class="account-info">
        <h1>Đổi Mật Khẩu</h1>
        <hr style="width: 100%; border: none; background-color: var(--Background_color); border-radius: 3px; height: 3px;">
        <br>

        <form action="" method="POST">
            <h3><i class="fa fa-user"></i> &nbsp;Tên tài khoản</h3>
            <input type="text" style="border: 1px solid #03fc0f; background-color: #ffffff;" class="inputcus-acc" name="Acc_Username" id="username" value="<?= $Acc_Username ?>" placeholder="Ex: thangdeplam" maxlength="100" autocomplete="off" disabled="disabled">
            <br>

            <h3><i class="fa fa-lock"></i> &nbsp;Nhập mật khẩu cũ</h3>
            <input type="password" class="inputcus-acc" name="Acc_Password" id="oldpassword" placeholder="Password" maxlength="100" autocomplete="off" required>
            <br>

            <h3><i class="fa fa-lock"></i> &nbsp;Nhập mật khẩu mới</h3>
            <input type="password" class="inputcus-acc" name="Acc_NewPassword" id="newpassword" placeholder="New Password" maxlength="100" autocomplete="off" required>

            <h3><i class="fa fa-lock"></i> &nbsp;Nhập lại mật khẩu mới</h3>
            <input type="password" class="inputcus-acc" name="Acc_ReNewPassword" id="renewpassword" placeholder="ReNew Password" maxlength="100" autocomplete="off" required>

            <br>

            <input type="submit" style="width: 100%; color: #ffffff;" name="changepassword" value="Đổi Mật Khẩu">



            <p style="color: red;">
                <?php
                    if(isset($_POST['changepassword']) && $_POST['changepassword'] == "Đổi Mật Khẩu")
                    {
                        $Acc_OldPassword = md5($_POST['Acc_Password']);
                        $Acc_NewPassword = md5($_POST['Acc_NewPassword']);
                        $Acc_ReNewPassword = md5($_POST['Acc_ReNewPassword']);

                        if($Acc_OldPassword === $Acc_Password)
                        {
                            if($Acc_NewPassword === $Acc_ReNewPassword)
                            {                           
                                $SQLChangepass = "UPDATE `accounts` SET `Acc_Password` = '$Acc_NewPassword' WHERE `Acc_ID` = '$Acc_ID'";
                                $ChangePassword = $con->query($SQLChangepass);
                                if($ChangePassword == true)
                                {
                                    echo "Đổi mật khẩu thành công!";                               
                                }
                                else
                                {
                                    echo "Lỗi hệ thống! Đổi mật khẩu thất bại!";
                                }
                            }
                            else
                            {
                                echo "Mật khẩu mới không khớp! Vui lòng nhập lại!";
                            }
                            unset($_POST);
                        }
                        else
                        {
                            echo "Mật khẩu cũ không chính xác!";
                        }
                    }
                ?>
            </p>
        </form>
    </div>
</div>




<!----------------- Popup, Modal ----------------->
<div class="popup center">
    <div class="icon" id="icon-status">

    </div>

    <div class="title-1" id="notify">

    </div>
    <!-- <div class="description">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias nihil provident voluptatem nulla placeat
    </div> -->
    <br>
    <div class="dismiss-btn">
        <button id="dismiss-popup-btn">OK</button>
    </div>
</div>





<script type="text/javascript">
    function Update_Info()
    {
        $.ajax
        ({
            url: "./Profile_Functions/Profile_Process.php?action=update", // gửi ajax đến file
            type: "post", // chọn phương thức gửi là post
            dateType: "text", // dữ liệu trả về dạng text
            data: 
            {
                Cus_ID: <?php if(isset($_SESSION['login']['Cus_ID'])) {echo $_SESSION['login']['Cus_ID'];} else{echo "0";} ?>,
                Cus_Name: $("#name").val(),
                Cus_BDay: $("#birthday").val(),
                Cus_Gender: $('[name="Cus_Gender"]:radio:checked').val(),
                Cus_Email: $("#email").val(),
                Cus_Phone: $("#tel").val(),
            },
            success: function(result)
            {   
                if(result == 'Cập nhật thành công!')
                {
                    $("#icon-status").html('<i class="fa fa-check"></i>');
                    $("#notify").text(result);
                }
                else if(result == 'Vui lòng điền đầy đủ thông tin!')
                {
                    $("#icon-status").html('<i class="fa fa-exclamation-triangle" style="color: #fcc603; font-size: 80px;"></i>');
                    $("#notify").text(result);                
                }
                $("#load_form").load("Profile.php?action=user #load_form");
            }
        });
    }


    document.getElementById("open-popup-btn").addEventListener("click",function()
    {
        document.getElementsByClassName("popup")[0].classList.add("active");
    });

    document.getElementById("dismiss-popup-btn").addEventListener("click",function()
    {
        document.getElementsByClassName("popup")[0].classList.remove("active");
    });
</script>

<?php
    }
    else
    {
        header('Location: ./Login.php');
    }
?>
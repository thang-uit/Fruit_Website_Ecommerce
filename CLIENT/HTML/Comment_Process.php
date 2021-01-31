<?php
    session_start();
    include './DBConnect/DBConnect.php';
    include 'Functions.php';
    date_default_timezone_set('Asia/Ho_Chi_Minh');

    $action = isset($_GET['action']) ? $_GET['action'] : 'comment'; //kiểm tra

    if($action == 'comment') 
    {
        $current_date = date("Y-m-d H:i:s");
        if(isset($_POST['Pro_ID']) && isset($_POST['Com_Content']) && isset($_POST['Acc_ID']))
        {
            $Pro_ID = $_POST['Pro_ID'];
            $Com_Content = $_POST['Com_Content'];
            $Acc_ID = $_POST['Acc_ID'];

            if(!empty($Com_Content))
            {
                $SQLcm = "INSERT INTO `comments`(`Com_ID`, `Com_Content`, `Com_Date`, `Pro_ID`, `Acc_ID`) VALUES ('', '$Com_Content', '$current_date', '$Pro_ID', '$Acc_ID')";
                $Comment = $con->query($SQLcm);
                if($Comment == true) 
                {
                    echo "Đã đăng bình luận";
                }
                else
                {
                    echo "Lỗi hệ thống! Đăng bình luận thất bại!";
                }
            }
            else
            {
                echo "Chưa có nội dung! Hãy nhập gì đó nhé";
            }

            
        }
    }
?>
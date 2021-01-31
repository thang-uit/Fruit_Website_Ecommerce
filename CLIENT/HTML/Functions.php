<?php
    include './DBConnect/DBConnect.php';

    include 'PHPMailer/src/PHPMailer.php';
    include 'PHPMailer/src/Exception.php';
    include 'PHPMailer/src/OAuth.php';
    include 'PHPMailer/src/POP3.php';
    include 'PHPMailer/src/SMTP.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    // Hiển thị ngôi sao
    function Rating_Stars($rate)
    {
        switch($rate)
        {
            case 1:
            {
                echo
                    '
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                    ';
                break;
            }
            case 2:
            {
                echo
                    '
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                    ';
                break;
            }
            case 3:
            {
                echo
                    '
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                    ';
                break;
            }
            case 4:
            {
                echo
                    '
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                    ';
                break;
            }
            case 5:
            {
                echo
                    '
                        <i class="fa fa-star"></i> 
                        <i class="fa fa-star"></i> 
                        <i class="fa fa-star"></i> 
                        <i class="fa fa-star"></i> 
                        <i class="fa fa-star"></i>
                    ';
                break;
            }
            default:
            {
                echo
                    '
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    ';
                break;
            }
        }
    }

    // Insert Into Table
    function Insert($table, $data, $except)
    {
        global $con;
        $field = "";
        $values = "";

        if(is_array($data))
        {
            $i = 0;
            foreach($data as $key => $value)
            {
                if($key != $except)
                {
                    $i++;
                    if($i == 1)
                    {
                        $field .= $key;
                        $values .= "'" . $value . "'";
                    }
                    else
                    {
                        $field .= "," . $key;
                        $values .= ",'" . $value . "'";
                    }
                }
            }
            $SQL_Insert = "INSERT INTO $table($field) VALUES($values)";
            mysqli_query($con, $SQL_Insert) or die("Error: Fail Query!");
            $id = mysqli_insert_id($con);
            return $id;          
        }
    }


    // Send Email
    function Send_Email($username, $password, $name, $email_customer, $name_customer, $content)
    {
        $mail = new PHPMailer(true);                        
        try 
        {
            echo "<p style='display: none'>";
                $mail->CharSet = 'UTF-8';
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      
                $mail->isSMTP(); // Send using SMTP
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true; // Enable SMTP authentication
                $mail->Username = $username; // SMTP username
                $mail->Password = $password; // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->Port = 587;                              
                
                
                //Recipients
                

                $mail->setFrom($username, $name);
                $mail->addAddress($email_customer, $name_customer); // Add a recipient
            
                // $mail->addCC('cc@example.com');
                // $mail->addBCC('bcc@example.com');

                // Attachments
                // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

                // Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Thông tin đơn hàng từ Trái cây sạch - TNTFRUIT';
                $mail->Body = 
                "
                    <h1>Kính chào $name_customer, cảm ơn bạn đã đặt hàng từ Trái cây sạch - TNT FRUIT.</h1>
                    <h4>Dưới đây là thông tin về đơn hàng của bạn. Nếu có bất kì sai sót nào hãy liên hệ với chúng tôi qua email này hoặc số điện thoại +84 (0961600587)</h4>                               
                    <hr>
                    <br>
                    $content
                    <hr>
                    <h2>Cảm ơn bạn đã đọc. Chúc $name_customer một ngày tốt lành nhé! </h2>
                    <p>Theo dõi fanpage của chúng tôi để xem thêm nhiều sản phẩm nữa nhé: <a href='https://www.facebook.com/TNTFRUIT'>Trái cây sạch - TNT FRUIT</a></p>

                ";
                // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
            echo "</p>";
            return true;
        } 
        catch (Exception $e) 
        {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        // return true;
    }

?>
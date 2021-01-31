<?php
    session_start();
    // session_destroy();
    include './DBConnect/DBConnect.php';
    include 'Functions.php';

    $id = !empty($_GET['id']) ? $_GET['id'] : 1;
    $Acc_ID = isset($_SESSION['login']['Acc_ID']) ? $_SESSION['login']['Acc_ID'] : 0;

    $QUERY = "SELECT * FROM `products` WHERE `Pro_ID` = " . $id;
    $result = $con->query($QUERY);
    $Product = $result->fetch_array();

    $QUERY_2 = "SELECT * FROM `listimg_products` WHERE `Pro_ID` = " . $id;
    $IMG = $con->query($QUERY_2);


    $sessionKey = 'post_' . $id;
    if(!isset($_SESSION["$sessionKey"]))
    {
        $_SESSION["$sessionKey"] = 1; //set giá trị cho session
        $con->query("UPDATE `products` SET `Pro_View` = `Pro_View` + 1 WHERE `Pro_ID` = " . $id);
    }

    $relate_product = 4; // Số sản phẩm muốn hiển thị
    $QRY = "SELECT * FROM `products` ORDER BY RAND() LIMIT " . $relate_product;
    $Relate_product = $con->query($QRY);
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
    <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>

    <title><?= $Product['Pro_Name']; ?></title>
</head>

<body>  
    <div class="backgroundcolor">
              
        <!------ Header ------>
        <?php include 'Header.php'; ?>

        <!------ Single product details ------>
        <div class="small-container single-product">
            <div class="row">
                <div class="col-2">
                    <img src="<?= $Product['Pro_Img'] ?>" id="productimg">
                    <div class="small-img-row">
                        <?php
                            while($row = $IMG->fetch_array())
                            {
                        ?>
                                <div class="small-img-col">
                                    <img src="<?= $row['Lis_Path'] ?>" class="small-img">
                                </div>    
                        <?php
                            }
                        ?>
                    </div>

                </div>
                <div class="col-2">
                    <!-- <p>Chi Tiết Sản Phẩm</p> -->
                    <p><i class="fa fa-eye"></i> <?= $Product['Pro_View']; ?></p>
                    <br>
                    <h1><?= $Product['Pro_Name']; ?></h1>
                    <br>
                    <p>Xuất xứ: <?= $Product['Pro_Nation']; ?></p>
    
                    <h4>Người dùng đánh giá: 
                        <?php
                            Rating_Stars($Product['Pro_Rate']);  
                        ?>
                    </h4> 
                    <h3>Giá: <?= number_format($Product['Pro_Price'], 0, ",", "."); ?> VNĐ</h3>
                    
                    <span>Số lượng: </span><input type="number" id="number" value="1" min="1" max="50"> <span>Kg</span>
                    <br>
                    <a href="" class="btn">Yêu thích<i class="fa fa-heart"></i></a>                       
                    <a class="btn modal-btn" id="addcart">Thêm vào giỏ<i class="fa fa-cart-plus"></i></a> 
                    
                    <h3>Thông Tin Sản Phẩm <i class="fa fa-indent"></i></h3>
                    <p class="product-info">
                        <?= $Product['Pro_Info']; ?>
                        <div class="fb-share-button" data-href="http://localhost:81/Code/Project/Fruit_Website/CLIENT/HTML/Product_Detail.php?id=<?= $id ?>" data-layout="button_count" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Flocalhost%3A81%2FCode%2FProject%2FFruit_Website%2FCLIENT%2FHTML%2FProduct_Detail.php&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>

                    </p>
                </div>
            </div>


            <hr style="border: none; background-color: var(--Background_color); border-radius: 3px; padding: 2px; height: 1px; margin: 100px 0 50px 0;">


            <h1 class="title-comment" id="comment">
                <i class="fa fa-comments"></i> &nbsp;&nbsp;BÌNH LUẬN, ĐÁNH GIÁ SẢN PHẨM <i class="fa fa-comments"></i>
            </h1>


            <div class="comment">
                <div class="comment-box">
                <!-- Frame comment facebook -->
                <div class="fb-comments" data-href="http://localhost:81/Code/Project/Fruit_Website/CLIENT/HTML/Product_Detail.php?id=<?= $id ?>" data-width="1100" data-numposts="10"></div>           

                    <?php
                        if(!isset($_SESSION['login']) && empty($_SESSION['login']))
                        {
                            echo '<h2 style="letter-spacing: 2px;">Đăng nhập để có thể bình luận và nhận thông tin khuyến mãi <a href="Login.php" style="color: red;"> TẠI ĐÂY</a></h2> <br>';
                        }
                        else
                        {
                    ?>                            
                            <textarea class="cm-content" name="Content" id="Com_Content" placeholder="Ex: Nhập bình luận ở đây" maxlength="100000" required></textarea>
                            <br>                               
                            <a class="btn" onclick="Comment(<?= $id ?>)">Đăng</a>
                            <p style="color: red" id="notify"></p>
                            
                            <hr style="width: 1100px; margin-bottom: 80px;">                       
                    <?php
                        }
                    ?>
                
                    <div id="commentload">                  
                        <?php
                            $SQLListCM = "SELECT * FROM `comments`, `accounts` WHERE `comments`.`Acc_ID` = `accounts`.`Acc_ID` AND `Pro_ID` = '$id' ORDER BY `Com_ID` ASC";
                            $ShowCM = $con->query($SQLListCM);
                            $totaltb = mysqli_num_rows($ShowCM);

                            if($totaltb <= 0)
                            {
                                echo '<h3>Chưa có bình luận nào.</h3>';
                            }
                            else
                            {
                        ?>
                                <div class="list-comment">
                                    <?php
                                        while($row = $ShowCM->fetch_array())
                                        {
                                    ?>
                                            <div class="user">
                                                <image src="../Image/Logo/User.png" class="user-img"> 
                                                <div class="username">&nbsp; <?= $row['Acc_Username'] ?></div>
                                                <br>
                                                <div class="time">&nbsp; Nhận xét vào: <?= $row['Com_Date'] ?></div>
                                                <div class="clear"></div>
                                                <br>
                                                <div class="content-comment">
                                                    <?= $row['Com_Content'] ?>                                               
                                                </div>
                                                <hr>
                                            </div>                                           
                                    <?php
                                        }
                                    ?>
                                </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
            <hr style="width: 100%; border: none; background-color: var(--Background_color); border-radius: 3px; padding: 2px; height: 1px; margin: 100px 0;">
        </div>


        

        <!-- Title -->
        <div class="small-container">
            <div class="row row-2">
                <h2>Sản Phẩm Liên Quan</h2>
                <a href="All_Product.php"><p>Xem thêm</p></a>
            </div>
        </div>

        <!-- Sản phẩm liên quan -->
        <div class="small-container relate-product">
            <div class="row">
            <?php
                    while ($row = $Relate_product->fetch_array())
                    {
                ?>
                    <div class="col-4 add-border">
                        <a href="Product_Detail.php?id=<?= $row['Pro_ID'] ?>">
                            <img src="<?= $row['Pro_Img'] ?>">                       
                            <h3><?= $row['Pro_Name'] ?></h3>
                            <div class="rating">
                                <?php
                                    Rating_Stars($row['Pro_Rate']);
                                ?>
                            </div>                   
                            <p><?= number_format($row['Pro_Price'], 0, ",", ".") ?> VNĐ/1kg</p>      
                            <!-- <span><a><i class="fa fa-cart-plus"></i></a></span>                                      -->
                        </a>                                                 
                    </div>                   
                <?php 
                    } 
                ?>
            </div>
        </div>


        <!--------- Modal --------->
        <div class="modal-bg">
            <div class="modal">
                <span class="modal-close">             
                    <a class="btn-close">&times;</a>                                   
                </span>
                
                <br> <br> 
                <hr style="border: none; background-color: var(--Background_color); border-radius: 3px; padding: 2px; height: 1px;">
                <br>
                <div class="modal-detail">
                    <div class="modal-img">
                        <img src="<?= $Product['Pro_Img'] ?>">
                    </div>

                    <div class="modal-info">
                        <h1 style="color: red;">Đã Thêm Vào Giỏ!</h1> 
                        <br>                      
                        <h2><?= $Product['Pro_Name']; ?></h2>
                        <br>
                        <p>Người dùng đánh giá: <?= Rating_Stars($Product['Pro_Rate']); ?></p>
                        <br>
                        <h4>Giá: <?= number_format($Product['Pro_Price'], 0, ",", "."); ?> <u>VNĐ</u></h4>
                        <br>    
                        <h3>Số lượng: <span id="value"></span></h3>                  
                    </div>
                </div>
                <div class="modal-function">
                    <a class="btn" href="javascript:history.back()">&#8592; Tiếp tục mua sắm</a>
                    <a class="btn" href="Cart.php">Xem giỏ hàng <i class="fa fa-shopping-cart"></i></a>
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
    <script src="../JAVASCRIPT/zoomsl.js"></script>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v9.0&appId=435501274293429&autoLogAppEvents=1" nonce="y16A1s05"></script>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v9.0&appId=435501274293429&autoLogAppEvents=1" nonce="0YQHaITj"></script>
    <script type="text/javascript">
        $(function()
        {
            $("#productimg").imagezoomsl(
            {
                zoomrange: [3, 3]
            });

            $("#addcart").click(function()
            {
                $.ajax
                ({
                    url: "Cart_Process.php?action=add", // gửi ajax đến file
                    type: "post", // chọn phương thức gửi là post
                    dateType: "text", // dữ liệu trả về dạng text
                    data: 
                    { 
                        ID: <?= $id ?>,
                        Number: $("#number").val()
                    },
                    success: function(result)
                    {                         
                        $("#value").text($("#number").val());
                        $("#numbercart").text(result);
                    }
                });
            }); 
        });

        CKEDITOR.replace('Com_Content');
        function Comment(id)
        {
            var content = CKEDITOR.instances["Com_Content"].getData();
            $.ajax
            ({
                url: "Comment_Process.php?action=comment", // gửi ajax đến file
                type: "post", // chọn phương thức gửi là get
                dateType: "text", // dữ liệu trả về dạng text
                data: 
                { 
                    Pro_ID: id,
                    Com_Content: content,
                    Acc_ID: <?= $Acc_ID ?>,
                },
                success: function(result)
                {   
                    $("#notify").text(result);
                    $("#commentload").load("Product_Detail.php?id=<?= $id ?> #commentload");
                }
            });
        }
    </script>

</body>

</html>
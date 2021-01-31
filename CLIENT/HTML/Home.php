<?php
    session_start();
    // session_destroy();
    include './DBConnect/DBConnect.php';
    include 'Functions.php';

    $item_per_page = 12; // Số sản phẩm trên một trang
    $current_page = !empty($_GET['page']) ? $_GET['page'] : 1; // Trang hiện tại
    $offset = ($current_page - 1) * $item_per_page; // Công thức chia sản phẩm đều ra các trang

    $SQL = "SELECT * FROM `products` WHERE `Pro_Type` = 'Trái cây nội' LIMIT " . $item_per_page . " OFFSET " . $offset;
    $Product = $con->query($SQL);
    
    $total_records = mysqli_query($con, "SELECT * FROM `products` WHERE `Pro_Type` = 'Trái cây nội'");
    $totals = mysqli_num_rows($total_records); // Tổng số sản phẩm
    // var_dump($totals); exit;
    $total_page = ceil($totals / $item_per_page); // Tổng số sản phẩm / Số sản phẩm trên một trang = Tổng số trang (Nếu ra số lẻ sẽ làm tròn)

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

    <title>TRÁI CÂY SẠCH - TNT FRUIT</title>
</head>

<body>  
    
    <!-- <div class="loader_bg">
        <div class="loader"></div>
    </div> -->

    <!------ Loading page ------>
    <div class="loading-screen">
        <div class="loading">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    
    <div class="backgroundcolor">
              
        <!------ Header ------>
        <?php include 'Header.php'; ?>        

        <div class="row">
            <div class="col-2">
                <h3>
                    Trái cây sạch - TNT FRUIT mang đến cho bạn<br>
                    những loại trái cây ngon, sạch và chất lượng nhất Việt Nam!
                </h3>
                <a href="#Featured" class="btn"><span></span>Mua sắm nào &#8594;</a>
            </div>
            <div class="col-2">
                <img src="../Image/Ảnh bìa/Traicay.png">
            </div>
        </div>

        <!------ Featured categories ------>
        <div class="categories">
            <div class="row">
                <div class="col-3">
                    <a href="#"><img src="../Image/Ảnh bìa/Traicay_1.jpg"></a>
                </div>
            </div>
        </div>

        <!------ Featured products ------>
        <div class="small-container">
            <h1 id="Featured" class="title">Trái Cây Nội</h1>
            <div class="row">
                <?php
                    while ($row = $Product->fetch_array())
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
                        </a>                                                 
                    </div>
                <?php 
                    } 
                ?>
            </div>

            <div class="page-btn">
                <?php
                    if($current_page > 5)
                    {
                        $first_page = 1;                 
                ?>
                        <a href="?page=<?= $first_page ?>"><span><strong>First</strong></span></a>
                <?php
                    }
                ?>

                <?php
                    for($num = 1; $num <= $total_page; $num++)
                    {
                        if($num != $current_page)
                        {
                            if($num > $current_page - 5 && $num < $current_page + 5)
                            {
                ?>
                                <a href="?page=<?= $num ?>"><span><?= $num ?></span></a>
                <?php
                            }  
                        }
                        else // Tô màu cho trang đã chọn
                        {
                ?>
                            <a href="?page=<?= $num ?>"><span class="select"><?= $num ?></span></a>
                <?php
                        } 
                    }
                ?>

                <?php
                    if($current_page < $total_page - 5)
                    {
                        $end_page = $total_page;
                ?>
                        <a href="?page=<?= $end_page ?>"><span><strong>Last</strong></span></a>
                <?php
                    }
                ?>
            </div>
        </div>
        
        <!------ Offer ------>
        <div class="offer">
            <div class="row">
                <div class="col-2">
                    <img src="../Image/Products/Sầu riêng/Sầu riêng.png" class="offer-img">
                </div>
                <div class="col-2">
                    <p>Chỉ có tại <strong>Trái Cây Sạch - TNT FRUIT</strong></p>
                    <p><strike>300,000 VNĐ / 1kg</strike><strong class="Price-Durian">&nbsp; &nbsp; 200,000 VNĐ / 1kg</strong></p>
                    <h2>Sầu Riêng Musang King</h2>
                    <small>
                        Giống sầu riêng Musang King (Musang King Durian) là giống sầu riêng có xuất xứ từ Malaysia, <br>
                        được mệnh danh là vua của các loại sầu riêng.
                        Là loại sầu riêng nổi tiếng khắp thế giới vì độ ngon và chất lượng đến từ Malaysia.                                
                    </small>
                    <br>
                    <a href="Product_Detail.php?id=17" class="btn"><span></span>Xem chi tiết &#8594;</a>
                </div>
            </div>
        </div>

        <!------ Testimonial ------>
        <div class="testimonial">
            <div class="row">
                 <!-- Lê Thị Tiểu Linh -->
                <div class="col-4">
                    <i class="fa fa-quote-left"></i>
                    <p>
                        TNT FRUIT chính là sự lựa chọn của tôi, 
                        những sản phẩm trái cây ở đây đều rất sạch và tươi ngon. Nhiều sản phẩm 
                        đa dạng và hơn hết là giá cả rất hợp lí. Tôi sẽ tiếp tục ủng hộ thuơng hiệu này!<br>
                        (26/10/2020)
                    </p>
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                    <a href="https://www.facebook.com/ri.bi.566/" target="_blank"><img
                            src="../Image/Rating/Lê Thị Tiểu Linh/Linh_2.jpg"></a>
                        <h3>Lê Thị Tiểu Linh</h3>                   
                </div>  
                
                <!-- Phan Thị Phương Thảo -->
                <div class="col-4">
                    <i class="fa fa-quote-left"></i>
                    <p>
                        TNT FRUIT chính là sự lựa chọn của tôi, 
                        những sản phẩm trái cây ở đây đều rất sạch và tươi ngon. Nhiều sản phẩm 
                        đa dạng và hơn hết là giá cả rất hợp lí. Tôi sẽ tiếp tục ủng hộ thuơng hiệu này!<br>
                        (26/10/2020)
                    </p>
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                    <a href="https://www.facebook.com/nun.khum" target="_blank"><img
                            src="../Image/Rating/Phan Thị Phương Thảo/Thảo_1.jpg"></a>
                    <h3>Phan Thị Phương Thảo</h3>
                </div>

                <!-- Nguyễn Thị Hồng Thủy -->
                <div class="col-4">
                    <i class="fa fa-quote-left"></i>
                    <p>
                        TNT FRUIT chính là sự lựa chọn của tôi, 
                        những sản phẩm trái cây ở đây đều rất sạch và tươi ngon. Nhiều sản phẩm 
                        đa dạng và hơn hết là giá cả rất hợp lí. Tôi sẽ tiếp tục ủng hộ thuơng hiệu này!<br>
                        (26/10/2020)
                    </p>
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                    <a href="https://www.facebook.com/profile.php?id=100007495536117" target="_blank"><img
                            src="../Image/Rating/Nguyễn Thị Hồng Thủy/Thủy_2.jpg"></a>
                    <h3>Nguyễn Thị Hồng Thủy</h3>
                </div>

                <!-- Đinh Thị Hoàng Lan -->
                <div class="col-4">
                    <i class="fa fa-quote-left"></i>
                    <p>
                        TNT FRUIT chính là sự lựa chọn của tôi, 
                        những sản phẩm trái cây ở đây đều rất sạch và tươi ngon. Nhiều sản phẩm 
                        đa dạng và hơn hết là giá cả rất hợp lí. Tôi sẽ tiếp tục ủng hộ thuơng hiệu này!<br>
                        (26/10/2020)
                    </p>
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                    <a href="https://www.facebook.com/profile.php?id=100005552327668" target="_blank"><img
                            src="../Image/Rating/Đinh Thị Hoàng Lan/Lan_1.jpg"></a>
                    <h3>Đinh Thị Hoàng Lan</h3>
                </div>

                <!-- Vũ Tiến Giáp -->
                <div class="col-4">
                    <i class="fa fa-quote-left"></i>
                    <p>
                        TNT FRUIT chính là sự lựa chọn của tôi, 
                        những sản phẩm trái cây ở đây đều rất sạch và tươi ngon. Nhiều sản phẩm 
                        đa dạng và hơn hết là giá cả rất hợp lí. Tôi sẽ tiếp tục ủng hộ thuơng hiệu này!<br>
                        (26/10/2020)
                    </p>
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                    <a href="https://www.facebook.com/jab.tinjab/" target="_blank"><img
                            src="../Image/Rating/Vũ Tiến Giáp/Giáp_1.jpg"></a>
                    <h3>Vũ Tiến Giáp</h3>
                </div>              

                <!-- Nguyễn Việt Hoàng -->
                <div class="col-4">
                    <i class="fa fa-quote-left"></i>
                    <p>
                        TNT FRUIT chính là sự lựa chọn của tôi, 
                        những sản phẩm trái cây ở đây đều rất sạch và tươi ngon. Nhiều sản phẩm 
                        đa dạng và hơn hết là giá cả rất hợp lí. Tôi sẽ tiếp tục ủng hộ thuơng hiệu này!<br>
                        (26/10/2020)
                    </p>
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                    <a href="https://www.facebook.com/profile.php?id=100042440866178" target="_blank"><img
                            src="../Image/Rating/Nguyễn Việt Hoàng/Hoàng_1.jpg"></a>
                    <h3>Nguyễn Việt Hoàng</h3>
                </div>

                <!-- Thắng đẹp trai -->
                <div class="col-4">
                    <i class="fa fa-quote-left"></i>
                    <p>
                        Thang dep lam Thang dep lam
                        Thang dep lam Thang dep lam
                        Thang dep lam Thang dep lam
                        Thang dep lam Thang dep lam
                        Thang dep lam Thang dep lam 
                        Thang dep lam Thang dep lam
                        Thang dep lam Thang dep lam
                        Thang dep lam Thang dep lam                                      
                    </p>
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                    <a href="https://www.facebook.com/ThangUIT2018/" target="_blank"><img
                            src="../Image/Rating/Me/Thắng_1.jpg"></a>
                    <h3>Chu Nam Thắng</h3>
                </div>

                <!-- Vũ Hồng Đức -->
                <div class="col-4">
                    <i class="fa fa-quote-left"></i>
                    <p>
                        TNT FRUIT chính là sự lựa chọn của tôi, 
                        những sản phẩm trái cây ở đây đều rất sạch và tươi ngon. Nhiều sản phẩm 
                        đa dạng và hơn hết là giá cả rất hợp lí. Tôi sẽ tiếp tục ủng hộ thuơng hiệu này!<br>
                        (26/10/2020)
                    </p>
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                    <a href="https://www.facebook.com/profile.php?id=100006372077938" target="_blank"><img
                            src="../Image/Rating/Vũ Hồng Đức/Đức_1.jpg"></a>
                    <h3>Vũ Hồng Đức</h3>
                </div>              
            </div>
        </div>

        <!------ Brands ------>
        <div class="brands">
            <div class="container">
                <div class="row">
                    <div class="col-5">
                        <a href="https://napas.com.vn/" target="_blank"><img src="../Image/Brand/logo-napas.png"></a>
                    </div>

                    <div class="col-5">
                        <a href="https://www.mastercard.us/en-us.html" target="_blank"><img
                                src="../Image/Brand/logo-mastercard.png"></a>
                    </div>

                    <div class="col-5">
                        <a href="https://www.visa.com.vn/vi_VN" target="_blank"><img
                                src="../Image/Brand/logo-visa.png"></a>
                    </div>

                    <div class="col-5">
                        <a href="https://momo.vn/" target="_blank"><img src="../Image/Brand/logo-momo.png"></a>
                    </div>

                    <div class="col-5">
                        <a href="https://zalopay.vn/" target="_blank"><img src="../Image/Brand/logo-zalopay.png"></a>
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
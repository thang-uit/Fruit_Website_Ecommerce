<?php
    session_start();
    include './DBConnect/DBConnect.php';
    include 'Functions.php';
    
    $field = isset($_GET['field']) ? $_GET['field'] : "";
    $sort = isset($_GET['sort']) ? $_GET['sort'] : "";
    $sort_condition = "";
    $param = "";

    if(!empty($field) && !empty($sort))
    {
        $sort_condition = "ORDER BY `$field` $sort";
        $param .= "field=$field&sort=$sort" . "&"; 
    }

    $item_per_page = 16; // Số sản phẩm trên một trang
    $current_page = !empty($_GET['page']) ? $_GET['page'] : 1; // Trang hiện tại
    $offset = ($current_page - 1) * $item_per_page; // Công thức chia sản phẩm đều ra các trang

    $QR = "SELECT * FROM `products` " . $sort_condition . " LIMIT " . $item_per_page . " OFFSET " . $offset;
    $Products = $con->query($QR);
    
    $total_records = mysqli_query($con, "SELECT * FROM `products`");
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

    <title>Tất Cả Sản Phẩm</title>
</head>

<body>  
    <div class="backgroundcolor">
              
        <!------ Header ------>
        <?php include 'Header.php'; ?>

        <!------ All products ------>
        <div class="small-container">

            <div class="row row-2">
                <h1>Tất Cả Sản Phẩm</h1>
                
                <select id="sortbox" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);"> 
                    <option value="?field=Pro_ID&sort=ASC" selected><p>Sắp xếp mặc định</p></option>
                    <option value="?field=Pro_Price&sort=ASC" <?php if(isset($_GET['field']) && $_GET['field'] == "Pro_Price" && isset($_GET['sort']) && $_GET['sort'] == "ASC"){ ?> selected <?php } ?>><p> GIÁ &nbsp; &nbsp;tăng dần</p></option>
                    <option value="?field=Pro_Price&sort=DESC" <?php if(isset($_GET['field']) && $_GET['field'] == "Pro_Price" && isset($_GET['sort']) && $_GET['sort'] == "DESC"){ ?> selected <?php } ?>><p> GIÁ &nbsp; &nbsp;giảm dần</p></option>
                    <option value="?field=Pro_Rate&sort=ASC" <?php if(isset($_GET['field']) && $_GET['field'] == "Pro_Rate" && isset($_GET['sort']) && $_GET['sort'] == "ASC"){ ?> selected <?php } ?>><p> ĐÁNH GIÁ &nbsp; &nbsp;tăng dần</p></option>
                    <option value="?field=Pro_Rate&sort=DESC" <?php if(isset($_GET['field']) && $_GET['field'] == "Pro_Rate" && isset($_GET['sort']) && $_GET['sort'] == "DESC"){ ?> selected <?php } ?>><p> ĐÁNH GIÁ &nbsp; &nbsp;giảm dần</p></option>
                    <option value="?field=Pro_View&sort=ASC" <?php if(isset($_GET['field']) && $_GET['field'] == "Pro_View" && isset($_GET['sort']) && $_GET['sort'] == "ASC"){ ?> selected <?php } ?>><p> SỐ LƯỢT XEM &nbsp; &nbsp;tăng dần</p></option>
                    <option value="?field=Pro_View&sort=DESC" <?php if(isset($_GET['field']) && $_GET['field'] == "Pro_View" && isset($_GET['sort']) && $_GET['sort'] == "DESC"){ ?> selected <?php } ?>><p> SỐ LƯỢT XEM &nbsp; &nbsp;giảm dần</p></option>
                    <option value="?field=Pro_Name&sort=ASC" <?php if(isset($_GET['field']) && $_GET['field'] == "Pro_Name" && isset($_GET['sort']) && $_GET['sort'] == "ASC"){ ?> selected <?php } ?>><p> BẢNG CHỮ CÁI &nbsp; &nbsp;(A - Z)</p></option>
                    <option value="?field=Pro_Name&sort=DESC" <?php if(isset($_GET['field']) && $_GET['field'] == "Pro_Name" && isset($_GET['sort']) && $_GET['sort'] == "DESC"){ ?> selected <?php } ?>><p> BẢNG CHỮ CÁI &nbsp; &nbsp;(Z - A)</p></option>
                </select>
            </div>
        

            <!------ Phân trang ------>
            <div class="page-btn">
                <?php
                    if($current_page > 3)
                    {
                        $first_page = 1;                 
                ?>
                        <a href="?<?= $param ?>per_page=<?= $item_per_page ?>&page=<?= $first_page ?>"><span><strong>First</strong></span></a>
                <?php
                    }
                ?>

                <?php
                    for($num = 1; $num <= $total_page; $num++)
                    {
                        if($num != $current_page)
                        {
                            if($num > $current_page - 3 && $num < $current_page + 3)
                            {
                ?>
                                <a href="?<?= $param ?>per_page=<?= $item_per_page ?>&page=<?= $num ?>"><span><?= $num ?></span></a>
                <?php
                            }  
                        }
                        else // Tô màu cho trang đã chọn
                        {
                ?>
                            <a href="?<?= $param ?>per_page=<?= $item_per_page ?>&page=<?= $num ?>"><span class="select"><?= $num ?></span></a>
                <?php
                        } 
                    }
                ?>

                <?php
                    if($current_page < $total_page - 3)
                    {
                        $end_page = $total_page;
                ?>
                        <a href="?<?= $param ?>per_page=<?= $item_per_page ?>&page=<?= $end_page ?>"><span><strong>Last</strong></span></a>
                <?php
                    }
                ?>
            </div>


            <!------ Hiển thị toàn bộ sản phẩm ------>
            <div class="row" id="product-load">
                <?php
                    while ($row = $Products->fetch_array())
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
                            <!-- <span>
                                <a><i class="fa fa-cart-plus"></i></a>   
                            </span> -->
                        </a>                                                 
                    </div>
                <?php 
                    } 
                ?>
            </div>


            <!------ Phân trang ------>
            <div class="page-btn">
                <?php
                    if($current_page > 3)
                    {
                        $first_page = 1;
                    
                ?>
                    <a href="?<?= $param ?>per_page=<?= $item_per_page ?>&page=<?= $first_page ?>"><span><strong>First</strong></span></a>
                <?php
                    }
                ?>

                <?php
                    for($num = 1; $num <= $total_page; $num++)
                    {
                        if($num != $current_page)
                        {
                            if($num > $current_page - 3 && $num < $current_page + 3)
                            {
                ?>
                                <a href="?<?= $param ?>per_page=<?= $item_per_page ?>&page=<?= $num ?>"><span><?= $num ?></span></a>
                <?php
                            }  
                        }
                        else // Tô màu cho trang đã chọn
                        {
                ?>
                    <a href="?<?= $param ?>per_page=<?= $item_per_page ?>&page=<?= $num ?>"><span class="select"><?= $num ?></span></a>
                <?php
                        } 
                    }
                ?>

                <?php
                    if($current_page < $total_page - 3)
                    {
                        $end_page = $total_page;
                    
                ?>
                    <a href="?<?= $param ?>per_page=<?= $item_per_page ?>&page=<?= $end_page ?>"><span><strong>Last</strong></span></a>
                <?php
                    }
                ?>
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
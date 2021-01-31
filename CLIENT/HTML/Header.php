<?php
    // session_start();
    date_default_timezone_set('Asia/Ho_Chi_Minh');
?>
<div class="header">
    <nav>
        <div class="container">
            <div class="logo">
                <a href="Home.php"><img src="../Image/Logo/TNT_4.png"></a>
            </div>
            <div class="options">
                <ul id="MenuItems">
                    <li><a href="Home.php">Trang chủ</a></li>
                    <li><a href="All_Product.php">Sản phẩm</a>
                        <div class="sub-menu-1">
                            <ul>
                                <li class="hover-me"><a href="#Featured">Trái cây nội</a> <i
                                        class="fa fa-angle-right"></i>
                                    <div class="sub-menu-2">
                                        <ul>
                                            <li><a href="#">Trái cây miền Bắc</a></li>
                                            <li><a href="#">Trái cây miền Trung</a></li>
                                            <li><a href="#">Trái cây miền Nam</a></li>
                                            <li><a href="#">Trái cây theo mùa</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li><a href="#">Trái cây ngoại nhập</a></li>
                                <li><a href="#">Trái cây đóng hộp</a></li>
                                <li><a href="#">Mâm quả trái cây</a></li>
                            </ul>
                        </div>
                    </li>
                    <li><a href="All_Product.php">Khuyến mãi</a></li>
                    <li><a href="#footer">Giới thiệu</a></li>
                    <li><a href="#footer">Liện hệ</a></li>
                </ul>
            </div>
            <div class="icon">
                <?php
                    if(isset($_SESSION['login']))
                    {
                ?>
                        <div class="tooltip">
                            <a rel="external" href="Profile.php"><i class="fa fa-user-circle"></i></a>
                            <span class="tooltiptext">Đã đăng nhập</span>
                        </div>
                <?php
                    }
                    else
                    {
                ?>
                        <div class="tooltip">
                            <a rel="external" href="Login.php"><i class="fa fa-user-circle"></i></a>
                            <span class="tooltiptext">Tài khoản</span>
                        </div>
                <?php
                    }
                ?>

                <div class="tooltip">
                    <a rel="external" href="#"><i class="fa fa-heart-o"></i></a>
                    <span class="tooltiptext">Yêu thích</span>
                </div>

                <?php
                    $number_cart = 0;
                    if(isset($_SESSION['cart']))
                    {
                        foreach($_SESSION['cart'] as $key => $value)
                        {
                            $number_cart++;
                        }
                    }
                ?>
                <div class="tooltip">
                    <a rel="external" href="Cart.php"><i class="fa fa-shopping-cart"></i><span><small class="numbercart" id="numbercart"><?= $number_cart ?></small></span></a>
                    <span class="tooltiptext">Giỏ hàng</span>
                </div>

                <div class="tooltip">
                    <a rel="external" onclick="Slide()"><i class="fa fa-search"></i></a>
                    <span class="tooltiptext">Tìm kiếm</span>
                </div>
                
                <img src="../Image/Icons/menu.png" class="menu-icon" onclick="menutoggle()">
            </div>
        </div>
    </nav>
    <div class="search hide">
        <div class="container-search">
            <form action="Search.php" method="GET">
                <input type="search" name="Search" placeholder="Ex: Thắng đẹp lắm" required> <input type="submit" value="Search">
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    var SearchBar = document.querySelector(".search");
    function Slide() 
    {
        if (SearchBar.classList.contains("hide")) 
        {
            SearchBar.classList.remove("hide");
        }
        else 
        {
            SearchBar.classList.add("hide");
        }
    }
</script>
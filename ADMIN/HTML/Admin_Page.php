<?php
    session_start();
    include './DBConnect/DBConnect.php';

    if(!isset($_SESSION['loginadmin']))
    {
        header('Location: Login.php');
    }
    $action = isset($_GET['action']) ? $_GET['action'] : 'dashboard';

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

    <title>
        <?php
            switch($action)
            {
                case 'dashboard':
                {
                    echo 'Dashboard';
                    break;
                }
                case 'adminac':
                {
                    echo 'Admin Account';
                    break;
                }
                case 'customerac':
                {
                    echo 'Customer Account';
                    break;
                }
                case 'customer':
                {
                    echo 'Customer Information';
                    break;
                }
                case 'product':
                {
                    echo 'Product';
                    break;
                }
                case 'order1':
                {
                    echo 'New Order';
                    break;
                }
                case 'order2':
                {
                    echo 'Packaging';
                    break;
                }
                case 'order3':
                {
                    echo 'Delivery';
                    break;
                }
                case 'order4':
                {
                    echo 'Order Success';
                    break;
                }
                case 'revenue':
                {
                    echo 'Revenue';
                    break;
                }
                default:
                {
                    echo 'Dashboard';
                    break;
                }
            }
        ?>
    </title>
</head>

<body>

    <!----------- Loading----------->
    <!-- <div class="loader_bg">
        <div class="loader"></div>
    </div> -->


    <div class="container">
        <!----------- Side Bar ----------->
        <nav class="navbar">
            <div class="nav_icon" onclick="Toggle_Sidebar()">
                <i class="fa fa-bars"></i>
            </div>

            <div class="navbar__left">
                <a href="#" class="active_link">Admin</a>
                <a href="#">Nothing</a>
                <a href="#">Nothing</a>
            </div>

            <div class="navbar__right">
                <a href="#"><i class="fa fa-search"></i></a>
                <a href="#"><i class="fa fa-clock-o"></i></a>
                <a href="#">
                    <img src="../Image/Logo/ThắngTS.png" alt="imgadmin">
                </a>
            </div>
        </nav>


        <!----------- Main content ----------->
        <main style="padding: 10px;">
            <?php 
                if($action == 'dashboard')
                {
                    include 'Dashboard.php';
                }
                else if($action == 'adminac')
                {
                    include 'Admin_Account.php';
                }
                else if($action == 'customerac')
                {
                    include 'Customer_Account.php';
                }
                else if($action == 'customer')
                {
                    include 'Customer.php';
                }
                else if($action == 'product')
                {
                    include 'Product.php';
                }
                else if($action == 'order1')
                {
                    include 'Order_1.php';
                }
                else if($action == 'order2')
                {
                    include 'Order_2.php';
                }
                else if($action == 'order3')
                {
                    include 'Order_3.php';
                }
                else if($action == 'order4')
                {
                    include 'Order_4.php';
                }
                else if($action == 'revenue')
                {
                    include 'Revenue.php';
                }
                else
                {
                    include 'Dashboard.php';
                }
            ?>
        </main>


        <!----------- Side Bar ----------->
        <div id="sidebar">
            <div class="sidebar__title">
                <div class="sidebar__img">
                    <img src="../Image/Logo/TNT_4.png" alt="imglogo">
                    <h1>Trái Cây Sạch - TNT FRUIT</h1>
                </div>
                <i class="fa fa-times" id="sidebarIcon" onclick="Close_Sidebar()"></i>
            </div>

            <div class="sidebar__menu">
                <div class="sidebar__link <?php if($action == 'dashboard'){echo "active_menu_link";} ?>">
                    <i class="fa fa-home"></i>
                    <a href="Admin_Page.php?action=dashboard">Dashboard</a>
                </div>
            

                <h2>ACCOUNT MANAGEMENT</h2>
                <div class="sidebar__link <?php if($action == 'adminac'){echo "active_menu_link";} ?>">
                    <i class="fa fa-user-circle-o"></i>
                    <a href="Admin_Page.php?action=adminac">Admin Account</a>
                </div>

                <div class="sidebar__link <?php if($action == 'customerac'){echo "active_menu_link";} ?>">
                    <i class="fa fa-user"></i>
                    <a href="Admin_Page.php?action=customerac">Customer Account</a>
                </div>


                <h2>CUSTOMER MANAGEMENT</h2>
                <div class="sidebar__link <?php if($action == 'customer'){echo "active_menu_link";} ?>">
                    <i class="fa fa-user"></i>
                    <a href="Admin_Page.php?action=customer">Customer Information</a>
                </div>


                <h2>PRODUCT MANAGEMENT</h2>
                <div class="sidebar__link <?php if($action == 'product'){echo "active_menu_link";} ?>">
                    <i class="fa fa-eercast"></i>
                    <a href="Admin_Page.php?action=product">Product</a>
                </div>

                <!-- <div class="sidebar__link">
                    <i class="fa fa-sign-out"></i>
                    <a href="#">Leave Policy</a>
                </div> -->


                <h2>ORDER MANAGEMENT</h2>
                <div class="sidebar__link <?php if($action == 'order1'){echo "active_menu_link";} ?>">
                    <i class="fa fa-cart-plus"></i>
                    <a href="Admin_Page.php?action=order1">New Order</a>
                </div>

                <div class="sidebar__link <?php if($action == 'order2'){echo "active_menu_link";} ?>">
                    <i class="fa fa-archive"></i>
                    <a href="Admin_Page.php?action=order2">Packaging</a>
                </div>

                <div class="sidebar__link <?php if($action == 'order3'){echo "active_menu_link";} ?>">
                    <i class="fa fa-truck"></i>
                    <a href="Admin_Page.php?action=order3">Delivery</a>
                </div>

                <div class="sidebar__link <?php if($action == 'order4'){echo "active_menu_link";} ?>">
                    <i class="fa fa-check-square-o"></i>
                    <a href="Admin_Page.php?action=order4">Order Success</a>
                </div>

                
                <h2>REVENUE</h2>
                <div class="sidebar__link <?php if($action == 'revenue'){echo "active_menu_link";} ?>">
                    <i class="fa fa-line-chart"></i>
                    <a href="Admin_Page.php?action=revenue">Revenue</a>
                </div>



                <div class="sidebar__logout modal-btn">
                    <i class="fa fa-power-off"></i>
                    <a class="modal-btn">Log out</a>
                </div>
            </div>
        </div>
    </div>



    <!--------- Modal --------->
    <div class="modal-bg">
        <div class="modal">
            <span class="modal-close">             
                <a class="btn-close">&times;</a>                                   
            </span>
            
            <br> <br> 
            <!-- <hr style="border: none; background-color: var(--Background_color); border-radius: 3px; padding: 2px; height: 1px;"> -->
            <br>
            <div class="modal-detail">
                <h1>Are you sure you want to log out?</h1>
            </div>
            <div class="modal-function">
                <a class="btn" style="background-color: #ff0000; color: #ffffff;" href="Login.php?module=logout">YES</a>
                <a class="btn" style="color: #ffffff;" href="">NO</a>
            </div>
        </div>
    </div>



    <!-- To top-->
    <a href="#" class="to-top">
        <i class="fa fa-arrow-circle-up"></i>
    </a>


    <script src="../JAVASCRIPT/main.js"></script>
    <script type="text/javascript">
        $(function()
        {
            // Jquery for Modal
            var modalbtn = document.querySelector('.modal-btn');
            var modalBg = document.querySelector('.modal-bg');
            var modalClose = document.querySelector('.modal-close');
            modalbtn.addEventListener('click', function()
            {
                modalBg.classList.add('bg-active');
            });
            modalClose.addEventListener('click', function()
            {
                modalBg.classList.remove('bg-active');
            });
        });
    </script>
</body>

</html>
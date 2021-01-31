
<?php
    if(isset($_SESSION['loginadmin']))
    {
        $SQLOrder1 = "SELECT COUNT(*) AS AMOUNT FROM `orders` WHERE `orders`.`Ord_Status` = '0'";
        $SQLOrder2 = "SELECT COUNT(*) AS AMOUNT FROM `orders` WHERE `orders`.`Ord_Status` = '1'";
        $SQLOrder3 = "SELECT COUNT(*) AS AMOUNT FROM `orders` WHERE `orders`.`Ord_Status` = '2'";
        $SQLOrder4 = "SELECT COUNT(*) AS AMOUNT FROM `orders` WHERE `orders`.`Ord_Status` = '3'";

        $Query1 = $con->query($SQLOrder1);
        $Query2 = $con->query($SQLOrder2);
        $Query3 = $con->query($SQLOrder3);
        $Query4 = $con->query($SQLOrder4);

        $row1 = $Query1->fetch_array();
        $row2 = $Query2->fetch_array();
        $row3 = $Query3->fetch_array();
        $row4 = $Query4->fetch_array();

        $Result1 = !empty($row1) ? $row1['AMOUNT'] : '0';
        $Result2 = !empty($row2) ? $row2['AMOUNT'] : '0';
        $Result3 = !empty($row3) ? $row3['AMOUNT'] : '0';
        $Result4 = !empty($row4) ? $row4['AMOUNT'] : '0';
?>
        <div class="main__container">
            <div class="main__title">
                <img src="../Image/Logo/TNT_4.png" alt="imglogo">
                <div class="main__greeting">
                    <h1>Hello <?= !empty($_SESSION['loginadmin']) ? $_SESSION['loginadmin']['Acc_Username'] : 'Admin' ?></h1>
                    <p>Welcome to your admin dashboard</p>
                </div>
            </div>

            <div class="main_cards">
                <a href="Admin_Page.php?action=order1">
                    <div class="card">
                        <i class="fa fa-cart-plus fa-2x text-lightblue"></i>
                        <div class="card__inner">
                            <p class="text-primary-p">New Order</p>
                            <span class="font-bold text-title"><?= $Result1 ?></span>
                        </div>
                    </div>
                </a>

                <a href="Admin_Page.php?action=order2">
                    <div class="card">
                        <i class="fa fa-archive fa-2x text-red"></i>
                        <div class="card__inner">
                            <p class="text-primary-p">Packaging</p>
                            <span class="font-bold text-title"><?= $Result2 ?></span>
                        </div>
                    </div>
                </a>

                <a href="Admin_Page.php?action=order3">
                    <div class="card">
                        <i class="fa fa-truck fa-2x text-yellow"></i>
                        <div class="card__inner">
                            <p class="text-primary-p">Delivery</p>
                            <span class="font-bold text-title"><?= $Result3 ?></span>
                        </div>
                    </div>
                </a>

                <a href="Admin_Page.php?action=order4">
                    <div class="card">
                        <i class="fa fa-check-square-o fa-2x text-green"></i>
                        <div class="card__inner">
                            <p class="text-primary-p">Order Success</p>
                            <span class="font-bold text-title"><?= $Result4 ?></span>
                        </div>
                    </div>
                </a>
            </div>


            <div class="charts">
                <div class="charts__left">
                    <div class="charts__left__title">
                        <div>
                            <h1>Daily Reports</h1>
                            <p>Thanh pho Ho Chi Minh, Viet Nam</p>
                        </div>
                        <i class="fa fa-usd"></i>
                    </div>
                    <div id="apex1"></div>
                </div>

                <div class="charts__right">
                    <div class="charts__right__title">
                        <div>
                            <h1>Stats Reports</h1>
                            <p>Thanh pho Thu Duc</p>
                        </div>
                        <i class="fa fa-usd"></i>
                    </div>

                    <div class="charts__right__cards">
                        <div class="card1">
                            <h1>Income</h1>
                            <p>$75,300</p>
                        </div>

                        <div class="card2">
                            <h1>Sales</h1>
                            <p>$50,500</p>
                        </div>

                        <div class="card3">
                            <h1>Users</h1>
                            <p>3900</p>
                        </div>

                        <div class="card4">
                            <h1>Orders</h1>
                            <p>1881</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="http://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script type="text/javascript">
            // Javascript for Apex Chart
            var options = 
            {
                series: 
                [
                    {
                        name: "Net Profit",
                        data: [44, 55, 57, 56, 61, 58, 63, 60, 66],
                    },
                    {
                        name: "Revenue",
                        data: [76, 85, 101, 98, 87, 105, 91, 114, 94],
                    },
                    {
                        name: "Free Cash Flow",
                        data: [35, 41, 36, 26, 45, 48, 52, 53, 41],
                    },
                ],

                chart: 
                {
                    type: "bar",
                    height: 250, //make this 250
                    sparkline: 
                    {
                        enabled: true,
                    },
                },
                
                plotOptions:
                {
                    bar: 
                    {
                        horizontal: false,
                        columnWidth: "55%",
                        endingShape: "rounded",
                    },
                },

                dataLabels:
                {
                    enabled: false,
                },
                
                stroke:
                {
                    show: true,
                    width: 2,
                    colors: ["transparent"],
                },

                xasis:
                {
                    categories: ["Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct"],
                },

                yaxis:
                {
                    title: 
                    {
                        text: "$ (thousands)",
                    },
                },

                fill:
                {
                    opacity: 1,
                },

                tooltip: 
                {
                    y: 
                    {
                        formatter: function(val)
                        {
                            return "$ " + val + " thousands";
                        },
                    },
                },
            };
            var chart = new ApexCharts(document.querySelector("#apex1"), options);
            chart.render();
        </script>
<?php
    }
    else
    {
        header('Location: Login.php');
    }
?>
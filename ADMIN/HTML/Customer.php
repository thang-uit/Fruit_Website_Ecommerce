<?php
    if(isset($_SESSION['loginadmin']))
    {
        $item_per_page = 20; // Số sản phẩm trên một trang
        $current_page = !empty($_GET['page']) ? $_GET['page'] : 1; // Trang hiện tại
        $offset = ($current_page - 1) * $item_per_page; // Công thức chia sản phẩm đều ra các trang

        $SQLCus = "SELECT * FROM `customer` LIMIT " . $item_per_page . " OFFSET " . $offset;
        $Customer = $con->query($SQLCus);
        
        $total_records = mysqli_query($con, "SELECT * FROM `customer`");
        $totals = mysqli_num_rows($total_records); // Tổng số sản phẩm
        // var_dump($totals); exit;
        $total_page = ceil($totals / $item_per_page); // Tổng số sản phẩm / Số sản phẩm trên một trang = Tổng số trang (Nếu ra số lẻ sẽ làm tròn)
?>
        <h1><i class="fa fa-user-circle-o"></i> Customer Information</h1>

        <div class="ad-account">
            <!-- <div class="add-account">
                <form class="form-account" id="form-account" method="POST">
                    <i class="fa fa-user"></i> &nbsp;<strong>Username</strong>
                    <input type="text" class="input-login" name="Acc_Username" id="username" placeholder="Username" maxlength="100" autocomplete="off" required>
                    <br><br>

                    <i class="fa fa-lock"></i> &nbsp;<strong>Password</strong>
                    <input type="password" class="input-login" name="Acc_Password" id="password" placeholder="Password" maxlength="100" autocomplete="off" required>
                    <br><br>

                    <input type="submit" name="addac" id="addac" value="Add New Account">
                </form>
            </div> -->
            <br>

            <div class="info-account">
                <br>
                <input type="text" class="search-ac" name="search" id="search-ac" placeholder="Customer name">
                <br>
                <br>
                <table border="1" cellspacing="0" align="center" id="loadcustomer">
                    <tr class="table-title">
                        <th>Customer ID</th>
                        <th>Customer Name</th>
                        <th>Birthday</th>
                        <th>Gender</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Delele</th>
                    </tr>
                    <tbody id="datasearch">
                        <?php
                            while($row = $Customer->fetch_array())
                            {
                        ?>
                                <tr>
                                    <td><a href="Account_Modal.php?CUSID=<?= $row['Cus_ID'] ?>" target="_blank" onclick="window.open(this.href, 'customer', 'left=500, top=50, width=450, height=300, toolbar=1, resizable=0'); return false;" style="color: #06ba2a; text-decoration: underline;"><?= $row['Cus_ID'] ?></a></td>
                                    <td><?= $row['Cus_Name'] ?></td>
                                    <td><?= $row['Cus_BDay'] ?> </td>
                                    <td><?php if($row['Cus_Gender'] == 1){echo "Nam";} else{echo "Nữ";} ?></td>
                                    <td><?= $row['Cus_Email'] ?></td>
                                    <td><?= $row['Cus_Phone'] ?></td>                                                          
                                    <td><a class="delete-ac" onclick="Delete(<?= $row['Cus_ID'] ?>)"><i class="fa fa-trash"></i></a></td>
                                </tr>
                        <?php
                            }
                        ?>

                        <tr>
                            <td colspan="8">
                                <div class="page-btn">
                                <?php
                                    if($current_page > 5)
                                    {
                                        $first_page = 1;                 
                                ?>
                                        <a href="?action=customer&page=<?= $first_page ?>"><span><strong>First</strong></span></a>
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
                                                <a href="?action=customer&page=<?= $num ?>"><span><?= $num ?></span></a>
                                <?php
                                            }  
                                        }
                                        else // Tô màu cho trang đã chọn
                                        {
                                ?>
                                            <a href="?action=customer&page=<?= $num ?>"><span class="select"><?= $num ?></span></a>
                                <?php
                                        } 
                                    }
                                ?>

                                <?php
                                    if($current_page < $total_page - 5)
                                    {
                                        $end_page = $total_page;
                                ?>
                                        <a href="?action=customer&page=<?= $end_page ?>"><span><strong>Last</strong></span></a>
                                <?php
                                    }
                                ?>
                                </div>
                            </td>
                        </tr>
                    </tbody>         
                </table>
            </div>
        </div>

        <script type="text/javascript">
            $(function()
            {
                $("#search-ac").keyup(function()
                {
                    var keyword = $("#search-ac").val();
                    $.ajax
                    ({
                        url: "Customer_Process.php?action=search", // gửi ajax đến file
                        type: "post", // chọn phương thức gửi là post
                        dateType: "text", // dữ liệu trả về dạng text
                        data: 
                        { 
                            Search: keyword,
                        },
                        success: function(result)
                        {                  
                            if(result == 'Nothing')     
                            {
                                $("#loadcustomer").load("Admin_Page.php?action=customer #loadcustomer"); 
                            }
                            else
                            {
                                $("#datasearch").html(result);
                            }                            
                        }
                    });
                });
            });

            function Delete(id)
            {
                $.ajax
                ({
                    url: "Customer_Process.php?action=delete", // gửi ajax đến file
                    type: "post", // chọn phương thức gửi là get
                    dateType: "text", // dữ liệu trả về dạng text
                    data: 
                    { 
                        Cus_ID: id,
                    },
                    success: function (result)
                    {              
                        alert(result);      
                        $("#loadcustomer").load("Admin_Page.php?action=customer #loadcustomer");             
                    }
                });
            };
        </script>
<?php
    }
    else
    {
        header('Location: Login.php');
    }
?>
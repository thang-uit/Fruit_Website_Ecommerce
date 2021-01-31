<?php
    if(isset($_SESSION['loginadmin']))
    {
        $item_per_page = 10; // Số sản phẩm trên một trang
        $current_page = !empty($_GET['page']) ? $_GET['page'] : 1; // Trang hiện tại
        $offset = ($current_page - 1) * $item_per_page; // Công thức chia sản phẩm đều ra các trang

        $SQLAccount = "SELECT * FROM `accounts` WHERE `Acc_Role` = 'admin' LIMIT " . $item_per_page . " OFFSET " . $offset;
        $AccountAD = $con->query($SQLAccount);
        
        $total_records = mysqli_query($con, "SELECT * FROM `accounts` WHERE `Acc_Role` = 'admin'");
        $totals = mysqli_num_rows($total_records); // Tổng số sản phẩm
        // var_dump($totals); exit;
        $total_page = ceil($totals / $item_per_page); // Tổng số sản phẩm / Số sản phẩm trên một trang = Tổng số trang (Nếu ra số lẻ sẽ làm tròn)
?>
        <h1><i class="fa fa-user-circle-o"></i> Admin Account</h1>

        <div class="ad-account">
            <div class="add-account">
                <form class="form-account" id="form-account" method="POST">
                    <i class="fa fa-user"></i> &nbsp;<strong>Username</strong>
                    <input type="text" class="input-login" name="Acc_Username" id="username" placeholder="Username" maxlength="100" autocomplete="off" required>
                    <br><br>

                    <i class="fa fa-lock"></i> &nbsp;<strong>Password</strong>
                    <input type="password" class="input-login" name="Acc_Password" id="password" placeholder="Password" maxlength="100" autocomplete="off" required>
                    <br><br>

                    <input type="submit" name="addac" id="addac" value="Add New Account">
                </form>
            </div>

            <br>

            <div class="info-account">
                <br>
                <input type="text" class="search-ac" name="search" id="search-ac" placeholder="Username">
                <br>
                <br>
                <table border="1" cellspacing="0" align="center" id="loadaccount">
                    <tr class="table-title">
                        <th>Account ID</th>
                        <th>Username </th>
                        <th>Password</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Date Created</th>
                        <th>Delele</th>
                    </tr>
                    <tbody id="datasearch">
                        <?php
                            while($row = $AccountAD->fetch_array())
                            {
                        ?>
                                <tr>
                                    <td><?= $row['Acc_ID'] ?></td>
                                    <td><?= $row['Acc_Username'] ?></td>
                                    <td><?= $row['Acc_Password'] ?> </td>
                                    <td><?= $row['Acc_Role'] ?></td>
                                    <td><?= $row['Acc_Status'] ?></td>
                                    <td><?= $row['Acc_Date'] ?></td>                                                           
                                    <td><a class="delete-ac" onclick="Delete(<?= $row['Acc_ID'] ?>)"><i class="fa fa-trash"></i></a></td>
                                </tr>
                        <?php
                            }
                        ?>

                        <tr>
                            <td colspan="7">
                                <div class="page-btn">
                                <?php
                                    if($current_page > 5)
                                    {
                                        $first_page = 1;                 
                                ?>
                                        <a href="?action=adminac&page=<?= $first_page ?>"><span><strong>First</strong></span></a>
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
                                                <a href="?action=adminac&page=<?= $num ?>"><span><?= $num ?></span></a>
                                <?php
                                            }  
                                        }
                                        else // Tô màu cho trang đã chọn
                                        {
                                ?>
                                            <a href="?action=adminac&page=<?= $num ?>"><span class="select"><?= $num ?></span></a>
                                <?php
                                        } 
                                    }
                                ?>

                                <?php
                                    if($current_page < $total_page - 5)
                                    {
                                        $end_page = $total_page;
                                ?>
                                        <a href="?action=adminac&page=<?= $end_page ?>"><span><strong>Last</strong></span></a>
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
                $("#form-account").submit(function(event) 
                {
                    event.preventDefault();
                    $.ajax
                    ({
                        url: "Account_Process.php?account=admin&action=addac", // gửi ajax đến file
                        type: "post", // chọn phương thức gửi là get
                        dateType: "text", // dữ liệu trả về dạng text
                        data: 
                        { 
                            New_account: $(this).serializeArray(),
                        },
                        success: function (result)
                        {          
                            if(result == 'New account created successfully!')    
                            {
                                alert(result);
                                $("#loadaccount").load("Admin_Page.php?action=adminac #loadaccount"); 
                            }
                            else
                            {
                                alert(result);
                            }                                                                                
                        }
                    });
                });

                $("#search-ac").keyup(function()
                {
                    var keyword = $("#search-ac").val();
                    $.ajax
                    ({
                        url: "Account_Process.php?account=admin&action=search", // gửi ajax đến file
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
                                $("#loadaccount").load("Admin_Page.php?action=adminac #loadaccount"); 
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
                    url: "Account_Process.php?account=admin&action=deleteac", // gửi ajax đến file
                    type: "post", // chọn phương thức gửi là get
                    dateType: "text", // dữ liệu trả về dạng text
                    data: 
                    { 
                        Acc_ID: id,
                    },
                    success: function (result)
                    {              
                        alert(result);      
                        $("#loadaccount").load("Admin_Page.php?action=adminac #loadaccount");             
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
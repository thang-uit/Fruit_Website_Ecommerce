<?php
    if(isset($_SESSION['loginadmin']))
    {
        include 'Functions.php';

        $item_per_page = 10; // Số sản phẩm trên một trang
        $current_page = !empty($_GET['page']) ? $_GET['page'] : 1; // Trang hiện tại
        $offset = ($current_page - 1) * $item_per_page; // Công thức chia sản phẩm đều ra các trang

        $SQLProduct = "SELECT * FROM `products` LIMIT " . $item_per_page . " OFFSET " . $offset;
        $Product = $con->query($SQLProduct);
        
        $total_records = mysqli_query($con, "SELECT * FROM `products`");
        $totals = mysqli_num_rows($total_records); // Tổng số sản phẩm
        // var_dump($totals); exit;
        $total_page = ceil($totals / $item_per_page); // Tổng số sản phẩm / Số sản phẩm trên một trang = Tổng số trang (Nếu ra số lẻ sẽ làm tròn)
?>
        <h1><i class="fa fa-eercast"></i> Product</h1>

        <div class="product">
            <?php
                if(isset($_POST['addpd']) && $_POST['addpd'] == 'Add New Product')
                {
                    $error = array();
                    $target_dir = '../../CLIENT/Image/Uploads/';
                    $target_file = $target_dir.basename($_FILES['Pro_Img']['name']);
                    

                    if($_FILES['Pro_Img']['size'] > 5242880)
                    {
                        $error['Pro_Img'] = "<h1>Vui lòng Upload file dưới 5MB!</h1>";
                    }


                    $type_file = pathinfo($_FILES['Pro_Img']['name'], PATHINFO_EXTENSION);
                    $type_fileAllow = array('png', 'jpg', 'jpeg', 'gif');

                    if(!in_array(strtolower($type_file), $type_fileAllow)) 
                    {
                        $error['Pro_Img'] = "<h1>File bạn vừa chọn hệ thống không hỗ trợ, bạn vui lòng chọn hình ảnh!</h1>";
                    }
                    if(file_exists($target_file))
                    {
                        $error['Pro_Img'] = "<h1>File bạn chọn đã tồn tại trên hệ thống!</h1>";
                    }
                    if(empty($error)) 
                    {
                        if (move_uploaded_file($_FILES['Pro_Img']['tmp_name'], $target_file)) 
                        {
                            echo "<h1>Bạn đã upload file thành công!</h1><br>";
                            $target_file;
                            $Pro_Type = $_POST['Pro_Type'];
                            $Pro_Name = $_POST['Pro_Name'];
                            $Pro_Nation = $_POST['Pro_Nation'];
                            $Pro_Price = $_POST['Pro_Price'];
                            $Pro_Rate = $_POST['Pro_Rate'];
                            $Pro_Info = $_POST['Pro_Info'];

                            $SQLADD = "INSERT INTO `products`(`Pro_ID`, `Pro_Img`, `Pro_Type`, `Pro_Name`, `Pro_Nation`, `Pro_Price`, `Pro_Rate`, `Pro_Info`, `Pro_View`) VALUES (NULL, '$target_file', '$Pro_Type', '$Pro_Name', '$Pro_Nation', '$Pro_Price', '$Pro_Rate', '$Pro_Info', '0')";
                            $Add = $con->query($SQLADD);

                            if($Add)
                            {
                                echo "Add success!";
                            }
                            else
                            {
                                echo "Add Fail!";
                            }
                            $flag = true;
                        } 
                        else 
                        {
                            echo "<h1>File bạn vừa upload gặp sự cố!</h1>";
                        }
                    }
                    else
                    {
                        echo $error['Pro_Img'];
                    }

                
                }
            ?>

            <div class="add-product">
                <form class="form-product" id="form-product" method="POST" autocomplete="off" accept="image/*" enctype="multipart/form-data">

                    <span class="input-title"><i class="fa fa-archive"></i> &nbsp;<strong>Product Type</strong><br></span>
                    <select class="input-login" name="Pro_Type" id="Pro_Type">
                        <option value="Trái cây nội" selected>Trái cây nội</option>
                        <option value="Trái cây ngoại">Trái cây ngoại</option>
                        <option value="Khác">Khác</option>
                    </select>
                    <br><br>

                    <span class="input-title"><i class="fa fa-eercast"></i> &nbsp;<strong>Name</strong><br></span>
                    <input type="text" class="input-login" id="Pro_Name" name="Pro_Name" placeholder="Name" maxlength="1000" required>
                    <br><br>

                    <span class="input-title"><i class="fa fa-globe"></i> &nbsp;<strong>Nation</strong><br></span>
                    <input type="text" class="input-login" id="Pro_Nation" name="Pro_Nation" placeholder="Viet Nam" maxlength="50" required>
                    <br><br>

                    <span class="input-title"><i class="fa fa-money"></i> &nbsp;<strong>Price</strong><br></span>
                    <input type="text" class="input-login" id="Pro_Price" name="Pro_Price" placeholder="Price" maxlength="100" required>
                    <br><br>

                    <span class="input-title"><i class="fa fa-star"></i> &nbsp;<strong>Rating</strong><br></span>
                    <select class="input-login" name="Pro_Rate" id="Pro_Rate">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5" selected>5</option>
                    </select>
                    <br><br>

                    <span class="input-title"><i class="fa fa-indent"></i> &nbsp;<strong>Product Information</strong><br></span>
                    <textarea class="input-login proinfo" id="Pro_Info" name="Pro_Info" placeholder="Information" maxlength="2000"></textarea>              
                    <br><br>

                    <span class="input-title"><i class="fa fa-file-image"></i> &nbsp;<strong>Photo Display</strong><br></span>
                    <input type="file" class="input-login" id="Pro_Img" name="Pro_Img" required onchange="Display_IMG()">
                    <br><br>
                    <div id="displayimg"></div>

                    <span class="input-title"><i class="fa fa-picture-o"></i> &nbsp;<strong>Photo Library</strong><br></span>
                    <input type="file" class="input-login" id="Lis_Path" name="Lis_Path[]" multiple required>
                    <br><br>

                    <input type="submit" name="addpd" id="addpd" value="Add New Product">
                </form>

            </div>

            <br>

            <div class="info-product">
                <br>
                <input type="text" class="search-pd" name="search" id="search-pd" placeholder="Product name">
                <br>
                <br>
                <table border="1" cellspacing="0" align="center" id="loadproduct">
                    <tr class="table-title">
                        <th>ID</th>
                        <th>Image Display</th>
                        <th>Product Type</th>
                        <th>Name</th>
                        <th>Nation</th>
                        <th>Price</th>
                        <th>Rating</th>
                        <th>Information</th>
                        <th>Viewer</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    <tbody id="datasearch">
                        <?php
                            while($row = $Product->fetch_array())
                            {
                        ?>
                                <tr>
                                    <td><?= $row['Pro_ID'] ?></td>
                                    <td><img src="<?= $row['Pro_Img'] ?>" style="width: 80%;"></td>
                                    <td><?= $row['Pro_Type'] ?> </td>
                                    <td><?= $row['Pro_Name'] ?></td>
                                    <td><?= $row['Pro_Nation'] ?></td>
                                    <td><?= number_format($row['Pro_Price'], 0, ",", "."); ?> VND</td> 
                                    <td><?= $row['Pro_Rate'] ?></td>
                                    <td><?= $row['Pro_Info'] ?></td>
                                    <td><?= $row['Pro_View'] ?></td>
                                    <td><a class="edit-pd" onclick="Edit(<?= $row['Pro_ID'] ?>)"><i class="fa fa-pencil-square-o"></i></a></td>
                                    <td><a class="delete-pd" onclick="Delete(<?= $row['Pro_ID'] ?>)"><i class="fa fa-trash"></i></a></td>
                                </tr>
                        <?php
                            }
                        ?>

                        <tr>
                            <td colspan="11">
                                <div class="page-btn">
                                <?php
                                    if($current_page > 5)
                                    {
                                        $first_page = 1;                 
                                ?>
                                        <a href="?action=product&page=<?= $first_page ?>"><span><strong>First</strong></span></a>
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
                                                <a href="?action=product&page=<?= $num ?>"><span><?= $num ?></span></a>
                                <?php
                                            }  
                                        }
                                        else // Tô màu cho trang đã chọn
                                        {
                                ?>
                                            <a href="?action=product&page=<?= $num ?>"><span class="select"><?= $num ?></span></a>
                                <?php
                                        } 
                                    }
                                ?>

                                <?php
                                    if($current_page < $total_page - 5)
                                    {
                                        $end_page = $total_page;
                                ?>
                                        <a href="?action=product&page=<?= $end_page ?>"><span><strong>Last</strong></span></a>
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
                // $("#form-product").submit(function(event) 
                // {
                //     event.preventDefault();
                //     $.ajax
                //     ({
                //         url: "Product_Process.php?action=add", // gửi ajax đến file
                //         type: "post", // chọn phương thức gửi là post
                //         dateType: "text", // dữ liệu trả về dạng text
                //         data: 
                //         { 
                //             New_product: $(this).serializeArray(),
                //             // Pro_Img: $("#Pro_Img").val(),
                //             // Lis_Path: $("#Lis_Path").val(),
                //         },
                //         success: function (result)
                //         {          
                //             alert(result);
                //             // if(result == 'New account created successfully!')    
                //             // {
                //             //     alert(result);
                //             //     $("#loadproduct").load("Admin_Page.php?action=customer #loadproduct"); 
                //             // }
                //             // else
                //             // {
                //             //     alert(result);
                //             // }                                                                                
                //         }
                //     });
                // });

                $("#search-pd").keyup(function()
                {
                    var keyword = $("#search-pd").val();
                    $.ajax
                    ({
                        url: "Product_Process.php?action=search", // gửi ajax đến file
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
                                $("#loadproduct").load("Admin_Page.php?action=product #loadproduct"); 
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
                    url: "Product_Process.php?action=delete", // gửi ajax đến file
                    type: "post", // chọn phương thức gửi là get
                    dateType: "text", // dữ liệu trả về dạng text
                    data: 
                    { 
                        Pro_ID: id,
                    },
                    success: function (result)
                    {              
                        alert(result);     
                        $("#loadproduct").load("Admin_Page.php?action=product #loadproduct");             
                    }
                });
            };


            function Display_IMG()
            {
                var fileSelected = document.getElementById("Pro_Img").files;
                if(fileSelected.length > 0)
                {
                    var fileToLoad = fileSelected[0];
                    var fileReader = new FileReader();
                    fileReader.onload = function(fileLoaderEvent)
                    {
                        var srcData = fileLoaderEvent.target.result;
                        var newImage = document.createElement('img');
                        newImage.style.width = '20%';
                        newImage.src = srcData;
                        document.getElementById("displayimg").innerHTML = newImage.outerHTML;
                    }
                    fileReader.readAsDataURL(fileToLoad);
                }
            }


        </script>
<?php
    }
    else
    {
        header('Location: Login.php');
    }
?>
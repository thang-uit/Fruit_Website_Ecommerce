
<?php
    if(isset($_SESSION['loginadmin']))
    {
        $current_date = date("Y-m-d");
        $SQLOrder = "SELECT * FROM `orders`, `customer` WHERE `orders`.`Cus_ID` = `customer`.`Cus_ID` AND `Ord_Status` = '3'";
        $Order = $con->query($SQLOrder);

        $NumID = 0;
        $Revenue = 0;
?>
    
        <h1><i class="fa fa-line-chart"></i> Revenue</h1>
        <br>
        <button id="exportexl"><i class="fa fa-file-excel-o"></i> &nbsp;Export To Excel</button>
        <div class="revenue">

            <form action="Report.php" class="filter" id="filter" method="GET" target="_blank">
                <h3>From &nbsp;</h3>
                <input type="date" class="input-date" name="date1" id="date1" min="1850-01-01" required>
                
                <h3>&nbsp;&nbsp; &nbsp;To &nbsp;</h3>
                <input type="date" class="input-date" name="date2" id="date2" min="1850-01-01" required>
                &nbsp;&nbsp;&nbsp;

                <a class="btn-filter" id="filtering"><i class="fa fa-filter"></i> Filter</a>&nbsp;&nbsp;&nbsp;
                <input type="submit" name="viewrp" id="exportpdf" value="View Report">&nbsp;&nbsp;&nbsp;
            </form> 
            <br>

            <div id="new-revenue">
                <table border="1" cellspacing="0" align="center" id="loadorder">
                    <tr class="table-title">
                        <th>Time</th>
                        <th>Order ID</th>
                        <th>Order Information</th>
                        <th>Total Money</th>
                        <th>Customer ID</th>
                        <th>Customer Name</th>
                    </tr>

                    <?php
                        while($row = $Order->fetch_array())
                        {
                            $NumID++;
                    ?>
                            <tr>
                                <td><?= $row['Ord_Date_Done'] ?></td> 
                                <td><?= $row['Ord_ID'] ?></td>                       
                                <td><a href="Order_Detail.php?ODID=<?= $row['Ord_ID'] ?>&CUSID=<?= $row['Cus_ID'] ?>" target="_blank" onclick="window.open(this.href, 'order', 'left=500, top=50, width=700, height=600, toolbar=1, resizable=0'); return false;" style="color: #06ba2a;">View Details</a></td>
                                <td>
                                    <?php
                                        $Price = $row['Ord_Total'];
                                        $Revenue += $Price;
                                    ?>
                                    <?= number_format($Price, 0, ",", ".") ?> 
                                    <br><strong>VND</strong>
                                </td>
                                <td><?= $row['Cus_ID'] ?></td>
                                <td><?= $row['Cus_Name'] ?></td>                   
                            </tr>
                    <?php
                        }
                    ?>
                            <tr class="table-title" style="background-color: #0dff4d; font-size: 20px;">
                                <th>Revenue</th>
                                <th><?= $NumID ?></th>
                                <th><?= $NumID ?></th>
                                <th><?= number_format($Revenue, 0, ",", ".") ?> <strong>VND</strong></th>
                                <th></th>
                                <th></th>
                            </tr>
                </table>
                <br>
                <h1>Total Invoice: &nbsp;<?= $NumID ?></h1>
                <h1>Revenue: &nbsp;<?= number_format($Revenue, 0, ",", ".") ?> <strong>VND</strong></h1>
            </div>
        </div>

        <script src="../JAVASCRIPT/table2excel.js"></script>
        <script type="text/javascript">
            document.getElementById("exportexl").addEventListener('click', function()
            {
                var table2excel = new Table2Excel();
                table2excel.export(document.querySelectorAll("#loadorder"), "Revenue");
            });


            $(function()
            {
                $("#filtering").click(function()
                {
                    $.ajax
                    ({
                        url: "Revenue_Process.php?action=revenue", // gửi ajax đến file
                        type: "post", // chọn phương thức gửi là get
                        dateType: "text", // dữ liệu trả về dạng text
                        data: 
                        { 
                            date1: $("#date1").val(),
                            date2: $("#date2").val(),
                        },
                        success: function (result)
                        {           
                            if(result == 'Please enter Date 1 and Date 2!')   
                            {
                                alert(result);
                            }    
                            else if(result == 'Date 2 must be greater than Date 1!')     
                            {
                                alert(result);
                            }
                            else if(result == 'Same day, please enter again!')
                            {
                                alert(result);
                            }
                            else
                            {
                                $("#new-revenue").html(result);
                            }                       
                        }
                    });
                });                
            });
        </script>
<?php
    }
?>
<?php
    require_once('./TCPDF/tcpdf.php');
    include './DBConnect/DBConnect.php';

    if(isset($_GET['viewrp']) && $_GET['viewrp'] == 'View Report' && isset($_GET['date1']) && isset($_GET['date2']))
    {
        $date1 = $_GET['date1'];
        $date2 = $_GET['date2'];
        
        $NumID = 1;
        $AmountIV = 0;
        $Revenue = 0;
        
        $SQLRevenue = "SELECT * FROM `orders`, `customer` WHERE `orders`.`Cus_ID` = `customer`.`Cus_ID` AND `Ord_Status` = '3' AND `Ord_Date_Done` BETWEEN DATE('$date1') AND DATE_ADD('$date2', INTERVAL 1 DAY)";
        $Result = $con->query($SQLRevenue);
  
        class PDF extends TCPDF
        {
            public function Header()
            {
                $image = K_PATH_IMAGES.'TNT_4.png';
                $this->Image($image, 20, 10, 35, '', 'PNG', '', 'T', 'false', 300, '', false, false, 0, false, false, false);
                $this->Ln(5);
                $this->SetFont('helvetica', 'B', 14);
                $this->Cell(189, 5, 'Trai Cay Sach - TNT FRUIT', 0, 1, 'R');

                $this->SetFont('helvetica', '', 12);
                $this->Cell(189, 3, 'Thanh pho Ho Chi Minh', 0, 1, 'R');
                $this->Cell(189, 3, 'Fanpage: Trai Cay Sach - TNT FRUIT', 0, 1, 'R');
                $this->Cell(189, 3, 'Email: traicaysachtnt@gmail.com', 0, 1, 'R');
                $this->Cell(189, 3, 'Phone: 84+ 961600587', 0, 1, 'R');
                $this->SetFont('helvetica', 'B', 25);
                $this->Ln(15);
                $this->Cell(189, 3, 'REVENUE REPORT', 0, 1, 'C');           
            }

            public function Footer()
            {
                $this->SetY(-120);
                $this->Ln(5);
                $this->SetFont('times', 'B', 12);
                $this->MultiCell(189, 15, 'Trai Cay Sach - TNT FRUIT', 0, 'C', 0, 1, '', '', true);
                $this->Ln(2);
                $this->Cell(20, 1, '___________________', 0, 0);
                $this->Cell(118, 1, '', 0, 0);
                $this->Cell(51, 1, '_____________________', 0, 1);
                $this->Cell(20, 5, 'President Signature', 0, 0);
                $this->Cell(118, 5, '', 0, 0);
                $this->Cell(51, 5, 'Manager Signature/PM', 0, 1);

                $this->Cell(8, 1, '', 0, 0);
                $this->SetFont('helvetica', 'I', 8);
                $this->Ln(30);
                
                //Page number
                date_default_timezone_set('Asia/Ho_Chi_Minh');
                $Today = date("d-m-Y H:i:s", time());
                $this->Cell(25, 5, 'Generation Date/Time: ' . $Today, 0, 0, 'L');
                $this->Cell(164, 5, 'Page ' . $this->getAliasNumPage() . ' of ' . $this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');              
            }
        }

        // create new PDF document
        $pdf = new PDF('p', 'mm', 'A4', true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Chu Nam Thang');
        $pdf->SetTitle('Revenue Report');
        $pdf->SetSubject('');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
        $pdf->setFooterData(array(0,64,0), array(0,64,128));

        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once(dirname(__FILE__).'/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        // ---------------------------------------------------------

        // set default font subsetting mode
        $pdf->setFontSubsetting(true);

        // Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // helvetica or times to reduce file size.
        $pdf->SetFont('dejavusans', '', 14, '', true);

        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();







        // Form Date to Date
        $pdf->Ln(50);
        $pdf->SetFont('times', 'B', 14);
        $pdf->Cell(189, 3, "From: $date1", 0, 1, 'L');
        $pdf->Cell(189, 3, "To: $date2", 0, 1, 'L');
        $pdf->Ln(5); 


        // Table Title
        $pdf->Ln(3);
        $pdf->SetFont('times', 'B', 12);
        $pdf->SetFillColor(130, 212, 30);
        $pdf->Cell(18, 5, 'Number', 1, 0, 'C', 1);
        $pdf->Cell(35, 5, 'Time', 1, 0, 'C', 1);
        $pdf->Cell(20, 5, 'Order ID', 1, 0, 'C', 1);
        $pdf->Cell(32, 5, 'Total Money', 1, 0, 'C', 1);
        $pdf->Cell(27, 5, 'Customer ID', 1, 0, 'C', 1);
        $pdf->Cell(48, 5, 'Customer Name', 1, 0, 'C', 1);


        // Table Content
        $pdf->SetFont('times', 'C', 10);
        $pdf->Ln(10);

        $i = 1; // no of page start
        $max = 10; // when sl no == 10 go to next page
        while($row = $Result->fetch_array())
        {
            $AmountIV++;
            $Price = $row['Ord_Total'];
            $Revenue += $Price;
            if(($i % $max) == 0)
            {
                // Add a page
                // This method has several options, check the source code documentation for more information.
                $pdf->AddPage();

                // Form Date to Date
                $pdf->Ln(50);
                $pdf->SetFont('times', 'B', 14);
                $pdf->Cell(189, 3, "From: $date1", 0, 1, 'L');
                $pdf->Cell(189, 3, "To: $date2", 0, 1, 'L');
                $pdf->Ln(5); 

                // Table Title
                $pdf->Ln(3);
                $pdf->SetFont('times', 'B', 12);
                $pdf->SetFillColor(130, 212, 30);
                $pdf->Cell(18, 5, 'Number', 1, 0, 'C', 1);
                $pdf->Cell(35, 5, 'Time', 1, 0, 'C', 1);
                $pdf->Cell(20, 5, 'Order ID', 1, 0, 'C', 1);
                $pdf->Cell(32, 5, 'Total Money', 1, 0, 'C', 1);
                $pdf->Cell(27, 5, 'Customer ID', 1, 0, 'C', 1);
                $pdf->Cell(48, 5, 'Customer Name', 1, 0, 'C', 1);

                // Table Content
                $pdf->SetFont('times', 'C', 10);
                $pdf->Ln(10);
            }
            $pdf->Cell(18, 5, $NumID++, 1, 0, 'C', 0);
            $pdf->Cell(35, 5, $row['Ord_Date_Done'], 1, 0, 'C', 0);
            $pdf->Cell(20, 5, $row['Ord_ID'], 1, 0, 'C', 0);
            $pdf->Cell(32, 5, number_format($Price, 0, ",", ".") . " VND", 1, 0, 'C', 0);
            $pdf->Cell(27, 5, $row['Cus_ID'], 1, 0, 'C', 0);
            $pdf->Cell(48, 5, $row['Cus_Name'], 1, 0, 'C', 0);
            $pdf->Ln(5);
            $i++;
        }       
        $pdf->SetFont('times', 'L', 16);
        $pdf->Ln(10);
        $pdf->Cell(189, 3, "Total Invoice: $AmountIV", 0, 1, 'L');
        $pdf->Cell(189, 3, "Revenue: " . number_format($Revenue, 0, ",", ".") . " VND", 0, 1, 'L');


        // set text shadow effect
        $pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

        // Set some content to print
        $html = "";

        // Print text using writeHTMLCell()
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

        // ---------------------------------------------------------

        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output("Report__$date1" . _ ."$date2.pdf", 'I');

        //============================================================+
        // END OF FILE
        //============================================================+
    }
    else
    {
        header('Location: 404.php');
    }
?>
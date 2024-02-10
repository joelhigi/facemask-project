<?php
    require('fpdf/fpdf.php');
    require('headerFooter_1.php');

    //creating fpdf object to access fpdf classes
    $pdf = new FPDF('L','mm','A4');
    $pdf = new PDF('L','mm','A4');
    $con = mysqli_connect("localhost","root","","facedetectorlog") or die("Connection was not established");
    // // $con = mysqli_connect("localhost","root","","depression") or die("Connection was not established");
    // if(isset($_POST['report'])){
    //     $select = $_POST['choice1'];
    //     if($select == 'abaturage'){
            // require('headerFooter_1.php');
    //     }else{
    //         require('headerFooter_2.php');
    //     }
    // }
    /*creating a page where to insert data
    ***AddPage([string orientation [, mixed size [, int rotation]]])
    */
    $pdf->AliasNbPages();
    $pdf->AddPage('L', 'A4');

    /*setting format of the data on the page
    ***##SYNTAX###
    *$app->SetFont()
    *** font-family : Arial
    *** font-weight : Bold(B is used)
    *** font-size   : 16
    */
    $pdf->SetFont('Arial','B',10);
    // $pdf->SetFont();
    /*adding a cell
    ***
    ***
    ***
    ***
    */
    // Cell(width[int], height[int], text[stiring], border[int], newLine[int], alignment[char], fill,[bool] link)
    // $pdf->Cell(70,10,'',0);
    // $pdf->Cell(50,10,'');
    $pdf->Cell(70,10,'' ,0,1);
    // $pdf->Cell(0,10,'', 0, 1);
    // $pdf->Cell(0,10,'', 0, 1);

    if(isset($_POST['report'])){
      if($_POST['choice1']=='HITAMO RAPORO...'){
        echo '
        <script type="text/javascript">
        alert("Nta raporo mwahisemo.");
        window.location="report.php";

        </script>';
      }

        $select1 = $_POST['choice1'];
        switch ($select1) {
            case 'todaycases':
                $select2 = $_POST['choice2'];
                $sqltoday = date('Y-m-d');
                $formattoday = date('d-m-Y');
                switch($select2){
                    case 'today':
                        $pdf->SetFont('Arial','BU',12);
                        $pdf->Cell(0,10,"ALL CASES THAT HAVE OCCURED TODAY ($formattoday)", 0, 1, 'C');
                        $pdf->Cell(0,10,'', 0, 1);
                        //build a query to bring every record under that email
                        $query = "SELECT framelog_unmasked_count, framelog_masked_count, framelog_time FROM framelog WHERE framelog_date = '$sqltoday' ORDER BY framelog_time ASC";
                        $pdf->SetFont('Arial','B',8);
                        //execute the query and keep the result in result variable
                        $res = mysqli_query($con,$query);
                        $count =1;
                        $pdf->SetLeftMargin(62);
                        $pdf->Cell(20,8,'CASE No', 1, 0, 'C');
                        $pdf->Cell(65,8,"NUMBER OF UNMASKED FACES DETECTED", 1, 0, 'C');
                        $pdf->Cell(65,8,'NUMBER OF MASKED FACES DETECTED', 1, 0, 'C');
                        $pdf->Cell(30,8,'TIME', 1, 1, 'C');
                        $pdf->SetFont('Arial','', 8);
                        $rows = mysqli_num_rows($res);
                        if($rows!=0){
                            while($framelog = mysqli_fetch_assoc($res)){

                                $unmasked = $framelog['framelog_unmasked_count'];
                                $masked = $framelog['framelog_masked_count'];
                                $time = $framelog['framelog_time'];
                                
                                $pdf->Cell(20,8,$count++, 1, 0, 'C');
                                $pdf->Cell(65,8,$unmasked, 1, 0, 'C');
                                $pdf->Cell(65,8,$masked, 1, 0, 'C');
                                $pdf->Cell(30,8,$time, 1, 1, 'C');
    
                            }
                        }
                        else{
                            $pdf->Cell(180,8,'No cases have been recorded yet',1,1);
                        }
                        
                        break;

                        
                }
            break;

            case 'unmaskedtodaycases':
                $select2 = $_POST['choice2'];
                $sqltoday = date('Y-m-d');
                $formattoday = date('d-m-Y');
                switch($select2){
                    case 'today':
                        $pdf->SetFont('Arial','BU',12);
                        $pdf->Cell(0,10,"ALL UNMASKED CASES THAT HAVE OCCURED TODAY ($formattoday)", 0, 1, 'C');
                        $pdf->Cell(0,10,'', 0, 1);
                        //build a query to bring every record under that email
                        $query = "SELECT framelog_unmasked_count, framelog_masked_count, framelog_time FROM framelog WHERE framelog_date = '$sqltoday' AND framelog_unmasked_count > 0 ORDER BY framelog_time ASC";
                        $pdf->SetFont('Arial','B',8);
                        //execute the query and keep the result in result variable
                        $res = mysqli_query($con,$query);
                        $count =1;
                        $pdf->SetLeftMargin(95);
                        $pdf->Cell(20,8,'CASE No', 1, 0);
                        $pdf->Cell(65,8,"NUMBER OF UNMASKED FACES DETECTED", 1, 0, 'C');
                        $pdf->Cell(30,8,'TIME', 1, 1, 'C');
                        $pdf->SetFont('Arial','', 8);
                        $rows = mysqli_num_rows($res);
                        if($rows!=0){
                            while($framelog = mysqli_fetch_assoc($res)){

                                $unmasked = $framelog['framelog_unmasked_count'];
                                $time = $framelog['framelog_time'];
                                
                                $pdf->Cell(20,8,$count++, 1, 0, 'C');
                                $pdf->Cell(65,8,$unmasked, 1, 0, 'C');
                                $pdf->Cell(30,8,$time, 1, 1, 'C');
    
                            }
                        }
                        else{
                            $pdf->Cell(115,8,'No cases have been recorded yet',1,1,'C');
                        }
                        break; 
                }
            break;
            
            case 'maskedtodaycases':
                $select2 = $_POST['choice2'];
                $sqltoday = date('Y-m-d');
                $formattoday = date('d-m-Y');
                switch($select2){
                    case 'today':
                        $pdf->SetFont('Arial','BU',12);
                        $pdf->Cell(0,10,"ALL MASKED CASES THAT HAVE OCCURED TODAY ($formattoday)", 0, 1, 'C');
                        $pdf->Cell(0,10,'', 0, 1);
                        //build a query to bring every record under that email
                        $query = "SELECT framelog_unmasked_count, framelog_masked_count, framelog_time FROM framelog WHERE framelog_date = '$sqltoday' AND framelog_masked_count > 0 ORDER BY framelog_time ASC";
                        $pdf->SetFont('Arial','B',8);
                        //execute the query and keep the result in result variable
                        $res = mysqli_query($con,$query);
                        $count =1;
                        $pdf->SetLeftMargin(95);
                        $pdf->Cell(20,8,'CASE No', 1, 0);
                        $pdf->Cell(65,8,'NUMBER OF MASKED FACES DETECTED', 1, 0, 'C');
                        $pdf->Cell(30,8,'TIME', 1, 1, 'C');
                        $pdf->SetFont('Arial','', 8);
                        $rows = mysqli_num_rows($res);
                        if($rows!=0){
                            while($framelog = mysqli_fetch_assoc($res)){

                                $masked = $framelog['framelog_masked_count'];
                                $time = $framelog['framelog_time'];
                                
                                $pdf->Cell(20,8,$count++, 1, 0, 'C');
                                $pdf->Cell(65,8,$masked, 1, 0, 'C');
                                $pdf->Cell(30,8,$time, 1, 1, 'C');
    
                            }
                        }
                        else{
                            $pdf->Cell(115,8,'No cases have been recorded yet',1,1,'C');
                        }
                        break; 
                }
            break;

            case 'previous':
                $select2 = $_POST['choice2'];
                switch($select2){
                    case 'yesterday':
                        $sqlyesterday = date('Y-m-d',strtotime("-1 days"));
                        $formatyesterday = date('d-m-Y');
                        $pdf->SetFont('Arial','BU',12);
                        $pdf->Cell(0,10,"ALL CASES THAT OCCURED ON '$formatyesterday'", 0, 1, 'C');
                        $pdf->Cell(0,10,'', 0, 1);
                        //build a query to bring every record under that email
                        $query = "SELECT framelog_unmasked_count, framelog_masked_count, framelog_date, framelog_time FROM framelog WHERE framelog_date = '$sqlyesterday' ORDER BY framelog_time ASC";
                        $pdf->SetFont('Arial','B',8);
                        //execute the query and keep the result in result variable
                        $res = mysqli_query($con,$query);
                        $count =1;
                        $pdf->SetLeftMargin(62);
                        $pdf->Cell(20,8,'CASE No', 1, 0);
                        $pdf->Cell(65,8,"NUMBER OF UNMASKED FACES DETECTED", 1, 0, 'C');
                        $pdf->Cell(65,8,'NUMBER OF MASKED FACES DETECTED', 1, 0, 'C');
                        $pdf->Cell(30,8,'TIME', 1, 1, 'C');
                        $pdf->SetFont('Arial','', 8);
                        $rows = mysqli_num_rows($res);
                        if($rows!=0){
                            while($framelog = mysqli_fetch_assoc($res)){

                                $unmasked = $framelog['framelog_unmasked_count'];
                                $masked = $framelog['framelog_masked_count'];
                                $time = $framelog['framelog_time'];
                                
                                $pdf->Cell(20,8,$count++, 1, 0, 'C');
                                $pdf->Cell(65,8,$unmasked, 1, 0, 'C');
                                $pdf->Cell(65,8,$masked, 1, 0, 'C');
                                $pdf->Cell(30,8,$time, 1, 1, 'C');
    
                            }
                        }
                        else{
                            $pdf->Cell(180,8,'No cases have been recorded yet',1,1,'C');
                        }
                    break;

                    case 'currentweek':
                        $sqlmonday = date('Y-m-d',strtotime('last monday'));
                        $sqltoday = date('Y-m-d');
                        $formatmonday = date('d-m-Y',strtotime('last monday'));
                        $formattoday = date('d-m-Y');
                        $pdf->SetFont('Arial','BU',12);
                        $pdf->Cell(0,10,"ALL CASES THAT OCCURED FROM $formatmonday TO $formattoday", 0, 1, 'C');
                        $pdf->Cell(0,10,'', 0, 1);
                        //build a query to bring every record under that email
                        $query = "SELECT framelog_unmasked_count, framelog_masked_count, framelog_date, framelog_time FROM framelog WHERE framelog_date >= '$sqlmonday' AND framelog_date <= '$sqltoday' ORDER BY framelog_time ASC";
                        $pdf->SetFont('Arial','B',8);
                        //execute the query and keep the result in result variable
                        $res = mysqli_query($con,$query);
                        $count =1;
                        $pdf->SetLeftMargin(50);
                        $pdf->Cell(20,8,'CASE No', 1, 0);
                        $pdf->Cell(65,8,"NUMBER OF UNMASKED FACES DETECTED", 1, 0, 'C');
                        $pdf->Cell(65,8,'NUMBER OF MASKED FACES DETECTED', 1, 0, 'C');
                        $pdf->Cell(30,8,'DATE', 1, 0, 'C');
                        $pdf->Cell(30,8,'TIME', 1, 1, 'C');
                        $pdf->SetFont('Arial','', 8);
                        $rows = mysqli_num_rows($res);
                        if($rows!=0){
                            while($framelog = mysqli_fetch_assoc($res)){

                                $unmasked = $framelog['framelog_unmasked_count'];
                                $masked = $framelog['framelog_masked_count'];
                                $date = $framelog['framelog_date'];
                                $time = $framelog['framelog_time'];
                                
                                $pdf->Cell(20,8,$count++, 1, 0, 'C');
                                $pdf->Cell(65,8,$unmasked, 1, 0, 'C');
                                $pdf->Cell(65,8,$masked, 1, 0, 'C');
                                $pdf->Cell(30,8,$date, 1, 0, 'C');
                                $pdf->Cell(30,8,$time, 1, 1, 'C');
    
                            }
                        }
                        else{
                            $pdf->Cell(210,8,'No cases have been recorded yet',1,1,'C');
                        }
                    break;

                    case 'lastsevendays':
                        $sqlfirst = date('Y-m-d',strtotime('-7 days'));
                        $sqltoday = date('Y-m-d');
                        $formatfirst = date('d-m-Y',strtotime('-7 days'));
                        $formattoday = date('d-m-Y');
                        $pdf->SetFont('Arial','BU',12);
                        $pdf->Cell(0,10,"ALL CASES THAT OCCURED FROM $formatfirst TO $formattoday", 0, 1, 'C');
                        $pdf->Cell(0,10,'', 0, 1);
                        //build a query to bring every record under that email
                        $query = "SELECT framelog_unmasked_count, framelog_masked_count, framelog_date, framelog_time FROM framelog WHERE framelog_date >= '$sqlfirst' AND framelog_date <= '$sqltoday' ORDER BY framelog_time ASC";
                        $pdf->SetFont('Arial','B',8);
                        //execute the query and keep the result in result variable
                        $res = mysqli_query($con,$query);
                        $count =1;
                        $pdf->SetLeftMargin(50);
                        $pdf->Cell(20,8,'CASE No', 1, 0);
                        $pdf->Cell(65,8,"NUMBER OF UNMASKED FACES DETECTED", 1, 0, 'C');
                        $pdf->Cell(65,8,'NUMBER OF MASKED FACES DETECTED', 1, 0, 'C');
                        $pdf->Cell(30,8,'DATE', 1, 0, 'C');
                        $pdf->Cell(30,8,'TIME', 1, 1, 'C');
                        $pdf->SetFont('Arial','', 8);
                        $rows = mysqli_num_rows($res);
                        if($rows!=0){
                            while($framelog = mysqli_fetch_assoc($res)){

                                $unmasked = $framelog['framelog_unmasked_count'];
                                $masked = $framelog['framelog_masked_count'];
                                $date = $framelog['framelog_date'];
                                $time = $framelog['framelog_time'];
                                
                                $pdf->Cell(20,8,$count++, 1, 0, 'C');
                                $pdf->Cell(65,8,$unmasked, 1, 0, 'C');
                                $pdf->Cell(65,8,$masked, 1, 0, 'C');
                                $pdf->Cell(30,8,$date, 1, 0, 'C');
                                $pdf->Cell(30,8,$time, 1, 1, 'C');
    
                            }
                        }
                        else{
                            $pdf->Cell(210,8,'No cases have been recorded yet',1,1,'C');
                        }
                    break;

                    case 'previousweek':
                        $start = date('Y-m-d',strtotime('last monday -7 days'));
                        $end = date('Y-m-d',strtotime('last monday -1 days'));
                        $formatstart = date('Y-m-d',strtotime('last monday -7 days'));
                        $formatend = date('Y-m-d',strtotime('last monday -1 days'));
                        $pdf->SetFont('Arial','BU',12);
                        $pdf->Cell(0,10,"ALL CASES THAT OCCURED FROM $formatstart TO $formatend", 0, 1, 'C');
                        $pdf->Cell(0,10,'', 0, 1);
                        //build a query to bring every record under that email
                        $query = "SELECT framelog_unmasked_count, framelog_masked_count, framelog_date, framelog_time FROM framelog WHERE framelog_date >= '$formatstart' AND framelog_date <= '$formatend' ORDER BY framelog_time ASC";
                        $pdf->SetFont('Arial','B',8);
                        //execute the query and keep the result in result variable
                        $res = mysqli_query($con,$query);
                        $count =1;
                        $pdf->SetLeftMargin(50);
                        $pdf->Cell(20,8,'CASE No', 1, 0);
                        $pdf->Cell(65,8,"NUMBER OF UNMASKED FACES DETECTED", 1, 0, 'C');
                        $pdf->Cell(65,8,'NUMBER OF MASKED FACES DETECTED', 1, 0, 'C');
                        $pdf->Cell(30,8,'DATE', 1, 0, 'C');
                        $pdf->Cell(30,8,'TIME', 1, 1, 'C');
                        $pdf->SetFont('Arial','', 8);
                        $rows = mysqli_num_rows($res);
                        if($rows!=0){
                            while($framelog = mysqli_fetch_assoc($res)){

                                $unmasked = $framelog['framelog_unmasked_count'];
                                $masked = $framelog['framelog_masked_count'];
                                $date = $framelog['framelog_date'];
                                $time = $framelog['framelog_time'];
                                
                                $pdf->Cell(20,8,$count++, 1, 0, 'C');
                                $pdf->Cell(65,8,$unmasked, 1, 0, 'C');
                                $pdf->Cell(65,8,$masked, 1, 0, 'C');
                                $pdf->Cell(30,8,$date, 1, 0, 'C');
                                $pdf->Cell(30,8,$time, 1, 1, 'C');
    
                            }
                        }
                        else{
                            $pdf->Cell(210,8,'No cases have been recorded yet',1,1,'C');
                        }
                    break;

                    case 'currentmonth':
                        $sqlstart = date('Y-m-01');
                        $sqlend = date('Y-m-d');
                        $formatstart = date('01-m-Y');
                        $formatend = date('d-m-Y');
                        $pdf->SetFont('Arial','BU',12);
                        $pdf->Cell(0,10,"ALL CASES THAT OCCURED FROM $formatstart TO $formatend", 0, 1, 'C');
                        $pdf->Cell(0,10,'', 0, 1);
                        //build a query to bring every record under that email
                        $query = "SELECT framelog_unmasked_count, framelog_masked_count, framelog_date, framelog_time FROM framelog WHERE framelog_date >= '$sqlstart' AND framelog_date <= '$sqlend' ORDER BY framelog_time ASC";
                        $pdf->SetFont('Arial','B',8);
                        //execute the query and keep the result in result variable
                        $res = mysqli_query($con,$query);
                        $count =1;
                        $pdf->SetLeftMargin(50);
                        $pdf->Cell(20,8,'CASE No', 1, 0);
                        $pdf->Cell(65,8,"NUMBER OF UNMASKED FACES DETECTED", 1, 0, 'C');
                        $pdf->Cell(65,8,'NUMBER OF MASKED FACES DETECTED', 1, 0, 'C');
                        $pdf->Cell(30,8,'DATE', 1, 0, 'C');
                        $pdf->Cell(30,8,'TIME', 1, 1, 'C');
                        $pdf->SetFont('Arial','', 8);
                        $rows = mysqli_num_rows($res);
                        if($rows!=0){
                            while($framelog = mysqli_fetch_assoc($res)){

                                $unmasked = $framelog['framelog_unmasked_count'];
                                $masked = $framelog['framelog_masked_count'];
                                $date = $framelog['framelog_date'];
                                $time = $framelog['framelog_time'];
                                
                                $pdf->Cell(20,8,$count++, 1, 0, 'C');
                                $pdf->Cell(65,8,$unmasked, 1, 0, 'C');
                                $pdf->Cell(65,8,$masked, 1, 0, 'C');
                                $pdf->Cell(30,8,$date, 1, 0, 'C');
                                $pdf->Cell(30,8,$time, 1, 1, 'C');
    
                            }
                        }
                        else{
                            $pdf->Cell(210,8,'No cases have been recorded yet',1,1,'C');
                        }
                    break;

                    case 'previousmonth':
                        $month = date('m');
                        $intmonth = (int)$month;
                        $last = $intmonth-1;
                        if($last==0){$last=12;}
                        $sqlfirst = date('Y-'.$last.'-01');
                        $sqllast = date('Y-'.$last.'-t');
                        $formatfirst = date('01-'.$last.'-Y');
                        $formatlast = date('t-'.$last.'-Y');
                        $pdf->SetFont('Arial','BU',12);
                        $pdf->Cell(0,10,"ALL CASES THAT OCCURED FROM $formatfirst TO $formatlast", 0, 1, 'C');
                        $pdf->Cell(0,10,'', 0, 1);
                        //build a query to bring every record under that email
                        $query = "SELECT framelog_unmasked_count, framelog_masked_count, framelog_date, framelog_time FROM framelog WHERE framelog_date >= '$sqlfirst' AND framelog_date <= '$sqllast' ORDER BY framelog_time ASC";
                        $pdf->SetFont('Arial','B',8);
                        //execute the query and keep the result in result variable
                        $res = mysqli_query($con,$query);
                        $count =1;
                        $pdf->SetLeftMargin(50);
                        $pdf->Cell(20,8,'CASE No', 1, 0);
                        $pdf->Cell(65,8,"NUMBER OF UNMASKED FACES DETECTED", 1, 0, 'C');
                        $pdf->Cell(65,8,'NUMBER OF MASKED FACES DETECTED', 1, 0, 'C');
                        $pdf->Cell(30,8,'DATE', 1, 0, 'C');
                        $pdf->Cell(30,8,'TIME', 1, 1, 'C');
                        $pdf->SetFont('Arial','', 8);
                        $rows = mysqli_num_rows($res);
                        if($rows!=0){
                            while($framelog = mysqli_fetch_assoc($res)){

                                $unmasked = $framelog['framelog_unmasked_count'];
                                $masked = $framelog['framelog_masked_count'];
                                $date = $framelog['framelog_date'];
                                $time = $framelog['framelog_time'];
                                
                                $pdf->Cell(20,8,$count++, 1, 0, 'C');
                                $pdf->Cell(65,8,$unmasked, 1, 0, 'C');
                                $pdf->Cell(65,8,$masked, 1, 0, 'C');
                                $pdf->Cell(30,8,$date, 1, 0, 'C');
                                $pdf->Cell(30,8,$time, 1, 1, 'C');
    
                            }
                        }
                        else{
                            $pdf->Cell(210,8,'No cases have been recorded yet',1,1,'C');
                        }
                    break;

                    case 'lastthirtydays':
                        $sqlstart = date('Y-m-d',strtotime('-30 days'));
                        $sqlend = date('Y-m-d');
                        $formatstart = date('d-m-Y',strtotime('-30 days'));
                        $formatend = date('d-m-Y');
                        $pdf->SetFont('Arial','BU',12);
                        $pdf->Cell(0,10,"ALL CASES THAT OCCURED FROM $formatstart TO $formatend", 0, 1, 'C');
                        $pdf->Cell(0,10,'', 0, 1);
                        //build a query to bring every record under that email
                        $query = "SELECT framelog_unmasked_count, framelog_masked_count, framelog_date, framelog_time FROM framelog WHERE framelog_date >= '$sqlstart' AND framelog_date <= '$sqlend' ORDER BY framelog_time ASC";
                        $pdf->SetFont('Arial','B',8);
                        //execute the query and keep the result in result variable
                        $res = mysqli_query($con,$query);
                        $count =1;
                        $pdf->SetLeftMargin(50);
                        $pdf->Cell(20,8,'CASE No', 1, 0);
                        $pdf->Cell(65,8,"NUMBER OF UNMASKED FACES DETECTED", 1, 0, 'C');
                        $pdf->Cell(65,8,'NUMBER OF MASKED FACES DETECTED', 1, 0, 'C');
                        $pdf->Cell(30,8,'DATE', 1, 0, 'C');
                        $pdf->Cell(30,8,'TIME', 1, 1, 'C');
                        $pdf->SetFont('Arial','', 8);
                        $rows = mysqli_num_rows($res);
                        if($rows!=0){
                            while($framelog = mysqli_fetch_assoc($res)){

                                $unmasked = $framelog['framelog_unmasked_count'];
                                $masked = $framelog['framelog_masked_count'];
                                $date = $framelog['framelog_date'];
                                $time = $framelog['framelog_time'];
                                
                                $pdf->Cell(20,8,$count++, 1, 0, 'C');
                                $pdf->Cell(65,8,$unmasked, 1, 0, 'C');
                                $pdf->Cell(65,8,$masked, 1, 0, 'C');
                                $pdf->Cell(30,8,$date, 1, 0, 'C');
                                $pdf->Cell(30,8,$time, 1, 1, 'C');
    
                            }
                        }
                        else{
                            $pdf->Cell(210,8,'No cases have been recorded yet',1,1,'C');
                        }
                    break;

                }
            break;

            case 'all':
                $select2 = $_POST['choice2'];
                switch($select2){
                    case 'alltime':
                        $pdf->SetFont('Arial','BU',12);
                        $pdf->Cell(0,10,"ALL MASKED CASES THAT HAVE OCCURED", 0, 1, 'C');
                        $pdf->Cell(0,10,'', 0, 1);
                        //build a query to bring every record under that email
                        $query = "SELECT framelog_unmasked_count, framelog_masked_count, framelog_date, framelog_time FROM framelog ORDER BY framelog_date DESC, framelog_time ASC";
                        $pdf->SetFont('Arial','B',8);
                        //execute the query and keep the result in result variable
                        $res = mysqli_query($con,$query);
                        $count =1;
                        $pdf->SetLeftMargin(50);
                        $pdf->Cell(20,8,'CASE No', 1, 0);
                        $pdf->Cell(65,8,"NUMBER OF UNMASKED FACES DETECTED", 1, 0, 'C');
                        $pdf->Cell(65,8,'NUMBER OF MASKED FACES DETECTED', 1, 0, 'C');
                        $pdf->Cell(30,8,'DATE', 1, 0, 'C');
                        $pdf->Cell(30,8,'TIME', 1, 1, 'C');
                        $pdf->SetFont('Arial','', 8);
                        $rows = mysqli_num_rows($res);
                        if($rows!=0){
                            while($framelog = mysqli_fetch_assoc($res)){

                                $unmasked = $framelog['framelog_unmasked_count'];
                                $masked = $framelog['framelog_masked_count'];
                                $date = $framelog['framelog_date'];
                                $time = $framelog['framelog_time'];
                                
                                $pdf->Cell(20,8,$count++, 1, 0, 'C');
                                $pdf->Cell(65,8,$unmasked, 1, 0, 'C');
                                $pdf->Cell(65,8,$masked, 1, 0, 'C');
                                $pdf->Cell(30,8,$date, 1, 0, 'C');
                                $pdf->Cell(30,8,$time, 1, 1, 'C');

                            }
                        }
                        else{
                            $pdf->Cell(210,8,'No cases have been recorded yet',1,1,'C');
                        }
                    break;
                }
            break;


        }

    }

    // Cell(width[int], height[int], text[stiring], border[int], newLine[int], alignment[char], fill,[bool] link)
    // $pdf->setY();
    $pdf->Ln(20);
    $pdf->Cell(70,10,'Done on '.date('d/m/y'),0, 2, 'L');
    $pdf->Cell(70,10,"Signature",0,0,'L');
    $pdf->Cell(50,10,'');
	$pdf->AliasNbPages();
    $pdf->Output();
?>

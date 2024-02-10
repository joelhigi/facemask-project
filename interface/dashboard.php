<!DOCTYPE html>

<html lang="en">
<?php
    session_start();
    require 'connection/connection.php';
    // if(!isset($_SESSION['admin'])){
    //     header('Location:index.php');
    // }
    $today = date("Y-m-d");
    $queryCasesToday = "SELECT * FROM framelog WHERE framelog_date = '$today'";
    $queryUnmaskedToday = "SELECT SUM(framelog_unmasked_count) AS totalUnmasked FROM framelog WHERE framelog_date = '$today' AND framelog_unmasked_count != 0";
    $queryMaskedToday = "SELECT SUM(framelog_masked_count) AS totalMasked FROM framelog WHERE framelog_date = '$today' AND framelog_masked_count != 0";
    $queryUnmaskedNotToday = "SELECT SUM(framelog_unmasked_count) AS totalUnmaskedPrev FROM framelog WHERE framelog_date != '$today' AND framelog_unmasked_count != 0";
    $queryMaskedNotToday = "SELECT SUM(framelog_masked_count) AS totalMaskedPrev FROM framelog WHERE framelog_date != '$today' AND framelog_masked_count != 0";
    $queryNotToday = "SELECT * FROM framelog WHERE framelog_date != '$today' AND framelog_masked_count != 0";
    $queryMaskedAll = "SELECT SUM(framelog_masked_count) AS totalMasked FROM framelog";
    $queryNotMaskedAll = "SELECT SUM(framelog_unmasked_count) AS totalUnmasked FROM framelog";
    $queryAll = "SELECT * FROM framelog";
    $runCasesToday = mysqli_query($conn,$queryCasesToday);
    $runUnmaskedToday = mysqli_query($conn,$queryUnmaskedToday);
    $runMaskedToday = mysqli_query($conn,$queryMaskedToday);
    $runUnmaskedNotToday = mysqli_query($conn,$queryUnmaskedNotToday);
    $runMaskedNotToday = mysqli_query($conn,$queryMaskedNotToday);
    $runNotToday = mysqli_query($conn,$queryNotToday);
    $runMaskedAll = mysqli_query($conn,$queryMaskedAll);
    $runNotMaskedAll = mysqli_query($conn,$queryNotMaskedAll);
    $runAll = mysqli_query($conn,$queryAll);
    $numNotToday = mysqli_num_rows($runNotToday);
    $numAll = mysqli_num_rows($runAll);
    $rowMasked = mysqli_fetch_array($runMaskedToday);
    $rowUnmaskedAll = mysqli_fetch_array($runNotMaskedAll);
    $rowMaskedAll = mysqli_fetch_array($runMaskedAll);
    $rowUnmasked = mysqli_fetch_array($runUnmaskedToday);
    $rowMaskedPrevious = mysqli_fetch_array($runMaskedNotToday);
    $rowUnmaskedPrevious = mysqli_fetch_array($runUnmaskedNotToday);
    $unmaskSum = $rowUnmasked['totalUnmasked'];
    $maskSum = $rowMasked['totalMasked'];
    $unmaskedPreviousSum = $rowUnmaskedPrevious['totalUnmaskedPrev'];
    $maskedPreviousSum = $rowMaskedPrevious['totalMaskedPrev'];

    $numNotMaskedAll = $rowUnmaskedAll['totalUnmasked'];
    $numMaskedAll = $rowMaskedAll['totalMasked'];

    $numToday = $maskSum + $unmaskSum;
    $numPrev = $unmaskedPreviousSum + $maskedPreviousSum;
    $numTotal = $numToday + $numPrev;
    
?>
<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
     <title>Face Mask Detection</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">
    <!-- Added by me -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index.html">
                            <img src="images/icon/logo1.jpg" alt="CoolAdmin" />
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                            
                        </li>
                       
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-copy"></i>Pages</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="login.html">Login</a>
                                </li>
                                <li>
                                    <a href="register.html">Register</a>
                                </li>
                                
                            </ul>
                        </li>
                       
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <img src="images/icon/logo1.jpg" alt="Cool Admin" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li class="active has-sub">
                            <a class="js-arrow" href="dashboard.php">
                                <i class="fas fa-tachometer-alt"></i>Dashboard <?php echo $today;?></a>
                           
                        <!-- <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-user"></i>Users</a>
                           
                        </li>
                        -->
                        <li class="has-sub">
                           
                            <a href="https://www.worldometers.info/coronavirus/?utm_campaign=homeAdvegas1?" target="_blank" rel="noopener noreferrer">   
                            <i class="fas fa-desktop"></i>COVID LIVE Update</a>
                           
                        </li> 
                        <li class="has-sub">
                            <a class="js-arrow" href="report.php">
                                <i class="fas fa-table"></i>Reports</a>
                           
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form class="form-header" action="" method="POST">
                                <!-- <input class="au-input au-input--xl" type="text" name="search" placeholder="Search for datas &amp; reports..." />
                                <button class="au-btn--submit" type="submit">
                                    <i class="zmdi zmdi-search"></i>
                                </button> -->
                            </form>
                            <div class="header-button">
                                
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            <img src="images/icon/ava.jpg " height="600px" width="600px" alt="Ntambara Vincent" />
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="#"><?php echo $_SESSION['username']; ?></a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        <img src="images/icon/ava.jpg " height="600px" width="600px" alt="Ntambara Vincent" />
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#"><?php echo $_SESSION['username']; ?></a>
                                                    </h5>
                                                    <span class="email"><?php echo $_SESSION['admin']; ?></span>
                                                </div>
                                            </div>
                                            <!--  -->
                                            <div class="account-dropdown__footer">
                                                <a href="logout.php">
                                                    <i class="zmdi zmdi-power"></i>Logout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1">overview</h2>
                                  
                                    <a href="report.php">
                                    <button class="au-btn au-btn-icon au-btn--blue">
                                        <i class="zmdi zmdi-plus" ></i>Generate Report</button></a>
                                </div>
                            </div>
                        </div>
                        <div class="row m-t-25">
                            <div class="col-sm-3 col-lg-2">
                                <div class="overview-item overview-item--c1">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-account-o"></i>
                                            </div>
                                            <div class="text">
                                                <h2><?php echo $numToday;?></h2>
                                                <span>Frames Taken Today</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            <!-- <canvas id="widgetChart1"></canvas> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 col-lg-2">
                                <div class="overview-item overview-item--c3">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-mood-bad"></i>
                                            </div>
                                            <div class="text">
                                                <h2>
                                                    <?php
                                                        if($unmaskSum != "")
                                                            {
                                                                echo $unmaskSum;
                                                            }
                                                        else{
                                                            echo 0;
                                                        }
                                                    ?></h2>
                                                <span>Unmasked Cases Today</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            <!-- <canvas id="widgetChart2"></canvas> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 col-lg-2">
                                <div class="overview-item overview-item--c4">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-mood"></i>
                                            </div>
                                            <div class="text">
                                                <h2><?php
                                                        if($maskSum != "")
                                                            {
                                                                echo $maskSum;
                                                            }
                                                        else{
                                                            echo 0;
                                                        }
                                                    ?></h2>
                                                <span>Masked Cases Today</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            <!-- <canvas id="widgetChart2"></canvas> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-sm-6 col-lg-2">
                                <div class="overview-item overview-item--c5">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                            <i class="fas fa-meh"></i>
                                            </div>
                                            <div class="text">
                                                <h2><?php echo $numPrev;?></h2>
                                                <span>Frames Taken Previously </span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            <!-- <canvas id="widgetChart3"></canvas> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-2">
                                <div class="overview-item overview-item--c3">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                          
                                            <i class="zmdi zmdi-mood-bad"></i>
                                            </div>
                                            <div class="text">
                                                <h2><?php echo $numNotMaskedAll;?></h2>
                                                <span>Total Unmasked Cases</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            <!-- <canvas id="widgetChart3"></canvas> -->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-lg-2">
                                    <div class="overview-item overview-item--c4">
                                        <div class="overview__inner">
                                            <div class="overview-box clearfix">
                                                <div class="icon">
                                            
                                                <i class="zmdi zmdi-mood"></i>
                                                </div>
                                                <div class="text">
                                                    <h2><?php echo $numMaskedAll;?></h2>
                                                    <span>Total Masked Cases</span>
                                                </div>
                                            </div>
                                            <div class="overview-chart">
                                                <!-- <canvas id="widgetChart3"></canvas> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                        </div>
                        <div class="m-t-25">
                            <div class="col-sm-6 col-lg-2">
                                    <div class="overview-item overview-item--c2">
                                        <div class="overview__inner">
                                            <div class="overview-box clearfix">
                                                <div class="icon">
                                            
                                                <i class="fas fa-meh"></i>
                                                </div>
                                                <div class="text">
                                                    <h2><?php echo $numTotal;?></h2>
                                                    <span>Total Cases</span>
                                                </div>
                                            </div>
                                            <div class="overview-chart">
                                                <!-- <canvas id="widgetChart3"></canvas> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        
                        <!-- <div class="row"> -->
                        <div class="card">
                        <?php
                            $sql="SELECT framelog_id, framelog_image, framelog_unmasked_count, framelog_masked_count, framelog_date, framelog_time FROM framelog  WHERE framelog_image!='None'";
                            $result=mysqli_query($conn,$sql);
                            $checkresult=mysqli_num_rows($result);
                        ?>
              <div class="card-header">
                <h3 class="card-title">All Frames containing Unmasked Subjects (<?php echo $checkresult;?> frames)</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Unmasked Detections</th>
                    <th>Masked Detections</th>
                    <th>Date Taken</th>
                    <th>Time</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                        
                    if ($checkresult > 0) {
                    while ($row=mysqli_fetch_array($result)) {
                        $umuturage = $row['framelog_id'];
                        echo "<tr>";
                        echo "<td>".$row['framelog_id']."</td>";
                            if($row['framelog_image']=='none'){
                                echo "<td>None</td>";
                            }
                            else{
                                echo "<td><a href=frame_view.php?frame=".$row['framelog_image']." class='btn btn-info'>View Frame</a></td>";
                            }
                            echo "<td>".$row['framelog_unmasked_count']."</td>
                            <td>".$row['framelog_masked_count']."</td>
                            <td>".$row['framelog_date']."</td>
                            <td>".$row['framelog_time']."</td>
                            </tr>";


                    }


                    }
                            ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Unmasked Detections</th>
                    <th>Masked Detections</th>
                    <th>Date Taken</th>
                    <th>Time</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
        
                            
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="copyright">
                                    <p>Copyright © 2021 I&J. All rights reserved <a> Ntambara Vincent </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>
<!-- Added by me -->
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>

</html>


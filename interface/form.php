<html>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="style/main.css">
        <title>Report | e-Mudugudu</title>
        <script type="text/javascript">
        </script>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="container-fluid">
                    <!-- Form starts here -->
                    <div class="page-header">
                    <h1>Facemask Detection Report Generator</h1>
                    </div>
                  <br/><br/>
                    <form action="makepdf.php" method="post" target="_blank">
                        <div class="form-row align-items-center">
                            <div class="col-auto my-1">
                                <label class="mr-sm-4" for="slct1" >Choose the Report Type: </label>
                                <select class="custom-select mr-sm-2" id="slct1" name="choice1" onchange="populate()">
                                    <option selected>Choose the Report...</option>
                                    <option value="todaycases">Cases Today</option>
                                    <option value="unmaskedtodaycases">Unmasked Cases Today</option>
                                    <option value="maskedtodaycases">Masked Cases Today</option>
                                    <option value="previous">Previous Cases</option>
                                    <option value="all">All Cases</option>
                                    <!-- <option value="imirimaYIgikoni">Raporo y’ingo zifite umurima w’igikoni</option> -->
                                </select>
                            </div>
                            <div class="main col-auto my-1 hide">
                                <label class="mr-sm-2" for="slct2">Period: </label>
                                <select class="custom-select mr-sm-2" id="slct2" name="choice2">
                                    <!-- <option value="imirimaYIgikoni">Raporo y’ingo zifite umurima w’igikoni</option> -->
                                </select>
                            </div>
                            <!-- isibo div -->
                            

                            <div class="col-auto my-1">
                                <br>
                                <button type="submit" class="btn btn-primary" name="report">Generate Report</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="script/main.js"></script>
    </body>
</html>

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
                    <h1 class="h3 mb-2 text-gray-800">Kwandika ubwishyu bwa Mituweli muri sisiteme</h1>
                    <form action="makepdf.php" method="post" >
                        <div class="form-row align-items-center">
                            <div class="col-auto my-1">

                                <label class="mr-sm-2" for="slct1" >Report0000: </label>
                                <select class="custom-select mr-sm-2" id="slct1" name="choice1" onchange="populate()">
                                    <option selected>Hitamo raporo...</option>
                                    <option value="abaturage">Raporo ku baturage</option>
                                    <option value="abayobozi">Raporo k'ubuyobozi</option>
                                    <option value="abana">Raporo y’abana</option>
                                    <option value="abagore">Raporo y’abagore</option>
                                    <option value="urubyiruko">Raporo y’urubyiruko</option>
                                    <option value="imiryango">Raporo y’imiryango</option>
                                    <option value="ingo">Raporo y’ingo</option>
                                    <!-- <option value="imirimaYIgikoni">Raporo y’ingo zifite umurima w’igikoni</option> -->
                                </select>
                            </div>
                            <div class="main col-auto my-1 hide">
                                <label class="mr-sm-2" for="slct2">type: </label>
                                <select class="custom-select mr-sm-2" id="slct2" name="choice2" onchange="isiboBox()">
                                    <!-- <option value="imirimaYIgikoni">Raporo y’ingo zifite umurima w’igikoni</option> -->
                                </select>
                            </div>
                            <!-- isibo div -->
                            <div class="main col-auto my-1 hideIsibo isibo">
                                <label class="mr-sm-2" for="isibo">isibo: </label>
                                <select class="custom-select mr-sm-2" id="isibo" name="choice3" >
                                   <?php
                                        echo "<option value='' disabled selected>Hitamo isibo...</option>";
                                        $connect = new mysqli("localhost","root","","umudugudu",3306);
                                        $queryIsiboId = $connect -> query("SELECT `isibo_id` FROM `isibo` ORDER BY `isibo_id` ASC");
                                        $queryIsiboName = $connect -> query("SELECT `isibo_name` FROM `isibo` ORDER BY `isibo_id` ASC");
                                        $arrayIsiboId = Array();
                                        $arrayIsiboName = Array();
                                        while($result = $queryIsiboId -> fetch_assoc()){
                                            $arrayIsiboId[] = $result['isibo_id'];
                                        }
                                        while($result = $queryIsiboName -> fetch_assoc()){
                                            $arrayIsiboName[] = $result['isibo_name'];
                                        }
                                        $size = sizeof($arrayIsiboId);
                                        $sizeTemp = $size - 1;
                                        for ($sizeTemp; $sizeTemp >=0; $sizeTemp--){
                                            echo "<option value='$arrayIsiboId[$sizeTemp]'>$arrayIsiboName[$sizeTemp]</option>";
                                        }
                                   ?>
                                </select>
                            </div>
                            <!-- ubwisungane div -->
                            <div class="main col-auto my-1 hideIsibo ubwisungane">
                                <label class="mr-sm-2" for="ubwisungane">Ubwisungane: </label>
                                <select class="custom-select mr-sm-2" id="ubwisungane" name="choice3" >
                                   <?php
                                        echo "<option value='' disabled selected>Hitamo ubwisungane...</option>";
                                        echo "<option value='0' >BWOSE</option>";
                                        $connect = new mysqli("localhost","root","","umudugudu",3306);
                                        $queryubwisunganeId = $connect -> query("SELECT `ubwisungane_id` FROM `ubwisungane` ORDER BY `ubwisungane_id` ASC");
                                        $queryubwisunganeName = $connect -> query("SELECT `ubwisungane_name` FROM `ubwisungane` ORDER BY `ubwisungane_id` ASC");
                                        $arrayubwisunganeId = Array();
                                        $arrayubwisunganeName = Array();
                                        while($result = $queryubwisunganeId -> fetch_assoc()){
                                            $arrayubwisunganeId[] = $result['ubwisungane_id'];
                                        }
                                        while($result = $queryubwisunganeName -> fetch_assoc()){
                                            $arrayubwisunganeName[] = $result['ubwisungane_name'];
                                        }
                                        $size = sizeof($arrayubwisunganeId);
                                        $sizeTemp = $size - 1;
                                        for ($sizeTemp; $sizeTemp >=0; $sizeTemp--){
                                            echo "<option value='$arrayubwisunganeId[$sizeTemp]'>$arrayubwisunganeName[$sizeTemp]</option>";
                                        }
                                   ?>
                                </select>
                            </div>
                            <!-- abashatse div -->
                            <div class="main col-auto my-1 hideIsibo abashatse">
                                <label class="mr-sm-2" for="abashatse">Abashatse: </label>
                                <select class="custom-select mr-sm-2" id="abashatse" name="choice3" >
                                   <?php
                                        echo "<option value='' disabled selected>Hitamo abashatse...</option>";
                                        echo "<option value='0' >BOSE</option>";
                                   ?>
                                   <option value="1">BYEMEWE</option>
                                   <option value="2">BITEMEWE</option>
                                </select>
                            </div>

                            <div class="col-auto my-1">
                                <br>
                                <button type="submit" class="btn btn-primary" name="report">get  report</button>
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

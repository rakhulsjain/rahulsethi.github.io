<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>

    <title>Cowin APP Data</title>
</head>
<body>
    <div class="container">
        <div class="row text-center" >
            <a href="/">
                <img src="img/logo.png">
            </a>
        </div>
        1. <a href="index.php">Search By Pincode</a> <br>
        2. <a href="district.php">Search By District Id</a>
    </div>

    <div class="container">
        <div class="">
            <form action="" method="post" style="margin-top:4.5%">
                <div class="row">
                    <div class="col-md-6">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="Date">Booking Date</label>
                                <input type="text" class="form-control" id="date" name="date" placeholder="Select dd-mm-yyyy">
                            </div>
                            <!-- <div class="input-group date" data-provide="datepicker">
                                <input type="text" class="form-control datepicker" name="date">
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                </div>
                            </div> -->
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="state">State</label>
                                <select  class="form-control state" id="state" name="state">
                                <option value="">Select State</option>   
                                <?php
                                    $url="https://cdn-api.co-vin.in/api/v2/admin/location/states";
                                    $handle = curl_init($url);
                                    curl_setopt($handle, CURLOPT_GET);
                                    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);

                                    $response_user = curl_exec($handle);

                                    curl_close($handle);
                                    $user_result = json_decode($response_user);
                                    foreach ($user_result as $s) {
                                        foreach ($s as $s1) {
                                            echo '<option value="'.$s1->state_id.'">'.$s1->state_name.'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group" id="data" >
                                <label for="city">City</label>
                                <select class="form-control city" id="city" name="city">
                                    <option value="">Select District</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- <div class="col-md-6">
                            <div class="form-group">
                                <label for="Vaccine">Vaccine</label>
                                <select  class="form-control vaccine" id="vaccine" name="vaccine">
                                    <option value="all">Any</option>
                                    <option value="covaxin">Covaxin</option>
                                    <option value="covishield">Covishield</option>
                                </select>
                            </div>
                        </div> -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Age">Age</label>
                                <select  class="form-control age" id="age" name="age">
                                    <option value="all">All</option>
                                    <option value="18+">18 to 44</option>
                                    <option value="45+">45+</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 mt-2" style="margin-top:4.5%">
                            <input type="button" class="btn btn-primary fetch" id="abc" name="submit" value="Search">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>  
    <div class="container">
        <div class="row">
            <div class="append" id="append">
            </div>
        </div>
    </div>
    
    <script type="text/javascript">
    $(document).ready(function () {
        $('#date').datepicker({
            format: "dd-mm-yyyy",
            autoclose:true
        });
        

        $('#state').on('change', function() {
            var country_id = $('#state').val();
            
            $.ajax({
                url: "city_ajax.php",
                type: "POST",
                data: {
                country_id: country_id
            },
            cache: false,
            success: function(result){
                $("#city").html(result);
            }
            });
        }); 

        $(document).on( 'click', '.fetch', function () {
            var date=$("#date").val();
            var age=$("#age").val();
            var city=$("#city").val();
            var cit ='cit';

            $.ajax({
                url: "ajax.php",
                type:"POST",
                data:{date:date, age:age, city:city, cit:cit},
                success: function  (data) {
                     $("#append").html(data);
                },
                error: function (jqXhr, textStatus, errorMessage) {
                    console.log(errorMessage);
                }
            });
        });
        $(document).on( 'change', '.age', function () {
            var date=$("#date").val();
            var age=$("#age").val();
            var city=$("#city").val();
            var cit ='cit';

            $.ajax({
                url: "ajax.php",
                type:"POST",
                data:{date:date, city:city, age:age, cit:cit},
                success: function  (data) {
                     $("#append").html(data);
                },
                error: function (jqXhr, textStatus, errorMessage) {
                    console.log(errorMessage);
                }
            });
        });

        $(document).on( 'change', '#city', function () {
            var date=$("#date").val();
            var city=$("#city").val();
            var age=$("#age").val();
            var cit ='cit';

            $.ajax({
                url: "ajax.php",
                type:"POST",
                data:{date:date, city:city, age:age, cit:cit},
                success: function  (data) {
                    console.log(data);
                     $("#append").html(data);
                },
                error: function (jqXhr, textStatus, errorMessage) {
                    console.log(errorMessage);
                }
            });
        });
    });
    function startFunction(){
        var date=$("#date").val();
        var age=$("#age").val();        

        if (date!='' && age!='') {
            $( ".fetch" ).trigger( "click" );
        }
        $('#green td .green_new').each(function() {
            console.log('Yes');
        });
    }
    $(document).ready(function(){
       var myVar = setInterval("startFunction()", 2000);
       
    });
    </script>
<!-- <meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'"> -->
</body>
</html>

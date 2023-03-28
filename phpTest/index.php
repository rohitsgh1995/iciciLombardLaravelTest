<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>ICICI Lombard PHP Test</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>

    <div class="container mt-5">
        <div class="row g-3 mb-5">
            <div class="col-12">
                <h4 class="m-0">Test 1.</h4>
            </div>
            <div class="col-12 col-md-3">
                <div class="form-group">
                    <input type="text" class="form-control w-100 common-selector reg-num" placeholder="Search by Reg Num">
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="input-group">
                    <input type="text" class="form-control common-selector engine-num" placeholder="Search by Engine Num">
                    <input type="text" class="form-control common-selector chassis-num" placeholder="Search by Chassis Num">
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="form-group">
                    <input type="text" class="form-control common-selector vin-num" placeholder="Search by Vin Num">
                </div>
            </div>
            <div class="col-12 filter_data" style="max-height: 35vh; overflow-y: scroll;"></div>
        </div>

        <div class="row g-3">
            <div class="col-12">
                <h4 class="m-0">Test 2.</h4>
                <small>$input_arr = ['apple', 'banana', 'custard', 'denmark', 'banana', 'apple', 'banana', 'denmark', 'apple'];</small>
            </div>
            <div class="container ps-5">                
                <div class="row g-5">
                    <div class="col-12">
                        <h6 class="m-0">a. Find the unique elements in the above array and print it one by one.</h6>
                        <div class="w-100 ps-5 mt-2">
                            <strong>Output :&nbsp;&nbsp;&nbsp;</strong>
                            <?php
                                $input_arr = ['apple', 'banana', 'custard', 'denmark', 'banana', 'apple', 'banana', 'denmark', 'apple'];

                                $unique = [];

                                foreach($input_arr as $val) {
                                    foreach($unique as $uniqueValue) {
                                        if($val == $uniqueValue) {
                                            continue 2;
                                        }
                                    }
                                    $unique[] = $val;
                                }

                                print_r($unique);
                            ?>
                        </div>
                    </div>
                    <div class="col-12">
                        <h6 class="m-0">b. Create an array with the unique elements as key and its corresponding value should be the number of times repeated in the above array.</h6>
                        <div class="w-100 ps-5 mt-2">
                            <strong>Output :&nbsp;&nbsp;&nbsp;</strong>
                            <?php
                                $new_array = [];

                                foreach($unique as $k => $u)
                                {
                                    $count = 1;

                                    foreach($input_arr as $ia)
                                    {
                                        if($u == $ia)
                                        {
                                            $new_array[$u] = $count++;
                                        }
                                    }
                                }

                                print_r($new_array);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function() {

            filter_data();

            function filter_data() {
                var action = 'fetch_data';
                var reg_num = regNum();
                var engine_num = engineNum();
                var chassis_num = chassisNum();
                var vin_num = vinNum();
                
                $.ajax({
                    url: "filter.php",
                    method: "POST",
                    data: {
                        action: action,
                        reg_num: reg_num,
                        engine_num: engine_num,
                        chassis_num: chassis_num,
                        vin_num: vin_num
                    },
                    success: function(data) {
                        $('.filter_data').html(data);
                    }
                });
            }

            function regNum() {
                return $('.reg-num').val();
            }

            function engineNum() {
                return $('.engine-num').val();
            }

            function chassisNum() {
                return $('.chassis-num').val();
            }

            function vinNum() {
                return $('.vin-num').val();
            }

            $('.common-selector').on('keyup change', function() {
                filter_data();
                regNum();
                engineNum();
                chassisNum();
                vinNum();
            });
        });
    </script>

</body>

</html>
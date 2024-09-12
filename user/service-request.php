<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sid'] == 0)) {
    header('location:logout.php');
} else {

    if (isset($_POST['submit'])) {
        $uid = $_SESSION['sid'];
        $category = $_POST['category'];
        $vehname = $_POST['vehiclename'];
        $vehmodel = $_POST['vehilemodel'];
        $vehbrand = $_POST['vehiclebrand'];
        $vehrego = $_POST['vehicleregno'];
        $vehservicedate = $_POST['servicedate'];
        $vehservicetime = $_POST['servicetime'];
        $deltype = $_POST['deltype'];
        $pickupadd = $_POST['pickupadd'];
        $sernumber = mt_rand(100000000, 999999999);
        $otp = mt_rand(1000, 9999);

        $query = mysqli_query($con, "insert into tblservicerequest(UserId,Category,ServiceNumber,VehicleName,VehicleModel,VehicleBrand,VehicleRegno,ServiceDate,ServiceTime,DeliveryType,PickupAddress,otp) value('$uid','$category','$sernumber','$vehname','$vehmodel','$vehbrand','$vehrego','$vehservicedate','$vehservicetime','$deltype','$pickupadd','$otp')");
        if ($query) {
            $msg = "Data has been added successfully.";
        } else {
            $msg = "Something Went Wrong. Please try again";
        }
    }
}




?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Lekma Hospital Surgery Request Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- App css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/metismenu.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="assets/js/modernizr.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#pickupaddress').hide();
            $('#deltype').change(function() {
                var v = $("#deltype").val();


                if (v == 'dropservice') {
                    $('#pickupaddress').hide();
                }

                if (v == 'pickupservice') {
                    $('#pickupaddress').show();
                }
            });
        });
    </script>

</head>


<body>

    <!-- Begin page -->
    <div id="wrapper">

        <?php include_once('includes/sidebar.php'); ?>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->

        <div class="content-page">

            <?php include_once('includes/header.php'); ?>

            <!-- Start Page content -->
            <div class="content">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-12">
                            <div class="card-box">
                                <h4 class="m-t-0 header-title">Appointment Request Form</h4>
                                <p class="text-muted m-b-30 font-14">

                                </p>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="p-20">
                                            <p style="font-size:16px; color:red" align="center"> <?php if ($msg) {
                                                                                                        echo $msg;
                                                                                                    }  ?> </p>
                                            <form class="form-horizontal" role="form" method="post" name="submit">
                                                <div class="form-group row">
                                                    <label class="col-2 col-form-label">Category</label>
                                                    <div class="col-10">
                                                        <select name='category' id="category" class="form-control" required="true">
                                                            <option value="">Appointment Category</option>
                                                            <?php $query = mysqli_query($con, "select * from tblcategory");
                                                            while ($row = mysqli_fetch_array($query)) {
                                                            ?>
                                                                <option value="<?php echo $row['VehicleCat']; ?>"><?php echo $row['VehicleCat']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-2 col-form-label" for="example-email">Appointment</label>
                                                    <div class="col-10">
                                                        <input type="text" id="vehiclename" name="vehiclename" class="form-control" placeholder="Name of Surgery" required="true">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-2 col-form-label">Appointment Type</label>
                                                    <div class="col-10">
                                                        <input type="text" class="form-control" name="vehilemodel" id="vehilemodel" required="true">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-2 col-form-label">Appointment Classifications</label>
                                                    <div class="col-10">
                                                        <input type="text" class="form-control" placeholder="Classification" name="vehiclebrand" id="vehiclebrand" required="true">
                                                    </div>
                                                </div>
                                                <!-- <div class="form-group row">
                                                    <label class="col-2 col-form-label">NIA Card</label>
                                                    <div class="col-10">
                                                        <input type="text" class="form-control" name="vehicleregno" id="vehicleregno" required="true">
                                                    </div>
                                                </div> -->
                                                <div class="form-group row">
                                                    <label class="col-2 col-form-label">Appointment Date</label>
                                                    <div class="col-10">
                                                        <input type="date" min="2021-01-17" class="form-control" name="servicedate" id="servicedate" required="true">
                                                    </div>
                                                </div>



                                                <div class="form-group row">
                                                    <label class="col-2 col-form-label">Service Time(Between 09:00 to 16:00)</label>

                                                    <div class="col-10">
                                                        <input type="time" min="10:00:00" max="16:00:00" class="form-control" name="servicetime" id="servicetime" required="true">

                                                    </div>
                                                </div>


                                                <div class="form-group row">
                                                    <label class="col-2 col-form-label">Arravial Type</label>
                                                    <div class="col-10">
                                                        <select name="deltype" id="deltype" required="true" class="form-control">
                                                            <option value="">Select</option>
                                                            <option value="pickupservice">Ambulance Service</option>
                                                            <option value="dropservice">Self Arrival</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row" id="pickupaddress">
                                                    <label class="col-2 col-form-label">Pickup Address</label>
                                                    <div class="col-10">
                                                        <input type="text" class="form-control" name="pickupadd" id="pickupadd">
                                                    </div>
                                                </div>

                                                <div class="col-12">

                                                    <div class="checkbox checkbox-custom">
                                                        <input id="remember" type="checkbox" checked="true">
                                                        <label for="remember">
                                                            I accept <a href="terms-conditions.php" class="text-custom">Terms and Conditions</a>
                                                        </label>
                                                    </div>

                                                </div>
                                                <div class="form-group row">

                                                    <div class="col-12">
                                                        <p style="text-align: center;"> <button type="submit" name="submit" class="btn btn-info btn-min-width mr-1 mb-1">Submit</button></p>
                                                    </div>
                                                </div>

                                            </form>
                                        </div>
                                    </div>

                                </div>
                                <!-- end row -->

                            </div> <!-- end card-box -->
                        </div><!-- end col -->
                    </div>
                    <!-- end row -->






                    <!-- end row -->





                </div> <!-- container -->

            </div> <!-- content -->

            <?php include_once('includes/footer.php'); ?>
        </div>


        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->


    </div>
    <!-- END wrapper -->



    <!-- jQuery  -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/waves.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>

    <!-- App js -->
    <script src="assets/js/jquery.core.js"></script>
    <script src="assets/js/jquery.app.js"></script>

</body>

</html>
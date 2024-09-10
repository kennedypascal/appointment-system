<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
    if (strlen($_SESSION['eid']==0)) {
  header('location:logout.php');
  } else{

if(isset($_POST['submit']))
  {

    $cid=$_GET['aticid'];
      $admrmk=$_POST['AdminRemark'];
      $picsta=$_POST['status'];
      $sercharge=$_POST['servicecharge'];
 $addcharge=$_POST['addcharge'];
 $partcharge=$_POST['partcharge'];
 $serviceby=$_POST['serper'];
 $pickupby=$_POST['pick'];
 $otp = mt_rand(1000, 9999);


   $query=mysqli_query($con, "update  tblservicerequest set PickupStatus='$picsta', PickupBy='$pickupby', otp='$otp' where ID='$cid'");
    if ($query) {
    $msg="Status has been updated";
  }
  else
    {
      $msg="Something Went Wrong. Please try again";
    }


}


  ?>
<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Lekma Hospital Surgery View Page</title>
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

        <script src="assets/js/modernizr.min.js"></script>

    </head>


    <body>

        <!-- Begin page -->
        <div id="wrapper">

          <?php include_once('includes/sidebar.php');?>

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->

            <div class="content-page">

                 <?php include_once('includes/header.php');?>

                <!-- Start Page content -->
                <div class="content">
                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-12">
                                <div class="card-box">
                                    <h4 class="m-t-0 header-title">View Surgery</h4>
                                    <p class="text-muted m-b-30 font-14">

                                    </p>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="p-20">

 <p style="font-size:16px; color:red" align="center"> <?php if($msg){
    echo $msg;
  }  ?> </p>


<?php
$cid=$_GET['aticid'];
$ret=mysqli_query($con,"select * from tblservicerequest join tbluser on tbluser.ID=tblservicerequest.UserId where tblservicerequest.ID='$cid'");

$cnt=1;

while ($row=mysqli_fetch_array($ret)) {

?>

<table border="1" class="table table-bordered mg-b-0">
<tr>
    <th>Surgery Number</th>
    <td><?php  echo $row['ServiceNumber'];?></td>
  </tr>
  <tr>
<th>Full Name</th>
    <td><?php  echo $row['FullName'];?></td>
  </tr>

<tr>
    <th>Surgery Category</th>
    <td><?php  echo $row['Category'];?></td>
  </tr>
   <tr>
    <th>Surgery Name</th>
    <td><?php  echo $row['VehicleName'];?></td>
  </tr>

<tr>
    <th>Surgery Type</th>
    <td><?php  echo $row['VehicleModel'];?></td>
  </tr>

  <tr>
    <th>Surgery Classification</th>
    <td><?php  echo $row['VehicleBrand'];?></td>
  </tr>
  <tr>
    <th>NIA Card </th>
    <td><?php  echo $row['VehicleRegno'];?></td>
  </tr>
  <tr>
    <th>Surgery Date</th>
    <td><?php  echo $row['ServiceDate'];?></td>
  </tr>
  <tr>
    <th>Surgery Time</th>
    <td><?php  echo $row['ServiceTime'];?></td>
  </tr>


  


  <tr>
    <th>Surgery Request Date</th>
    <td><?php echo $row['PickupAddress'];?></td>
  </tr>


<tr>
  <th>Surgery Request Date</th>
  <td><?php echo $row['ServicerequestDate'];?></td>
</tr>




</table>




<table class="table mb-0">

<?php if($row['AdminStatus']=="1"){ ?>


<form name="submit" method="post" enctype="multipart/form-data">





</form>
  <?php } ?>


</table>

<?php } ?>




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

             <?php include_once('includes/footer.php');?>
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
<?php }  ?>

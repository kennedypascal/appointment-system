<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once "./vendor/autoload.php";

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
 $pickup=$_POST['PickupStatus'];

 $pickupby=$_SESSION['eid'];

if($pickup!="2")
{
 $s = mysqli_query($con,"select * from tblservicerequest where ID='$cid'");
 $service=mysqli_fetch_array($s);
 $user_id = $service['UserId'];
 $otp = $service['otp'];

 $u = mysqli_query($con,"select * from tbluser where ID='$user_id'");
 $userdata=mysqli_fetch_array($u);
 $user_email=$userdata['Email'];
 $user_name = $userdata['FullName'];

 $p = mysqli_query($con,"select * from tblpickup where ID='$pickupby'");
 $pdata=mysqli_fetch_array($p);
 $pickup_name = $pdata['FullName'];


   $query=mysqli_query($con, "update  tblservicerequest set PickupStatus='$picsta', PickupBy='$pickupby' where ID='$cid'");
    if ($query) {

      $mail = new PHPMailer(true);
      $mail->isSMTP();
      $mail->Host = "smtp.zoho.in";
      $mail->SMTPAuth = true;
      $mail->Username = "contact@sainoxtechnologies.com";
      $mail->Password = "sainoxtechnologies2020Aa";
      $mail->SMTPSecure = "tls";
      $mail->Port = 587;
      $mail->From = "contact@sainoxtechnologies.com";
      $mail->FromName = "VSMS";
      $mail->addAddress($user_email);
      $mail->isHTML(true);
      $mail->Subject = "Pickup Details.";
      $mail->Body = "<i>Pickup By: ".$pickup_name."</i><br><i>OTP: ".$otp." </i>";
      $mail->AltBody = "This is the plain text version of the email content";
      try {
          $mail->send();
          echo "Message has been sent successfully";
      } catch (Exception $e) {
          echo "Mailer Error: " . $mail->ErrorInfo;
      }

    $msg="Status has been updated";
  }
  else
    {
      $msg="Something Went Wrong. Please try again";
    }
}

}





  ?>
<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Lekma Hospital Surgery Prep Page</title>
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
                                    <h4 class="m-t-0 header-title">View Surgeries</h4>
                                    <?php echo $_session['Email'];?>
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
    <th> NIA Card</th>
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
    <th>Pickup OTP</th>
    <td><?php echo $row['otp']; ?></td>
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



  <tr>
    <th> Status :</th>
    <td>
   <select name="status" class="form-control wd-450" required="true" >
     <option value="1" selected="true">Accept</option>
     
   </select></td>
  </tr>
    <tr align="center">
    <td colspan="2"><button type="submit" name="submit" class="btn btn-az-primary pd-x-20">Submit</button></td>
  </tr>
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

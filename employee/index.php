<?php
session_start();
error_reporting(E_ALL);
include('includes/dbconnection.php');

if (isset($_POST['login'])) {
    $emailcon = $_POST['emailcont']; // This now matches the form field
    $password = md5($_POST['password']); // Hash the password

    // Use prepared statements to avoid SQL injection
    $stmt = $conn->prepare("SELECT * FROM tblpickup WHERE (email = ? OR MobileNumber = ?) AND password = ?");
    $stmt->bind_param('sss', $emailcon, $emailcon, $password); // Bind the email/contact and hashed password

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['doctor'] = $emailcon; // Use $emailcon as email/contact
        header('Location: /welcome.php');
        exit(); // Make sure to exit after a redirect
    } else {
        $error = "Invalid email/contact number or password.";
    }

    $stmt->close();

     // $query = mysqli_query($con, "select ID from tblpickup where (Email='$Email' || MobileNumber='$MobileNumber') && Password='$Password' ");
    // $ret = mysqli_fetch_array($query);
    // if ($ret > 0) {
    //     $_SESSION['eid'] = $ret['ID'];
    //     $_SESSION['Email'] = $ret['Email'];
    //     header('location:welcome.php');
    // } else {
    //     $msg = "Invalid Details.";
    // }
}
?>

   

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Doctors Login Page</title>
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

    <!-- Custom styles -->
    <style>
        .accountbg {
            background: url('assets/images/doctors_login.png');
            background-size: cover;
            background-position: center;
            filter: brightness(0.85);
        }

        .wrapper-page {
            max-width: 400px;
            margin: auto;
        }

        .account-box {
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .btn-custom {
            background-color: #34495e;
            color: white;
        }

        .btn-custom:hover {
            background-color: #2c3e50;
        }

        .text-muted:hover {
            text-decoration: underline;
        }

        .form-control {
            border-radius: 6px;
            box-shadow: none;
        }

        .account-copyright {
            color: #95a5a6;
        }
    </style>
</head>

<body class="account-pages">

    <!-- Begin page -->
    <div class="accountbg"></div>

    <div class="wrapper-page account-page-full">

        <div class="card">
            <div class="card-block">

                <div class="account-box">

                    <div class="card-box p-5">
                        <h3 class="text-center pb-4">
                            <a href="./index.php" class="text-success">
                                <span>Lekma Hospital | Doctors Login</span>
                            </a>
                        </h3>
                        <p style="font-size:16px; color:red" align="center"> <?php if ($msg) {
                                                                                echo $msg;
                                                                            }  ?> </p>

                        <form class="" action="#" name="login" method="post">

                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="emailaddress">Email or Contact Number</label>
                                    <input class="form-control" type="text" id="emailcont" name="emailcont" required="" placeholder="Enter your email or contact number">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-12">
                                    <a href="forget-password.php" class="text-muted float-right"><small>Forgot your password?</small></a>
                                    <label for="password">Password</label>
                                    <input class="form-control" type="password" required="" id="password" name="password" placeholder="Enter your password">
                                </div>
                            </div>

                            <div class="form-group row text-center mt-4">
                                <div class="col-12">
                                    <button class="btn btn-block btn-custom waves-effect waves-light" type="submit" name="login">Sign In</button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>

        <div class="text-center mt-4">
            <p class="account-copyright">2024 © Lekma Hospital</p>
        </div>

    </div>

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

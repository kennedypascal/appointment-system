<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(isset($_POST['login'])) {
    $adminuser=$_POST['username'];
    $password=md5($_POST['password']);
    $query=mysqli_query($con,"select ID from tbladmin where AdminuserName='$adminuser' && Password='$password'");
    $ret=mysqli_fetch_array($query);
    if($ret > 0){
        $_SESSION['adid']=$ret['ID'];
        header('location:dashboard.php');
    } else {
        $msg="Invalid Details.";
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Administrator Login Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f6f9;
        }
        .accountbg {
            background: url('assets/images/admin_login.jpg') no-repeat center center/cover;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
        }
        .wrapper-page {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .card {
            width: 100%;
            max-width: 400px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 1;
        }
        h3 {
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }
        .btn-custom {
            background-color: #28a745;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn-custom:hover {
            background-color: #218838;
        }
        .text-muted {
            color: #6c757d;
        }
        .text-center {
            text-align: center;
        }
        p {
            font-size: 16px;
            color: red;
            text-align: center;
        }
        .m-t-40 {
            margin-top: 40px;
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="accountbg"></div>

    <div class="wrapper-page account-page-full">

        <div class="card">
            <div class="card-block">

                <div class="account-box">

                    <div class="card-box p-5">
                        <h3 class="text-center pb-4">
                            <a href="../index.php" class="text-success">
                                <span>Lekma Hospital | Admin Login</span>
                            </a>
                        </h3>
                        <p> <?php if($msg){ echo $msg; }  ?> </p>

                        <form action="#" name="login" method="post">

                            <div class="form-group">
                                <label for="emailaddress">User Name</label>
                                <input class="form-control" type="text" id="username" name="username" required="" placeholder="User Name">
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input class="form-control" type="password" required="" id="password" name="password" placeholder="Enter your password">
                                <a href="forget-password.php" class="text-muted float-right"><small>Forgot your password?</small></a>
                            </div> 
                            

                            <div class="form-group text-center">
                                <button class="btn btn-custom btn-block" type="submit" name="login">Sign In</button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>

        <div class="m-t-40">
            <p>2024 © Surgery Appointment System</p>
        </div>

    </div>

</body>
</html>

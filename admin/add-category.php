<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['adid']==0)) {
  header('location:logout.php');
} else {

if(isset($_POST['submit'])) {
    $catname = $_POST['catename'];
    $query = mysqli_query($con, "insert into tblcategory(VehicleCat) value('$catname')");
    if ($query) {
        $msg = "Category has been added.";
    } else {
        $msg = "Something Went Wrong. Please try again";
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Adwoa Boatemaa Memorial Clinic Add Category Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f6f9;
        }
        #wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .content-page {
            flex: 1;
        }
        .card-box {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 20px 0;
        }
        h4 {
            font-size: 20px;
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
        .btn-info {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn-info:hover {
            background-color: #218838;
        }
        .text-muted {
            color: #6c757d;
        }
        p {
            font-size: 16px;
            color: red;
            text-align: center;
        }
        .footer {
            padding: 10px 0;
            text-align: center;
            background-color: #f4f6f9;
        }
    </style>
</head>

<body>

    <div id="wrapper">

        <?php include_once('includes/sidebar.php'); ?>

        <div class="content-page">

            <?php include_once('includes/header.php'); ?>

            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card-box">
                                <h4 class="m-t-0 header-title">Add Surgery Category</h4>

                                <div class="p-20">
                                    <p><?php if($msg){ echo $msg; } ?></p>
                                    <form class="form-horizontal" role="form" method="post" name="submit">

                                        <div class="form-group row">
                                            <label class="col-2 col-form-label" for="catename">Category Name</label>
                                            <div class="col-10">
                                                <input type="text" id="catename" name="catename" class="form-control" placeholder="Surgery Category" required="true">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-12">
                                                <p style="text-align: center;">
                                                    <button type="submit" name="submit" class="btn btn-info btn-min-width">Add</button>
                                                </p>
                                            </div>
                                        </div>

                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php include_once('includes/footer.php'); ?>
        </div>

    </div>

</body>
</html>
<?php } ?>

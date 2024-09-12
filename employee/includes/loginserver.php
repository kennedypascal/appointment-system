<?php
session_start();

// initializing variables
$name = "";
$username = "";
$Email    = "";
$errors = array();
$reg_date = date("Y/m/d");

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'surgerydb');



// LOGIN USER
if (isset($_POST['tblpickup'])) {
  $Email = mysqli_real_escape_string($db, $_POST['Email']);
  $Password = mysqli_real_escape_string($db, $_POST['Password']);

  if (empty($Email)) {
    array_push($errors, "Username is required");
  }
  if (empty($Password)) {
    array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
    $Password = md5($Password);
    $query = "SELECT * FROM tblpickup WHERE Email='$Email' AND password='$Password'";
    $results = mysqli_query($db, $query);
    if (mysqli_num_rows($results) == 1) {
      $_SESSION['username'] = $Email;
      $_SESSION['success'] = "You are now logged in";
      header('location: welcome.php');
    }else {
      array_push($errors, "Wrong username/password combination");
    }
  }
}
?>

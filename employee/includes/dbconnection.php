<?php
// $con=mysqli_connect("localhost", "root", "", "surgerydb");
// if(mysqli_connect_errno()){
// echo "Connection Fail".mysqli_connect_error();
// }
?>


<?php
$host = 'localhost';
$user = 'root';  // Change this if your MySQL username is different
$pass = '';      // Add your MySQL password here
$dbname = 'surgerydb'; // Change this if your database name is different

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>


<?php
$servername = "localhost";
$username = "root";
$password ="";
$dbname = "ElChart";

$conn = new mysqli($servername,$username,$password,$dbname);
if($conn ->connect_error){
    echo "erro in connection";
}
?>
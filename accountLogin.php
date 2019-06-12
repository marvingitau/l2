<?php
// $servername = "localhost";
// $username = "root";
// $password ="";
// $dbname = "ElChart";
// $uname = "marvin1";
require_once "spec.php";
session_start();
$codU = $_POST['pwd'];
$uname = $_POST['usernameLogin'];
$code = "";// password is null
$conn = new mysqli($servername,$username,$password,$dbname);
if($conn ->connect_error){
    echo "erro in connection";
}
$_SESSION["usrname"] = $uname;
$_SESSION["passcode"] = $codU;

if($_SERVER['REQUEST_METHOD']=='POST'){

    $sql = "SELECT passcode FROM ".$uname." ";
    try{

    if(!$result = $conn->query($sql)){
        throw new Exception('no obj');
    }
    if($result->num_rows>0){
        $row=$result->fetch_assoc();
        $code = $row['passcode'];
        if(strcmp($code,$codU) == 0){
            header('Location: homepg1.php');
        }
        }

    
    }catch(Exception $e){
        echo "No given Ac.";
    }

    

}
?>
<?php
     require_once("spec.php");
     session_start();
    //   $servername = "localhost";
    //   $username = "root";
    //   $password ="";
    //   $dbname = "ElChart";

    function verifyEmail ($mail) {
         $email = filter_var($mail,FILTER_SANITIZE_EMAIL);
         if(filter_var($email,FILTER_VALIDATE_EMAIL)){
            return $email;
         }
    }
    function verifyUser($uname){
        $unam = filter_var($uname,FILTER_SANITIZE_STRING);
        $unam = str_replace(' ','_',$unam);
        return $unam;
    }
    function verifyPasscode($arg0,$arg1){
        if(strcmp($arg0,$arg1) == 0){
            return $arg0;
        }
        require('register.html');
        
    }

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $unam= verifyUser($_POST['username']);
        $mail= verifyEmail($_POST['email']);
        $code= verifyPasscode($_POST['passcode1'],$_POST['passcode2']);
        
        if(empty($unam) || empty($mail) || empty($code)){
            
             print_r ("chec the user inputs");
             echo $unam;
             echo $mail;
             echo $code;
        }else{
            $conn = new mysqli($servername,$username,$password,$dbname);
            
            if($conn->connect_error){
                die("error connecting to db".$conn->connect_error);
            }else{
               
                $sql1 = "CREATE TABLE  ".$unam."( 
                    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    email VARCHAR(100) NOT NULL,
                    msg VARCHAR(1000) NOT NULL,
                    passcode VARCHAR(100) NOT NULL
                )";
                if($conn->query($sql1) === TRUE){
                    $sql2 = "INSERT INTO ".$unam."(email,passcode) VALUE('$mail','$code')";
                    if($conn->query($sql2) === TRUE){
                        $_SESSION["usrname"] = $unam;
                        $_SESSION["passcode"] = $code;
                        header("Location: homepg1.php");   //check for exeptions.
                    }
                }else{
                    echo "user name exist ";
                }
            //include('homePg.php');
            }
        }

        

    }

?>
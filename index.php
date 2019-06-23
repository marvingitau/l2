<?php
session_start();
require_once "spec.php";

if (isset($_SESSION['logged_in'])){
    header('Location: homepg1.php');
}else{



    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <title>login</title>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="deps/bootstrap.min.css">
            <script src="deps/jquery-3.1.1.min.js"></script>
            <script src="deps/bootstrap.min.js"></script>
    
            <style>
             body{
                 /* background-color: black; */
                 background-image: url('node.jpg');
             }
             header{
                 background-color:rgb(40, 173, 206);
             }
             .logo{
                 display: block;
                 margin-left: auto;
                 margin-right: auto;
                 width: 50%;
             }
             section{
                 /* background-color: rgb(45, 45, 77); */
                 background-image: url('node.jpg');
                 
             }
             .label{
                 color:rgba(106, 226, 230, 0.774);
                 font-size: 25px;
                 font-style: bold;
                 padding-left: 0%;
    
             }
            </style>
        </head>
        <body>
    
            <div class="container">
                <header>
                    <div class="row">
                        <!-- <div class="col-lg-12"> -->
                        <img src="logo.png" class="logo" draggable="false" height="300px" width="300px">
                            <!-- <a href="#"><img src="logo.png" class="logo" draggable="false" height="300px" width="300px"></a> -->
                        <!-- </div> -->
                    </div>
                </header>
                <section>
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> " class="" role="form" method="POST" autocomplete="off">
    
                                <div class="form-group">
                                    <label for="usrname" class=" label">username</label>
                                    <input type="text" class="form-control" required id="usrname" name="usernameLogin" placeholder="Enter username">
                                </div>
    
                                <div class="form-group">
                                    <label for="passcode" class="label">passcode</label>
                                    <input type="password" class="form-control" required id="passcode" name="pwd" placeholder="Enter Passcode">
                                </div>
                                
                                <button type="submit" class="btn btn-default">submit</button> &nbsp;&nbsp;
                                <a href="./register.html" class="btn btn-default" role="button">Register</a>
                                
    
                                &nbsp; 
                            </form>
                            <?php
                            if(isset($err)){ ?>
                                <div class="alert alert-warning">
                                  <strong>Warning!</strong><?php echo  $err;?>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </section>
            </div>
    
        </body>
    </html>
    
    
    <?php


// @$codU = $_POST['pwd'];
// @$uname = $_POST['usernameLogin'];
// $code = "";// password is null





if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['pwd'],$_POST['usernameLogin'])){
    $codU = $_POST['pwd'];
    $uname = $_POST['usernameLogin'];
    $code = "";// password is null

    $_SESSION["usrname"] = $uname;
    $_SESSION["passcode"] = $codU;

    $sql = "SELECT passcode FROM ".$uname." ";
    try{

    if(!$result = $conn->query($sql)){
        throw new Exception('no obj');
    }
    if($result->num_rows>0){
        $row=$result->fetch_assoc();
        $code = $row['passcode'];
        if(strcmp($code,$codU) == 0){
            $_SESSION['logged_in'] = true;
            header('Location: homepg1.php');
            quit();
        }
        }

    
    }catch(Exception $e){
        $err="No given Ac.";
        // header("Location: index.php");
 
    }   
}
}
?>
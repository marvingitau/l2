<?php 
 // require_once 'login.php';
 // $conn = new mysqli($servername,$username,$password,$dbname);
  // check for connection
//   if($conn->connect_error){
//       die("connection failed".$conn ->connect_error);
//   }

    // echo $row['msg'];

   // $sql = "SELECT msg,ntime,uname FROM brain ORDER BY ntime DESC";
   // $result = $conn -> query($sql);

    // if($result->num_rows >0){
    // while($row = $result->fetch_assoc()){
    //     echo "".date("Y-m-d-H-i-s",$row['ntime']).">".$row['msg']."<br>";
    // }
    // }
    // if(isset($_REQUEST["q"])){
    //     echo "working on it";
    // }
    
    function getPrevMsg(){
        $servername = "localhost";
            $username = "root";
            $password ="";
            $dbname = "ElChart";
        $conn = new mysqli($servername,$username,$password,$dbname);
        if($conn->connect_error){
            echo "error in connecting the db".$conn->connect_error;
        }
       return $conn;
    }
    

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
        <script src="ajaxuser.js"></script>

        <style>
         body{
             /* background-color: black; */
             background-image: url('node.jpg');
             /* background-repeat:no-repeat; */
             /* background-repeat:no-repeat; */
             /* background-size: 100% 100%; */
             margin: 0px;
             padding: 0px;
             font-family:"Helvetica";
             text-decoration:none;
             list-style-type:none;
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
             /* background-image: url('node.jpg'); */
             margin-left: 10px;
             margin-right: 10px;
             margin-bottom: 10px;
             /* border: 1px solid red; */
             
         }
         .label{
             color:rgba(40, 173, 206, 0.719);
             font-size: 30px;
             font-style: bold;
             padding-left: 0%;

         }
         aside{
             /* border: 2px solid red; */
             margin-left: 10px;
             margin-right: 10px;
             margin-bottom: 10px;
             /* border-radius:3px; */
        

             /* float: left; */
             /* width: 20%; */
         }
         table,th,td{
             /* border: 1px solid white; */
             text-align: center;
             background-color: rgba(40, 173, 206, 0.527);
             color:black;
             border-radius:5px;
             /* border-bottom:1px solid rgba(255,255,255,0); */
         }
         #msgArea{
             /* border:red solid 1px; */
             background-color:rgba(255,255,255,255);
             color :black;
            
             vertical-align:center;
             border-radius:5px;
             font-family:"Helvetica";
             font-size:1.2em;
             
         }
         #usernames{
              border:red solid 1px;
         }
         footer{
             display:block;
             text-align:center;
             /* background-color:gray; */
             /* position:fixed; */
             /* bottom:0; */
         }
        </style>
    </head>
    <body>

         <div class="container-fluid"> 
            <header>
                <div class="row">
                    <div class="col-lg-9">
                    <img src="logo.png" class="logo" draggable="false" height="200px" width="150px">
                        <!-- <a href="#"><img src="logo.png" class="logo" draggable="false" height="300px" width="300px"></a> -->
                    </div>

                    <!-- THE USER SETTING SECTION -->
                    <div class="col-lg-3 panel-group" style="text-align: center;font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;border-radius: 2px;width:300px;">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" href="#list">
                                        USER
                                    </a>
                                </h4>
                            </div>
                            <div id="list" class="panel-collapse collapse">
                                    <ul class="list-group">
                                        <li class="list-group-item">setting</li>
                                        <li class="list-group-item"><a href="logpage.html">Log Out</a></li>
                                    </ul>
                            </div>
                        </div>
                    </div>

                    <!-- END OF USER SETTING SECTION -->

                </div>
            </header>

                <div class="row">
                   
                    <div class="col-sm-10 col-lg-9">
                            <section>
                                <p style="color:white;text-align:center;font-size:1.1em;" >MESSAGING</p>
                                <button type="button" class="btn btn-default" data-toggle="collapse" data-target="#userInput">Create Msg</button>
                                <button type="button" class="btn btn-default" data-toggle="collapse" data-target="#userInput1" style="float:right;">View Prev msg</button>
                                
                                <div id="userInput" class="collapse">
                                        <form role="form" action="<?php echo htmlspecialchar($_SERVER['PHP_SELF']);?>" method="POST" enctype="multipart/form-data">
                                            <!-- <a href="#">Creating a new message</a> -->
                                            <div class="form-group">
                                                <label for="msgArea">Msg</label>
                                                <textarea class="form-control" id="msgArea" rows="6" name="msgValue"></textarea>
                                                <button type="button" class="btn btn-dafault" data-toggle="modal" data-target="#myModal">Send to</button>
                                                <!-- UPLOAD FILE -->
                                                <input type = "file" class ="form-control-file" name="upFile"/>
                                                <div id="myModal" class="modal fade" role="dialog">
                                                    <div class="modal-dialog">
                                                        <!-- Modal contents -->
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                <h4 class="modal-title">Contacts</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <!-- SEARCH BAR -->
                                                                <input type="text" class="form-control" name="searchUserName" placeholder ="Search Username" style = "margin-bottom:2px;" onkeyup="showUser(this.value)">
                                                                <p><span id="unameHint"></span></p>
                                                                
                                                                 
                                                                
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-default" data-dismiss="modal">Ok</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                </div>
                                <!-- RECORDED FILES FROM DB -->
                                <div id="userInput1" class="collapse">
                                        <form role="form" action="" method="POST" enctype="multipart/form-data">
                                            <!-- <a href="#">jsijkweJKWEEJ</a> -->
                                            <div class="form-group">
                                                <label for="msgArea">Msgs</label>
                                                <!-- PREVIOUS MESSAGES  -->
                                                
                                               
                                            
                                                   
                                                <!-- MODAL FADE SECTION BEGIN -->
                                                <div id="myModal" class="modal fade" role="dialog">
                                                    <div class="modal-dialog">
                                                        <!-- Modal contents -->
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                <h4 class="modal-title">Contacts</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Add elemments/list from DB</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-default" data-dismiss="modal">Ok</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </form>
                                </div>
                                
                               
                            </section>
                    </div>
                    <div class="col-sm-2 col-lg-3">
                            <aside>
                                <p style="color:white;text-align:center;vertical-align:center;">UPCOMING</p>
                                <table border="1">
                                    <tr>
                                        <th>NEWS</th>
                                    </tr>
                                    <tr>
                                        <td>dsdssdsdd
                                                Skin as fair as Lily's hair, as golden as the corn
                                                They knew that she was special from the moment she first cried
                                                She was a mountain angel certified
                                                She was her momma's baby, she was her daddy's pride
                                                Good at home, at church and school, at everything she tried
                                                Everybody's darlin' led a c
                                        </td>
                                    </tr>
                                    <tr>
                                            <td>dsdssdsdd
                                                    Skin as fair as Lily's hair, as golden as the corn
                                                    They knew that she was special from the moment she first cried
                                                    She was a mountain angel certified
                                                    She was her momma's baby, she was her daddy's pride
                                                    Good at home, at church and school, at everything she tried
                                                    Everybody's darlin' led a c
                                            </td>
                                        </tr>
                                        <tr>
                                                <td>dsdssdsdd
                                                        Skin as fair as Lily's hair, as golden as the corn
                                                        They knew that she was special from the moment she first cried
                                                        She was a mountain angel certified
                                                        She was her momma's baby, she was her daddy's pride
                                                        Good at home, at church and school, at everything she tried
                                                        Everybody's darlin' led a c
                                                </td>
                                            </tr>
                                </table>
                            </aside>
                    </div>
                    
               </div>
               <footer>
                   @copy ElmsgingApp
                </footer>
        </div>

    </body>
    <script>
    
    function userVal(id,val){
        switch(val){
                    case 'n':
                        document.getElementById(id).style.color="red"
                        document.getElementById(id).value="y"
                        break
                    case 'y':
                        document.getElementById(id).style.color="black"
                        document.getElementById(id).value="n"
                        break
                    default:
                        document.getElementById(id).style.color="red"
                        document.getElementById(id).value="y"
                        break
                }
    }
    </script>
</html>
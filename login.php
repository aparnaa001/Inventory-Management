<?php
session_start();
include("commonheader.php");
include("connection.php");

?>




<center>

<div class="col-xl-6 wow fadeInRight" data-wow-delay="0.4s" style="margin: 200px;">
    
                        <div style="padding-top: 25px;padding-bottom: 25px;border-radius: 40px;" >
                            
                            <form method="post">
                                <div class="row g-3">
                                    <div>
                                    <div class="col-lg-12 col-xl-6" style="margin-bottom:20px">
                                        <div class="form-floating">
                                            <input type="email" name="Sender" class="form-control border-0" id="email" placeholder="Your Email" required>
                                            <label for="email">Your Email</label>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-xl-6">
                                        <div class="form-floating">
                                            <input type="password" name="Password" class="form-control border-0" id="name" placeholder="Your Name" required>
                                            <label for="name">Your Password</label>
                                        </div>
                                    </div>
                                   

                                    </div>
                                    <div class="col-12">
                                        <button name="login" type="submit" class="btn btn-primary w-50 py-3">Login</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>


                    </center>




<?php


if(isset($_POST['login'])){
    $email = mysqli_real_escape_string($con, $_POST['Sender']);
    $password = mysqli_real_escape_string($con, $_POST['Password']);

    $qry1 = "SELECT * FROM `login` WHERE `email`= '$email' AND `password`= '$password'";
    $result = mysqli_query($con, $qry1);

    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);
       
            if($row['type'] == 'User'){
                $_SESSION['user'] = $row['uid'];
                echo "<script>alert('Welcome $row[type]');location='customerhome.php';</script>";
            } elseif($row['type'] == 'Shop'){
                $_SESSION['user'] = $row['uid'];
                echo "<script>alert('Welcome $row[type]');location='shophome.php';</script>";
            } elseif($row['type'] == 'Admin'){
                echo "<script>alert('Welcome Admin');location='adminhome.php';</script>";
            } else {
                echo "<script>alert('Unknown user type');</script>";
            }
        
    } else {
        echo "<script>alert('User Not Found');</script>";
    }
}


include("commonfooter.php");
?>
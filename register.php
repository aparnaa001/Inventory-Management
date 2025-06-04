<?php
include("commonheader.php");
include("connection.php");
?>


<center>

<div class="col-xl-6 wow fadeInRight" data-wow-delay="0.4s" style="margin:100px">
                        <div>
                            
                            <form method="post" enctype="multipart/form-data" >
                                <div class="row g-3">
                                    <div class="col-lg-12">
                                        <div class="form-floating">
                                            <input type="text" name="Name" class="form-control border-0" id="name" placeholder="Your Name" required>
                                            <label for="name" >Your Name</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-floating">
                                            <input type="email" name="Email" class="form-control border-0" id="email" placeholder="Your Email" required>
                                            <label for="email" >Your Email</label>
                                        </div>
                                    </div>
                                    
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input type="password" name="Password" class="form-control border-0" id="subject" placeholder="Password" required>
                                            <label for="subject" >Password</label>
                                        </div>
                                    </div>
                                   
                                    <div class="col-12">
                                    
                                    </div>
                                    <div class="col-12">
                                        <button name="submit" type="submit" class="btn btn-primary w-100 py-3">Register</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    </center>




<?php


if (isset($_POST['submit'])) {
    $name = $_POST['Name'];
    $email = $_POST['Email'];
    $pass = $_POST['Password'];
    // $folder = 'media/';
    // $file = $folder . basename($_FILES['Image']['name']);
    // move_uploaded_file($_FILES['Image']['tmp_name'],$file);
    // // Check if user already exists
    $qry1 = "SELECT * FROM `customer` WHERE `cemail`= '$email'";
    $result = mysqli_query($con, $qry1);
    
    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('User already exists');</script>";
    } else {
        // Insert user data
        $qry2 = "INSERT INTO `customer` (`cname`, `cemail`) VALUES ('$name', '$email')";
  
        $insertUser = mysqli_query($con, $qry2);
        
        // Insert login data
        if ($insertUser) {
            $qry3 = "INSERT INTO `login` (`uid`, `email`, `password`, `type`) VALUES ((SELECT MAX(`cid`) FROM `customer`), '$email', '$pass', 'User')";
            $insertLogin = mysqli_query($con, $qry3);
            if ($insertLogin) {
                echo "<script>alert('Registered successfully');</script>";
            } else {
                echo "<script>alert('Failed to register login '+$insertLogin);</script>";
            }
        } else {
            echo "<script>alert('Failed to register user');</script>";
        }
    }
}


include("commonfooter.php");
?>
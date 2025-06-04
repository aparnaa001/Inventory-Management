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
                                    <div class="col-lg-12">
                                        <div class="form-floating">
                                            <input type="number" name="Phone" class="form-control border-0" id="phone" max-length="10" pattern='[6,7,8,9]{0-9}' placeholder="Your Phone number" required>
                                            <label for="phone" >Your Phone number</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-floating">
                                            <input type="number" name="Gstin" class="form-control border-0" id="gstin" placeholder="Your Phone number" required>
                                            <label for="gstin" >Your Gstin</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-floating">
                                            <input type="text" name="Address" class="form-control border-0" id="address" placeholder="Your Address" required>
                                            <label for="gstin" >Your Address</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-floating">
                                            <input type="text" name="About" class="form-control border-0" id="about" placeholder="Your About" required>
                                            <label for="gstin" >Your About</label>
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
    $phone = $_POST['Phone'];
    $gstin = $_POST['Gstin'];
    $address = $_POST['Address'];
    $about = $_POST['About'];
    $pass = $_POST['Password'];
    // $folder = 'media/';
    // $file = $folder . basename($_FILES['Image']['name']);
    // move_uploaded_file($_FILES['Image']['tmp_name'],$file);
    // Check if user already exists
    $qry1 = "SELECT * FROM `shop` WHERE `shopemail`= '$email' or `shopphone`='$phone'";
    $result = mysqli_query($con, $qry1);
    
    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('User or Phone Number already exists');</script>";
    } else {
        // Insert user data
        $qry2 = "INSERT INTO `shop` (`shopname`, `shopemail`, `shopphone`,`gstin`, `shopaddress`, `about`) VALUES ('$name', '$email','$phone','$gstin', '$address', '$about')";
  
        $insertUser = mysqli_query($con, $qry2);
        
        // Insert login data
        if ($insertUser) {
            $qry3 = "INSERT INTO `login` (`uid`, `email`, `password`, `type`) VALUES ((SELECT MAX(`sid`) FROM `shop`), '$email', '$pass', 'Shop')";
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
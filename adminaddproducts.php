<?php
include("adminheader.php");
include("connection.php");
?>


<center>

<div class="col-xl-6 wow fadeInRight" data-wow-delay="0.4s" style="margin:100px">
                        <div>
                            
                            <form method="post" enctype="multipart/form-data" >
                                <div class="row g-3">
                                    <div class="col-lg-12">
                                        <div class="form-floating">
                                            <input type="text" name="Name" class="form-control border-0" id="name" placeholder="Product Name" required>
                                            <label for="name" >Product Name</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-floating">
                                            <input type="text" name="Email" class="form-control border-0" id="email" placeholder="Product About" required>
                                            <label for="email" >Product About</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-floating">
                                            <input type="number" name="Phone" class="form-control border-0" id="phone"  placeholder="Expiry Month" required>
                                            <label for="phone" >Product Expiry in months</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-floating">
                                            <input type="number" name="Gstin" class="form-control border-0" id="gstin" placeholder="Product Price per Piece" required>
                                            <label for="gstin" >Product Price per Piece</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-floating">
                                            <input type="file" name="Image" class="form-control border-0" id="address" placeholder="Product Image" required>
                                            <label for="gstin" >Product Image</label>
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
    $folder = 'media/';
    $file = $folder . basename($_FILES['Image']['name']);
    move_uploaded_file($_FILES['Image']['tmp_name'],$file);
   
        // Insert user data
        $qry2 = "INSERT INTO `products` (`pname`, `about`, `expiry`,`adddate`, `price`, `pimage`) VALUES ('$name', '$email','$phone',CURDATE(),'$gstin', '$file')";
  
        $insertUser = mysqli_query($con, $qry2);
        
        // Insert login data
        if ($insertUser) {
                echo "<script>alert('Added successfully');</script>";
            } else {
                echo "<script>alert('Failed to Add '+$insertLogin);</script>";
            }
        }
include("commonfooter.php");
?>
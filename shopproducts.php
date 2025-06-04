<?php
session_start();
include("shopheader.php");
include("connection.php");
$id = $_SESSION['user'];
?>

<!-- <div class="container" style="padding:120px">
<table class="table table-hover">
  <thead style='align-content:center;text-align:center;'>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Product</th>
      <th scope="col">Image</th>
      <th scope="col">About</th>
      <th scope="col">Expiry (in Months)</th>
      <th scope="col">Add date</th>
      <th scope="col">Count</th>
    
    </tr>
  </thead>
  <tbody style='align-contents:center;text-align:center;'>
 
    <tr>
    <td><?php  echo $row['pid']   ?></td>
      <td></td>
      <td><img src="" style="height: 100px;" alt="Product Image"></td>
      <td></td>
      <td><?php  echo $row['expiry']   ?> months</td>
      <td><?php  echo $row['adddate']   ?></td>
      <td><?php  echo $row['count']   ?></td>
      
      
    </tr>
  
  </tbody>
</table>
</div> -->
<section style="background-color: #eee;">
  <div class="text-center container py-5">

    <div class="row">
    <?php
                
                $qry = "SELECT * from `products`";

                $data = mysqli_query($con, $qry);

                if($data){
                while ($row = mysqli_fetch_array($data)) {
                            $pid = $row['pid'];
                ?>
      <div class="col-lg-4 col-md-12 mb-4" style="width:250px">
        <div class="card">
          <div class="bg-image hover-zoom ripple ripple-surface ripple-surface-light"
            data-mdb-ripple-color="light">
            <img src="<?php  echo $row['pimage'] ?>"
              class="w-75" />
            <a href="#!">
              <div class="mask">
                <div class="d-flex justify-content-start align-items-end h-100">
                  <h6><span class="badge bg-primary ms-2">New</span></h6>
                </div>
              </div>
              <div class="hover-overlay">
                <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
              </div>
            </a>
          </div>
          <div class="card-body">
            <a href="" class="text-reset">
              <h5 class="card-title mb-3">Product Name : <?php  echo $row['pname']   ?></h5>
            </a>
            <a href="" class="text-reset">
              <p>Details : <?php  echo $row['about']   ?></p>
            </a>
            <a href="" class="text-reset">
              <p>Expiry : <?php  echo $row['expiry']   ?> months</p>
            </a>
            <h6 class="mb-3">₹ <?php  echo $row['price']   ?> / Piece</h6>
            <form method="post">
              <input type="hidden" name="pid" value="<?php  echo $pid   ?>">
            <input type="number" name="Name" class="form-control" placeholder="Count" required><br>
            <button name="submit" type="submit" class="btn btn-primary">Request</button>

            </form>

          </div>
        </div>
      </div>
      <?php
                }}
   ?>
    </div>
    <?php

if (isset($_POST['submit'])) {
    $name = $_POST['Name'];
    $prid = $_POST['pid'];
        $qry2 = "INSERT INTO `request` (`pid`, `sid`, `count`) VALUES ('$prid', '$id','$name')";
        $insertUser = mysqli_query($con, $qry2);
        
        // Insert login data
        if ($insertUser) {
                echo "<script>alert('Request Added successfully');window.location('shopproducts.php');</script>";
            } else {
                echo "<script>alert('Failed to Add ');</script>";
            }
        }
            
            ?>
  </div>
</section>

<?php

include("commonfooter.php");
?>
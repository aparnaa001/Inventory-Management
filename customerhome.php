<?php
session_start();
include("customerheader.php");
include("connection.php");

$id = $_SESSION['user'];
?>

<section style="background-color: #eee;">
  <div class="text-center container py-5">
    <div class="row">
      <?php
      $qry1 = "SELECT s.*, p.*, st.*
                FROM `stock` st
                JOIN `products` p ON st.pid = p.pid
                JOIN `shop` s ON st.sid = s.sid
                WHERE st.`count` > 0;";
      $data1 = mysqli_query($con, $qry1);

      if ($data1) {
        while ($row = mysqli_fetch_array($data1)) {

          
      ?>
      <div class="col-lg-4 col-md-12 mb-4" style="width:250px">
        <div class="card">
          <div class="bg-image hover-zoom ripple ripple-surface ripple-surface-light" data-mdb-ripple-color="light">
            <img src="<?php echo $row['pimage'] ?>" class="w-75" />
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
              <h5 class="card-title mb-3">Product Name: <?php echo $row['pname'] ?></h5>
            </a>
            <a href="" class="text-reset">
              <p>Details: <?php echo $row['about'] ?></p>
            </a>
            <a href="" class="text-reset">
              <p>Shop : <?php echo $row['shopname'] ?> </p>
            </a>
            <h6 class="mb-3">₹ <?php echo $row['price'] + 20 ?> / Piece</h6>
            <form method="post">
              <input type="hidden" name="count" value="<?php echo $row['count'] ?>">
              <input type="hidden" name="stkid" value="<?php echo $row['stkid'] ?>">
              <input type="hidden" name="sid" value="<?php echo $row['sid'] ?>">
              <input type="hidden" name="pid" value="<?php echo $row['pid'] ?>">
              <input type="hidden" name="price" value="<?php echo $row['price'] ?>">
            <input type="number"  name="Name" class="form-control" min='1' max='<?php echo $row['count'] ?>' placeholder="Enter the Count First" required>
            <br>
              <button name="submit" type="submit"  class="btn btn-primary">Purchase</button>
              </form>
          </div>
        </div>
      </div>
      <?php
            }
          }
        
      ?>
    </div>
  </div>
</section>


<?php
if (isset($_POST['submit'])) {
              
  $email = mysqli_real_escape_string($con, $_POST['Name']);
  $count = mysqli_real_escape_string($con, $_POST['count']);
  $stkid = mysqli_real_escape_string($con, $_POST['stkid']);
  $sid = mysqli_real_escape_string($con, $_POST['sid']);
  $pid = mysqli_real_escape_string($con, $_POST['pid']);
  $price = mysqli_real_escape_string($con, $_POST['price']);
  
  if ($count >= $email){
  $total = $email * ( $price + 20);
  $_SESSION['stkid'] = $stkid;
  $_SESSION['price'] = $total;
  $_SESSION['sid'] = $sid;
  $_SESSION['pid'] = $pid;
  echo $pid;
  $_SESSION['ucount'] = $email;
  $_SESSION['count'] = $count;
  
  header("Location: payment2.php");}
  else{
    echo "<script>  alert('Exceeded the Existing Products Maximum is ')  </script>";
  }
}
include("commonfooter.php");
?>

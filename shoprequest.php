<?php
session_start();
include("shopheader.php");
include("connection.php");
$id=$_SESSION['user']
?>




<div class="container" style="padding:120px">
<table class="table table-hover">
  <thead style='align-content:center;text-align:center;'>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Product</th>
      <th scope="col">Image</th>
      <th scope="col">Shop</th>
      <th scope="col">Count</th>
      <th scope="col">Status</th>
      <th scope="col">Total price</th>
    </tr>
  </thead>
  <tbody style='align-contents:center;text-align:center;'>
  <?php
                
                $qry = "SELECT * from `request` Where `sid`='$id'";

                $data = mysqli_query($con, $qry);

                if($data){
                while ($row = mysqli_fetch_array($data)) {

                ?>
    <tr>
    <?php
                
                $qry2 = "SELECT * from `products` Where `pid`='".$row['pid']."' ";

                $data2 = mysqli_query($con, $qry2);

                if($data2){
                while ($row2 = mysqli_fetch_array($data2)) {
                        $price = $row2['price'];
                ?>
    <td><?php  echo $row['rid']   ?></td>
      <td><?php  echo $row2['pname']   ?></td>
      <td><img src="<?php  echo $row2['pimage'] ?>" style="height: 100px;" alt="Product Image"></td>
      <?php  }} 
      
      $qry3 = "SELECT * from `shop` Where `sid`='".$row['sid']."' ";

                $data3 = mysqli_query($con, $qry3);

                if($data3){
                while ($row3 = mysqli_fetch_array($data3)) {

      ?>
      <td><?php  echo $row3['shopname']   ?></td>
      <?php
                }}
   ?>
      <td><?php  echo $row['count']   ?> </td>
      <td><?php  echo $row['status']   ?></td>
      <td>₹ <?php  echo $row['count'] * $price  ?></td>
      <?php  if  ($row['status'] == 'Pay') {
        ?>
        <td><form method='post'>
        <input type="hidden" name="Sender" value="<?php  echo $row['rid']   ?>" >
      <a name="sell" id="sellbtn" href="./payment.php?id=<?php echo $row['rid'] ;?>&total=<?php  echo $row['count'] * $price  ;?>&pid=<?php  echo $row['pid'];?>&count=<?php  echo $row['count'] ;?>" class="btn btn-primary"> Pay </a>
      </form> </td>`;
      <?php
      }
      ?> 
      
    </tr>
   <?php

// if(isset($_POST['sell'])){
//     $email = mysqli_real_escape_string($con, $_POST['Sender']);

//     $qry1 = "UPDATE `request` SET `status` = 'Accepted' WHERE `rid` = '".$row['rid']."';";
//     $result = mysqli_query($con, $qry1);
// }




                }}
   ?>
  </tbody>
</table>
</div>


<?php

include("commonfooter.php");
?>
<?php
// session_start();
include("adminheader.php");
include("connection.php");

?>

<div class="container" style="padding:120px">
<table class="table table-hover">
  <thead style='align-content:center;text-align:center;'>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Product</th>
      <th scope="col">Image</th>
      <th scope="col">About</th>
      <th scope="col">Expiry (in Months)</th>
      <th scope="col">Add date</th>
      <th scope="col">Price</th>
    
    </tr>
  </thead>
  <tbody style='align-contents:center;text-align:center;'>
  <?php
                
                $qry = "SELECT * from `products`";

                $data = mysqli_query($con, $qry);

                if($data){
                while ($row = mysqli_fetch_array($data)) {

                ?>
    <tr>
    <td><?php  echo $row['pid']   ?></td>
      <td><?php  echo $row['pname']   ?></td>
      <td><img src="<?php  echo $row['pimage'] ?>" style="height: 100px;" alt="Product Image"></td>
      <td><?php  echo $row['about']   ?></td>
      <td><?php  echo $row['expiry']   ?> months</td>
      <td><?php  echo $row['adddate']   ?></td>
      <td>₹ <?php  echo $row['price']   ?></td>
      
      
    </tr>
   <?php
                }}
   ?>
  </tbody>
</table>
</div>


<?php

include("commonfooter.php");
?>
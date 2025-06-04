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
      <th scope="col">Shop</th>
      <th scope="col">Email</th>
      <th scope="col">Phone</th>
      <th scope="col">Address</th>
      <th scope="col">Gstin</th>
      <th scope="col">Bio</th>
    
    </tr>
  </thead>
  <tbody style='align-contents:center;text-align:center;'>
  <?php
                
                $qry = "SELECT * from `shop`";

                $data = mysqli_query($con, $qry);

                if($data){
                while ($row = mysqli_fetch_array($data)) {

                ?>
    <tr>
    <td><?php  echo $row['sid']   ?></td>
    <td><?php  echo $row['shopname']   ?></td>
      <td><?php  echo $row['shopemail']   ?></td>
      <td><?php  echo $row['shopphone'] ?></td>
      <td><?php  echo $row['shopaddress']   ?></td>
      <td><?php  echo $row['gstin']   ?></td>
      <td><?php  echo $row['about']   ?></td>
      
      
      
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
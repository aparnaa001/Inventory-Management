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
      <th scoe="col">About</th>
      <th scope="col">Count</th>
    </tr>
  </thead>
  <tbody style='align-contents:center;text-align:center;'>
  <?php
                
                $qry = "SELECT * FROM `stock` WHERE `sid`='$id' AND `count` > 0;";

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
                       
                ?>
    <td><?php  echo $row['stkid']   ?></td>
      <td><?php  echo $row2['pname']   ?></td>
      <td><img src="<?php  echo $row2['pimage'] ?>" style="height: 100px;" alt="Product Image"></td>
      <td><?php  echo $row2['about']   ?> </td>
      <?php  }} 
      ?>

      <td><?php  echo $row['count']   ?> </td>
     
      
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
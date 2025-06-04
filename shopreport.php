<?php
session_start();
include("shopheader.php");
include("connection.php");
$id = $_SESSION['user'];
$ttl=0;
$profit=0;
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
                <th scope="col">Date</th>
                <th scope="col">Total price</th>
            </tr>
        </thead>
        <tbody style='align-contents:center;text-align:center;'>
        <?php
        $qry = "
            SELECT b.*, p.*, s.* 
            FROM `booking` b
            JOIN `products` p ON b.pid = p.pid
            JOIN `shop` s ON b.sid = s.sid WHERE b.`sid` = '$id'
        ";
      

        $data = mysqli_query($con, $qry);

        if ($data) {
            while ($row = mysqli_fetch_array($data)) {
                $total_price = $row['bcount'] * ($row['price'] + 20);
        ?>
            <tr>
                <td><?php echo $row['bid']; ?></td>
                <td><?php echo $row['pname']; ?></td>
                <td><img src="<?php echo $row['pimage']; ?>" style="height: 100px;" alt="Product Image"></td>
                <td><?php echo $row['shopname']; ?></td>
                <td><?php echo $row['bcount']; ?></td>
                <td><?php echo $row['date']; ?></td>
                <td>₹ <?php echo $total_price; ?></td>
                
            </tr>
        <?php
            $ttl = $ttl + $total_price;
            $profit= $profit + ($row['bcount'] * 20);
            }
        }
        ?>
        </tbody>
    </table>
</div>
<div class="card-container">
    <div class="card">
        <h2>Total Price</h2>
        <p><?php echo $ttl; ?>₹</p>
    </div>
    <div class="card">
        <h2>Total Profit</h2>
        <p><?php echo $profit; ?>₹</p>
    </div>
</div>
<style>
    .card-container {
    display: flex;
    gap: 20px;
    padding: 20px;
}

.card {
    background-color: white; 
    border: 1px solid #ccc; 
    border-radius: 8px; 
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 16px; 
    width: 50%; 
}

.card h2 {
    margin: 0 0 10px; 
}

.card p {
    margin: 0;
}

</style>
<?php

include("commonfooter.php");
?>

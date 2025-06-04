<?php
session_start();
include("customerheader.php");
include("connection.php");
$id = $_SESSION['user'];
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
            JOIN `shop` s ON b.sid = s.sid WHERE b.`cid` = '$id'
        ";

        $data = mysqli_query($con, $qry);

        if ($data) {
            while ($row = mysqli_fetch_array($data)) {
                $total_price = $row['bcount'] * $row['price'];
        ?>
            <tr>
                <td><?php echo $row['bid']; ?></td>
                <td><?php echo $row['pname']; ?></td>
                <td><img src="<?php echo $row['pimage']; ?>" style="height: 100px;" alt="Product Image"></td>
                <td><?php echo $row['shopname']; ?></td>
                <td><?php echo $row['bcount']; ?></td>
                <td><?php echo $row['date']; ?></td>
                <td>₹ <?php echo $row[4]; ?></td>
                
            </tr>
        <?php
            }
        }
        ?>
        </tbody>
    </table>
</div>

<?php
include("commonfooter.php");
?>

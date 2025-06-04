<?php
// session_start();
include("adminheader.php");
include("connection.php");

// Handle form submission
if (isset($_POST['sell'])) {
    $rid = mysqli_real_escape_string($con, $_POST['Sender']);
    $qry4 = "UPDATE `request` SET `status` = 'Pay' WHERE `rid` = ?";
    $stmt = mysqli_prepare($con, $qry4);
    mysqli_stmt_bind_param($stmt, 'i', $rid);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

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
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody style='align-contents:center;text-align:center;'>
        <?php
        // Retrieve all data in a single query using JOINs
        $qry = "
            SELECT r.rid, r.count, r.status, p.pname, p.pimage, p.price, s.shopname 
            FROM `request` r
            JOIN `products` p ON r.pid = p.pid
            JOIN `shop` s ON r.sid = s.sid WHERE r.`status` != 'Paid'
        ";

        $data = mysqli_query($con, $qry);

        if ($data) {
            while ($row = mysqli_fetch_array($data)) {
                $total_price = $row['count'] * $row['price'];
        ?>
            <tr>
                <td><?php echo $row['rid']; ?></td>
                <td><?php echo $row['pname']; ?></td>
                <td><img src="<?php echo $row['pimage']; ?>" style="height: 100px;" alt="Product Image"></td>
                <td><?php echo $row['shopname']; ?></td>
                <td><?php echo $row['count']; ?></td>
                <td><?php echo $row['status']; ?></td>
                <td>₹ <?php echo $total_price; ?></td>
                <?php
                if($row['status']=='Requested'){
                    ?>
                    <td>
                    <form method='post'>
                        <input type="hidden" name="Sender" value="<?php echo $row['rid']; ?>">
                        <button name="sell" class="btn btn-primary">Sell</button>
                    </form>
                </td>
                    <?php
                }
                ?>
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

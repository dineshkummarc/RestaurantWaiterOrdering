<?php
session_start();
include 'db.php';
if (isset($_SESSION['them'])) {
    $them = $_SESSION['them'] . ".php";
    include $them;
}

if (!isset($_SESSION['usr'])) {
    header("Location: index.php");
}
$oid = '';
if (isset($_REQUEST['oid'])):
    if (!empty($_REQUEST['oid'])):
        $oid = htmlspecialchars($_GET['oid']);
    else:
        header("Location:viewOrderDetail.php?update=failed");

    endif;
else:
    header("Location:viewOrderDetail.php?update=failed");

endif;
?>

<div class="col-sm-7 col-sm-offset-2 col-md-8 col-md-offset-2 main">

    <input type="hidden" id="page_name" value="order">
    <h4 class="sub-header">View Order Detail</h4>

    <form class="form-horizontal" role="form" method="POST">


        <table class="table table-striped">
            <tr>
                <th>OrderId: </th>
                <td colspan="2"><?php echo $oid; ?></td>
            </tr>
            <?php
            $resultnew = mysqli_query($conn, "SELECT startdatetime,status,amount,grandtotal,paymentmode,discount FROM ordertable where id=" . $oid);
            $rownew = mysqli_fetch_row($resultnew);
            $startdatetime = $rownew[0];
            $status = $rownew[1];
            $amount = $rownew[2];
            $grandtotal = $rownew[3];
            $mode1 = $rownew[4];
            $disc = $rownew[5];
            $typenm = mysqli_query($conn, "select type from paymentmode where id='$mode1'");
            $typerow = mysqli_fetch_row($typenm);
            $mode = $typerow[0];
            if ($status == "0")
                $status1 = "Unpaid";
            else if ($status == "1")
                $status1 = "Process";
            else if ($status == "2")
                $status1 = "Paid";
            else if ($status == "3")
                $status1 = "Finish";
            else
                $status1 = "Cancel";
            $resulttax = mysqli_query($conn, "SELECT * FROM settings");
            while ($rowtax = mysqli_fetch_row($resulttax)) {
                $tax = $rowtax[5];
                $vattax = $rowtax[6];
                $additionaltax = $rowtax[7];
                $disconut = $rowtax[8];
            }
            ?>
            <tr>
                <th>StartDateTime: </th>
                <td colspan="2"><?php echo $startdatetime; ?></td>
            </tr>
            <tr>
                <th>Status: </th>
                <td colspan="2"><?php echo $status1; ?></td>
            </tr>
            <tr>
                <th>Dish: </th>
                <th>Quantity: </th>
                <th>Price: </th>

            </tr>
            <?php
            $result = mysqli_query($conn, "SELECT od.price,od.quantity,od.dishid,d.dishname FROM ordertable ot,orderdetails od,dish d where ot.id='$oid' and od.orderid=ot.id and od.dishid=d.id") or die(mysql_error());
            $amount = 0;
            if (mysqli_num_rows($result) > 0) :
                while ($row = mysqli_fetch_array($result)) {

                    $price = $row[0];
                    $quantity = $row[1];
                    $dish = $row[3];
                    $amount = $amount + $price;
                    ?>

                    <tr>
                        <td><?php echo $dish; ?></td>
                        <td><?php echo $quantity; ?></td>
                        <td><?php echo $price; ?></td>
                    </tr>

                    <?php
                }
            endif;
            ?>
            <tr>
                <th colspan="2">Amount: </th>
                <td ><?php echo $amount; ?></td>
            </tr>

            <tr>
                <th colspan="2">Tax: </th>
                <td ><?php echo $tax . "%"; ?></td>
            </tr>

            <tr>
                <th colspan="2">VatTax: </th>
                <td ><?php echo $vattax . "%"; ?></td>
            </tr>

            <tr>
                <th colspan="2">Additional Service Tax: </th>
                <td ><?php echo $additionaltax . "%"; ?></td>
            </tr>
            <tr>
                <th colspan="2">Discount:</th>
                <td><?php echo $disconut . "%"; ?></td>
            </tr>


            <tr>
                <th colspan="2">Grand Total: </th>
                <td ><?php echo $grandtotal; ?></td>
            </tr>
            <?php
            if($mode1!=0)
            {
            ?>
            <tr>
                <th >Payment Mode: </th>
                <td colspan="2"><?php echo $mode; ?></td>
            </tr>
            <?php
            }
            ?>
            <tr>
                <th>Additional Discount:</th>
                <td colspan="2"><?php echo $disc; ?>
                </td>
            </tr>
        </table>

    </form>

</div>

<?php include 'footer.php'; ?>


</body>
</html>

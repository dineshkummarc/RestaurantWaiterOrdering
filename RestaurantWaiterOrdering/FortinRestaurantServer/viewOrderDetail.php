<?php
session_start();
include 'db.php';
if (isset($_SESSION['them'])) {
    $them = $_SESSION['them'] . ".php";
    include $them;
}
$tax = 0;
$vattax = 0;
$additionaltax = 0;
$adddiscvalue = 0;
$amount = 0;
$disc = 0;
$tot = 0;
$paymentmode = '';
$msg = '';
$grosstotal = 0;
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
//ReActive Table Button Click
if (isset($_POST['btntable'])) {
    $gettable = mysqli_query($conn, "SELECT tableid from ordertable where id='$oid'");
    $rowtable = mysqli_fetch_row($gettable);
    $tid = $rowtable[0];
    $chtbst = mysqli_query($conn, "select tablestatus from tablemaster where id='$tid'");
    $chrow = mysqli_fetch_row($chtbst);
    $tst = $chrow[0];
    if ($tst == '0') {
        mysqli_query($conn, "UPDATE tablemaster SET tablestatus='1' where id='$tid'");
        $updateordertable = "UPDATE ordertable SET status='1',paymentstatus='unpaid',paymentmode='0' where id='$oid'";
        $msg = 'Table ReActive';
        $result = mysqli_query($conn, $updateordertable);
        header("Location:Order.php");
    } else {

        $msg = ' Table is Inactive';
    }
}

//Order cancel Button Click
if (isset($_POST['btncancel'])) {
    mysqli_query($conn, "UPDATE ordertable SET status='4' where id='$oid'");
    mysqli_query($conn, "UPDATE orderdetails SET status='3' where orderid='$oid'");
    $getdata = mysqli_query($conn, "SELECT tableid from ordertable where id='$oid'");
    $getrow = mysqli_fetch_row($getdata);
    $tid = $getrow[0];

    mysqli_query($conn, "UPDATE tablemaster SET tablestatus='0' where id='$tid'");
}
//Paid Button Click
if (isset($_POST['btnsubmit'])) {

    $paymentmode = $_POST['paymentmode'];
    $amount = $_POST['amount'];
    $grandtotal = $_POST['grandtotal'];
    $discount = $_POST['disc'];
    if ($paymentmode == 0) {
        $msg = "Select Paymentmode";
    } else {

        $updateordertable = "UPDATE ordertable SET amount='$amount',grandtotal='$grandtotal',status='3',paymentstatus='paid',paymentmode='$paymentmode',discount='$discount' where id='$oid'";
        $result = mysqli_query($conn, $updateordertable);

        $gettable = mysqli_query($conn, "SELECT tableid from ordertable where id='$oid'");
        $rowtable = mysqli_fetch_row($gettable);
        $tid = $rowtable[0];
        
        mysqli_query($conn,"UPDATE orderdetails SET status='2' where orderid='$oid'");
       
        mysqli_query($conn, "UPDATE tablemaster SET tablestatus='0' where id='$tid'");

        header("Location:paid.php?oid=$oid");
    }
}
?>

<input type="hidden" id="page_name" value="order">
<div class="col-sm-7 col-sm-offset-2 col-md-8 col-md-offset-2 main">

    <h4 class="sub-header">View Order Detail</h4>

    <form class="form-horizontal" role="form" method="POST">
        <?php
        if ($msg != '') {
            echo '<div class="form-group">';
            echo '<label id="msg" class="control-label  alert-danger"><span class="glyphicon glyphicon-remove"></span>' . $msg . '</label>';
            echo '</div>';
        }
        ?>

        <table class="table table-striped">
            <tr>
                <th>OrderId: </th>
                <td colspan="2"><?php echo $oid; ?></td>
            </tr>
            <?php
            $resultnew = mysqli_query($conn, "SELECT startdatetime,status,amount,grandtotal,paymentmode FROM ordertable where id=" . $oid);
            $rownew = mysqli_fetch_row($resultnew);
            $startdatetime = $rownew[0];
            $status = $rownew[1];
            $amount = $rownew[2];
            $grandtotal = $rownew[3];
            $mode = $rownew[4];
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
                $taxvalue = $tax / 100;
                $vattaxvalue = $vattax / 100;
                $additionaltaxvalue = $additionaltax / 100;
                $disconut = $rowtax[8];
                $disconutvalue = $disconut / 100;
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
                $grosstotal = $amount + ($amount * $taxvalue) + ($amount * $vattaxvalue) + ($amount * $additionaltaxvalue);
                if ($grandtotal == 0)
                    $grandtotal = $amount + ($amount * $taxvalue) + ($amount * $vattaxvalue) + ($amount * $additionaltaxvalue) - ($amount * $disconutvalue) - ($amount * $adddiscvalue);
            endif;
            ?>
            <tr>
                <th colspan="2">Amount: </th>
                <td ><input type="hidden" id="amount" name="amount" value="<?php echo $amount; ?>"><?php echo $amount; ?></td>
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
            <?php
            if ($disconut != 0) {
                ?>
                <tr>
                    <th colspan="2">Discount:</th>
                    <td><input type="hidden" value="<?php echo $disconut; ?>"><?php echo $disconut . "%"; ?></td>
                </tr>
                <?php
            } else
                $disconut = 0;
            ?>

            <input type="hidden" id="tot" name="tot" value="<?php echo $tot; ?>"/>
            <tr>
                <th colspan="2">Gross Amount: </th>
                <td ><?php echo $grosstotal; ?></td>
            </tr>
            <tr>
                <th colspan="2">Grand Total: </th>
                <td ><input type="text" id="grandtotal" name="grandtotal" value="<?php echo $grandtotal; ?>" readonly/></td>
            </tr>
            <tr>
                <th >Payment Mode: </th>
                <td colspan="2"><select id="paymentmode" name="paymentmode">
                        <?php
                        if ($mode == 0)
                            echo "<option value='0'>Select Mode</option>";
                        $result = mysqli_query($conn, "SELECT * FROM paymentmode");
                        if (mysqli_num_rows($result) > 0) :
                            while ($row = $result->fetch_assoc()) {
                                $pid = $row["id"];
                                $pname = $row["type"];
                                if ($mode == $pid)
                                    echo "<option selected value='$pid'>$pname</option>";
                                else
                                    echo "<option value='$pid'>$pname</option>";
                            }
                        endif;
                        ?>

                    </select>
                    <?php
                    if ($msg != '')
                        echo '<div style="line-height: 1.7em;color:red;">' . $msg . '</div>';
                    ?></td>
            </tr>
            <tr>
                <th>Additional Discount:</th>
                <td colspan="2"><input type="radio" id="yes" name="radiodisc" value="yes" onclick=""/>
                    <label> Yes </label>  
                    <input type="radio" id="no" name="radiodisc" checked = "checked"  value="no" />
                    <label>No</label> 
                    <div id="discdiv">     <input type="text"  name="disc" id="disc" placeholder="Enter Discount(%)"/>
                        <input type="button" id="btnapply" name="btnapply" value="Apply" class="btn btn-default" onclick="calgrandtot('<?php echo $grandtotal; ?>')"> 
                    </div>
                </td>
            </tr>
        </table>

        <input type="submit" id="btnsubmit" name="btnsubmit" value="Paid" class="btn btn-default">                    
        <input type="submit" id="btntable" name="btntable" value="Re-ActiveTable" class="btn btn-default"> 
        <?php
        if ($status != "3" and $status != "4") {
            echo '<input type="submit" id="btncancel" name="btncancel" value="Cancel Order" class="btn btn-default">';
        }
        ?>
    </form>
</div>



<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script type="text/javascript" src="js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<!--Script for hide show-->
<script type="text/javascript" src="js/jquery-latest.js"></script>
<script type="text/javascript">
                            $(document).ready(function() {
                                $('#discdiv').hide();
                                document.getElementById("disc").value = 0;
                                $('#yes').click(function() {
                                    $('#discdiv').show();
                                });
                                $('#no').click(function() {
                                    $('#discdiv').hide();
                                    document.getElementById("disc").value = 0;
                                    document.getElementById("grandtotal").value = document.getElementById("tot").value;
                                });
                            });

                            function calgrandtot(grandtot)
                            {

                                var tot = grandtot;
                                document.getElementById("tot").value = tot;
                                var discamt = document.getElementById("disc").value;
                                var discamtvalue = discamt / 100;
                                var grandtotal = grandtot - (grandtot * discamtvalue);
                                document.getElementById("grandtotal").value = grandtotal;
                            }

                            $(document).ready(function() {
                                var page_name = document.getElementById("page_name").value;
                                $("#" + page_name).addClass("active");


                            });
</script>
</body>
</html>

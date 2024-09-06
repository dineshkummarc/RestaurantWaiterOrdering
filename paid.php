<?php
session_start();
$paymentmode = '';
$discount = 0;
if (!isset($_SESSION['usr'])) {
    header("Location: index.php");
    die();
}
$oid = '';
if (isset($_REQUEST['oid'])):
    if (!empty($_REQUEST['oid'])):
        $oid = htmlspecialchars($_GET['oid']);
    else:
        header("Location:viewOrderDetail.php?update=failed");
        die();
    endif;
else:
    header("Location:viewOrderDetail.php?update=failed");
    die();
endif;

if(isset($_POST['btnorder']))
{
    header("Location:Order.php");
    die();
}
?>
<html>
    <body>
        <form role="form" method="POST">
             <table  cellpadding="0" cellspacing="0" border="1" width="30%" >

                <?php
                require 'db.php';
                $resultnew = mysqli_query($conn, "SELECT startdatetime,status,amount,grandtotal FROM ordertable where id=" . $oid) or die(mysql_error());
                $rownew = mysqli_fetch_row($resultnew);
                $startdatetime = $rownew[0];
                $amount = $rownew[2];
                $grandtot = $rownew[3];

                $resulttax = mysqli_query($conn, "SELECT * FROM settings") or die(mysql_error());
                while ($rowtax = mysqli_fetch_row($resulttax)) {
                    $name = $rowtax[1];
                    $tax = $rowtax[5];
                    $vattax = $rowtax[6];
                    $additionaltax = $rowtax[7];
                }
                ?>
                <tr>
                    <th align="left" style="padding-left: 4px;">Hotel Name: </th>
                    <th colspan="2" align="left" style="padding-left: 4px;"><?php echo $name; ?></th>
                </tr>
                <tr>
                    <th align="left" style="padding-left: 4px;">Order No: </th>
                    <td colspan="2" align="left" style="padding-left: 4px;"><?php echo $oid; ?></td>
                </tr>


                <tr>
                    <th align="left" style="padding-left: 4px;">Dish</th>
                    <th align="left" style="padding-left: 4px;">Quantity </th>
                    <th width="25%"><center>Price</center> </th>
                </tr>
                <?php
                $result = mysqli_query($conn, "SELECT od.price,od.quantity,od.dishid,d.dishname,ot.paymentmode,p.type,ot.discount FROM ordertable ot,orderdetails od,dish d,paymentmode p where ot.id='$oid' and od.orderid=ot.id and od.dishid=d.id and ot.paymentmode=p.id") or die(mysql_error());

                if (mysqli_num_rows($result) > 0) :
                    while ($row = mysqli_fetch_array($result)) {

                        $price = $row[0];
                        $quantity = $row[1];
                        $dish = $row[3];
                        $paymentmode = $row[5];
                        $discount = $row[6];
                        ?>

                        <tr>
                            <td align="left"  style="padding-left: 4px;"><?php echo $dish; ?></td>
                            <td align="center"><?php echo $quantity; ?></td>
                            <td align="right" style="padding-right: 3px;"><?php echo $price; ?></td>
                        </tr>

                        <?php
                    }

                endif;
                ?>
                <tr>
                    <th align="left"  colspan="2" style="padding-left: 4px;">Amount: </th>
                    <td align="right" style="padding-right: 3px;"><?php echo $amount; ?></td>
                </tr>

                <tr>
                    <th align="left"  colspan="2" style="padding-left: 4px;">Tax: </th>
                    <td align="right" style="padding-right: 3px;"><?php echo $tax . "%"; ?></td>
                </tr>

                <tr>
                    <th align="left"  colspan="2" style="padding-left: 4px;">VatTax: </th>
                    <td align="right" style="padding-right: 3px;"><?php echo $vattax . "%"; ?></td>
                </tr>

                <tr>
                    <th align="left"  colspan="2" style="padding-left: 4px;">Additional Service Tax: </th>
                    <td align="right" style="padding-right: 3px;"><?php echo $additionaltax . "%"; ?></td>
                </tr>
                <tr>
                    <th align="left"  colspan="2" style="padding-left: 4px;">Discount: </th>
                    <td align="right" style="padding-right: 3px;"><?php echo $discount . "%"; ?></td>
                </tr>

                <tr>
                    <th align="left"  colspan="2" style="padding-left: 4px;">Grand Total: </th>
                    <td align="right" style="padding-right: 3px;"><?php echo $grandtot; ?></td>
                </tr>
                <tr>
                    <th align="left"  width="50%" style="padding-left: 4px;">Payment Mode: </th>
                    <td colspan="2" align="center"><?php echo $paymentmode; ?></td>
                </tr>

            </table>
            <input type="submit" name="btnorder" value="Back To Order"/>
            <br/>
        </form>
    </body>
</html>

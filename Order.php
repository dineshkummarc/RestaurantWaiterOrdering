<?php
session_start();
include 'db.php';
if (isset($_SESSION['them'])) {
    $them = $_SESSION['them'] . ".php";
    include $them;
}
$getcurrency = mysqli_query($conn, "SELECT currency FROM settings");
$rowcurrency = mysqli_fetch_row($getcurrency);
$currency = $rowcurrency[0];

if(isset($_POST['btnrecall']))
{
    header("Location: Order.php");
}
?>
<!--<div id="vieworder">-->
<input type="hidden" id="page_name" value="order"/>
<div class="col-sm-9 col-sm-offset-3 col-md-12 col-md-offset-2 main">
    <h4 class="sub-header">View Order</h4>
 <form class="form-horizontal" role="form" method="POST">
     <input type="submit" id="btnrecall" name="btnrecall" value="Refresh" class="btn btn-default"> 
    <div class="col-sm-9 col-md-8  main">
        <div class="table-responsive">
            <table class="table table-striped" id="tbtable">
                <thead>
                    <tr>
                        <th>SrNo</th>
                        <th>Tablename</th>
                        <th>Orderid</th>
                        <th>Date/Time</th>
                        <th>Amount<?php echo " (" . $currency . ")"; ?></th>
                        <th>GrandTotal<?php echo " (" . $currency . ")"; ?></th>
                        <th>Status</th>
                        <th>View</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $currentdate = date('Y-m-d H:i:s');
                    $no = 1;
                    $result = mysqli_query($conn, "SELECT ot.id,ot.startdatetime,ot.status,ot.amount,ot.tableid,t.tablename,ot.grandtotal FROM ordertable ot,tablemaster t WHERE ot.tableid=t.id ORDER BY startdatetime DESC LIMIT 200") or die(mysql_error());
 //$result = mysqli_query($conn, "SELECT ot.id,ot.startdatetime,ot.status,ot.amount,ot.tableid,t.tablename FROM ordertable ot,tablemaster t WHERE ot.tableid=t.id AND DATE(`startdatetime`)= CURDATE();") or die(mysql_error());

                    if (mysqli_num_rows($result) > 0) :
                        while ($row = mysqli_fetch_array($result)) {
                            $startdatetime = $row[1];
                            $orderid = $row[0];
                            $status = $row[2];
                            $tableid = $row[4];
                            $tablenm = $row[5];
                            $amount = $row[3];
                            $grandtotal=$row[6];
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
                            ?>
                            <tr>

                                <td><?php echo $no ?></td>
                                <td><?php echo $tablenm; ?></td>
                                <td><?php echo $orderid; ?></td>  
                                <td><?php echo $startdatetime; ?></td>
                                <td><?php echo $amount; ?></td> 
                                 <td><?php echo $grandtotal; ?></td> 
                                <td><?php echo $status1; ?></td> 
                                <td><a href="viewOrderDetail.php?oid=<?php echo $orderid ?>">View Details</a></td> 

                            </tr>

                            <?php
                            $no++;
                        } endif;
                    ?>
                </tbody>
            </table>
        </div>
 </form>
    </div>
</div>
</div>

<?php
include 'footer.php';
?>
<!--<script type="text/javascript">
     $(document).ready(function () {

        $.ajaxSetup({cache: false}); // This part addresses an IE bug. without it, IE will only load the first number and will never refresh
        setInterval(function () {
          //  alert('hhh');
            $('#vieworder').load('Order.php');
        }, 90000); // the "3000" here refers to the time to refresh the div. it is in milliseconds.

    });
</script>-->
</body>
</html>



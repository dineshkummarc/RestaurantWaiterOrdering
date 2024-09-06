<?php
session_start();

if (isset($_SESSION['them'])) {
    $them = $_SESSION['them'] . ".php";
    include $them;
}
if (!isset($_SESSION['usr'])) {
    header("Location: index.php");
    die();
}
?>

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
 <input type="hidden" id="page_name" value="addpaymentmode"/>
    <h4 class="sub-header">Add New Paymentmode</h4>

    <form class="form-horizontal" role="form" action="addpaymentmodedb.php" method="POST">

        <div class="form-group">
            <label for="Paymentmode" class="col-sm-2 control-label">Paymentmode Type:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="paymentmodetype" name="paymentmodetype" placeholder="Enter Paymentmode Type" required>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-1 col-sm-8">
                <?php
                if (isset($_REQUEST['add_rdata'])):
                    if (!empty($_REQUEST['add_rdata'])):
                        $add_cdata = $_GET['add_rdata'];
                        if ('empty' == $add_cdata):
                            ?>
                            <div style="line-height: 1.7em;color:red;">Please Do Not Submit Empty Characters !!</div>

                            <?php
                        endif;

                        if ('success' == $add_cdata):
                            ?>
                            <div style="line-height: 1.7em;color:blue;">Paymentmode Added Successfully !!</div>

                            <?php
                        endif;

                        if ('failed' == $add_cdata):
                            ?>
                            <div style="line-height: 1.7em;color:red;">Server Error Please Try Again Later !!</div>

                            <?php
                        endif;

                    endif;

                endif;
                ?>

                <button type="submit" class="btn btn-default">Add Paymentmode</button>
            </div>
        </div>
    </form>
    <!--View Table-->
    <h4 class="sub-header">View Paymentmode</h4>
    <div class="col-sm-9 col-md-8  main">
        <div class="table-responsive">
            <table class="table table-striped" id="tbtable">
                <thead>
                    <tr>
                        <th>SrNo</th>

                        <th>Paymentmode Type</th>
                        <th>Delete Table</th>
                        <th>View / Update Table</th>

                    </tr>
                </thead>
                <tbody>

                    <?php
                    require 'db.php';
                    $result = mysqli_query($conn, "SELECT * FROM paymentmode") or die(mysql_error());
                    $no = 1;
                    if (mysqli_num_rows($result) > 0) :
                        while ($row = $result->fetch_assoc()) {
                            $id = $row["id"];
                            $tname = $row["type"];
                            ?>
                            <tr>

                                <td><?php echo $no; ?></td>                             
                                <td><?php echo $tname; ?></td>
                                <td><a href="deletePaymentmode.php?pid=<?php echo $id ?>">Delete</a></td> 
                                <td><a href="updatePaymentmode.php?pid=<?php echo $id ?>">View / Update</a></td> 
                            </tr>

        <?php
        $no++;
    } endif;
?>
                </tbody>
            </table>
        </div>
    </div>
    <!--End View Table-->

</div>

<?php
include 'footer.php';
?>

</body>
</html>
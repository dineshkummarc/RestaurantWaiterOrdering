<?php
session_start();
include 'db.php';
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
 <input type="hidden" id="page_name" value="settings"/>
    <h4 class="sub-header">Settings</h4>
    <?php
    $squery = mysqli_query($conn, "select * from settings where id='1'");
    $row = mysqli_fetch_array($squery);
    $sid = $row[0];
    $name = $row[1];
    $address = $row[2];
    $phone = $row[3];
    $currency = $row[4];
    $tax = $row[5];
    $vattax = $row[6];
    $additionaltax = $row[7];
    $discount = $row[8];
    ?>
    <form class="form-horizontal" action="settingsdb.php" role="form" method="POST">


        <div class="form-group">
            <input type="hidden" class="form-control" id="sid" name="sid"  value="<?php echo $sid; ?>">
            <label for="name" class="col-sm-2 control-label">Name:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="<?php echo $name; ?>" required>
            </div>
        </div>
        <div class="form-group">
            <label for="address" class="col-sm-2 control-label">Address:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address" value="<?php echo $address; ?>" required>
            </div>
        </div>

        <div class="form-group">
            <label for="phone" class="col-sm-2 control-label">Phone:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone" value="<?php echo $phone; ?>" required>
            </div>
        </div>

        <div class="form-group">
            <label for="currency" class="col-sm-2 control-label">Currency:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="currency" name="currency" placeholder="Enter Currency" value="<?php echo $currency; ?>" required>
            </div>
        </div>

        <div class="form-group">
            <label for="tax" class="col-sm-2 control-label">Tax:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="tax" name="tax" placeholder="Enter Tax(%)" value="<?php echo $tax; ?>" required>
            </div>
        </div>

        <div class="form-group">
            <label for="vattax" class="col-sm-2 control-label">Vat Tax:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="vattax" name="vattax" placeholder="Enter Vat Tax(%)" value="<?php echo $vattax; ?>" required>
            </div>
        </div>

        <div class="form-group">
            <label for="additionaltax" class="col-sm-2 control-label">Additional Service Tax:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="additionaltax" name="additionaltax" placeholder="Enter Additional Service Tax(%)" value="<?php echo $additionaltax; ?>" required>
            </div>
        </div>

        <div class="form-group">
            <label for="discount" class="col-sm-2 control-label">Discount:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="discount" name="discount" placeholder="Enter Discount(%)" value="<?php echo $discount; ?>" required>
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
                            <div style="line-height: 1.7em;color:blue;">User Added Successfully !!</div>

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
                <button type="submit" class="btn btn-default">Update</button>
            </div>
        </div>
    </form>


</div>
</div>
</div>
<?php include 'footer.php'; ?>

</body>
</html>
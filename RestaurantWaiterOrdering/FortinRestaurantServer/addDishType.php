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
   <input type="hidden" id="page_name"  value="adddishtype"/>
    <h4 class="sub-header">Add Dish Type</h4>

    <form class="form-horizontal" role="form" action="addDishTypedb.php" method="POST">

        <div class="form-group">
            <label for="DishType" class="col-sm-2 control-label">Dish Type Name:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="typename" name="typename" placeholder="Enter Dish Type Name" required>
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
                            <div style="line-height: 1.7em;color:blue;">Dish type Added Successfully !!</div>

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

                <button type="submit" class="btn btn-default">Add Dish Type</button>
            </div>
        </div>
    </form>
    <!--View Table-->
    <h4 class="sub-header">View Dish Type</h4>
    <div class="col-sm-9 col-md-8  main">
        <div class="table-responsive">
            <table class="table table-striped" id="tbtable">
                <thead>
                    <tr>
                        <th>SrNo</th>
                        <th>Type Name</th>
                        <th>Delete DishType</th>
                        <th>View / Update DishType</th>

                    </tr>
                </thead>
                <tbody>

<?php
require 'db.php';
$result = mysqli_query($conn, "SELECT * FROM dish_type") or die(mysql_error());
$no = 1;
if (mysqli_num_rows($result) > 0) :
    while ($row = $result->fetch_assoc()) {
        $id = $row["id"];
        $tname = $row["typename"];
        ?>
                            <tr>

                                <td><?php echo $no; ?></td>                             
                                <td><?php echo $tname; ?></td>
                                <td><a href="deleteDishType.php?typeid=<?php echo $id ?>">Delete</a></td> 
                                <td><a href="updateDishType.php?typeid=<?php echo $id ?>">View / Update</a></td> 
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
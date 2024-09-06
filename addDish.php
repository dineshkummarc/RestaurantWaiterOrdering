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
$getcurrency = mysqli_query($conn, "SELECT currency FROM settings");
$rowcurrency = mysqli_fetch_row($getcurrency);
$currency = $rowcurrency[0];
?>

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <input type="hidden" id="page_name" value="adddish"/>
    <h4 class="sub-header">Add New Dish</h4>

    <form class="form-horizontal" role="form" action="addDishdb.php" method="POST" enctype="multipart/form-data">

        <div class="form-group">
            <label for="dishname" class="col-sm-2 control-label">Dish Name:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="dishname" name="dishname" placeholder="Enter Dish Name" required>
            </div>
        </div>

        <div class="form-group">
            <label for="CuisineSelect" class="col-sm-2 control-label">Select Cuisine:</label>
            <div class="col-sm-4">
                <select name="cusineid" required>
                    <?php
                    require 'db.php';
                    $result = mysqli_query($conn, "SELECT * FROM cusine") or die(mysql_error());
                    if (mysqli_num_rows($result) > 0) :
                        while ($row = $result->fetch_assoc()) {
                            $cusineid = $row["id"];
                            $cname = $row["cusinename"];
                            ?>
                            <option value="<?php echo $cusineid; ?>"><?php echo $cname; ?></option>   
                            <?php
                        }
                    endif;
                    ?>

                </select>

            </div>
        </div>

        <div class="form-group">
            <label for="TypeSelect" class="col-sm-2 control-label">Select Type:</label>
            <div class="col-sm-4">
                <select name="typeid" required>
                    <?php
                    require 'db.php';
                    $result = mysqli_query($conn, "SELECT * FROM dish_type") or die(mysql_error());
                    if (mysqli_num_rows($result) > 0) :
                        while ($row = $result->fetch_assoc()) {
                            $typeid = $row["id"];
                            $tname = $row["typename"];
                            ?>
                            <option value="<?php echo $typeid; ?>"><?php echo $tname; ?></option>   
                            <?php
                        }
                    endif;
                    ?>

                </select>

            </div>
        </div>

        <div class="form-group">
            <label for="description" class="col-sm-2 control-label">Discription:</label>
            <div class="col-sm-4">

                <textarea class="form-control" id="discription" name="discription" placeholder="Enter Discription" cols="35" rows="5" required ></textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="price" class="col-sm-2 control-label">Price<?php echo " (In " . $currency . ")"; ?>:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="price" name="price" placeholder="Enter Price" required>
            </div>
        </div>

        <div class="form-group">
            <label for="ImageUpload" class="col-sm-2 control-label">Image:</label>
            <div class="col-sm-4">
                <input type="file" id="dishimage" name="dishimage" required>
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
                        if ('checkdishname' == $add_cdata):
                            ?>
                            <div style="line-height: 1.7em;color:red;">Dishname is already avaliable !!</div>

                            <?php
                        endif;
                        if ('success' == $add_cdata):
                            ?>
                            <div style="line-height: 1.7em;color:blue;">Dish Added Successfully !!</div>

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

                <button type="submit" class="btn btn-default">Add Dish</button>
            </div>
        </div>
    </form>
    <!--View Table-->
    <h4 class="sub-header">View Dish</h4>
    <div class="col-sm-10 col-md-12  main">
        <div class="table-responsive">
            <table class="table  table-striped" id="tbtable">
                <thead>
                    <tr>
                        <th>SrNo</th>
                        <th>Image</th>
                        <th>Dish Name</th>
                        <th>Cusine Name</th>
                        <th>Type Name</th>
                        <th>Discription</th>
                        <th>Price<?php echo " (" . $currency . ")"; ?></th>
                        <th>Delete Dish</th>
                        <th>View / Update Dish</th>

                    </tr>
                </thead>
                <tbody>

                    <?php
                    require 'db.php';
                    $query = "SELECT d.id,c.cusinename,d.dishname,d.dishimage,t.typename,d.description,d.price FROM dish d,dish_type t,cusine c where c.id=d.cusineid and t.id=d.dishtype";
                    $result = mysqli_query($conn, $query) or die(mysql_error());

                    $no = 1;
                    if (mysqli_num_rows($result) > 0) :
                        while ($row = mysqli_fetch_array($result)) {
                            $id = $row[0];
                            $name = $row[2];
                            $cusine = $row[1];
                            $desc = $row[5];
                            $type = $row[4];
                            $price = $row[6];
                            $image = $row[3];
                            $cphotourl = 'upload/' . $image;
                            ?>
                            <tr>

                                <td><center><?php echo $no; ?></center></td>  
                        <td><img src="<?php echo $cphotourl; ?>" height="50px" width="50px"></td> 
                        <td><?php echo $name; ?></td>
                        <td><?php echo $cusine; ?></td>
                        <td><?php echo $type; ?></td>

                        <td><?php echo $desc; ?></td>
                        <td><?php echo $price; ?></td>
                        <td><a href="deleteDish.php?dishid=<?php echo $id ?>">Delete</a></td> 
                        <td><a href="updateDish.php?dishid=<?php echo $id ?>">View / Update</a></td> 
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
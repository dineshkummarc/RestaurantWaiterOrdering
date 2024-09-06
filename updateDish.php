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
$dishid = '';
if (isset($_REQUEST['dishid'])):
    if (!empty($_REQUEST['dishid'])):
        $dishid = htmlspecialchars($_GET['dishid']);
    else:
        header("Location: updateDish.php?update=failed");
        die();
    endif;
else:
    header("Location: updateDish.php?update=failed");
    die();
endif;
?>

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <input type="hidden" id="page_name" value="adddish">                        
    <h4 class="sub-header">Update Dish</h4>

    <?php
    require 'db.php';
    $query = "SELECT d.id,c.cusinename,d.dishname,d.dishimage,t.typename,d.description,d.price,d.cusineid,d.dishtype FROM dish d,dish_type t,cusine c where c.id=d.cusineid and t.id=d.dishtype and d.id=" . $dishid;
    $result = mysqli_query($conn, $query) or die(mysql_error());

    $no = 1;
    if (mysqli_num_rows($result) > 0) :
        while ($row = mysqli_fetch_array($result)) {
            $id = $row[0];
            $dishname = $row[2];
            $cusinename = $row[1];
            $typename = $row[4];
            $cusionid = $row[7];
            $description = $row[5];
            $typeid = $row[8];
            $price = $row[6];
            $image = $row[3];
            $cphotourl = 'upload/' . $image;
        }
    endif;
    ?>

    <form class="form-horizontal" role="form" action="updateDishdb.php" method="POST" enctype="multipart/form-data">

        <div class="form-group">

            <div class="col-sm-4">
                <input type="hidden" class="form-control" id="dishid" name="dishid" value="<?php echo $id; ?>">
            </div>
        </div>

        <div class="form-group">
            <label for="dishname" class="col-sm-2 control-label">Dish Name:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="dishname" value="<?php echo $dishname; ?>" name="dishname" placeholder="Enter Dish Name" required>
            </div>
        </div>

        <div class="form-group">
            <label for="CuisineSelect" class="col-sm-2 control-label">Select Cusine:</label>
            <div class="col-sm-4">
                <select name="cusineid" value=<?php echo $cusionid; ?> required>
                    <?php
                    require 'db.php';
                    $result = mysqli_query($conn, "SELECT * FROM cusine") or die(mysql_error());
                    if (mysqli_num_rows($result) > 0) :
                        while ($row = $result->fetch_assoc()) {
                            $cusineid1 = $row["id"];
                            $cname = $row["cusinename"];
                            if ($cusionid == $cusineid1)
                                echo "<option selected value='$cusineid1'>$cname</option>";
                            else
                                echo "<option value='$cusineid1'>$cname</option>";
                        }
                    endif;
                    ?>

                </select>

            </div>
        </div>
        <div class="form-group">
            <label for="TypeSelect" class="col-sm-2 control-label">Select Type:</label>
            <div class="col-sm-4">
                <select name="typeid" value="<?php echo $typeid; ?>" required>
                    <?php
                    require 'db.php';
                    $result = mysqli_query($conn, "SELECT * FROM dish_type") or die(mysql_error());
                    if (mysqli_num_rows($result) > 0) :
                        while ($row = $result->fetch_assoc()) {
                            $typeid1 = $row["id"];
                            $tname = $row["typename"];
                            if ($typeid == $typeid1)
                                echo "<option selected value='$typeid1'>$tname</option>";
                            else
                                echo "<option value='$typeid1'>$tname</option>";
                        }
                    endif;
                    ?>

                </select>

            </div>
        </div>

        <div class="form-group">
            <label for="description" class="col-sm-2 control-label">Discription:</label>
            <div class="col-sm-4">

                <textarea class="form-control" id="description" name="description" placeholder="Enter Discription" cols="35" rows="5" required ><?php echo $description; ?></textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="price" class="col-sm-2 control-label">Price</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="price" value="<?php echo $price; ?>" name="price" placeholder="Enter Price" required>
            </div>
        </div>

        <div class="form-group">
            <label for="ImageUpload" class="col-sm-2 control-label">Image:</label>
            <div class="col-sm-4">
                <input type="file" id="dishimage" name="dishimage" value="<?php echo $image; ?>">
                <img src="<?php echo $cphotourl; ?>" height="50px" width="50px">
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
                            <div style="line-height: 1.7em;color:blue;">Cusine Updated Successfully !!</div>

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

                <button type="submit" class="btn btn-default">Update Cusine</button>
            </div>
        </div>
    </form>
</div>


<?php include 'footer.php'; ?>


</body>
</html>

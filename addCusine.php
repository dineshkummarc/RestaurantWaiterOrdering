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
 <input type="hidden" id="page_name" value="addcusine"/>
    <h4 class="sub-header">Add New Cuisine - C+O+D+E+L+I+S+T+.+C+C</h4>

    <form class="form-horizontal" role="form" action="addCusinedb.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="Cuisine" class="col-sm-2 control-label">Cuisine Name:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="cusinename" name="cusinename" placeholder="Enter Cusine Name" required>
            </div>
        </div>

        <div class="form-group">
            <label for="ImageUpload" class="col-sm-2 control-label">Image:</label>
            <div class="col-sm-4">
                <input type="file" id="cusineimage" name="cusineimage" required>
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
                            <div style="line-height: 1.7em;color:blue;">Cuisine Added Successfully !!</div>

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

                <button type="submit" class="btn btn-default">Add Cuisine</button>
            </div>
        </div>
    </form>

    <h4 class="sub-header">View Cuisine</h4>
    <?php
    if (isset($_REQUEST['delete'])):
        if (!empty($_REQUEST['delete'])):
            $add_cdata = $_GET['delete'];

            if ('exists' == $add_cdata):
                ?>

                <div style="line-height: 1.7em;color:red;">Cannot Delete As Dish are Mapped To This Cuisine !!</div>
                <?php
            endif;

        endif;
    endif;
    ?>

    <div class="col-sm-9 col-md-8  main">
        <div class="table-responsive">
            <table class="table table-striped" id="tbtable">
                <thead>
                    <tr>
                        <th>SrNo</th>

                        <th>Cuisine Photo</th>
                        <th>Cuisine Name</th>
                        <th>Delete Cusine</th>
                        <th>View/Update Cusine</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    require 'db.php';
                    $no = 1;
                    $result = mysqli_query($conn, "SELECT * FROM cusine") or die(mysql_error());
                    if (mysqli_num_rows($result) > 0) :
                        while ($row = $result->fetch_assoc()) {
                            $id = $row["id"];
                            $cname = $row["cusinename"];
                            $cphoto = $row["cusineimage"];
                            $cphotourl = 'upload/' . $cphoto;
                            ?>
                            <tr>

                                <td><?php echo $no; ?></td>

                                <td><img src="<?php echo $cphotourl; ?>" height="50px" width="50px"></td>  
                                <td><?php echo $cname; ?></td>
                                <td><a href="deleteCusine.php?cid=<?php echo $id ?>">Delete</a></td> 
                                <td><a href="updateCusine.php?cid=<?php echo $id ?>">View/Update</a></td> 

                            </tr>

                            <?php
                            $no++;
                        } endif;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?php
include 'footer.php';
?>

</body>
</html>
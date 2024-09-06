<?php
session_start();
include 'db.php';
if (isset($_SESSION['them'])) {
    $them = $_SESSION['them'] . ".php";
    include $them;
}
?>

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <input type="hidden" id="page_name" value="uploadcsv"/>
    <h4 class="sub-header">  Upload new csv by browsing to file and clicking on Upload<br /></h4>

    <?php
    if (isset($_POST['submit'])) {
        if ($_POST['cmbchoice'] == "yes") {
            mysqli_query($conn, "TRUNCATE TABLE dish");
        }
        //Upload File
        if (is_uploaded_file($_FILES['filename']['tmp_name'])) {

            echo "<h5>" . "File " . $_FILES['filename']['name'] . " uploaded successfully." . "</h5>";
            header("Location:uploadCSV.php");
            //  echo "<h2>Displaying contents:</h2>";
            //readfile($_FILES['filename']['tmp_name']);
        }

        //Import uploaded file to Database

        $handle = fopen($_FILES['filename']['tmp_name'], "r");


        $i = 0;
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

            if ($i == 0) {
                $i++;
                continue;
            } else {
                $i++;
            }
// print_r($data);
//            echo "<br/>";
            $cusinename = ucfirst($data[0]);
            $cusineimage = $data[1];
            $dishname = ucfirst($data[2]);
            $dishimage = $data[3];
            $typename = ucfirst($data[4]);
            $desc = $data[5];
            $price = $data[6];
            if ($cusineimage == '')
                $cusineimage = 'noimage.png';
            if ($dishimage == '')
                $dishimage = 'noimage.png';

            //check cusine
            $checkcusine = mysqli_query($conn, "SELECT id,cusinename FROM cusine where cusinename='$cusinename'");
            if (mysqli_num_rows($checkcusine) > 0) {
                $rowcusine = mysqli_fetch_row($checkcusine);
                $cusine_id = $rowcusine[0];
                $cusinenm = $rowcusine[1];
            } else {
                //insert cusine
                $cusinequery = "INSERT INTO `cusine`(cusinename,cusineimage) VALUES ('$cusinename','$cusineimage')";
                mysqli_query($conn, $cusinequery);
                $cusine_id = mysqli_insert_id($conn);
            }
            //check dishtype
            $checkdishtype = mysqli_query($conn, "SELECT * FROM dish_type where typename='$typename'");
            if (mysqli_num_rows($checkdishtype) > 0) {
                $rowdishtype = mysqli_fetch_row($checkdishtype);
                $dishtype_id = $rowdishtype[0];
                $typenm = $rowdishtype[1];
            } else {
                //insert dishtype
                $dishtypequery = "INSERT INTO `dish_type`(typename) VALUES('$typename')";
                mysqli_query($conn, $dishtypequery);
                $dishtype_id = mysqli_insert_id($conn);
            }
            //check dish
            $checkdish = mysqli_query($conn, "SELECT * FROM dish where dishname='$dishname'");
            if (mysqli_num_rows($checkdish) > 0) {
                continue;
            } else {
                //insert dish
                $dishquery = "INSERT INTO `dish`(cusineid,dishname,dishimage,dishtype,description,price) VALUES ('$cusine_id','$dishname','$dishimage','$dishtype_id','$desc','$price')";
                mysqli_query($conn, $dishquery);
            }
        }

        die();

        fclose($handle);
        echo "Import done";

        //view upload form
    } else {
        ?>

        <form name='form1' class="form-horizontal" role="form" enctype='multipart/form-data' action='uploadCSV.php' method='post'>
            <div class="form-group">
                <label for="file" class="col-sm-2 control-label">File Name:</label>
                <div class="col-sm-4">
                    <input type="file" name="filename">
                </div>
            </div>

            <div class="form-group">
                <label for="file" class="col-sm-2 control-label">Select:</label>
                <div class="col-sm-4">
                    <select name="cmbchoice">
                        <option value="yes">Delete & Upload Dish</option>
                        <option value="no">Update dish in existing data</option>   
                    </select>
                </div>
            </div>

            <input type="hidden" name="deletedata" value="no">

            <div class="form-group">

                <div class="col-sm-4 "><center>

                        <input type='submit' name='submit' value='Upload' class="btn btn-default"></center>
                    
                </div>
            </div>


            <?php
        }
        ?>
    </form>

    <form method="get" action="upload/restaurant.csv">
       
        <button type="submit" class="btn btn-link">Download CSV Demo File</button>
        
    </form>
</div>

<?php include 'footer.php'; ?>
</body>
</html>

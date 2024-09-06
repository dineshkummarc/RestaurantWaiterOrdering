<?php
$tbstatus = $_REQUEST['tbstatus'];
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
 <input type="hidden" id="page_name" value="addtable"/>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <!--View Table-->
    <h4 class="sub-header">View Tables</h4>
    <div class="col-sm-9 col-md-5  main">
        <div class="table-responsive">
            <table class="table table-striped" id="tbtable">
                <thead>
                    <tr>
                        <th>SrNo</th>
                        <th>Table Name</th>

                    </tr>
                </thead>
                <tbody>

                    <?php
                    require 'db.php';
                    $result = mysqli_query($conn, "SELECT * FROM tablemaster WHERE tablestatus='$tbstatus';") or die(mysql_error());
                    $no = 1;
                    if (mysqli_num_rows($result) > 0) :
                        while ($row = $result->fetch_assoc()) {
                            $id = $row["id"];
                            $tname = $row["tablename"];
                            ?>
                            <tr>

                                <td><?php echo $no; ?></td>                             
                                <td><?php echo $tname; ?></td>

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

    <?php
    include 'footer.php';
    ?>

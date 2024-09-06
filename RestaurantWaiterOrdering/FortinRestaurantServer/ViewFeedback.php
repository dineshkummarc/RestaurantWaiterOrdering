<?php
session_start();
include 'db.php';
if (isset($_SESSION['them'])) {
    $them = $_SESSION['them'] . ".php";
    include $them;
}
?>
<input type="hidden" id="page_name" value="viewfeedback"/>
<div class="col-sm-9 col-sm-offset-3 col-md-12 col-md-offset-2 main">

    <h4 class="sub-header">View Feedback</h4>

    <div class="col-sm-9 col-md-8  main">

        <div class="table-responsive">
            <table class="table table-striped" id="tbtable">
                <thead>
                    <tr>
                        <th>SrNo</th>

                        <th>Customer Name</th>
                        <th>Phone</th>
                        <th>UserName</th>
                        <th>Rating</th>
                        <th>Comment</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $feedbackquery = mysqli_query($conn, "SELECT f.*,u.username FROM feedback f,ordertable ot,usermaster u where f.orderid=ot.id and ot.userid=u.id");
                    if (mysqli_num_rows($feedbackquery)) {
                        while ($rowfeedback = mysqli_fetch_array($feedbackquery)) {
                            $feedbackid = $rowfeedback[0];
                            $customernm = $rowfeedback[1];
                            $phone = $rowfeedback[2];
                            $rating = $rowfeedback[3];
                            $comment = $rowfeedback[4];
                            $orderid = $rowfeedback[5];
                            $usernm = ucfirst($rowfeedback[6]);
                            if ($customernm == "")
                                $customernm = "No Customer Name";

                            if ($phone == "")
                                $phone = "No Customer Phone";
                            ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $customernm; ?></td>
                                <td><?php echo $phone; ?></td>
                                <td><?php echo $usernm; ?></td>
                                <td><?php echo $rating . "/5"; ?></td>
                                <td><?php echo $comment; ?></td>
                            </tr>
        <?php
        $no++;
    }
}
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
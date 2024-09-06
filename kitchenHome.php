<?php
session_start();
include 'db.php';
if (isset($_SESSION['them'])) {
    $them = $_SESSION['them'] . ".php";
    include $them;
}
$st = '';
if (isset($_REQUEST['kid'])) {
    $status = $_REQUEST['status'];
    $id = $_REQUEST['kid'];
    if ($status == "0") {
        $status = "1";
    } else if ($status == "1") {
        $status = "2";
    } else if ($status = "2") {
        $status = "2";
    }
    $updatestatus = "UPDATE orderdetails SET status='$status' WHERE id='$id'";
    mysqli_query($conn, $updatestatus);
}
?>
<!--    <div id="kitchen">-->
<input type="hidden" id="page_name" name="kitchenhome" value="kitchenhome"/>
<div class="col-sm-7 col-sm-offset-2 col-md-8 col-md-offset-2 main">
    <div class="container">
        <div class="page-header">
            <h3 class="page-header">Kitchen - C/O/D/E/L/I/S/T/./C/C</h3>
            <h4 class="sub-header">View Order</h4>
        </div>
        <div class="form-group">
            <label for="New Order" class="col-sm-2 control-label" style="background-color:#3CB371">New Order</label>
            <label for="Received Order" class="col-sm-2 control-label" style="background-color:#FF9912">Received Order</label>
            <label for="Served Order" class="col-sm-2 control-label" style="background-color:#ff6347">Served Order</label>
        </div> 
        <div class="row">
            <div class="col-md-11">
                <div class="panel with-nav-tabs panel-primary">
                    <div class="panel-heading">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab1primary" data-toggle="tab">New Order</a></li>
                            <li><a href="#tab2primary" data-toggle="tab">Served Order</a></li>
                        </ul>
                    </div>
                    <div class="panel-body">
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="tab1primary">
                                <a href="kitchenHome.php" class="btn btn-circle"> <span class="glyphicon glyphicon-refresh"> Refresh</span></a>
                                <div class="col-sm-9 col-md-12  main">
                                    <div class="table-responsive" >
                                        <table class="table" id="tbkitchen">
                                            <thead>
                                                <tr>
                                                    <th>SrNo</th>
                                                    <th>Orderid</th>
                                                    <th>UserName</th>
                                                    <th>TableName</th>
                                                    <th>Dish Name</th>
                                                    <th>Quantity</th>
                                                    <th>Status</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                $query = "select od.id,od.dishid,od.quantity,od.status,od.orderid,d.dishname,u.username,t.tablename from orderdetails od,dish d,ordertable ot,usermaster u,tablemaster t where od.dishid=d.id and ot.userid=u.id and ot.tableid=t.id and od.orderid=ot.id ORDER BY od.status";
                                                $result = mysqli_query($conn, $query);
                                                if (mysqli_num_rows($result) > 0) {
                                                    while ($row = mysqli_fetch_array($result)) {
                                                        $orderdetailid = $row[0];
                                                        $dishid = $row[1];
                                                        $quantity = $row[2];
                                                        $status = $row[3];
                                                        $orderid = $row[4];
                                                        $dishname = $row[5];
                                                        $uname = $row[6];
                                                        $tablename = $row[7];
                                                        if ($status == "0") {
                                                            $st = "New";
                                                            $color = "#3CB371";
                                                        } else if ($status == "1") {
                                                            $st = "Received";
                                                            $color = "#FF9912";
                                                        } else if ($status = "2") {
                                                            $st = "Served";
                                                            $color = "#ff6347";
                                                            continue;
                                                        } else if ($status = "3") {
                                                            $st = "Cancel";
                                                        }
                                                        ?>
                                                        <tr id="" style="color:#ffff;background-color: <?php echo $color; ?>">
                                                            <td><?php echo $no; ?></td>
                                                            <td><?php echo $orderid; ?></td>
                                                            <td><?php echo $uname; ?></td> 
                                                            <td><?php echo $tablename; ?></td> 
                                                            <td><?php echo $dishname; ?></td>
                                                            <td><?php echo $quantity; ?></td> 
                                                            <td><a href="kitchenHome.php?kid=<?php echo $orderdetailid; ?>&status=<?php echo $status; ?>" class="btn btn-danger"><?php echo $st; ?></a></td>
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
                            <div class="tab-pane fade" id="tab2primary">
                                <div class="col-sm-9 col-md-12  main">
                                    <div class="table-responsive" >
                                        <table class="table" id="tbkitchen1">
                                            <thead>
                                                <tr>
                                                    <th>SrNo</th>
                                                    <th>Orderid</th>
                                                    <th>UserName</th>
                                                    <th>TableName</th>
                                                    <th>Dish Name</th>
                                                    <th>Quantity</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                $query = "select od.id,od.dishid,od.quantity,od.status,od.orderid,d.dishname,u.username,t.tablename from orderdetails od,dish d,ordertable ot,usermaster u,tablemaster t where od.dishid=d.id and ot.userid=u.id and ot.tableid=t.id and od.orderid=ot.id and od.status=2 ORDER BY od.status";
                                                $result = mysqli_query($conn, $query);
                                                if (mysqli_num_rows($result) > 0) {
                                                    while ($row = mysqli_fetch_array($result)) {
                                                        $orderdetailid = $row[0];
                                                        $dishid = $row[1];
                                                        $quantity = $row[2];
                                                        $status = $row[3];
                                                        $orderid = $row[4];
                                                        $dishname = $row[5];
                                                        $uname = $row[6];
                                                        $tablename = $row[7];
                                                        if ($status = "2") {
                                                            $st = "Served";
                                                            $color = "#ff6347";
                                                        } else if ($status = "3") {
                                                            $st = "Cancel";
                                                        }
                                                        ?>
                                                        <tr id="" style="color:#ffff;background-color: <?php echo $color; ?>">
                                                            <td><?php echo $no; ?></td>
                                                            <td><?php echo $orderid; ?></td>
                                                            <td><?php echo $uname; ?></td> 
                                                            <td><?php echo $tablename; ?></td> 
                                                            <td><?php echo $dishname; ?></td>
                                                            <td><?php echo $quantity; ?></td> 
                                                            <td><a href="#" class="btn btn-danger"><?php echo $st; ?></a></td>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Bootstrap core JavaScript
   ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script type="text/javascript" src="js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/dataTables.bootstrap.js"></script>
<script type="text/javascript">

//    $(document).ready(function() {
////        $.ajaxSetup({cache: false}); // This part addresses an IE bug. without it, IE will only load the first number and will never refresh
////        setInterval(function() {
////            $('#kitchen').load('kitchenHome.php');
////        }, 90000); // the "3000" here refers to the time to refresh the div. it is in milliseconds.
//
//    });

    $(document).ready(function() {
        var page_name = document.getElementById("page_name").value;
        $("#" + page_name).addClass("active");
    });
    $(document).ready(function() {
        $('#tbkitchen').dataTable();
        $('#tbkitchen1').dataTable();
    });
</script>
</body>
</html>
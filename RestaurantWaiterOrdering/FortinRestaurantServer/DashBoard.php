<?php
session_start();
if (isset($_SESSION['them'])) {
    $them = $_SESSION['them'] . ".php";
    include $them;
}
include 'db.php';
//active table count
$activequery = mysqli_query($conn, "SELECT count(id) FROM `tablemaster` WHERE tablestatus='1'");
$activerow = mysqli_fetch_row($activequery);
$totactive = $activerow[0];
//inactive table count
$inactivequery = mysqli_query($conn, "SELECT count(id) FROM `tablemaster` WHERE tablestatus='0'");
$inactiverow = mysqli_fetch_row($inactivequery);
$totinactive = $inactiverow[0];
//pending order count
$pendingorder = mysqli_query($conn, "SELECT count(id) FROM `ordertable` WHERE DATE(`startdatetime`)= CURDATE() and status='1'");
$pendingrow = mysqli_fetch_row($pendingorder);
$totpending = $pendingrow[0];
//received order count
$receivedorder = mysqli_query($conn, "SELECT count(id) FROM `ordertable` WHERE DATE(`startdatetime`)= CURDATE()");
$receivedrow = mysqli_fetch_row($receivedorder);
$totreceived = $receivedrow[0];
?>
<head>
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">
</head>
<input type="hidden" id="page_name" name="dashboard" value="dashboard">
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Dashboard - c_o_d_e_l_i_s_t_._c_c</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!--             /.row -->
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <img src="upload/order.jpg" height="60" width="60"/>
<!--                                    <i class="fa fa-comments fa-5x"></i>-->
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $totpending; ?></div>
                            <div>Pending Order</div>
                        </div>
                    </div>
                </div>
                <a href="Order.php">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <img src="upload/order.jpg" height="60" width="60"/>
<!--                                    <i class="fa fa-support fa-5x"></i>-->
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $totreceived; ?></div>
                            <div>Total Order</div>
                        </div>
                    </div>
                </div>
                <a href="Order.php">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <img src="upload/inactivetb.jpg" height="60" width="60"/>
<!--                                    <i class="fa fa-tasks fa-5x"></i>-->
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $totinactive; ?></div>
                            <div>InActive Tables</div>
                        </div>
                    </div>
                </div>
                <a href="ViewTables.php?tbstatus=0">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
<!--                                    <i class="fa fa-shopping-cart fa-5x"></i>-->
                            <img src="upload/active.jpg" height="60" width="60"/>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $totactive; ?></div>
                            <div>Active Tables</div>
                        </div>
                    </div>
                </div>
                <a href="ViewTables.php?tbstatus=1">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

    </div>

</div>
<?php
include 'footer.php';
?>
</body>
</html>

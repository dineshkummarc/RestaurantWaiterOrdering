<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../favicon.ico">

        <title>Fortin Restaurant</title>

        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="css/dashboard.css" rel="stylesheet">
        <link href="css/dataTables.bootstrap.css" rel="stylesheet">
        <link href="css/bootstrap-theme-panel.css" rel="stylesheet" type="text/css">

        <!-- MetisMenu CSS -->
        <link href="bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    </head>

    <body>

        <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Fortin Restaurant</a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="logout.php">Logout</a></li>

                    </ul>

                </div>
            </div>
        </div>

        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-3 col-md-2 sidebar navbar-collapse collapse">

                    <ul class="nav nav-sidebar">
<!--                        <li id="superadminpanel"><a href="#"><b>Super Admin Panel</b></a></li>-->
                        <li id="dashboard"><a href="DashBoard.php">DashBoard</a></li>
                        <li id="kitchenhome"><a href="kitchenHome.php">Kitchen Home</a></li>
                        <li id="order"><a href="Order.php">Order</a></li>
                        <li id="addtable"><a href="addTable.php">Manage Table</a></li>
                        <li id="adduser"><a href="addUser.php">Manage Member</a></li>
                        <li id="addcusine"><a href="addCusine.php">Manage Cusine</a></li>
                        <li id="adddish"><a href="addDish.php">Manage Dish</a></li>
                        <li id="adddishtype"><a href="addDishType.php">Manage Dish Type</a></li>
                        <li id="addpaymentmode"><a href="addpaymentmode.php">Manage Paymentmode</a></li>
                        <li id="uploadcsv"><a href="uploadCSV.php">Upload CSV</a></li>
                        <li id="report"><a href="report.php">Report</a></li>
                        <li id="viewfeedback"><a href="ViewFeedback.php">View Feedbacks</a></li>
                        <li id="settings"><a href="settings.php">Settings</a></li>
                    </ul>
                </div>

            </div>


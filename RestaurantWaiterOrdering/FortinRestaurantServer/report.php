<?php
session_start();
include 'db.php';
if (isset($_SESSION['them'])) {
    $them = $_SESSION['them'] . ".php";

    include $them;
}
$getcurrency = mysqli_query($conn, "SELECT currency FROM settings");
$rowcurrency = mysqli_fetch_row($getcurrency);
$currency = $rowcurrency[0];
?>
<link href="datepicker/css/datepicker.css" rel="stylesheet">
<div class="col-sm-9 col-sm-offset-3 col-md-12 col-md-offset-2 main">
 <input type="hidden" id="page_name" value="report"/>
    <h4 class="sub-header">Search Order</h4>

    <form  role="form" method="POST">


        Start Date:  <input type="text"  id="startdate" name="startdate" class="span2" data-date-format="mm/dd/yy" >

        End Date:   <input type="text"  id="enddate" name="enddate" class="span2" data-date-format="mm/dd/yy">
        <input type="submit" id="btnsubmit" name="btnsubmit" value="Search" class="btn btn-default">
        <input type="submit" id="btnexport" name="btnexport" value="Export To CSV" class="btn btn-default">



    </form>


    <div class="col-sm-9 col-md-8  main">
        <div class="table-responsive">
            <table class="display table table-striped" id="tboreder">
                <thead>
                    <tr>
                        <th>SrNo</th>

                        <th>Orderid</th>
                        <th>Date/Time</th>
                        <th>Amount<?php echo " (" . $currency . ")"; ?></th>
                        <th>Status</th>
                        <th>View Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($_POST['btnsubmit'])) {
                        $st_date = date("Y-m-d H:i:s", strtotime($_POST['startdate']));
                        $en_date = date("Y-m-d H:i:s", strtotime($_POST['enddate']));
                        $result = mysqli_query($conn, "SELECT * FROM ordertable WHERE startdatetime BETWEEN '$st_date' AND '$en_date';");
                    } else
                        $result = mysqli_query($conn, "SELECT * FROM ordertable;");

                    $no = 1;

                    if (mysqli_num_rows($result) > 0) :
                        while ($row = $result->fetch_assoc()) {
                            $startdatetime = $row["startdatetime"];
                            $orderid = $row["id"];
                            $status = $row["status"];
                            $amount = $row["amount"];
                            if ($status == "0")
                                $status1 = "Unpaid";
                            else if ($status == "1")
                                $status1 = "Process";
                            else if ($status == "2")
                                $status1 = "Paid";
                            else if ($status == "3")
                                $status1 = "Finish";
                            else
                                $status1 = "Cancel";
                            ?>
                            <tr>

                                <td><?php echo $no; ?></td>

                                <td><?php echo $orderid; ?></td>  
                                <td><?php echo $startdatetime; ?></td>
                                <td><?php echo $amount; ?></td> 
                                <td><?php echo $status1; ?></td> 
                                <td><a href="orderDetail.php?oid=<?php echo $orderid ?>">View Details</a></td>

                            </tr>

                            <?php
                            $no++;
                        } endif;
                    ?>
                </tbody>
            </table>
        </div>
        <div id="testdiv" style="visibility: hidden;"> </div>
    </div>

</div>


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script type="text/javascript" src="js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/dataTables.bootstrap.js"></script>
<script src="js/bootstrap-datepicker.js"></script>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function () {
        $('#tboreder').dataTable();
        $('#startdate').datepicker({
            format: "yyyy-mm-dd"
        });
        $('#enddate').datepicker({
            format: "yyyy-mm-dd"

        });
    });
    
          $(document).ready(function() {          
            var page_name = document.getElementById("page_name").value; 
            $("#"+page_name).addClass("active");          
    });

    //Export To CSV
    function table2csv(oTable, exportmode, tableElm) {
        // alert('fun call');
        var csv = '';
        var headers = [];
        var rows = [];

        // Get header names
        $(tableElm + ' thead').find('th').each(function () {
            var $th = $(this);
            var text = $th.text();
            var header = '"' + text + '"';
            // headers.push(header); // original code
            if (text != "")
                headers.push(header); // actually datatables seems to copy my original headers so there ist an amount of TH cells which are empty
        });
        csv += headers.join(',') + "\n";

        // get table data
        if (exportmode == "full") { // total data
            var total = oTable.fnSettings().fnRecordsTotal()
            for (i = 0; i < total; i++) {
                var row = oTable.fnGetData(i);
                row = strip_tags(row);
                rows.push(row);
            }
        } else { // visible rows only
            $(tableElm + ' tbody tr:visible').each(function (index) {
                var row = oTable.fnGetData(this);
                row = strip_tags(row);
                rows.push(row);
            })
        }
        csv += rows.join("\n");

        // if a csv div is already open, delete it
        if ($('.csv-data').length)
            $('.csv-data').remove();
        // open a div with a download link


        $('#testdiv').append('<div class="csv-data"><form enctype="multipart/form-data" method="post" action="csv.php"><textarea class="form" name="csv">' + csv + '</textarea><input type="submit" id="csvdownload" class="submit" value="Download as file" /></form></div>');

    }

    function strip_tags(html) {
        var tmp = document.createElement("div");
        tmp.innerHTML = html;
        return tmp.textContent || tmp.innerText;
    }

// export only what is visible right now (filters & paginationapplied)
    $('#btnexport').click(function (event) {
        event.preventDefault();
        var oTable = $('table.display').dataTable();
        console.log(oTable);
        table2csv(oTable, 'full', 'table.display');
        $('#csvdownload').trigger('click');
        //csvdownload
    })



    $(document).ready(function () {
        var asInitVals = new Array();

    });



</script>


</body>
</html>

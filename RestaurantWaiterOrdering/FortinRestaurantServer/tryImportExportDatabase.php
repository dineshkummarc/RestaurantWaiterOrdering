<?php
if (isset($_POST['btnimport'])) {
//ENTER THE RELEVANT INFO BELOW
    $mysqlDatabaseName = 'restaurant';
    $mysqlUserName = 'root';
    $mysqlPassword = '';
    $mysqlHostName = 'localhost';
    $mysqlImportFilename = 'restaurant1.sql';

//DO NOT EDIT BELOW THIS LINE
//Export the database and output the status to the page
    $command = 'mysql -h' . $mysqlHostName . ' -u' . $mysqlUserName . ' -p' . $mysqlPassword . ' ' . $mysqlDatabaseName . ' < ' . $mysqlImportFilename;
    exec($command, $output = array(), $worked);
    switch ($worked) {
        case 0:
            echo 'Import file <b>' . $mysqlImportFilename . '</b> successfully imported to database <b>' . $mysqlDatabaseName . '</b>';
            break;
        case 1:
            echo 'There was an error during import. Please make sure the import file is saved in the same folder as this script and check your values:<br/><br/><table><tr><td>MySQL Database Name:</td><td><b>' . $mysqlDatabaseName . '</b></td></tr><tr><td>MySQL User Name:</td><td><b>' . $mysqlUserName . '</b></td></tr><tr><td>MySQL Password:</td><td><b>NOTSHOWN</b></td></tr><tr><td>MySQL Host Name:</td><td><b>' . $mysqlHostName . '</b></td></tr><tr><td>MySQL Import Filename:</td><td><b>' . $mysqlImportFilename . '</b></td></tr></table>';
            break;
    }
}

if (isset($_POST['btnexport'])) {
    //ENTER THE RELEVANT INFO BELOW
    $mysqlDatabaseName = 'restaurant';
    $mysqlUserName = 'root';
    $mysqlPassword = '';
    $mysqlHostName = 'localhost';
    $mysqlExportPath = 'upload/restaurant1.sql';

//DO NOT EDIT BELOW THIS LINE
//Export the database and output the status to the page
    $command = 'mysqldump --opt -h ' . $mysqlHostName . ' -u' . $mysqlUserName . ' -p' . $mysqlPassword . ' ' . $mysqlDatabaseName . ' > ~/' . $mysqlExportPath;
    //echo $command;die;
    exec($command, $output = array(), $worked);
    switch ($worked) {
        case 0:
            echo 'Database <b>' . $mysqlDatabaseName . '</b> successfully exported to <b>~/' . $mysqlExportPath . '</b>';
            break;
        case 1:
            echo 'There was a warning during the export of <b>' . $mysqlDatabaseName . '</b> to <b>~/' . $mysqlExportPath . '</b>';
            break;
        case 2:
            echo 'There was an error during export. Please check your values:<br/><br/><table><tr><td>MySQL Database Name:</td><td><b>' . $mysqlDatabaseName . '</b></td></tr><tr><td>MySQL User Name:</td><td><b>' . $mysqlUserName . '</b></td></tr><tr><td>MySQL Password:</td><td><b>NOTSHOWN</b></td></tr><tr><td>MySQL Host Name:</td><td><b>' . $mysqlHostName . '</b></td></tr></table>';
            break;
    }
}
?>
<html>
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <form method="POST">
            <input type="submit" name="btnimport" id="btnimport" value="Import"><br/>
            <input type="submit" name="btnexport" id="btnexport" value="Export"><br/>
        </form>
    </body>
</html>


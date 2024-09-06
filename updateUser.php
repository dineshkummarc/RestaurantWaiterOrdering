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
$tableid = '';
if (isset($_REQUEST['uid'])):
    if (!empty($_REQUEST['uid'])):
        $uid = htmlspecialchars($_GET['uid']);
    else:
        header("Location:updateUser.php?update=failed");
        die();
    endif;
else:
    header("Location: updateUser.php?update=failed");
    die();
endif;
?>

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <input type="hidden" id="page_name" value="adduser">                             
    <h4 class="sub-header">Update User</h4>

    <?php
    require 'db.php';
    $result = mysqli_query($conn, "SELECT * FROM usermaster where id=" . $uid) or die(mysql_error());
    if (mysqli_num_rows($result) > 0) :
        while ($row = $result->fetch_assoc()) {
            $id = $row["id"];
            $username = $row["username"];
            $password = $row["password"];
            $role = $row["role"];
        }

    endif;
    ?>

    <form id="form1" class="form-horizontal" role="form" action="updateUserdb.php" method="POST">

        <div class="form-group">
            <!-- <label for="User" class="col-sm-2 control-label">User Id:</label>-->
            <div class="col-sm-4">
                <input type="hidden" class="form-control" id="uid" name="uid" placeholder="" value="<?php echo $id; ?>">
            </div>
        </div>

        <div class="form-group">
            <label for="Username" class="col-sm-2 control-label">User Name:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>" placeholder="Enter User Name" required>
            </div>
        </div>

        <div class="form-group">
            <label for="Pwd" class="col-sm-2 control-label">Password:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="password" name="password" value="<?php echo $password; ?>" placeholder="Enter Password">
            </div>
        </div>
        <?php
        if ($role != "superadmin") {
            ?>
            <div class="form-group">
                <label for="Role" class="col-sm-2 control-label">Select Role:</label>
                <div class="col-sm-4">
                    <select id="role" name="role">
                        <?php
                        if ($role == "admin") {
                            echo '<option selected value="admin">Admin</option>';
                            echo '<option  value="accountmanager">Account Manager</option>';
                            echo '<option value="kitchenmanager">Kitchen Manager</option>';
                            echo '<option  value="user">User(Waiter)</option>';
                        }
                        if ($role == "accountmanager") {
                            echo '<option value="admin">Admin</option>';
                            echo '<option selected  value="accountmanager">Account Manager</option>';
                            echo '<option value="kitchenmanager">Kitchen Manager</option>';
                            echo '<option  value="user">User(Waiter)</option>';
                        }
                        if ($role == "kitchenmanager") {
                            echo '<option value="admin">Admin</option>';
                            echo '<option  value="accountmanager">Account Manager</option>';
                            echo '<option selected  value="kitchenmanager">Kitchen Manager</option>';
                            echo '<option  value="user">User(Waiter)</option>';
                        }
                        if ($role == "user") {
                            echo '<option value="admin">Admin</option>';
                            echo '<option  value="accountmanager">Account Manager</option>';
                            echo '<option   value="kitchenmanager">Kitchen Manager</option>';
                            echo '<option selected value="user">User(Waiter)</option>';
                        }
                        ?>

                    </select>
                </div>
            </div>
                        <?php
                    }
                    else
                        echo "<input type='hidden' name='role' value='superadmin'>";
                    ?>


        <div class="form-group">
            <div class="col-sm-offset-1 col-sm-8">
        <?php
        if (isset($_REQUEST['add_rdata'])):
            if (!empty($_REQUEST['add_rdata'])):
                $add_cdata = $_GET['add_rdata'];
                if ('empty' == $add_cdata):
                    ?>
                            <div style="line-height: 1.7em;color:red;">Please Do Not Submit Empty Characters !! C;O;D;E;L;I;S;T;.;C;C</div>

                            <?php
                        endif;

                        if ('success' == $add_cdata):
                            ?>
                            <div style="line-height: 1.7em;color:blue;">User Updated Successfully !!</div>

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

                <button type="submit" class="btn btn-default">Update User</button>
            </div>
        </div>
    </form>


</div>

<?php include 'footer.php'; ?>

</body>
</html>

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
?>

<div class="col-sm-10 col-sm-offset-2 col-md-12 col-md-offset-2 main">
 <input type="hidden" id="page_name" value="adduser"/>
    <h4 class="sub-header">Add New User</h4>

    <form class="form-horizontal" role="form" action="addUserdb.php" method="POST">

        <div class="form-group">
            <label for="User" class="col-sm-2 control-label">User Name:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="uname" name="uname" placeholder="Enter User Name" required>
            </div>
        </div>

        <div class="form-group">
            <label for="Password" class="col-sm-2 control-label">Password:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="password" name="password" placeholder="Enter Password Name" required>
            </div>
        </div>

        <div class="form-group">
            <label for="Role" class="col-sm-2 control-label">Select Role:</label>
            <div class="col-sm-4">
                <select id="cmbrole" name="cmbrole">
                    <option value="admin">Admin</option>
                    <option value="accountmanager">Account Manager</option>
                    <option value="kitchenmanager">Kitchen Manager</option>
                    <option value="user">User(Waiter)</option>
                </select>
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
                            <div style="line-height: 1.7em;color:blue;">User Added Successfully !!</div>

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

                <button type="submit" class="btn btn-default">Add User</button>
            </div>
        </div>
    </form>

    <!--View User-->
    <h4 class="sub-header">View User</h4>
    <div class="col-sm-9 col-md-8  main">
        <div class="table-responsive">
            <table class="table table-striped" id="tbtable">
                <thead>
                    <tr>
                        <th>SrNo</th>
                        <th>User Name</th>
                        <th>Password</th>
                        <th>Role</th>
                        <th>Delete User</th>
                        <th>View / Update User</th>

                    </tr>
                </thead>
                <tbody>

                    <?php
                    require 'db.php';
                    $result = mysqli_query($conn, "SELECT * FROM usermaster") or die(mysql_error());
                    $no = 1;
                    if (mysqli_num_rows($result) > 0) :
                        while ($row = $result->fetch_assoc()) {
                            $id = $row["id"];
                            $uname = $row["username"];
                            $upwd = $row["password"];
                            $role = $row["role"];
                            ?>
                            <tr>

                                <td><?php echo $no; ?></td>                             
                                <td><?php echo $uname; ?></td>
                                <td><?php echo $upwd; ?></td>
                                <td><?php echo ucfirst($role); ?></td>
                                <td><a href="deleteUser.php?uid=<?php echo $id ?>">Delete</a></td> 
                                <td><a href="updateUser.php?uid=<?php echo $id ?>">View / Update</a></td> 
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


</div>

<?php
include 'footer.php';
?>

</body>
</html>
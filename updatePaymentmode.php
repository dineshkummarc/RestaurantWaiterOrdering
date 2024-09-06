<?php
session_start();

if(isset($_SESSION['them'])){
  $them=$_SESSION['them'].".php";
 include $them;
}
if(!isset($_SESSION['usr'])){
  header("Location: index.php");
        die();
}
$pid = '';
if (isset($_REQUEST['pid'])):
   if(!empty($_REQUEST['pid'])):     
     $pid = htmlspecialchars($_GET['pid']);
   else:
       header("Location:updatePaymentmode.php?update=failed");
        die();
   endif;
   else:
       header("Location: updatePaymentmode.php?update=failed");
        die();
endif;
?>


    
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <input type="hidden" id="page_name" value="addpaymentmode">                             
          <h4 class="sub-header">Update Table</h4>
         
          <?php 
          require 'db.php';
                    $result = mysqli_query($conn,"SELECT * FROM paymentmode where id=".$pid) or die(mysql_error());
                    if (mysqli_num_rows($result) > 0) :
                         while ($row = $result->fetch_assoc()) {
                            $id = $row["id"]; 
                            $type = $row["type"];       
                           
                         }
                         
                         endif;                  
                           ?>
          
          <form class="form-horizontal" role="form" action="updatePaymentmodedb.php" method="POST">
              
              <div class="form-group">
              <!-- <label for="Table" class="col-sm-2 control-label">Table Id:</label>-->
               <div class="col-sm-4">
                   <input type="hidden" class="form-control" id="pid" name="pid" placeholder="" value="<?php echo $id;?>">
               </div>
            </div>
            
       <div class="form-group">
               <label for="type" class="col-sm-2 control-label">Paymentmode Type:</label>
               <div class="col-sm-4">
                  <input type="text" class="form-control" id="type" name="type" value="<?php echo $type;?>" placeholder="Enter Paymentmode Type" required>
               </div>
            </div>
              
                                              
                                     
       
   <div class="form-group">
      <div class="col-sm-offset-1 col-sm-8">
           <?php 
                    if (isset($_REQUEST['add_rdata'])):
                        if(!empty($_REQUEST['add_rdata'])):     
                           $add_cdata = $_GET['add_rdata'];
                        if('empty'==$add_cdata):
                        ?>
                             <div style="line-height: 1.7em;color:red;">Please Do Not Submit Empty Characters !!</div>
                            
                            <?php
                             endif;
                             
                           if('success'==$add_cdata):
                        ?>
                             <div style="line-height: 1.7em;color:blue;">Table Updated Successfully !!</div>
                            
                            <?php
                             endif;
                             
                             if('failed'==$add_cdata):
                        ?>
                             <div style="line-height: 1.7em;color:red;">Server Error Please Try Again Later !!</div>
                            
                            <?php
                             endif;
                             
                        endif;
                        
                     endif;
                        
            
            ?>
                                             
         <button type="submit" class="btn btn-default">Update Paymentmode</button>
      </div>
   </div>
</form>
          
  
        </div>
      </div>
    </div>

<?php include 'footer.php';?>

   
  </body>
</html>

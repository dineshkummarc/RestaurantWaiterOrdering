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
$cid = '';
if (isset($_REQUEST['cid'])):
   if(!empty($_REQUEST['cid'])):     
     $cid = htmlspecialchars($_GET['cid']);
   else:
       header("Location: updateCusine.php?update=failed");
        die();
   endif;
   else:
       header("Location: updateCusine.php?update=failed");
        die();
endif;
?>
 
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <input type="hidden" id="page_name" value="addcusine">                
          <h4 class="sub-header">Update Cusine</h4>
         
          <?php 
          require 'db.php';
                    $result = mysqli_query($conn,"SELECT * FROM cusine where id=".$cid) or die(mysql_error());
                    if (mysqli_num_rows($result) > 0) :
                         while ($row = $result->fetch_assoc()) {
                            $id = $row["id"]; 
                            $cusinename = $row["cusinename"];       
                            $cusineimage = $row["cusineimage"];     
                     
                           $cphotourl = 'upload/' . $cusineimage;
                         }
                         
                         endif;                  
                           ?>
          
          <form class="form-horizontal" role="form" action="updateCusinedb.php" method="POST" enctype="multipart/form-data">
            
              <div class="form-group">
              
               <div class="col-sm-4">
                   <input type="hidden" class="form-control" id="cid" name="cid" value="<?php echo $id;?>">
               </div>
            </div>
              
              <div class="form-group">
               <label for="cusinename" class="col-sm-2 control-label">Cusine Name:</label>
               <div class="col-sm-4">
                  <input type="text" class="form-control" id="cusinename" name="cusinename" value="<?php echo $cusinename;?>" placeholder="Enter Cusine Name" required>
               </div>
            </div>           

       <div class="form-group">
           <label for="ImageUpload" class="col-sm-2 control-label">Cusine Image:</label>
           <div class="col-sm-4">
               <input type="file" id="cusineimage" name="cusineimage">
               <img src="<?php echo $cphotourl; ?>" height="50px" width="50px">
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
                             <div style="line-height: 1.7em;color:blue;">Cusine Updated Successfully !!</div>
                            
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
                                             
         <button type="submit" class="btn btn-default">Update Cusine</button>
      </div>
   </div>
</form>
        </div>
<?php include 'footer.php';?>   
  </body>
</html>

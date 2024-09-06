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
$typeid = '';
if (isset($_REQUEST['typeid'])):
   if(!empty($_REQUEST['typeid'])):     
     $typeid = htmlspecialchars($_GET['typeid']);
   else:
       header("Location:updateDishType.php?update=failed");
        die();
   endif;
   else:
       header("Location: updateDishType.php?update=failed");
        die();
endif;
?>

  
     <input type="hidden" id="page_name"  value="adddishtype"/> 
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                               
          <h4 class="sub-header">Update Dish Type</h4>
         
          <?php 
          require 'db.php';
                    $result = mysqli_query($conn,"SELECT * FROM dish_type where id=".$typeid) or die(mysql_error());
                    if (mysqli_num_rows($result) > 0) :
                         while ($row = $result->fetch_assoc()) {
                            $id = $row["id"]; 
                            $typename = $row["typename"];       
                          
                         }
                         
                         endif;                  
                           ?>
          
          <form class="form-horizontal" role="form" action="updateDishTypedb.php" method="POST">
              
              <div class="form-group">
              <!-- <label for="Typeid" class="col-sm-2 control-label">Dish Type Id:</label>-->
               <div class="col-sm-4">
                   <input type="hidden" class="form-control" id="typeid" name="typeid" placeholder="" value="<?php echo $id;?>" >
               </div>
            </div>
            
       <div class="form-group">
               <label for="Typename" class="col-sm-2 control-label">Dish Type Name:</label>
               <div class="col-sm-4">
                  <input type="text" class="form-control" id="typename" name="typename" value="<?php echo $typename;?>" placeholder="Enter Dish Type Name" required>
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
                             <div style="line-height: 1.7em;color:blue;">Dish Type Updated Successfully !!</div>
                            
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
                                             
         <button type="submit" class="btn btn-default">Update Dish Type</button>
      </div>
   </div>
</form>
          
  
        </div>
      </div>
    </div>

  <?php include 'footer.php';?>

   
  </body>
</html>

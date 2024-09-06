<!-- Bootstrap core JavaScript
   ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script type="text/javascript" src="js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/dataTables.bootstrap.js"></script>
<script type="text/javascript">   
    
      $(document).ready(function() {          
            var page_name = document.getElementById("page_name").value; 
            $("#"+page_name).addClass("active");          
    });
    
     $(document).ready(function () {
         $('#tbtable').dataTable();
    });
  
</script>

<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);
if(isset($_REQUEST['pnm']))
{
$page_title=base64_decode($_REQUEST['pnm']);
}
else
{
	$page_title="Group Entry";
}
include "membersonly.inc.php";
$Members  = new isLogged(1);
include "header.php";
function searchForId($id, $array,$chkfld,$sendfld) {

   foreach ($array as $val) 
   {
       if ($val[$chkfld]==$id) {
           return $val[$sendfld];
       }
   }
   return 'root';
}
?>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/avatar.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $Members->User_Details->name;?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
	  <?php echo include "left_bar.php";?>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $page_title;?>
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?php echo $page_title;?></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
	<div class="row">
	<div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $page_title;?></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
              <div class="box-body">

<div class="row">
<div class="form-group col-md-4">
<label>
<b><font color="#ed2618"></font>Ledger name : </b>
</label>
<select class="form-control" name="sl" id="sl" required>
  <option value="">*****Select*****</option>
  <?php
			
      $fld1['sl']='0';
      $op1['sl']=">,";

      $list1  = new Init_Table();
      $list1->set_table("main_ledger","sl");
      $row=$list1->search_custom($fld1,$op1,'',array('sl' => 'ASC'));
      $pdo= new MainPDO();
      foreach ($row as $value) 
      {
			?>
  <option value="<?php echo $value['sl'];?>"><?php echo $value['ldg'];?></option>
      <?php
      }
      ?>
</select>
</div>
<div class="form-group col-md-4">
<label>
<b><font color="#ed2618"></font>From Date : </b>
</label>
<input type="date" id="d1" name="d1" class="form-control" value="" style="width:100%" required>
</div>
<div class="form-group col-md-4">
<label>
<b><font color="#ed2618"></font>To Date : </b>
</label>
<input type="date" id="d2" name="d2" class="form-control" value="" style="width:100%" required>
</div>

<div class="form-group col-md-3" id="alt" style="display:none;">
<div class="alert alert-danger" role="alert">
Complete all the details
</div>
</div>

<div class="form-group col-md-12" align="right">
<br>
<input type="submit" class="btn btn-success" value="SEARCH" onclick="show()">
</div>
</div>
<input type="hidden" name="table_name" value="main_drcr">	 
<input type="hidden" name="page_name" value="ledger_details.php">  

</form>
</div>
<!-- /.box body -->
</div>

<!-- /.box -->
</div>  
	<div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $page_title;?> List</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
              <div class="box-body" id="show">
			 
	
				    </div>
          <!-- /.box body -->
        </div>
          <!-- /.box -->
	</div>  				  
	</div>
</section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    
    <strong>Copyright &copy; 2019-2020 </strong> All rights reserved. Designed & Developed By <a href="http://onnetsolution.com">Onnet Solution Infotech Pvt. Ltd.</a>.
  </footer>


</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- Morris.js charts -->
<script src="bower_components/raphael/raphael.min.js"></script>
<script src="bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>

<link rel="stylesheet" href="chosen.css">
<script src="chosen.jquery.js" type="text/javascript"></script>
<script src="prism.js" type="text/javascript" charset="utf-8"></script>
	
	<script>



function show()
{
  var sl=document.getElementById('sl').value;
  var d1=document.getElementById('d1').value;
  var d2=document.getElementById('d2').value;
  if(sl=="" || d1=="" || d2=="")
  {
    document.getElementById('alt').style.display="block";
    document.getElementById('show').style.display="none";

  }else{
    document.getElementById('alt').style.display="none";
    $('#show').load("call_led_del.php?sl="+sl+"&d1="+d1+"&d2="+d2).fadeIn('fast');

  }
 
}


	</script>

</body>
</html>

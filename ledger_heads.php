<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);
$page_title = "Ledger Heads";

$sl = base64_decode($_REQUEST['sl']);

include "membersonly.inc.php";
$Members = new isLogged(1);
include "header.php";
function searchForId($id, $array, $chkfld, $sendfld)
{

  foreach ($array as $val) {
    if ($val[$chkfld] == $id) {
      return $val[$sendfld];
    }
  }
  return 'root';
}
?>

   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
        <p>
          <?php echo $Members->User_Details->name; ?>
        </p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <?php echo include "left_bar.php"; ?>
  </section>
  <!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <?php
      $fld10['sl'] = $sl;
      $op10['sl'] = "=,";

      $list10 = new Init_Table();
      $list10->set_table("main_ledger", "sl");
      $row0 = $list10->search_custom($fld10, $op10, '', array('sl' => 'ASC'));
      $pdo = new MainPDO();
      foreach ($row0 as $values) {
      }

      echo $values['ldg'];
      ?>
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">
        <?php echo $page_title; ?>
      </li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Transaction Lists</h3>
          </div>
          <!-- /.box-header -->

          <!-- form start -->
          <div class="box-body">
            <!-- **** -->
            <div class="row">
              <div class="form-group col-md-12">
                <div class="form-group col-md-6">
                  <label>
                    <b>
                      <font color="#ed2618"></font>From Date :
                    </b>
                  </label>
                  <?php
                  $date= date('Y-m-d');
                  $_POST["edtm"] = date('Y-m-d H:i:s A');

                  $yr = date('Y');
                  $mnt = date('m');
                  $day = date('d');
                 if($mnt<4){
                  $nyr=$yr-1;
                   $cdate=$nyr.'-'.$mnt.'-'.$day;
                  }
                if($mnt>4){
                 $cdate=$yr.'-04-01';
                }
                  ?>
                  <input class="form-control" type="date" value="<?php echo $cdate;?>" name="d1" id="d1">
                </div>
                <div class="form-group col-md-6">
                  <label>
                    <b>
                      <font color="#ed2618"></font>To Date :
                    </b>
                  </label>
                  <input class="form-control" type="date" value="<?php echo $date; ?>" name="d2"  id="d2">
                </div>
              </div>
              <div class="form-group col-md-12" align="right">
                <br>
                <input type="hidden"  value="<?php echo $sl;?>" id="sl" onclick="cldt()">
                <input type="submit" class="btn btn-success" value="SUBMIT" onclick="cldt()">
              </div>
            </div>
          <script>
            function cldt(){
              var sl=document.getElementById('sl').value;
              var d1=document.getElementById('d1').value;
              var d2=document.getElementById('d2').value;
            $('#showdata').load('ledger_head_data.php?d1='+d1+'&d2='+d2+'&sl='+sl).fadeIn('fast');
            }
          </script>
            <!-- **** -->

            <div class="row">
              <div class="form-group col-md-12">
                <label>
                  <b>
                    <font color="#ed2618"></font>Oppening Balance :
                  </b>
                </label>
              <!-- table started -->
              <!-- dynamic table -->
              <div id="showdata">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th scope="col">DEBIT</th>
                      <th scope="col">CREDIT</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>

                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th scope="col">SL</th>
                              <th scope="col">DATE</th>
                              <th scope="col">FROM</th>
                              <th scope="col">AMOUNT</th>

                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $fld1['dr'] = $sl;
                            $op1['dr'] = "=, and ";
                            $fld1['sl'] = '0';
                            $op1['sl'] = ">,  and edt between '$cdate' and '$date'";


                            $list1 = new Init_Table();
                            $list1->set_table("main_drcr", "sl");
                            $row = $list1->search_custom($fld1, $op1, '', array('edt' => 'ASC'));
                            $f = 0;
                            $td = 0;
                            foreach ($row as $value) {
                              $f++;
                              $td = $td + $value['amt'];
                              ?>
                              <tr>
                                <th>
                                  <?php echo $f; ?>
                                </th>
                                <td>
                                  <?php echo $value['edt']; ?>
                                </td>
                                <th>
                                  <?php


                                  $fld1x['sl'] = $value['cr'];
                                  $op1x['sl'] = "=,";

                                  $main_ledger = new Init_Table();
                                  $main_ledger->set_table("main_ledger", "sl");
                                  $rowx = $main_ledger->search_custom($fld1x, $op1x, '', array('sl' => 'ASC'));
                                  $pdo = new MainPDO();
                                  foreach ($rowx as $valuesx) {
                                    echo $valuesx['ldg'];

                                  }


                                  ?>
                                </th>
                                <th>
                                  <?php echo $value['amt']; ?>
                                </th>

                              </tr>
                              <?php
                            }
                            ?>
                          </tbody>
                        </table>

                      </td>
                      <td>
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th scope="col">SL</th>
                              <th scope="col">DATE</th>
                              <th scope="col">FROM</th>
                              <th scope="col">AMOUNT</th>

                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $fld['cr'] = $sl;
                            $op['cr'] = "=, and ";
                            $fld['sl'] = '0';
                            $op['sl'] = ">,  and edt between '$cdate' and '$date'";


                            $list = new Init_Table();
                            $list->set_table("main_drcr", "sl");
                            $ro = $list->search_custom($fld, $op, '', array('sl' => 'ASC'));
                            $f1 = 0;
                            $tc = 0;
                            foreach ($ro as $valuex) {
                              $f1++;
                              $tc = $tc + $valuex['amt'];
                              ?>
                              <tr>
                                <th>
                                  <?php echo $f1; ?>
                                </th>
                                <td>
                                  <?php echo $valuex['edt']; ?>
                                </td>
                                <th>
                                  <?php

                                  $fld1x['sl'] = $valuex['dr'];
                                  $op1x['sl'] = "=,";

                                  $main_ledger = new Init_Table();
                                  $main_ledger->set_table("main_ledger", "sl");
                                  $rowx = $main_ledger->search_custom($fld1x, $op1x, '', array('sl' => 'ASC'));
                                  $pdo = new MainPDO();
                                  foreach ($rowx as $valuesx) {
                                  }


                                  echo $valuesx['ldg'];
                                  ?>
                                </th>
                                <th>
                                  <?php echo $valuex['amt']; ?>
                                </th>

                              </tr>
                              <?php
                            }
                            ?>
                          </tbody>

                        </table>
                      </td>
                    </tr>
                  </tbody>
                  <tr>
                    <td>Total Debit : <b>
                        <?php echo $td; ?>
                      </b></td>
                    <td>Total Credit : <b>
                        <?php echo $tc; ?>
                      </b></td>
                    <td>Current Balance : <b>
                        <?php echo $td - $tc; ?>
                      </b></td>
                  </tr>
                </table>
                              <!-- table ended -->
                              </div>
                              <!-- dynamic div -->
              </div>
            </div>
          </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<footer class="main-footer">

  <strong>Copyright &copy; 2019-2020 </strong> All rights reserved. Designed & Developed By <a
    href="http://onnetsolution.com">Onnet Solution Infotech Pvt. Ltd.</a>.
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



</body>

</html>
<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);
include "membersonly.inc.php";
$Members  = new isLogged(1);
$d1=$_REQUEST['d1'];
$d2=$_REQUEST['d2'];
?>
<table class="table table-bordered">
      <thead>
    <tr>
      <th scope="col">Income</th>
      <th scope="col">Expenditure</th>

    </tr>
  </thead>
  <tbody>
    <tr>
      <td><table class="table table-striped">
      <thead>
    <tr>
      <th scope="col">SL</th>
      <th scope="col">Income Head</th>
      <th scope="col">Date</th>
      <th scope="col">Balance</th>

    </tr>
  </thead>
  <tbody>
  <?php
			
      $fld1['pid']='3';
      $op1['pid']="=, and edt between '$d1' and '$d2' ";

      $list1  = new Init_Table();
      $list1->set_table("main_ledger","sl");
      $row=$list1->search_custom($fld1,$op1,'',array('sl' => 'ASC'));
      $pdo= new MainPDO();
      $f=0;
    $total=0;
      foreach ($row as $values) 
      {    
                 $f++;

 
			?>
            <tr>
<td><?php echo $f;?></td>
<td><a href="inex_head_data.php?sl=<?php echo base64_encode($values['sl']);?>&d1=<?php echo base64_encode($d1);?>&d2=<?php echo base64_encode($d2);?>&pid=3" ><?php echo $values['ldg'];?></a> </td>
<?php
$fld1y['cr'] = $values['sl'];
$op1y['cr'] = "=, ";
$newamty=0;
$main_drcry  = new Init_Table();
$main_drcry->set_table("main_drcr","sl");
$fldy = array("SUM(amt) as newamt ");
$rowy = $main_drcry->search_custom_ultra($fld1y, $op1y, '', array('sl' => 'ASC'), $fldy);
foreach ($rowy as $resy) {
	$credit = $resy['newamt'];
}


?>
<td><?php 
$fld10['cr'] = $values['sl'];
$op10['cr'] = "=, ";
      $main_drcr  = new Init_Table();
      $main_drcr->set_table("main_drcr","sl");
      $row=$main_drcr->search_custom($fld10,$op10,'',array('sl' => 'ASC'));
      $pdo= new MainPDO();

      foreach ($row as $values) 
      { 

      }
      echo $values['edt'];

      ?></td>

<td><?php echo $credit;?></td>

</tr>
<?php
                      $total=$total+$credit;

      }
?>
<th><td> <b>Total :<?php echo $total;?> </b> </td></th>

  </tbody>
</table></td>
      <td><table class="table table-striped">
      <thead>
    <tr>
    <th scope="col">SL</th>
      <th scope="col">Expenditure Head</th>
      <th scope="col">Date</th>
      <th scope="col">Balance</th>
    </tr>
  </thead>
  <tbody>
  <?php
			
            $fld1['pid']='4';
            $op1['pid']="=, and edt between '$d1' and '$d2'";
            $total2=0;
            $list1  = new Init_Table();
            $list1->set_table("main_ledger","sl");
            $row=$list1->search_custom($fld1,$op1,'',array('sl' => 'ASC'));
            $pdo= new MainPDO();
            $t=0;
            $total=0;
            foreach ($row as $values) 
            {    
                       $t++;
                
       
                  ?>
                  <tr>
      <td><?php echo $t;?></td>
      <td><a href="inex_head_data.php?sl=<?php echo base64_encode($values['sl']);?>&pid=4&d1=<?php echo base64_encode($d1);?>&d2=<?php echo base64_encode($d2);?>"> <?php echo $values['ldg'];?></a></td>
      <?php

      
      $fld110['dr'] = $values['sl'];
      $op110['dr'] = "=, ";
      $newamt0=0;
      $main_drcr0  = new Init_Table();
      $main_drcr0->set_table("main_drcr","sl");
      $fld10 = array("SUM(amt) as newamt0 ");
      $row0 = $main_drcr0->search_custom_ultra($fld110, $op110, '', array('sl' => 'ASC'), $fld10);
      foreach ($row0 as $res0) {
          $debit = $res0['newamt0'];
      }
      ?>
       <td><?php 
$fld['cr'] = $values['sl'];
$op['cr'] = "=, ";
      $main_drcrx  = new Init_Table();
      $main_drcrx->set_table("main_drcr","sl");
      $r=$main_drcrx->search_custom($fld,$op,'',array('sl' => 'ASC'));
      $pdo= new MainPDO();

      foreach ($row as $value) 
      { 

      }
      echo $value['edt'];
            ?></td>
      
      <td><?php echo $debit;?></td>
      </tr>
      <?php
             $total2=$total2+$debit;
            }
      ?>
      <th><td><b>Total :<?php echo $total2;?> </b></td></th>

  </tbody>
</table></td>
    </tr>

  </tbody>
</table>
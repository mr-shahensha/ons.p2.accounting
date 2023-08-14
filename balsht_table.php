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
    <th scope="col">Liability</th>
      <th scope="col">Asset</th>

    </tr>
  </thead>
  <tbody>
    <tr>
      <td><table class="table table-striped">
      <thead>
    <tr>
      <th scope="col">SL</th>
      <th scope="col">Liability Head</th>
      <th scope="col">Balance</th>

    </tr>
  </thead>
  <tbody>
  <?php
			
      $fld1['pid']='2';
      $op1['pid']="=,";

      $list1  = new Init_Table();
      $list1->set_table("main_ledger","sl");
      $row=$list1->search_custom($fld1,$op1,'',array('sl' => 'ASC'));
      $pdo= new MainPDO();
      $f=0;
    $total=0;
    $tl=0;
    $ta=0;
    $total2=0;

      foreach ($row as $values) 
      {    
                 $f++;

 
			?>
            <tr>
<td><?php echo $f;?></td>
<td><a href="balsht_head_data.php?sl=<?php echo base64_encode($values['sl']);?>&d1=<?php echo base64_encode($d1);?>&d2=<?php echo base64_encode($d2);?>&pid=2" ><?php echo $values['ldg'];?></a> </td>

<td><?php

$fld1y['cr'] = $values['sl'];
$op1y['cr'] = "=, and edt < '$d2'";
$newamty=0;
$main_drcry  = new Init_Table();
$main_drcry->set_table("main_drcr","sl");
$fldy = array("SUM(amt) as newamt ");
$rowy = $main_drcry->search_custom_ultra($fld1y, $op1y, '', array('sl' => 'ASC'), $fldy);
foreach ($rowy as $resy) {
	$credit = $resy['newamt'];
}


$fld1yy['dr'] = $values['sl'];
$op1yy['dr'] = "=, and edt < '$d2'";
$newamtyy=0;
$main_drcryy  = new Init_Table();
$main_drcryy->set_table("main_drcr","sl");
$fldyy = array("SUM(amt) as newamt ");
$rowyy = $main_drcryy->search_custom_ultra($fld1yy, $op1yy, '', array('sl' => 'ASC'), $fldyy);
foreach ($rowyy as $resyy) {
	$debit = $resyy['newamt'];
}

echo $tl=($credit-$debit);
?></td>

</tr>
<?php
                    $total=$total+$tl;

 }
?>
<th><td> <b>Total :<?php  echo $total;?> </b> </td></th>

  </tbody>
</table></td>
      <td><table class="table table-striped">
      <thead>
    <tr>
    <th scope="col">SL</th>
      <th scope="col">Asset Head</th>
      <th scope="col">Balance</th>
    </tr>
  </thead>
  <tbody>
  <?php
			
            $fld1['pid']='1';
            $op1['pid']="=, ";
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
      <td><a href="balsht_head_data.php?sl=<?php echo base64_encode($values['sl']);?>&pid=1&d1=<?php echo base64_encode($d1);?>&d2=<?php echo base64_encode($d2);?>"> <?php echo $values['ldg'];?></a></td>


      <td><?php
            
      $fld110['dr'] = $values['sl'];
      $op110['dr'] = "=, and edt < '$d2'";
      $newamt0=0;
      $main_drcr0  = new Init_Table();
      $main_drcr0->set_table("main_drcr","sl");
      $fld10 = array("SUM(amt) as newamt0 ");
      $row0 = $main_drcr0->search_custom_ultra($fld110, $op110, '', array('sl' => 'ASC'), $fld10);
      foreach ($row0 as $res0) {
          $debit2 = $res0['newamt0'];
      }

      $fld110x['cr'] = $values['sl'];
      $op110x['cr'] = "=, and edt < '$d2'";
      $newamt0x=0;
      $main_drcr0x  = new Init_Table();
      $main_drcr0x->set_table("main_drcr","sl");
      $fld10x = array("SUM(amt) as newamt0 ");
      $row0x = $main_drcr0x->search_custom_ultra($fld110x, $op110x, '', array('sl' => 'ASC'), $fld10x);
      foreach ($row0x as $res0x) {
          $credit2 = $res0x['newamt0'];
      }
      
      echo $ta=$debit2-$credit2;

      ?></td>
      </tr>
      <?php
              $total2=$total2+$ta;
            }
      ?>
      <th><td><b>Total :<?php echo $total2;?> </b></td></th>

  </tbody>
</table></td>
    </tr>

  </tbody>
</table>
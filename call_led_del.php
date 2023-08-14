<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);
include "membersonly.inc.php";
$Members  = new isLogged(1);
$sl=$_REQUEST['sl'];
$d1=$_REQUEST['d1'];
$d2=$_REQUEST['d2'];

$fldz['sl'] = $sl;
$opz['sl'] = "=, ";
$main_ledgerz = new Init_Table();
$main_ledgerz->set_table("main_ledger", "sl");
$rooz = $main_ledgerz->search_custom($fldz, $opz, '', array('sl' => 'ASC'));
foreach ($rooz as $valueo) {
}
?>
<table class="table">
    <tr>
        <th colspan="2"><b>Opening Balance : 
        <?php
           if($valueo['pid']==1){ 
                //     $flde['dr'] = $sl;
                //     $ope['dr'] = "=, and and edt < '$d1'";
                //     $main_drcre = new Init_Table();
                //     $main_drcre->set_table("main_drcr", "sl");
                //     $fld0 = array("SUM(amt) as newamt0 ");
                //     $rowe = $main_drcre->search_custom_ultra($flde, $ope, '', array('sl' => 'ASC'), $fld0);

                //     foreach ($rowe as $valuee) {
                // }
                // echo $valuee['newamt0'];
            }
           if($valueo['pid']==2){ 
            } 
            if($valueo['pid']==3){ 
            } 
            if($valueo['pid']==4){ 
            }
        ?>

        </b></th>
    </tr>
    <tr>
        <?php
           if($valueo['pid']==1){ 
        ?>
            <th width="50%">DEBIT TABLE</th>
            <th width="50%">CREDIT TABLE</th>
    <?php
           }
           if($valueo['pid']==2){ 
            ?>
                <th width="50%">CREDIT TABLE</th>
                <th width="50%">DEBIT TABLE</th>
        <?php
           }
                  if($valueo['pid']==3){ 
                    ?>
                        <th width="50%">DEBIT TABLE</th>
                <?php
                       }
                       if($valueo['pid']==4){ 
                        ?>
                            <th width="50%">CREDIT TABLE</th>
                    <?php
                           }
                    ?>
    </tr>

<tbody>
<tr>
        <!-- first table -->
        
    <td>
    <table class="table  table-striped">
    <tr>
    <tr>
    <th width="25%">SL</th>
    <th width="25%">DATE</th>
    <th width="25%">Transaction From</th>
    <th width="25%">AMOUNT</th>
    </tr>
    <?php
           if($valueo['pid']==1){ 
        ?>
    </tr>

<tbody>
<?php
                            $fld1['dr'] = $sl;
                            $op1['dr'] = "=, and ";
                            $fld1['sl'] = '0';
                            $op1['sl'] = ">,  and edt between '$d1' and '$d2'";


                            $main_drcr = new Init_Table();
                            $main_drcr->set_table("main_drcr", "sl");
                            $ro1 = $main_drcr->search_custom($fld1, $op1, '', array('sl' => 'ASC'));
                    $f1=0;
                    $total=0;
                            foreach ($ro1 as $valuex1) {
                                $f1++;
                                ?>
<tr>
<td><?php echo  $f1;?></td>
<td><?php echo  $valuex1['edt'];?></td>
<td><?php

          $fld1x['sl'] =$valuex1['cr'];
          $op1x['sl'] = "=,";

          $main_ledger = new Init_Table();
          $main_ledger->set_table("main_ledger", "sl");
          $rowx = $main_ledger->search_custom($fld1x, $op1x, '', array('sl' => 'ASC'));
          $pdo = new MainPDO();
          foreach ($rowx as $valuesx) {
          }


          echo $valuesx['ldg'];
  ?></td>
<td><?php echo  $valuex1['amt'];?></td>
</tr>
<?php 
$total=$total+$valuex1['amt'];
                            }
?>
<tr>
<th>Total Credit : <?php echo $total;?></th>

</tr>
<?php
           }
           if($valueo['pid']==2){ 
        ?>
<?php
                            $fld['cr'] = $sl;
                            $op['cr'] = "=, and ";
                            $fld['sl'] = '0';
                            $op['sl'] = ">,  and edt between '$d1' and '$d2'";


                            $list = new Init_Table();
                            $list->set_table("main_drcr", "sl");
                            $ro = $list->search_custom($fld, $op, '', array('sl' => 'ASC'));
                    $f=0;
                    $total1=0;
                            foreach ($ro as $valuex) {
                                $f++;
                                ?>
<tr>
<td><?php echo  $f;?></td>
<td><?php echo  $valuex['edt'];?></td>
<td><?php
          $fld1x['sl'] = $valuex['dr'];
          $op1x['sl'] = "=,";

          $main_ledger = new Init_Table();
          $main_ledger->set_table("main_ledger", "sl");
          $rowx = $main_ledger->search_custom($fld1x, $op1x, '', array('sl' => 'ASC'));
          $pdo = new MainPDO();
          foreach ($rowx as $valuesx) {
          }


          echo $valuesx['ldg'];
?></td>
<td><?php echo  $valuex['amt'];?></td>
</tr>
<?php
$total1=$total1+$valuex['amt'];
                            }
?>
<tr>
    <th>Total Debit : <?php echo $total1;?></th>
</tr>
        <?php
           }
           if($valueo['pid']==3){ 
            ?>
            <?php
                            $fld['cr'] = $sl;
                            $op['cr'] = "=, and ";
                            $fld['sl'] = '0';
                            $op['sl'] = ">,  and edt between '$d1' and '$d2'";


                            $list = new Init_Table();
                            $list->set_table("main_drcr", "sl");
                            $ro = $list->search_custom($fld, $op, '', array('sl' => 'ASC'));
                    $f=0;
                    $total1=0;
                            foreach ($ro as $valuex) {
                                $f++;
                                ?>
<tr>
<td><?php echo  $f;?></td>
<td><?php echo  $valuex['edt'];?></td>
<td><?php
          $fld1x['sl'] = $valuex['dr'];
          $op1x['sl'] = "=,";

          $main_ledger = new Init_Table();
          $main_ledger->set_table("main_ledger", "sl");
          $rowx = $main_ledger->search_custom($fld1x, $op1x, '', array('sl' => 'ASC'));
          $pdo = new MainPDO();
          foreach ($rowx as $valuesx) {
          }


          echo $valuesx['ldg'];
  ?></td>
<td><?php echo  $valuex['amt'];?></td>
</tr>
<?php
$total1=$total1+$valuex['amt'];
                            }
?>
<tr>
    <th>Total Debit : <?php echo $total1;?></th>
</tr>
            <?php
           }
          if($valueo['pid']==4){ 
            ?>
    </tr>

<tbody>
<?php
                            $fld1['dr'] = $sl;
                            $op1['dr'] = "=, and ";
                            $fld1['sl'] = '0';
                            $op1['sl'] = ">,  and edt between '$d1' and '$d2'";


                            $main_drcr = new Init_Table();
                            $main_drcr->set_table("main_drcr", "sl");
                            $ro1 = $main_drcr->search_custom($fld1, $op1, '', array('sl' => 'ASC'));
                    $f1=0;
                    $total=0;
                            foreach ($ro1 as $valuex1) {
                                $f1++;
                                ?>
<tr>
<td><?php echo  $f1;?></td>
<td><?php echo  $valuex1['edt'];?></td>
<td><?php
          $fld1x['sl'] = $valuex1['cr'];
          $op1x['sl'] = "=,";

          $main_ledger = new Init_Table();
          $main_ledger->set_table("main_ledger", "sl");
          $rowx = $main_ledger->search_custom($fld1x, $op1x, '', array('sl' => 'ASC'));
          $pdo = new MainPDO();
          foreach ($rowx as $valuesx) {
          }


          echo $valuesx['ldg'];

?></td>
<td><?php echo  $valuex1['amt'];?></td>
</tr>
<?php 
$total=$total+$valuex1['amt'];
                            }
?>
<tr>
<th>Total Credit : <?php echo $total;?></th>

</tr>
            <?php
          }
            ?>
</tbody>

</table>

    </td>
        <!-- second table -->

    <td>
    <table class="table  table-striped">
    <?php if($valueo['pid']==1){ 
              ?>
    <tr>
    <th width="25%">SL</th>
    <th width="25%">DATE</th>
    <th width="25%">Transaction From</th>
    <th width="25%">AMOUNT</th>
    </tr>
              <?php
            }
            if($valueo['pid']==2){ 
                ?>
                <tr>
                <th width="25%">SL</th>
                <th width="25%">DATE</th>
                <th width="25%">Transaction From</th>
                <th width="25%">AMOUNT</th>
                </tr>
                          <?php
                }

         ?>

<tbody>
<?php
           if($valueo['pid']==1){ 
        ?>
<?php
                            $fld['cr'] = $sl;
                            $op['cr'] = "=, and ";
                            $fld['sl'] = '0';
                            $op['sl'] = ">,  and edt between '$d1' and '$d2'";


                            $list = new Init_Table();
                            $list->set_table("main_drcr", "sl");
                            $ro = $list->search_custom($fld, $op, '', array('sl' => 'ASC'));
                    $f=0;
                    $total1=0;
                            foreach ($ro as $valuex) {
                                $f++;
                                ?>
<tr>
<td><?php echo  $f;?></td>
<td><?php echo  $valuex['edt'];?></td>
<td><?php
            $fld1x['sl'] = $valuex['dr'];
            $op1x['sl'] = "=,";

            $main_ledger = new Init_Table();
            $main_ledger->set_table("main_ledger", "sl");
            $rowx = $main_ledger->search_custom($fld1x, $op1x, '', array('sl' => 'ASC'));
            $pdo = new MainPDO();
            foreach ($rowx as $valuesx) {
            }
echo  $valuesx['ldg'];?></td>
<td><?php echo  $valuex['amt'];?></td>
</tr>
<?php
$total1=$total1+$valuex['amt'];
                            }
?>
<tr>
    <th>Total Debit : <?php echo $total1;?></th>
</tr>
<?php
           }
           if($valueo['pid']==2){ 

?>
<?php
                            $fld1['dr'] = $sl;
                            $op1['dr'] = "=, and ";
                            $fld1['sl'] = '0';
                            $op1['sl'] = ">,  and edt between '$d1' and '$d2'";


                            $main_drcr = new Init_Table();
                            $main_drcr->set_table("main_drcr", "sl");
                            $ro1 = $main_drcr->search_custom($fld1, $op1, '', array('sl' => 'ASC'));
                    $f1=0;
                    $total=0;
                            foreach ($ro1 as $valuex1) {
                                $f1++;
                                ?>
<tr>
<td><?php echo  $f1;?></td>
<td><?php echo  $valuex1['edt'];?></td>
<td><?php
            $fld1x['sl'] = $valuex1['cr'];
            $op1x['sl'] = "=,";

            $main_ledger = new Init_Table();
            $main_ledger->set_table("main_ledger", "sl");
            $rowx = $main_ledger->search_custom($fld1x, $op1x, '', array('sl' => 'ASC'));
            $pdo = new MainPDO();
            foreach ($rowx as $valuesx) {
            }
echo  $valuesx['ldg'];?></td>
<td><?php echo  $valuex1['amt'];?></td>
</tr>
<?php 
$total=$total+$valuex1['amt'];
                            }
?>
<tr>
<th>Total Credit : <?php echo $total;?></th>

</tr>
<?php
           }
?>
</tbody>

</table>

    </td>
</tr>
<tr>
    <td><b> Current Balance : <?php 
            if($valueo['pid']==1){     
                echo $total-$total1;
            }
            if($valueo['pid']==2){     
                echo $total1-$total;

            }
            if($valueo['pid']==3){ 
                echo $total1;
            }
            if($valueo['pid']==4){ 
                echo $total;

            }
            ?></b></td>
</tr>
</tbody>

</table>
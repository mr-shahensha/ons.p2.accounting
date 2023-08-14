<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);
include "membersonly.inc.php";
$Members  = new isLogged(1);
$sl=$_REQUEST['sl'];
$d1=$_REQUEST['d1'];
$d2=$_REQUEST['d2'];


?>
<table class="table">
    <tr>
    <th width="50%">CREDIT TABLE</th>
    <th width="50%">DEBIT TABLE</th>
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
<td><?php echo  $valuex1['cr'];?></td>
<td><?php echo  $valuex1['amt'];?></td>
</tr>
<?php 
$total=$total+$valuex1['amt'];
                            }
?>
<tr>
<th>Total Credit : <?php echo $total;?></th>

</tr>
</tbody>

</table>

    </td>
        <!-- second table -->

    <td>
    <table class="table  table-striped">
    <tr>
    <th width="25%">SL</th>
    <th width="25%">DATE</th>
    <th width="25%">Transaction From</th>
    <th width="25%">AMOUNT</th>
    </tr>

<tbody>
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
<td><?php echo  $valuex['dr'];?></td>
<td><?php echo  $valuex['amt'];?></td>
</tr>
<?php
$total1=$total1+$valuex['amt'];
                            }
?>
<tr>
    <th>Total Debit : <?php echo $total1;?></th>
</tr>
</tbody>

</table>

    </td>
</tr>
<tr>
    <td><b> Current Balance : <?php echo $total-$total1;?></b></td>
</tr>
</tbody>

</table>
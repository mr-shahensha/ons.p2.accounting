<?php
include "include.class.php";

$sl=$_REQUEST['a'];

$fld['sl']=$sl;
$op['sl']="=, ";

$list  = new Init_Table();
$list->set_table("main_ledger","sl");
$ro=$list->search_custom($fld,$op,'',array('sl' => 'ASC'));
$pdo= new MainPDO();
foreach ($ro as $value) 
{
}


$fld1['cr'] = $sl;
$op1['cr'] = "=, ";
$newamt=0;
$main_drcr  = new Init_Table();
$main_drcr->set_table("main_drcr","sl");
$fld = array("SUM(amt) as newamt ");
$row = $main_drcr->search_custom_ultra($fld1, $op1, '', array('sl' => 'ASC'), $fld);
foreach ($row as $res) {
	$credit = $res['newamt'];
}


$fld10['dr'] = $sl;
$op10['dr'] = "=, ";
$newamt0=0;
$main_drcr0  = new Init_Table();
$main_drcr0->set_table("main_drcr","sl");
$fld0 = array("SUM(amt) as newamt0 ");
$row0 = $main_drcr0->search_custom_ultra($fld10, $op10, '', array('sl' => 'ASC'), $fld0);
foreach ($row0 as $res0) {
	$debit = $res0['newamt0'];
}
?>
<input type="text" id="nar" name="nar" class="form-control" value="<?php 
if($value['pid']==1){
    echo $debit-$credit;

}
if($value['pid']==2){
    echo $credit-$debit;

}
?>" style="width:100%"  readonly></d
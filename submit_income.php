<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);
include "membersonly.inc.php";
$Members  = new isLogged(1);
	
function array_except($array, $keys) {
  return array_diff_key($array, array_flip((array) $keys));   
}
$_POST["eby"]=$Members->User_Details->username;
$_POST["edt"]=date('Y-m-d');
$_POST["edtm"]=date('Y-m-d H:i:s A');

$tbl_nm=$_POST['table_name'];
$page_name=$_POST['page_name'];
if($page_name=='income.php'){
	$_POST["type"]='1';

}
if($page_name=='expen.php'){
	$_POST["type"]='2';

}
if($page_name=='journal.php'){
	$_POST["type"]='3';

}
$exception=array('submit_form','table_name','page_name','lid','drcr');
$field=array_except($_POST,$exception);
// print_r($_POST);
		$pdo_obj  = new Init_Table();
		$pdo_obj->set_table($tbl_nm,"sl");
		foreach($field as $key=>$vl)
		{
		$pdo_obj->$key=$vl;	
		}
		
		if(isset($_POST["sl"]) )
{
 
		    $pdo_obj->save(); 
         	$msg="Data Updated Successfully...";
	
}
else
{
	$pdo_obj->create();
	$msg="Data Submited Successfully...";
}

?>	
<script>
alert("<?php echo $msg;?>");
window.document.location="<?php echo $page_name;?>";
</script>


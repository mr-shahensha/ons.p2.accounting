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

$lid=$_POST['lid'];
$drcr=$_POST['drcr'];
$tbl_nm=$_POST['table_name'];
$page_name=$_POST['page_name'];
$_POST["type"]='0';


if($drcr=="cr"){
    $fld['cr']=$lid;
    $op['cr']="=, and";
    $fld['dr']='-1';
    $op['dr']="=, and";

    $_POST['cr']=$lid;
    $_POST['dr']='-1';
}
if($drcr=="dr"){
    $fld['dr']=$lid;
    $op['dr']="=, and";
    $fld['cr']='-1';
    $op['cr']="=, and";

    $_POST['dr']=$lid;
    $_POST['cr']='-1';
}

$fld['amt']=$_POST['amt'];
$op['amt']="=, ";

$list  = new Init_Table();
$list->set_table($tbl_nm,"sl");
$count=$list->row_count_custom($fld,$op,'',array('sl' => 'ASC'));
$msg="";
if($count>0)	
{
$msg="Data Already Exists!!!";	
}
if($msg=="")
{

$exception=array('submit_form','table_name','page_name','lid','drcr');
$field=array_except($_POST,$exception);
//print_r($_POST);
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
<?php
}

else{
?>	
<script>
alert("<?php echo $msg;?>");
history.go(-1);;
</script>
<?php
}
?>

<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);
include "membersonly.inc.php";
$Members  = new isLogged(1);
$pid=$_REQUEST['pid'];
?>
<select class="form-control" name="gid" id="gid" required>
  <option value="">*****Select*****</option>
  <?php 
  $fld1['pid']=$pid;
  $op1['pid']="=,";
  
  $list1  = new Init_Table();
  $list1->set_table("main_group","sl");
  $row=$list1->search_custom($fld1,$op1,'',array('sl' => 'ASC'));
  foreach ($row as $value) 
  {
  
  ?>
    <option value="<?php echo $value['sl'];?>"><?php echo $value['gnm'];?></option>

<?php
}
?>
</select>
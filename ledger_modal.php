<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);
include "membersonly.inc.php";
$Members  = new isLogged(1);
$x=$_REQUEST['x'];
$fld['sl']=$x;
$op['sl']="=,";

$list  = new Init_Table();
$list->set_table("main_ledger","sl");
$row0=$list->search_custom($fld,$op,'',array('sl' => 'ASC'));
$pdo= new MainPDO();
foreach ($row0 as $value0) 
{
}
?>
<form class="form-bordered" action="submit_ledger.php" method="POST">

<div id="row">
						<div class="form-group col-md-12">
					<label>
					<b><font color="#ed2618"></font>Primary : </b>
					</label>

					<select class="form-control" name="pid" id="pid" required >
					<option value="">*****Select*****</option>
					<?php
								
						$fld1['sl']='0';
						$op1['sl']=">,";

						$list1  = new Init_Table();
						$list1->set_table("main_primary","sl");
						$row=$list1->search_custom($fld1,$op1,'',array('sl' => 'ASC'));
						$pdo= new MainPDO();
						foreach ($row as $value) 
						{
								?>
					<option value="<?php echo $value['sl'];?>" <?php if($value0['pid']==$value['sl']){ echo "selected";}?>><?php echo $value['pnm'];?></option>
						<?php
						}
						?>
					</select>
					</div>
					<div class="form-group col-md-12">
					<label>
					<b><font color="#ed2618"></font>Group : </b>
					</label>
					<div id="cgid">
					<select class="form-control" name="gid" id="gid" required >
					<option value="">*****Select*****</option>
					<?php
								
						$fld1x['sl']='0';
						$op1x['sl']=">,";

						$main_group  = new Init_Table();
						$main_group->set_table("main_group","sl");
						$rowx=$main_group->search_custom($fld1x,$op1x,'',array('sl' => 'ASC'));
						$pdo= new MainPDO();
						foreach ($rowx as $valuex) 
						{
								?>
					<option value="<?php echo $valuex['sl'];?>" <?php if($value0['gid']==$valuex['sl']){ echo "selected";}?>><?php echo $valuex['gnm'];?></option>
						<?php
						}
						?>
					</select>
					</div>

					</div>
					<div class="form-group col-md-12">
					<label>
					<b><font color="#ed2618"></font>Ledger Name : </b>
					</label>
					<input type="text" id="ldg" name="ldg" class="form-control" value="<?php echo $value0['ldg'];?>" style="width:100%" placeholder="Enter Ledger Name " required>
					</div>
					<div class="form-group col-md-12" align="right">
					<br>
					<input type="hidden" name="sl" value="<?php echo $x;?>">
					<input type="hidden" name="table_name" value="main_ledger">	 
					<input type="hidden" name="page_name" value="ledger.php">  
					<input type="submit" class="btn btn-success" value="SUBMIT">
					</div>
								</div>
						</div>
						</form>
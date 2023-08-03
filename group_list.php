<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);
include "membersonly.inc.php";
$Members  = new isLogged(1);
?>
 <?php
			
      $fld1['sl']='0';
      $op1['sl']=">,";

      $list1  = new Init_Table();
      $list1->set_table("main_group","sl");
      $row=$list1->search_custom($fld1,$op1,'',array('sl' => 'ASC'));
		$path1="";
			?>
							<table class="table">
							<tr>
							<th width="25%">SL</th>
							<th width="25%">Primary</th>
							<th width="25%">Group Name</th>
							<th width="25%">Action</th>
							</tr>
								<?php	
								$cnt=0;
                $pdo= new MainPDO();
								foreach ($row as $value) 
								{
									$cnt++;
									$sl=$value['sl'];
									?>
									<tr>
									<td><?php echo $cnt;?></td>
                  <td><?php
				        $fld2['sl']=$value['pid'];
						$op2['sl']="=,";
				  
						$main_primary  = new Init_Table();
						$main_primary->set_table("main_primary","sl");
						$row2=$main_primary->search_custom($fld2,$op2,'',array('sl' => 'ASC'));
						foreach ($row2 as $value2) 
						{
						}
				 
				 echo $value2['pnm'];
				?></td>
				  <td><?php echo $value['gnm'];?></td>
									<td>
									<a href="group_edit.php?sl=<?php echo base64_encode($sl);?>"><input type="button" class="btn btn-primary btn-xs" value="Edit">
									</a>

									</td>
									</tr>
									<?php
								}
							?>

</table>
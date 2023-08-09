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
      $list1->set_table("main_ledger","sl");
      $row=$list1->search_custom($fld1,$op1,'',array('sl' => 'ASC'));
		$path1="";
			?>
							<table class="table">
							<tr>
							<th width="20%">SL</th>
							<th width="20%">Primary</th>
							<th width="20%">Group Name</th>
                            <th width="20%">Ledger</th>
							<th width="20%">Action</th>
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
				  <td><?php
                  
                  $fld3['sl']=$value['gid'];
                  $op3['sl']="=,";
            
                  $main_group  = new Init_Table();
                  $main_group->set_table("main_group","sl");
                  $row3=$main_group->search_custom($fld3,$op3,'',array('sl' => 'ASC'));
                  foreach ($row3 as $value3) 
                  {
                  }
                  
                  echo $value3['gnm'];?></td>
                  <td><?php echo $value['ldg'];?></td>
					<td>
					<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" onclick="get(<?php echo $sl;?>)">Edit</button>

							<!-- Modal -->
							<div id="myModal" class="modal fade" role="dialog">
							<div class="modal-dialog">

					<!-- Modal content-->
					<div class="modal-content">
					<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title" >Edit Ledger</h4>
					</div>
					<div class="modal-body">
				  <div id="showmodal">

				  </div>
							<div class="modal-footer">
							</div>
							</div>
						</div>
						</div>

						</td>
						</tr>
						<?php
					}
				?>

</table>

<script>
	function get(x){
		$('#showmodal').load('ledger_modal.php?x='+x).fadeIn('fast');
		$('#mymodal').modal('show');

	}
</script>
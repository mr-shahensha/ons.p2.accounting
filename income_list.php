<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);
include "membersonly.inc.php";
$Members  = new isLogged(1);
$type=$_REQUEST['type'];
?>
 <?php

	  $fld1['type']='1';
	  $op1['type']="=, and ";
      $fld1['sl']='0';
      $op1['sl']=">,";

      $list1  = new Init_Table();
      $list1->set_table("main_drcr","sl");
      $row=$list1->search_custom($fld1,$op1,'',array('sl' => 'ASC'));
		$path1="";
			?>
							<table class="table">
							<tr>
							<th width="20%">SL</th>
							<th width="20%"> Income Head </th>
							<th width="20%">To</th>
                            <th width="20%">Balance</th>
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
                    $fld2['sl']=$value['cr'];
                    $op2['sl']="=,";
            
                    $main_ledger  = new Init_Table();
                    $main_ledger->set_table("main_ledger","sl");
                    $row2=$main_ledger->search_custom($fld2,$op2,'',array('sl' => 'ASC'));
                    foreach ($row2 as $value2) 
                    {
                    }
                  
                  echo $value2['ldg'];?></td>
                  <td>
                  <?php
                    $fld2['sl']=$value['dr'];
                    $op2['sl']="=,";
            
                    $main_ledger  = new Init_Table();
                    $main_ledger->set_table("main_ledger","sl");
                    $row2=$main_ledger->search_custom($fld2,$op2,'',array('sl' => 'ASC'));
                    foreach ($row2 as $value2) 
                    {
                    }
                  
                  echo $value2['ldg'];?>
                  </td>

                  <td><?php echo $value['amt'];?></td>
						<td>
						<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" onclick="get(<?php echo $sl;?>)">Edit</button>

						<!-- Modal -->
						<div id="myModal" class="modal fade" role="dialog">
						<div class="modal-dialog">

							<!-- Modal content-->
							<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Opening Balance Edit</h4>
							</div>
							<div class="modal-body">
							<div id="showmodal"></div>
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
		$('#showmodal').load('income_modal.php?x='+x).fadeIn('fast');
		$('#mymodal').modal('show');

	}
</script>
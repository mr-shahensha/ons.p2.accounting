<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);
include "membersonly.inc.php";
$Members  = new isLogged(1);
$type=$_REQUEST['type'];
?>
 <?php
		if($type==1){
			$fld1['type']='1';
			$op1['type']="=, and ";
		}
		if($type==0){
			$fld1['type']='0';
			$op1['type']="=, and ";
		}	
		if($type==2){
			$fld1['type']='2';
			$op1['type']="=, and ";
		}
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
							<th width="20%">Ledger</th>
							<th width="20%">Type</th>
                            <th width="20%">Amount</th>
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

                                    <?php
                        if($value['cr']!=-1){
                        $fld2['sl']=$value['cr'];
                        }
                        if($value['dr']!=-1){
                            $fld2['sl']=$value['dr'];
                            }
						$op2['sl']="=,";
				  
						$main_ledger  = new Init_Table();
						$main_ledger->set_table("main_ledger","sl");
						$row2=$main_ledger->search_custom($fld2,$op2,'',array('sl' => 'ASC'));
						foreach ($row2 as $value2) 
						{
						}  
                    ?>
				  <td><?php echo $value2['ldg'];?></td>
                  <td>
                    <?php 
                    if($value['cr']!=-1){
                        echo "Credited";
                    }
                     else if( $value['dr']!=-1){
                            echo "Debited";
                    }else{
						echo "income !!";
					}
                    ?>
                  </td>

                  <td><?php echo $value['amt'];?></td>
						<td>
						<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Edit</button>

						<!-- Modal -->
						<div id="myModal" class="modal fade" role="dialog">
						<div class="modal-dialog">

							<!-- Modal content-->
							<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Modal Header</h4>
							</div>
							<div class="modal-body">
								<p>Some text in the modal.</p>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
							</div>

						</div>
						</div>
						<!-- <a href="ledger_edit.php?sl=<?php echo base64_encode($sl);?>"><input type="button" class="btn btn-primary btn-xs" value="Edit"> -->
						</a>

						</td>
						</tr>
							<?php
						}
					?>

</table>
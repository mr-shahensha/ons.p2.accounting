<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);
include "membersonly.inc.php";
$Members  = new isLogged(1);
$x=$_REQUEST['x'];
//echo $x;
$fld['sl']=$x;
$op['sl']="=,";

$list  = new Init_Table();
$list->set_table("main_drcr","sl");
$row0=$list->search_custom($fld,$op,'',array('sl' => 'ASC'));
$pdo= new MainPDO();
foreach ($row0 as $value0) 
{
}
?>
<form class="form-bordered" action="submit_openbal.php" method="POST">

<div id="row">
						<div class="form-group col-md-12">
					<label>
					<b><font color="#ed2618"></font>Ledger : </b>
					</label>

					<select class="form-control" name="lid" id="lid" required >
					<option value="">*****Select*****</option>
                    <?php
                        $main_ledger  = new Init_Table();
                        $main_ledger->set_table("main_ledger","sl");
                        $row2=$main_ledger->search_custom($fld2,$op2,'',array('sl' => 'ASC'));
                        foreach ($row2 as $value2) 
                        {
                        ?>
                        <option value="<?php echo $value2['sl'];?>"
                            <?php if($value0['cr']==$value2['sl']){ echo "selected";}
                            if($value0['dr']==$value2['sl']){ echo "selected";} ?>>
                        <?php echo $value2['ldg'];?></option>
                        <?php
                            }  
                            ?>
					</select>
					</div>
					<div class="form-group col-md-12">
					<label>
					<b><font color="#ed2618"></font>Type : </b>
					</label>
					<div id="cgid">
					<select id="drcr" name="drcr" class="form-control" required>
                        <option value="">*****Select*****</option>
                        <option value="cr" <?php if($value0['cr']!=-1){ echo "selected"; }?>>Credit</option>
                        <option value="dr" <?php  if($value0['dr']!=-1){  echo "selected"; }?>>Debit</option>
                    </select>
					</div>

					</div>
					<div class="form-group col-md-12">
					<label>
					<b><font color="#ed2618"></font>Amount : </b>
					</label>
					<input type="text" id="amt" name="amt" class="form-control" value="<?php echo $value0['amt'];?>" style="width:100%" placeholder="Enter Ledger Name " required>
					</div>
					<div class="form-group col-md-12" align="right">
					<br>
                    <input type="hidden" name="type" >	 
					<input type="hidden" name="sl" value="<?php echo $x;?>">
					<input type="hidden" name="table_name" value="main_drcr">	 
					<input type="hidden" name="page_name" value="openbal.php">  
					<input type="submit" class="btn btn-success" value="SUBMIT">
					</div>
								</div>
						</div>
						</form>
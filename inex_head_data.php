<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);
include "membersonly.inc.php";
$Members  = new isLogged(1);
$d1=$_REQUEST['d1'];
$d2=$_REQUEST['d2'];
$sl=$_REQUEST['sl'];
$pid=$_REQUEST['pid'];

?>
                  <?php
                  $fld1y['cr'] = $sl;
                  $op1y['cr'] = "=,  and  ";

                  $fld1y['edt'] = $d1;
                  $op1y['edt'] = "<,";
                  $credit = 0;
                  $main_drcry = new Init_Table();
                  $main_drcry->set_table("main_drcr", "sl");
                  $fldy = array(" SUM(amt) as newamt ");
                  $rowy = $main_drcry->search_custom_ultra($fld1y, $op1y, '', array('sl' => 'ASC'), $fldy);
                  foreach ($rowy as $resy) {
                    $credit = $resy['newamt'];
                  }


                  $fld100['dr'] = $sl;
                  $op100['dr'] = "=,  and ";
                  $fld100['edt'] = $d1;
                  $op100['edt'] = "<,";
                  // $fld10['sl'] = '0';
                  // $op10['sl'] = ">,";
                  
                  $debit = 0;
                  $main_drcr0 = new Init_Table();
                  $main_drcr0->set_table("main_drcr", "sl");
                  $fld0 = array("SUM(amt) as newamt0 ");
                  $row0 = $main_drcr0->search_custom_ultra($fld100, $op100, '', array('sl' => 'ASC'), $fld0);
                  foreach ($row0 as $res0) {
                  $debit = $res0['newamt0'];
                  }

                  ?>
                <label>
                  <b>
                    <font color="#ed2618"></font>Opening Balance :                 
                          <?php 
                            if($pid==3){
                          echo $credit;
                             }
                             if($pid==4){
                                echo $debit;

                             }?>

                  </b>
                </label>
<table class="table table-bordered">
                  <thead>
                    <tr>
                    <?php
                    if($pid==3){
                    ?>
                    <th scope="col">CREDIT</th>
                    <?php
                    }
                    if($pid==4){

                    ?>
                      <th scope="col">DEBIT</th>
                      <?php
                    }
                      ?>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                    <?php
                    if($pid==3){
                    ?>
                    <td>
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th scope="col">SL</th>
                              <th scope="col">DATE</th>
                              <th scope="col">FROM</th>
                              <th scope="col">AMOUNT</th>

                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $fld['cr'] = $sl;
                            $op['cr'] = "=, and ";
                            $fld['sl'] = '0';
                            $op['sl'] = ">,  and edt between '$d1' and '$d2'";


                            $list = new Init_Table();
                            $list->set_table("main_drcr", "sl");
                            $ro = $list->search_custom($fld, $op, '', array('sl' => 'ASC'));
                            $f1 = 0;
                            $tc = 0;
                            foreach ($ro as $valuex) {
                              $f1++;
                              $tc = $tc + $valuex['amt'];
                              ?>
                              <tr>
                                <th>
                                  <?php echo $f1; ?>
                                </th>
                                <td>
                                  <?php echo $valuex['edt']; ?>
                                </td>
                                <th>
                                  <?php

                                  $fld1x['sl'] = $valuex['dr'];
                                  $op1x['sl'] = "=,";

                                  $main_ledger = new Init_Table();
                                  $main_ledger->set_table("main_ledger", "sl");
                                  $rowx = $main_ledger->search_custom($fld1x, $op1x, '', array('sl' => 'ASC'));
                                  $pdo = new MainPDO();
                                  foreach ($rowx as $valuesx) {
                                  }


                                  echo $valuesx['ldg'];
                                  ?>
                                </th>
                                <th>
                                  <?php echo $valuex['amt']; ?>
                                </th>
                              </tr>
                              <?php
                            }
                            ?>
                          </tbody>

                        </table>
                      </td>
                      <?php
                    }
                    if($pid==4){

                    ?>
                      <td>

                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th scope="col">SL</th>
                              <th scope="col">DATE</th>
                              <th scope="col">FROM</th>
                              <th scope="col">AMOUNT</th>

                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $fld1['dr'] = $sl;
                            $op1['dr'] = "=, and";
                            $fld1['sl'] = '0';
                            $op1['sl'] = ">, and edt between '$d1' and '$d2'";


                            $list1 = new Init_Table();
                            $list1->set_table("main_drcr", "sl");
                            $row = $list1->search_custom($fld1, $op1, '', array('edt' => 'ASC'));
                            $f = 0;
                            $td = 0;
                            foreach ($row as $value) {
                              $f++;
                              $td = $td + $value['amt'];
                              ?>
                              <tr>
                                <th>
                                  <?php echo $f; ?>
                                </th>
                                <td>
                                  <?php echo $value['edt']; ?>
                                </td>
                                <th>
                                  <?php


                                  $fld1x['sl'] = $value['cr'];
                                  $op1x['sl'] = "=,";

                                  $main_ledger = new Init_Table();
                                  $main_ledger->set_table("main_ledger", "sl");
                                  $rowx = $main_ledger->search_custom($fld1x, $op1x, '', array('sl' => 'ASC'));
                                  $pdo = new MainPDO();
                                  foreach ($rowx as $valuesx) {
                                  }


                                  echo $valuesx['ldg'];
                                  ?>
                                </th>
                                <th>
                                  <?php echo $value['amt']; ?>
                                </th>

                              </tr>
                              <?php
                            }
                            ?>
                          </tbody>
                        </table>

                      </td>
                     <?php
                    }
                     ?>
                    </tr>
                  </tbody>
                  <tr>
                  <?php
                    if($pid==3){
                    ?>
                    <td>Total Credit : <b>
                        <?php echo $tc; ?>
                      </b></td>
                      <?php
                    }
                    if($pid==4){

                    ?>
                      <td>Total Debit : <b>
                        <?php echo $td; ?>
                      </b></td>
<?php
                    }
?>
                  </tr>
                </table>
<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);
include "membersonly.inc.php";
$Members  = new isLogged(1);
$d1=$_REQUEST['d1'];
$d2=$_REQUEST['d2'];
$sl=$_REQUEST['sl'];
?>
<table class="table table-bordered">
                  <thead>
                    <tr>
                      <th scope="col">DEBIT</th>
                      <th scope="col">CREDIT</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
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
                    </tr>
                  </tbody>
                  <tr>
                    <td>Total Debit : <b>
                        <?php echo $td; ?>
                      </b></td>
                    <td>Total Credit : <b>
                        <?php echo $tc; ?>
                      </b></td>
                    <td>Current Balance : <b>
                        <?php echo $td - $tc; ?>
                      </b></td>
                  </tr>
                </table>
<?php

error_reporting(0);

require_once 'db.php';
$MOBNO              = '1736180458';
$today_datetime_int = date("YmdHis");

 $query="SELECT * FROM (SELECT * FROM QUIZ_CONTEST_CONTENT WHERE TO_DATE(QDATE,'DD-MM-YY') = TO_DATE(SYSDATE, 'DD-MM-YY') ) WHERE ROWNUM=1";
  $res       = helper_exec_select_query($conn, $query);
  print_r($res);
  if($res){
  $i = 0;
  while($res['SEQ'][$i]){
  $seq=$res['SEQ'][$i];
  $service=$res['SERVICE'][$i];
  $qtype=$res['QTYPE'][$i];
  $category=$res['CATEGORY'][$i];
  $status=$res['STATUS'][$i];
  $i++;
  //  print_r($seq);

  }
  }
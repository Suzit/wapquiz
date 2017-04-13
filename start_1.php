<?php
error_reporting(0);

require_once 'db.php';

$MOBNO              = '1736180458';
$today_datetime_int = date("YmdHis");
/*
  $table1="SELECT SERVICE, SEQ, QTYPE, CATEGORY,STATUS FROM QUIZ_CONTEST_CONTENT WHERE SEQ='12'";
  $res       = helper_exec_select_query($conn, $table1);
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
  // print_r($seq);



  //$quiz_query="INSERT INTO QUIZ_CONTEST_LOG(SEQ,SERVICE,MOBILENO,QUES_NUM,ANSERED,POINT,STATUS,QTYPE,CATEGORY) VALUES ('1002','GK','" .  $_GET['MSISDN'] . "','2','B','5','0','Regular','Bangladesh')";
  $quiz_query="INSERT INTO QUIZ_CONTEST_LOG(SEQ,SERVICE,MOBILENO,QUES_NUM,ANSERED,POINT,STATUS,QTYPE,CATEGORY) VALUES ('1012','".  $service  ."','" .  $MOBNO . "','".  $seq  ."','B','0','".  $status  ."','".  $qtype  ."','".  $category  ."')";
  //echo"====>".$quiz_query;
  $result = helper_exec_update_query($conn, $quiz_query);
  //print_r($result);
  if($result){
  //echo "successfully inserted";
  }
 */

$msg   = 'Q';
//echo $msg;
$ans1  = trim($_REQUEST['A']);
//echo $ans1;
//$ans2= trim($_REQUEST['ans2']);
//echo $ans2;
$score = 'score';
//echo $point;
//$current_date = date('d-M-y');
//echo  "====>>> ".$current_date;

if ($msg == 'Q') {
    /*
    $random_question = "SELECT * FROM  
(SELECT * FROM QUIZ_CONTEST_CONTENT LEFT JOIN QUIZ_CONTEST_LOG ON 
QUIZ_CONTEST_CONTENT.SEQ = QUIZ_CONTEST_LOG.QUES_NUM 
WHERE TO_DATE(QUIZ_CONTEST_LOG.EDATE,'DD-MM-YY') = TO_DATE(SYSDATE, 'DD-MM-YY')
ORDER BY QUIZ_CONTEST_LOG.SEQ DESC ) 
WHERE ROWNUM =1";
    $res             = helper_exec_select_query($conn, $random_question);
    if ($res) {
        $i = 0;
        while ($res['SEQ'][$i]) {
            $seq1         = $res['SEQ'][$i];
            $service1     = $res['SERVICE'][$i];
            $qtype1       = $res['QTYPE'][$i];
            $question1    = $res['QUESTION'][$i];
            //echo $question;
            $correct_ans1 = $res['CORRECT'][$i];
            $option1      = $res['OPTION1'][$i];
            $option2      = $res['OPTION2'][$i];
            $i++;
            //  print_r($seq);
        }
    }
     * 
     */
    $first_ques = "SELECT * FROM (SELECT * FROM QUIZ_CONTEST_CONTENT WHERE TO_DATE(QDATE,'DD-MM-YY') = TO_DATE(SYSDATE, 'DD-MM-YY') ORDER BY QUESTION ASC) WHERE ROWNUM=1";
    $res       = helper_exec_select_query($conn, $first_ques);
    //print_r($res);
    if($res){
     $i = 0;
     while($res['SEQ'][$i]){
        $seq=$res['SEQ'][$i];
        //echo $seq;
        $service=$res['SERVICE'][$i];
        $qtype=$res['QTYPE'][$i];
        $question=$res['QUESTION'][$i];
        $correct_ans=$res['CORRECT'][$i];
        $option1      = $res['OPTION1'][$i];
        $option2      = $res['OPTION2'][$i];
        $i++;
      //  print_r($seq);
         
    }
}
}


$Answered_Check = "SELECT *
FROM ( SELECT * FROM QUIZ_CONTEST_CONTENT LEFT JOIN QUIZ_CONTEST_LOG ON 
QUIZ_CONTEST_CONTENT.SEQ = QUIZ_CONTEST_LOG.QUES_NUM 
WHERE TO_DATE(QUIZ_CONTEST_LOG.EDATE,'DD-MM-YY') = TO_DATE(SYSDATE, 'DD-MM-YY')
ORDER BY QUIZ_CONTEST_LOG.SEQ DESC ) 
WHERE ROWNUM =1";
//echo $Answered_Check;
$res1           = helper_exec_select_query($conn, $Answered_Check);
if ($res1) {
    $i = 0;
    while ($res1['SEQ'][$i]) {
        $seq2         = $res1['SEQ'][$i];
        //echo $seq2;
        $service2     = $res1['SERVICE'][$i];
        // echo $service;
        $qtype2       = $res1['QTYPE'][$i];
        // echo $qtype;
        $correct_ans2 = $res1['CORRECT'][$i];
        //echo $correct_ans2;
        $Score2       = $res1['POINT'][$i];
        $i++;
        //  print_r($seq);
    }
}
if ($_POST['submit']) {

    if ($ans1 == $correct_ans2) {
        //echo 'abcd';

        $update = "UPDATE QUIZ_CONTEST_LOG SET POINT = POINT+1, STATUS = 1, ANSERED='" . $ans1 . "', DATEINT=  $today_datetime_int   WHERE SEQ=  $seq2   AND MOBILENO= $MOBNO   AND SERVICE='" . $service2 . "' ";
        //print_r($update);
        // echo $update;
        $result = helper_exec_update_query($conn, $update);
        if ($result) {
            //echo 'Successfully updated';
        }
    }
    else {
        //echo 'abcd';
        $negative_update = "UPDATE QUIZ_CONTEST_LOG SET POINT = POINT-1, STATUS = 1, ANSERED='" . $ans1 . "', DATEINT=  $today_datetime_int   WHERE SEQ=  $seq2   AND MOBILENO= $MOBNO   AND SERVICE='" . $service2 . "' ";
        $result          = helper_exec_update_query($conn, $negative_update);
        if ($result) {
            //echo 'Successfully updated';
        }
    }
 $random_question = "SELECT * FROM  
(SELECT * FROM QUIZ_CONTEST_CONTENT LEFT JOIN QUIZ_CONTEST_LOG ON 
QUIZ_CONTEST_CONTENT.SEQ = QUIZ_CONTEST_LOG.QUES_NUM 
WHERE TO_DATE(QUIZ_CONTEST_LOG.EDATE,'DD-MM-YY') = TO_DATE(SYSDATE, 'DD-MM-YY')
ORDER BY QUIZ_CONTEST_LOG.SEQ DESC ) 
WHERE ROWNUM =1";
    $res             = helper_exec_select_query($conn, $random_question);
    if ($res) {
        $i = 0;
        while ($res['SEQ'][$i]) {
            $seq         = $res['SEQ'][$i];
            $service     = $res['SERVICE'][$i];
            $qtype       = $res['QTYPE'][$i];
            $question    = $res['QUESTION'][$i];
            //echo $question;
            $correct_ans = $res['CORRECT'][$i];
            $option1      = $res['OPTION1'][$i];
            $option2      = $res['OPTION2'][$i];
            $i++;
            //  print_r($seq);
        }
    }
}
if ($score == 'score') {
    //echo 'abcd........';
    $total_point_query = "SELECT  SUM(POINT) AS TOTAL_POINT FROM QUIZ_CONTEST_LOG WHERE MOBILENO=$MOBNO";
//echo $total_point_query;
    $res1              = helper_exec_select_query($conn, $total_point_query);
//print_r($res1);
    if ($res1) {
        $i = 0;
            $total_point = $res1['TOTAL_POINT'][$i];
            //echo $total_point;
            //  print_r($seq);
    }
    else{
        $total_point=0;
    }

    $todays_point = "SELECT SUM(POINT) AS TODAYS_POINT FROM QUIZ_CONTEST_LOG WHERE MOBILENO=$MOBNO AND TO_DATE(QUIZ_CONTEST_LOG.EDATE,'DD-MM-YY') = TO_DATE(SYSDATE, 'DD-MM-YY') GROUP BY POINT";
    $res1         = helper_exec_select_query($conn, $todays_point);
//print_r($res1);
    if ($res1) {
        $i = 0;
        $today_point = $res1['TODAYS_POINT'][$i];
            //echo $today_point;
    //  print_r($seq);
        
    }
    else {
        $today_point=0;
    }
}
?>                                                              
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
            <title>SMS Report Panel</title>
            <meta content="" name="keywords">
                <meta content="" name="description">

                    <link media="all" type="text/css" rel="stylesheet" href="style.css">
                        <style>
                        </style>
                        <script>

                            function nameempty()
                            {
                                var i = 0;
                                if (document.form.user_id.value == '') {
                                    i++;
                                }
                                if (document.form.pass.value == '') {
                                    i++;
                                }

                                if (i > 0) {
                                    return false;
                                }
                            }
                        </script>
                        </head>
                        <body >
                            <div id="wrapper">
                                <div id="header">
                                    <div class="logo">
                                        <img height="90px" src="images/logo.jpg">
                                    </div>
                                    <div class="htext">
                                        <h1>SMS Report</h1>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>

                                <div id="menu">
                                    <ul>
                                        <li class=""> </li>
                                        <li>

                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div id="content">
                                    <div class="box" align="center" style="padding:150px 0 150px 0;">
                                        <form id="form" onsubmit="return nameempty();" action="start.php" enctype="multipart/form-data" method="post" name="form">
                                                      <?php echo $question; ?> <br> <br>
                                                    <div align="center" style="margin:auto; width:650;">
                                                        <input type="radio" name="A" value="A" id="radio1"><?php echo $option1 ?>
                                                            <input type="radio" name="A" value="B" id="radio2"><?php echo $option2 ?>   <br>
                                                                    <br><br>
                                                                            <input type="submit" value="Submit" name="submit" /> 
                                                                            </form>
                                                                            <br><br>
                                                                                    <table style='font-size:13px;' border='1' align='center' width='50%'><tr align='center' bgcolor='#999999'>
                                                                                            <td><b> Today's Point </b></td>
                                                                                            <td><b> Total Point </b></td>
                                                                                        </tr>
                                                                                        <?php
                                                                                  echo "<tr align='center' valign='middle'>";
                                                                                 echo "<td>" . $today_point . "</td>
                                                                                    <td>" . $total_point . "</td>
                                                                                     </tr>";
                                                                                     ?>
                                                                                    </table>
                                                                                    </div>
                                                                                    </div>
                                                                                    </div>
                                                                                    <div id="footer">
                                                                                        <p>
                                                                                            <img height="80px" src="images/16309.jpg">
                                                                                        </p>
                                                                                    </div>
                                                                                    </body>
                                                                                    </html>
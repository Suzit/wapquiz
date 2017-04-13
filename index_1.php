<?php
error_reporting(0);

require_once 'db.php';

$MOBNO              = '1736180458';
$today_datetime_int = date("YmdHis");
$msg                = 'Q';

if ($msg == 'Q') {
    $dat            = date("d-m-Y");
//echo $dat;
//$dat = date("01-11-2016");
//  $question_query = "SELECT * FROM (SELECT * FROM QUIZ_CONTEST_CONTENT where to_char(qdate,'DD-MM-YYYY')='$dat' ORDER BY DBMS_RANDOM.RANDOM ASC) WHERE ROWNUM=1";
    // check Log
    $question_query = "SELECT * FROM (SELECT * FROM QUIZ_CONTEST_CONTENT WHERE to_char(qdate,'DD-MM-YYYY')='$dat' AND QUIZ_CONTEST_CONTENT.SEQ NOT IN (SELECT QUES_NUM FROM QUIZ_CONTEST_LOG) ORDER BY DBMS_RANDOM.RANDOM ASC) WHERE ROWNUM=1";

    // echo $question_query;
    $result = helper_exec_select_query($conn, $question_query);


    //print_r($result);


    if ($result) {
        $i        = 0;
        // while ($result['SEQ'][$i]) {
        $seq      = $result['SEQ'][$i];
        $service  = $result['SERVICE'][$i];
        $qtype    = $result['QTYPE'][$i];
        $category = $result['CATEGORY'][$i];
        $status   = $result['STATUS'][$i];
        $question = $result['QUESTION'][$i];
        //echo $question;
        $option1  = $result['OPTION1'][$i];
        $option2  = $result['OPTION2'][$i];
        $correct  = $result['CORRECT'][$i];
        //echo $correct;
        $i++;
        //  print_r($seq);

        echo $seq . "=====>>> ";
        //sss}
    }
    $insert_query = "INSERT INTO QUIZ_CONTEST_LOG(SERVICE,MOBILENO,QUES_NUM,QTYPE,CATEGORY) VALUES ('" . $service . "','" . $MOBNO . "','" . $seq . "','" . $qtype . "','" . $category . "')";
    //echo"====>".$insert_query;
    $result       = helper_exec_update_query($conn, $insert_query);
    //print_r($result);
    if ($result) {
        //echo "successfully inserted";
    }
}
// $multiple_ques="SELECT * FROM (SELECT * FROM QUIZ_CONTEST_CONTENT WHERE TO_DATE(QDATE,'DD-MM-YY') = '24-OCT-16' AND QUIZ_CONTEST_CONTENT.SEQ NOT IN (SELECT QUES_NUM FROM QUIZ_CONTEST_LOG) ORDER BY DBMS_RANDOM.RANDOM ASC) WHERE ROWNUM=1";
if (isset($_POST['submit'])) {

//    echo '<pre>';
//    print_r($_POST);
//    echo '</pre>';
//    die("UUUUUUUUUUUUUUUUu");

    $ans1 = trim($_REQUEST['A']);
    //echo $ans1;     

    if ($ans1 == $correct) {
//        echo "IF Executed !";
        $update = "UPDATE QUIZ_CONTEST_LOG SET POINT = POINT+1, STATUS = 1, ANSERED='" . $ans1 . "', DATEINT=$today_datetime_int WHERE MOBILENO=$MOBNO AND SERVICE='" . $service . "' AND QTYPE='" . $qtype . "' AND QUES_NUM=" . $_POST['seq_num'];
        //print_r($update);
//        die($update);
        $result = helper_exec_update_query($conn, $update);
        if ($result) {
            //echo 'Successfully updated';
        }
    }
    else {
//        echo ("ELSE Executed !");
        //echo 'abcd';
        $negative_update = "UPDATE QUIZ_CONTEST_LOG SET POINT = POINT-1, STATUS = 1, ANSERED='" . $ans1 . "', DATEINT=  $today_datetime_int   WHERE MOBILENO= $MOBNO AND SERVICE='" . $service . "' AND QUES_NUM=" . $_POST['seq_num'];
//        die($negative_update);
        $result          = helper_exec_update_query($conn, $negative_update);
        if ($result) {
            //echo 'Successfully updated';           
        }
    }
    $next_question = "SELECT * FROM (SELECT * FROM QUIZ_CONTEST_CONTENT WHERE TO_DATE(QDATE,'DD-MM-YY') = '27-OCT-16' AND QUIZ_CONTEST_CONTENT.SEQ NOT IN (SELECT QUES_NUM FROM QUIZ_CONTEST_LOG) ORDER BY DBMS_RANDOM.RANDOM ASC) WHERE ROWNUM=1";

    $result = helper_exec_select_query($conn, $next_question);
    //print_r($result);
    if ($result) {
        $i = 0;
        while ($result['SEQ'][$i]) {
            $seq      = $result['SEQ'][$i];
            //echo $seq;
            $service  = $result['SERVICE'][$i];
            $qtype    = $result['QTYPE'][$i];
            $category = $result['CATEGORY'][$i];
            $status   = $result['STATUS'][$i];
            $question = $result['QUESTION'][$i];
            //echo $question;
            $option1  = $result['OPTION1'][$i];
            $option2  = $result['OPTION2'][$i];
            $correct  = $result['CORRECT'][$i];
            //echo $correct;
            $i++;
            //  print_r($seq);
        }
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
                                        <form id="form" onsubmit="return nameempty();" action="index.php" enctype="multipart/form-data" method="post" name="form">
                                            <input type="hidden" name="seq_num" value="<?php echo $seq; ?>" />
                                            <?php echo $question; ?> <br> <br>
                                                    <div align="center" style="margin:auto; width:650;">
                                                        <input type="radio" name="A" value="A" id="radio1"><?php echo $option1 ?>
                                                            <input type="radio" name="A" value="B" id="radio2"><?php echo $option2 ?>   <br>
                                                                    <br><br>
                                                                            <input type="submit" value="Submit" name="submit" /> 

                                                                            </div>

                                                                            </form>
                                                                            </div>
                                                                            </div>
                                                                            <div id="footer">
                                                                                <p>
                                                                                    <img height="80px" src="images/16309.jpg">
                                                                                </p>
                                                                            </div>
                                                                            </body>
                                                                            </html>


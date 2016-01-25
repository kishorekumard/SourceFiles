<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<META HTTP-EQUIV="Content-language" CONTENT="ar">
<?php 
phpinfo(); exit;
ob_start();   
set_time_limit(3000); 
ini_set('mbstring.internal_encoding','utf-8');
ini_set('default_charset','utf-8');
ini_set("mbstring.language", "Neutral");
ini_set("mbstring.internal_encoding", "utf-8");
ini_set("mbstring.encoding_translation", "On");
ini_set("mbstring.http_input", "auto");
ini_set("mbstring.http_output", "utf-8");
ini_set("mbstring.detect_order", "auto");
ini_set("mbstring.substitute_character", "none");
ini_set("default_charset", "utf-8");
ini_set("mbstring.func_overload", 7);

//setlocale(LC_TIME, "en_US.utf-8");
/*$link = mysql_connect("localhost", 'server84', 'server84');
mysql_select_db('systemtest');*/



$hostname = '{10.10.18.20:143/imap/novalidate-cert}Test';
$username = 'suresh.kumar@cattechnologies.com'; 
$password = 'suresh';

mysql_query("SET CHARACTER SET utf8");
mysql_query("SET NAMES utf8");
header('Content-Type: text/html; charset=utf-8');
   
$inbox = $emails = $inbox_result = $MsgCount = $total_messages = "";
$inbox = imap_open($hostname, $username, $password) or die('Cannot connect to - '.$serverhost." - - " . imap_last_error());
$emails = imap_search($inbox, 'ALL', SE_UID);
if ($emails) {
$MsgCount = imap_check($inbox);
if($MsgCount->Nmsgs > 0){
    $inbox_result = imap_fetch_overview($inbox,"1:{$MsgCount->Nmsgs}",0);
    $total_messages=count($inbox_result);
    if($total_messages>0)
    {
        for($mi=0;$mi<$total_messages;$mi++)
        {
            $seen =  $msgno = $subject =$comment = "";
            $seen = $inbox_result[$mi]->seen;
            $msgno = $inbox_result[$mi]->msgno;
                     
                $subject = $inbox_result[$mi]->subject;
                $comment = imap_body($inbox, $msgno);                
                //echo  $comment;
                /* echo  "<br><br><br><br>";
                echo  quoted_printable_decode($comment);
                echo  "<br><br><br><br>";
                echo  quoted_printable_encode($comment);
                echo  "<br><br><br><br>";
                echo  base64_encode($comment);
                echo  "<br><br><br><br>";
                echo  base64_decode($comment);
                echo  "<br><br><br><br>";
                echo  imap_binary($comment);
                echo  "<br><br><br><br>";*/                
                //echo $data=mb_detect_encoding($comment, "auto");
                //echo $string = iconv('ASCII', 'UTF-8//IGNORE', $comment);
                //mb_convert_encoding($comment, 'UTF-8');
                //$sd=utf8_encode($comment);
                // echo $string = iconv('ASCII', 'UTF-8//IGNORE', $sd);
                //echo $comment = mb_convert_encoding($comment, 'HTML-ENTITIES', "UTF-8");
                //echo $string = iconv('ASCII', 'UTF-8//IGNORE', $comment);
                $data=quoted_printable_decode($comment);
                iconv('ASCII', 'UTF-8//IGNORE', $data);
                $data1=utf8_decode($data );
                echo $lang= mb_convert_encoding($data1, "UTF-8", "auto");                
            }
    }
}
} else {
echo "No New Emails ....";
imap_close($inbox);
exit;
}
echo "Reading Completed Successfully...";
exit;
/* try to connect */
$inbox = imap_open($hostname,$username,$password) or die('Cannot connect to Gmail: ' . imap_last_error());
$emails = imap_search($inbox,'ALL');
/* useful only if the above search is set to 'ALL' */
$max_emails = 16;
/* if any emails found, iterate through each email */
if($emails) {
    $count = 1;
        /* put the newest emails on top */
    rsort($emails);
        /* for every email... */
    foreach($emails as $email_number) 
    {
        /* get information specific to this email */
        $overview = imap_fetch_overview($inbox,$email_number,0);
        /* get mail message */
        $message = imap_fetchbody($inbox,$email_number,2);
       echo $message; 
                
        if($count++ >= $max_emails) break;
    }
  } 
/* close the connection */
imap_close($inbox);
echo "Done";

?>
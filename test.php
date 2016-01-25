<?                         
                               $vendors_name_admin = $client_admin_email_name = $vendor_user_email_name ="ASAsASasAS";
        $mailList_name = array($vendors_name_admin, $client_admin_email_name, $vendor_user_email_name);
                      print_r($mailList_name);
                      exit;
?>

<html xmlns="http://www.w3.org/1999/xhtml" lang="ar" xml:lang="ar" />
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1256" />
<meta http-equiv="Content-Language" content="ar-sy">
<meta name="description" content="<?php echo htmlentities($meta_description);?>" />
 <meta name="description" content="Arabic Editor, Arabic Word processor, ActiveX, Write Arabic, Urdu Editor, Urdu Wordprocessor, ActiveX, Language, Urdu, Write Urdu, Editor, Arabic, Word Processor">   
</head>
<?php 
ob_start();   
set_time_limit(3000); 
/*ini_set('mbstring.internal_encoding','utf-8');
ini_set('default_charset','utf-8');
ini_set("mbstring.language", "Neutral");
ini_set("mbstring.internal_encoding", "utf-8");
ini_set("mbstring.encoding_translation", "On");
ini_set("mbstring.http_input", "auto");
ini_set("mbstring.http_output", "utf-8");
ini_set("mbstring.detect_order", "auto");
ini_set("mbstring.substitute_character", "none");
ini_set("default_charset", "utf-8");
ini_set("mbstring.func_overload", 7);*/

//setlocale(LC_TIME, "en_US.utf-8");
/*$link = mysql_connect("localhost", 'server84', 'server84');
mysql_select_db('systemtest');*/



$serverhost = "mail.solexplus.com.sa";
$username = 'pandamail1@solexplus.com.sa';
$password = 'sol@123';

$portnumber = "143";  
$hostname = '{'.$serverhost.':'.$portnumber.'/imap}INBOX';

/*mysql_query("SET CHARACTER SET utf8");
mysql_query("SET NAMES utf8");
header('Content-Type: text/html; charset=utf-8');*/
   
$inbox = $emails = $inbox_result = $MsgCount = $total_messages = "";
$inbox = imap_open($hostname, $username, $password) or die('Cannot connect to - '.$serverhost." - - " . imap_last_error());
$emails = imap_search($inbox, 'ALL');

if($emails) {
    $output = '';
    rsort($emails);

    foreach($emails as $email_number) {
        $overview = imap_fetch_overview($inbox,$email_number,0);
        $structure = imap_fetchstructure($inbox, $email_number);  

        if(isset($structure->parts) && is_array($structure->parts) && isset($structure->parts[1])) {
            $part = $structure->parts[1];
            $message = imap_fetchbody($inbox,$email_number,'2.2.2');

            if($part->encoding == 3) {
                $message = imap_base64($message);
            } else if($part->encoding == 1) {
                $message = imap_8bit($message);
            } else {
                $message = imap_qprint($message);
            }
        }

        $output.= '<div class="toggle'.($overview[0]->seen ? 'read' : 'unread').'">';
        $output.= '<span class="from">From: '.utf8_decode(imap_utf8($overview[0]->from)).'</span>';
        $output.= '<span class="date">on '.utf8_decode(imap_utf8($overview[0]->date)).'</span>';
        $output.= '<br /><span class="subject">Subject('.$part->encoding.'): '.utf8_decode(imap_utf8($overview[0]->subject)).'</span> ';
        $output.= '</div>';

        $output.= '<div class="body">'.$message.'</div><hr />';
    }
    $data=quoted_printable_decode($$output);
    iconv('ASCII', 'UTF-8//IGNORE', $data);
    $data1=utf8_decode($data );
    echo $lang= mb_convert_encoding($data1, "UTF-8", "auto"); 
    
    echo $output;
}else {
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
ob_end_flush(); 

?>
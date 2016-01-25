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
error_reporting(E_ALL);
ini_set('display_errors',1);
//include('config.inc.php'); 
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


/*$link = mysql_connect($dbconfig['db_server'], $dbconfig['db_username'], $dbconfig['db_password']);
mysql_select_db($dbconfig['db_name']);
mysql_query("SET NAMES 'utf8'");
mysql_query('SET CHARACTER SET utf8');
$sql_select_ticket = "SELECT picklist_valueid FROM vtiger_ticketcategories WHERE picklist_valueid>764";
$RESULT = mysql_query($sql_select_ticket);*/

set_time_limit(30000000);
function strip_html_tags1($text){
$text = preg_replace(array('@<head[^>]*?>.*?</head>@siu','@<table[^>]*?>.*?</table>@siu'),array('',''),$text);
return trim($text);
}

/*function strip_html_tags($text){
$text=trim(str_ireplace('ltr', "",$text));
$text = preg_replace(
    array
    (
        '@<head[^>]*?>.*?</head>@siu',
        '@<style[^>]*?>.*?</style>@siu',
        '@<script[^>]*?.*?</script>@siu',
        '@<object[^>]*?.*?</object>@siu',
        '@<embed[^>]*?.*?</embed>@siu',
        '@<applet[^>]*?.*?</applet>@siu',
        '@<noframes[^>]*?.*?</noframes>@siu',
        '@<noscript[^>]*?.*?</noscript>@siu',

   //     '@<noembed[^>]*?.*?</noembed>@siu',
  //      '@</?((address)|(blockquote)|(center)|(del))@iu',
  //      '@</?((font)|(div)|(h[1-9])|(ins)|(isindex)|(p)|(pre)|(br))@iu',
  //      '@</?((dir)|(dl)|(dt)|(dd)|(li)|(menu)|(ol)|(ul))@iu',
 //       '@<?((color:)|(background)|(face=3D)|(font-size:12pt)|(font-size:11pt)|(=3D3)|(or=3Dblack)|(- white))@iu',
  //      '@<?((Calibri,Arial,Helvetica,sans-serif)|(#FFFFFF)|(or:#000000)|(font=-family:Calibri,Arial,Helvetica,sans-serif)|(background-color)|(style=3D)|(style)|(7px)|(target job title:b)|(boldtext)|(align)|(valign)|(cellpadding)|(cellspacing)|(width)|(bgcolor)|(border)|(top)|(bottom)|(center)|(valigntop)|(160)|(270)|(180))@iu',
  //      '@<?((table)|(th)|(td)|(tr)|(span)|(caption))@iu',
   //     '@</?((table)|(th)|(td)|(tr)|(span)|(caption))@iu',
  //      '@</?((form)|(button)|(fieldset)|(legend)|(input))@iu',
  //      '@</?((label)|(select)|(optgroup)|(option)|(textarea))@iu',

 //       '@</?((frameset)|(frame)|(iframe))@iu',
 //       '@<?((IMG)|(col)|(height))@iu',
  //      '@<?((form)|(button)|(fieldset)|(legend)|(input))@iu',
//        '@<?((fontfamily:)|(#=FFFFFF)|(or=3Dblack)|(size==3D3)|(id=3DdivRplyFwdMsg)|(id=3DdivRplyFwdMsg)|(#000000)|(Calibri)|(sans-serif)|(- white)|(=CA)|(=E3)|(=CD)|(=E1)|(=C7)|(=E1)|(=E3)|(=D4)|(=DF)|(=E1)|(=C9)|(=ED)|(=D3)|(=C8)|(=E4)|(=C8)|(=E4)|(=EC)|(=ED)|(=C8)|(=E4)|(=EC)|(=E4)|(=ED)|(=C8)|(=EC)|(=E4)|(=ED)|(=D1)|(=CC)|(=C1)|(=DA)|(=CF)|(=D1)|(=CF))@iu',

    ),
    array(' ', ' ', ' ', ' ',' ',' ', ' ', ' ', ' ',' ', ' ', ' ', ' ',' ', ' ', ' ', ' ',' ', ' ', ' ', ' ', ' ',),
    $text);
$text=trim(str_ireplace(';', "",str_ireplace('"', "",str_ireplace(':white;', "", str_ireplace('dir=3D', "",  str_ireplace('dir=3Dl', "",  str_ireplace('dir=3D"l;', "", str_ireplace("&nbsp;", "", str_ireplace(">", "", str_ireplace("<", "", str_ireplace("<=", "", str_ireplace('font face=3D"Calibri,Arial,Helvetica,sans-serif"', '', strip_tags($text)))))))))))));
$text = str_ireplace(array('or=3D','id=3DdivRplyFwdMsg',',','-','face==3D','fontfamily:','#=FFFFFF','class=3DdvHeaderText'),'',$text);
$text = str_ireplace(array('  '),' ',$text);
return trim($text);
}*/
$serverhost = "mail.solexplus.com.sa";
$username = 'pandamail1@solexplus.com.sa';
$password = 'sol@123';

$portnumber = "143";  
$hostname = '{'.$serverhost.':'.$portnumber.'/imap}TEST';

$inbox = $emails = $inbox_result = $MsgCount = $total_messages = "";
$inbox = imap_open($hostname, $username, $password) or die('Cannot connect to - '.$serverhost." - - " . imap_last_error());
$emails = imap_search($inbox, 'ALL');//, SE_UID);
if ($emails) {
$MsgCount = imap_check($inbox);
if($MsgCount->Nmsgs > 0){
    $inbox_result = imap_fetch_overview($inbox,"1:{$MsgCount->Nmsgs}",0);
   /* echo "<pre>";
    print_r($inbox_result);*/
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
            echo $subject = imap_utf8($inbox_result[$mi]->subject);
            $comment =  imap_fetchbody($inbox,$msgno,1);
            
            
            $data=quoted_printable_decode($comment);
            //iconv('ASCII', 'UTF-8//IGNORE', $data);
            //echo $convertedString = iconv('ISO-8859-1', 'UTF-8//TRANSLIT', $data);
            $data1=utf8_decode($data );
            echo $lang= mb_convert_encoding($data1, "UTF-8", "auto");
            
            
            


/*            $unifer_pattern_err = '/<span [^>]*?>([\\s\\S]*?)<\/span>/';*/
  //          preg_match($unifer_pattern_err, $comment, $matches_xml_err);
//mysql_query("SET NAMES 'utf8'");
//mysql_query('SET CHARACTER SET utf8');
//$comment=$matches_xml_err[1];

        //$comment = '=?UTF-8?B?' . utf8_decode($comment) . '?=';
        $comment = utf8_decode($comment);
        $comment = imap_utf8($comment);
        $comment = quoted_printable_decode($comment);
        $comment= imap_qprint($comment);
        $comment= mb_convert_encoding($comment, "UTF-8", "auto"); 

//echo        $comment = imap_utf8($comment);
//echo        $comment = quoted_printable_decode($comment);
//echo        $comment = utf8_decode($comment);

//
//echo        $comment = imap_utf8($comment);
//echo        $comment = utf8_decode($comment);
//echo        $comment = quoted_printable_decode($comment);




    //  echo  $comment = quoted_printable_decode(utf8_decode($comment));



  //  echo    $comment= mb_convert_encoding($comment , "UTF-8", "auto");

            
    //    $comment1 = imap_body($inbox, $msgno);
        //    $data=quoted_printable_decode($comment1);
        //    $data1=utf8_decode($data);
         //   $comment= mb_convert_encoding($data1, "UTF-8", "auto"); 
            
            
          //  echo $subject;
        //    echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";
          //  echo $comment;
            
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
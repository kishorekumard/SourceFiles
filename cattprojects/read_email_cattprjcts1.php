<?php
ob_start();   
set_time_limit(3000);
$serverhost = "mail.cattprojects.com";
$username = 'James.Martin@cattprojects.com';
$password = '!Martin#45';

//$username = 'Robert.Villiams@cattprojects.com';
//$password = '!Villiam#45'; 
$portnumber = "143";  
$hostname = '{'.$serverhost.':'.$portnumber.'/imap/novalidate-cert}INBOX';
$inbox = $emails = $inbox_result = $MsgCount = $total_messages = "";
$inbox = imap_open($hostname, $username, $password) or die('Cannot connect to - '.$serverhost." - - " . imap_last_error());
$allcomments="";
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
                   // print_r($inbox_result[$mi]);
                    $seen =  $msgno = $subject =$comment = "";
                    $seen = $inbox_result[$mi]->seen;
                    $msgno = $inbox_result[$mi]->msgno;
                   // if($seen==0){
                   $subject = imap_utf8($inbox_result[$mi]->subject);
                   $comment = trim(get_part($inbox, $msgno, "TEXT/HTML"));
                   if($comment == ""){
                    $comment = get_part($inbox, $msgno, "TEXT/PLAIN");
                   }
                   $comment= iconv("windows-1256" , "utf8" , $comment);  
                   if(trim($comment) != ""){
                   $allcomments.=$comment;
                   $comment_with_sub = "";
                   $comment_with_sub = "###Start###".$subject . " -------------- ".$comment."###END###";
                   $filename="James--".date('Y-m-d').".txt";
                   $filename_Path = '/var/www/html/SourceFiles/cattprojects/James/'.$filename;
/*                   if(file_exists($filename_Path))
                   {
                       unlink($filename_Path);
                   } */
                   $handle = fopen($filename_Path, 'a');
                   chmod($filename_Path,0777);
                   if (fwrite($handle, $comment_with_sub) === FALSE) {
                       echo "<font color='red'>Cannot write to file ($filename_Path)</font>\n<br/>";
                   }
                   echo "Success, wrote to file ($filename_Path)\n<br/><br/>";
                    } 
                }
                }
            }
        }
    //}
    echo "Reading Completed Successfully...";
/*    $contents = $allcomments;
    $email_text = $email = $email_text_sql = "";
    $emailpattern = '/[A-Z_a-z0-9-]+(\.[A-Z_a-z0-9-]+)*@[A-Za-z0-9-]+(\.[A-Za-z0-9-]+)*(\.[A-Za-z]{2,3})/i'; //regex for pattern of e-mail address
    preg_match_all($emailpattern, $contents, $email_matches);
        if (count($email_matches) > 0) {
            for ($em = 0; $em < count($email_matches[0]); $em++) {
                $email_text .= trim(strtolower($email_matches[0][$em])) . ",";
                //$email_text .= trim(strtolower($email_matches[0][$em])) . "\n";
            }
        }
         //print_r(array_unique(explode(",", rtrim(ltrim($email_text, ",")))));
          $email = implode(' ,\n ', array_unique(explode(",", rtrim(ltrim($email_text, ","), ","))));

          echo $email;    */
    
    function get_mime_type(&$structure) {
        $primary_mime_type = array("TEXT", "MULTIPART", "MESSAGE", "APPLICATION", "AUDIO", "IMAGE", "VIDEO", "OTHER");
        if($structure->subtype) {
            return $primary_mime_type[(int) $structure->type] . '/' . $structure->subtype;
        }
        return "TEXT/PLAIN";
    }

    function get_part($stream, $msg_number, $mime_type, $structure = false, $part_number = false) {
        if (!$structure) {
            $structure = imap_fetchstructure($stream, $msg_number);
        }             
        if($structure) {
            if($mime_type == get_mime_type($structure)) {
                if(!$part_number) {
                    $part_number = "1";
                }
                $text = imap_fetchbody($stream, $msg_number, $part_number);
                if($structure->encoding == 3) {
                    return imap_base64($text);
                } else if ($structure->encoding == 4) {
                    return imap_qprint($text);    
                } else {
                    return $text;
                }
            }
            if ($structure->type == 1) { /* multipart */
                while (list($index, $sub_structure) = each($structure->parts)) {
                    if ($part_number) {
                        $prefix = $part_number . '.';
                    }
                    $data = get_part($stream, $msg_number, $mime_type, $sub_structure, $prefix . ($index + 1));
                    if ($data) {
                        return $data;
                    }
                }
            }
        }
        return false;
    }
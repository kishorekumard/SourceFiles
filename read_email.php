<?php
//exit;
ob_start();   
//error_reporting(E_ALL);
//ini_set('display_errors',1);
set_time_limit(3000);
/*include('config.inc.php');
$link = "";
$link = mysql_connect($dbconfig['db_server'], $dbconfig['db_username'], $dbconfig['db_password']);
mysql_select_db($dbconfig['db_name']);
mysql_query("SET character_set_client='utf8'",$link);
mysql_query("SET character_set_connection='utf8'",$link);
mysql_query("SET character_set_database='utf8'",$link);
mysql_query("SET character_set_results='utf8'",$link);
mysql_query("SET character_set_server='latin1'",$link);
mysql_query("SET character_set_system='utf8'",$link);
mysql_query("SET collation_connection='utf8_general_ci'",$link);
mysql_query("SET collation_database='utf8_general_ci'",$link);
mysql_query("SET collation_server='latin1_general_ci'",$link);
mysql_query("SET NAMES 'utf8'",$link);
mysql_query('SET CHARACTER SET utf8',$link); */
$serverhost = "mail.cattprojects.com";
$username = 'James.Martin@cattprojects.com';
$password = '!Martin#45';
$portnumber = "143";  
//$hostname = '{'.$serverhost.':'.$portnumber.'/imap}INBOX';
$hostname = '{'.$serverhost.':'.$portnumber.'/imap/novalidate-cert}INBOX';
$inbox = $emails = $inbox_result = $MsgCount = $total_messages = "";
$inbox = imap_open($hostname, $username, $password) or die('Cannot connect to - '.$serverhost." - - " . imap_last_error());
$emails = imap_search($inbox, 'ALL', SE_UID);
print_r($emails);
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
                   // if($seen==0){
                      echo  $subject = imap_utf8($inbox_result[$mi]->subject);
                      echo  $comment = trim(get_part($inbox, $msgno, "TEXT/HTML"));
                        if($comment == ""){
                            $comment = get_part($inbox, $msgno, "TEXT/PLAIN");
                        }
                        $comment= iconv("windows-1256" , "utf8" , $comment);  
                /*        $comment = preg_replace("/<img[^>]+\>/i", " ", $comment);
                        $db_comment = preg_replace("/[\r\n]/","\r",$comment);  
                        $db_comment=trim(mysql_real_escape_string(strip_tags($comment)));
                        $db_comment= trim(html_entity_decode($db_comment, ENT_QUOTES, "UTF-8"));
                        $db_comment = trim(str_ireplace(array('\r\r\r','\r\r\r\r','\r\r\r\r\r','\r\r\r\r\r\r'),'',$db_comment));
                        preg_match_all("/TT\d+\s/", $subject, $matches, PREG_PATTERN_ORDER);
                        if(count($matches[0])>0){
                            $user_result = $tkt_nums = "";
                            $tkt_nums = trim($matches[0][0]);
                            ############ Start - Insert / Update Ticket Comments ###################        
                            if ($tkt_nums != "") {
                                $no_of_rows = 0;
                                 $sql_select_ticket = "select ticketid from vtiger_troubletickets where ticket_no='".$tkt_nums."'";
                                $exec_select_ticket = mysql_query($sql_select_ticket);
                                $result_select_ticket = mysql_fetch_array($exec_select_ticket);
                                $no_of_rows = mysql_num_rows($exec_select_ticket);
                                if ($no_of_rows > 0) {
                                    $ticketId = $sql_comments = $findme = $pos1 = "";
                                    $ticketId = trim($result_select_ticket["ticketid"]);
                                    if ($ticketId != "") {
                                        if($db_comment!=""){
                                            $findme="Delivery has failed";
                                            $pos1 = stripos($db_comment, $findme);
                                            if ($pos1 === false) {
                                                $datetime = date('Y-m-d H:i:s');
                                                $tkt_comments_tbl = 'vtiger_ticketcomments';
                                                $sql_comments = $exec_comment = $sql_ttupdate = $exec_ttupdate = "";
                                                $sql_comments="insert into vtiger_ticketcomments (ticketid,comments,createdtime) values (".$ticketId.",'".$db_comment."','".$datetime."')";
                                                $exec_comment = mysql_query($sql_comments);

                                                $sql_ttupdate="update vtiger_troubletickets set status ='In Progress' where ticketid=".$ticketId."";
                                                $exec_ttupdate= mysql_query($sql_ttupdate);
                                            }
                                            mysql_close($link);
                                        }
                                    }
                                }
                            }
                        } */

                    }
                }
            }
        }
/*    } else {
        echo "No New Emails ....";
        if($link){     mysql_close($link); }
        imap_close($inbox);
        exit;
    } */
    echo "Reading Completed Successfully...";
    exit;  

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
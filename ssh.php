<?php
    ob_start();   
    error_reporting(E_ALL);
    ini_set('display_errors' , 1);  
/**
 * Simple example of extending the SQLite3 class and changing the __construct
 * parameters, then using the open method to initialize the DB.
 */
class MyDB extends SQLite3
{
    function __construct()
    {
        $this->open('mysqlitedb.db');
    }
}

$db = new MyDB();

$db->exec('CREATE TABLE foo (bar STRING)');
$db->exec("INSERT INTO foo (bar) VALUES ('This is a test')");

$result = $db->query('SELECT bar FROM foo');
var_dump($result->fetchArray());
exit;

   // error_reporting(E_ALL);
    ini_set('display_errors' , 0);
    set_time_limit(3000);
    $serverhost = "10.10.18.20";
    $username = 'kishore.d@cattechnologies.com';
    $password = '@!'; 
    $portnumber = "143";  
    $hostname = '{'.$serverhost.':'.$portnumber.'/imap/novalidate-cert}Locals';
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
                    $seen =  $msgno = $subject =$comment = "";
                    $seen = $inbox_result[$mi]->seen;
                    $msgno = $inbox_result[$mi]->msgno;
                    if($seen==0){
                        $subject = imap_utf8($inbox_result[$mi]->subject);
                        $comment = trim(get_part($inbox, $msgno, "TEXT/HTML"));
                        if($comment == ""){
                            $comment = get_part($inbox, $msgno, "TEXT/PLAIN");
                        }
                        $comment= iconv("windows-1256" , "utf8" , $comment);  
                        if(trim($comment) != ""){
                            $connection = ssh2_connect('10.10.10.84', 22);
                            ssh2_auth_password($connection, 'root', '');
                            $stream = ssh2_exec($connection, "'".trim($comment)."'");
                            $stderr_stream = ssh2_fetch_stream($stream, SSH2_STREAM_STDERR);
                        }
                    }
                }
            }
        }
    }

    
    
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
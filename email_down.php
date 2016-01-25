<?php
set_time_limit(30000000);
//$hostname = '{imap.gmail.com:993/imap/ssl}INBOX';
//$hostname = '{imap.gmail.com:143/imap/ssl/novalidate-cert}Inbox';
//$hostname = '{imap.gmail.com:143/imap/ssl/novalidate-cert/norsh}Inbox';
//$username = 'catamericaltd@gmail.com';
//$password = 'Kishore@1';

################  Local Mail server ####################
/*$hostname = '{10.10.18.20:143/novalidate-cert}INBOX';
$username = 'kishore.d@cattechnologies.com';
$password = '!@';   */ 

################  Solexplus Mail server ####################

//$hostname = '{imap.solexplus.com.sa:143/novalidate-cert}INBOX';
//$hostname = '{imap.solexplus.com.sa:143/imap/ssl/novalidate-cert}Inbox';

//$hostname = '{212.118.103.37:143/novalidate-cert}INBOX';
//$hostname = '{212.118.103.37:143/imap/ssl/novalidate-cert}INBOX';

//$hostname = '{imap.solexplus.com.sa:25/imap/ssl/novalidate-cert}INBOX';
//$hostname = '{imap.solexplus.com.sa:25/pop3/ssl/novalidate-cert}INBOX';

$portnumber = "143";  //563 ,119 ,143 ,993 ,995 , 110
$serverhost = "mail.solexplus.com.sa";
$username = 'pandamail1@solexplus.com.sa';
$password = 'sol@123';
$hostname = '{'.$serverhost.':'.$portnumber.'/imap/ssl}INBOX';
//$hostname = '{'.$serverhost.':'.$portnumber.'/imap/ssl/novalidate-cert}INBOX';

//$hostname = '{'.$serverhost.':'.$portnumber.'/pop3}INBOX';
//$hostname = '{'.$serverhost.':'.$portnumber.'/pop3/ssl/novalidate-cert}INBOX';





//$message_type = 'ALL';
$message_type = 'UNSEEN';
$inbox = imap_open($hostname, $username, $password , OP_DEBUG) or die('Cannot connect to : ' .$serverhost .' - - '. imap_last_error());
$emails = imap_search($inbox, $message_type);


if ($emails) {
    $count = 1;
    rsort($emails);
    foreach ($emails as $email_number) {
        $overview = imap_fetch_overview($inbox, $email_number, 0);
        $message = imap_fetchbody($inbox, $email_number, 1 ,2);
        $structure = imap_fetchstructure($inbox, $email_number);
        echo "<pre>";
        print_r($overview);
        print_r($message);
        print_r($structure);

        exit;

        $attachments = array();
        if (isset($structure->parts) && count($structure->parts)) {
            for ($i = 0; $i < count($structure->parts); $i++) {
                $attachments[$i] = array(
                    'is_attachment' => false,
                    'filename' => '',
                    'name' => '',
                    'attachment' => ''
                );

                if ($structure->parts[$i]->ifdparameters) {
                    foreach ($structure->parts[$i]->dparameters as $object) {
                        if (strtolower($object->attribute) == 'filename') {
                            $attachments[$i]['is_attachment'] = true;
                            $attachments[$i]['filename'] = $object->value;
                        }
                    }
                }

                if ($structure->parts[$i]->ifparameters) {
                    foreach ($structure->parts[$i]->parameters as $object) {
                        if (strtolower($object->attribute) == 'name') {
                            $attachments[$i]['is_attachment'] = true;
                            $attachments[$i]['name'] = $object->value;
                        }
                    }
                }

                if ($attachments[$i]['is_attachment']) {
                    $attachments[$i]['attachment'] = imap_fetchbody($inbox, $email_number, $i + 1);
                    if ($structure->parts[$i]->encoding == 3) {
                        $attachments[$i]['attachment'] = base64_decode($attachments[$i]['attachment']);
                    } elseif ($structure->parts[$i]->encoding == 4) {
                        $attachments[$i]['attachment'] = quoted_printable_decode($attachments[$i]['attachment']);
                    }
                }
            }
        }

        foreach ($attachments as $attachment) {
            if ($attachment['is_attachment'] == 1) {
                $filename = $attachment['name'];
                if (empty($filename)) $filename = $attachment['filename'];
                if (empty($filename)) $filename = time() . ".dat";
                $fp = fopen("./" . $email_number . "-" . $filename, "w+");
                fwrite($fp, $attachment['attachment']);
                fclose($fp);
            }

        }
        $count = $count + 1;
    }
}
imap_close($inbox);
echo "All Message are Done";
<?php
/*echo phpinfo();
exit;*/
/**
 *	Uses PHP IMAP extension, so make sure it is enabled in your php.ini,
 *	extension=php_imap.dll
  */
 set_time_limit(0); 
 /* connect to gmail with your credentials */

//$hostname = '{imap.gmail.com:993/imap/ssl/novalidate-cert}INBOX';
$hostname = '{imap.gmail.com:993/imap/ssl}INBOX';
$username = 'username@gmail.com'; 
$password = '(pwd)';
/* try to connect */
$inbox = imap_open($hostname,$username,$password ) or die('Cannot connect to Gmail: ' . imap_last_error());

/*$mbox = imap_open( '{imap.gmail.com:993/imap/ssl}INBOX' , $username , $password );
print_r($mbox);*/

$emails = imap_search($inbox,'UNSEEN');
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
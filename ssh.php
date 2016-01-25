<?php
echo phpinfo();
exit;
exec('reboot -n');
error_reporting(E_ALL);
ini_set('display_errors',1);
echo $connection = ssh2_connect("10.10.10.84", 22);
ssh2_auth_password($connection,"root", "abc123");  // or use any of the ssh2_auth_* methods
$sftp = ssh2_sftp($connection);

$dh = opendir("ssh2.sftp://$sftp/var/www/html/");

while (($file = readdir($dh)) !== false) {
  echo "$file is in hostname:/path/to/dirn";
}

closedir($dh);
?> 
<?php
ob_start();
/*echo "<pre>";
error_reporting(E_ALL);
ini_set("display_errors",1);
*/$openfile_path= "/var/www/html/validateemailid/";
$openfile=$openfile_path."Leads1.csv";
$handle = fopen($openfile, "r");
$data = "";
$validemailids="";
$invalidemailids="";
while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
$email = "";
$email = $data[1];
$explode_email=explode('@',$email);
//print_r(dns_get_record('cattechnologies.com'));    
if(count($explode_email)>0)              
{
    $id = $domain = "";
    $domain = $explode_email[6];
    $id = $explode_email[0];
    
  if(filter_var(gethostbyname($domain), FILTER_VALIDATE_IP))
    {   
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                $validemailids.= $id.",".$email.",\n";
        } else {
                $invalidemailids.= $id.",".$email.",";
        }
    }  
}
}
$validfile=$openfile_path."ValidEmail_".date('Y-m-d')."_".time().".csv";
$invalidfile=$openfile_path."InvalidEmail_".date('Y-m-d')."_".time().".csv";

$validemailids = rtrim($validemailids,",");
$invalidemailids = rtrim($invalidemailids,",");

$handle = fopen($validfile, 'a');
fwrite($handle, $validemailids);
fclose($handle);

$handle1 = fopen($invalidfile, 'a');
fwrite($handle1, $invalidemailids);
fclose($handle1);
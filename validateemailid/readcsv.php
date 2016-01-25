<?php
ob_start();
//error_reporting(E_ALL);
//ini_set('display_errors',1);
set_time_limit(0);
ini_set('max_execution_time', 0);
ini_set('max_input_time', -1);
ini_set('memory_limit', -1);
ini_set('post_max_size', '400M');
ini_set('max_input_vars', 55000);
$link = mysql_connect('localhost', 'server84', 'server84');
$selected = mysql_select_db("datavalidate",$link) or die("Could not select examples");
$openfile_path= "/var/www/html/validateemailid/inputdb/";


$file_array=array(
    //'Leads1.csv'
    //'Leads2.csv'
    //'Leads3.csv'
    //'Leads4.csv',
    //'Leads5.csv'
    //'Leads6.csv',
    //'Leads7.csv',
    //'Leads8.csv',
    //'Leads9.csv',
    //'Leads11.csv',
    //'Leads12.csv',
    //'Leads13.csv',
    //'Leads14.csv',
    //'Leads15.csv',
    'Leads16.csv',
    //'Leads17.csv',
    //'Leads18.csv',
  //  'Leads19.csv'     // */
);

//print_r($file_array);exit;

for($c=0;$c<count($file_array);$c++)
{
    //$openfile=$openfile_path."Leads1.csv";
    $openfile=$openfile_path.$file_array[$c];//"Leads1.csv";
    $handle = fopen($openfile, "r");
    $data = "";
    $validemailids="";
    $invalidemailids="";
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

        $data = array_map("trim",$data);
        $data = array_map("mysql_real_escape_string",$data);
        $sql_insert="insert into data values(
        '".$data['0']."',
        '".$data['1']."',
        '".$data['2']."',
        '".$data['3']."',
        '".$data['4']."',
        '".$data['5']."',
        '".$data['6']."',
        '".$data['7']."',
        '".$data['8']."',
        '".$data['9']."',
        '".$data['10']."',
        '".$data['11']."',
        '".$data['12']."',
        '".$data['13']."',
        '".$data['14']."',
        '".$data['15']."',
        '".$data['16']."',
        '".$data['17']."',
        '".$data['18']."',
        '".$data['19']."',
        '".$data['20']."',
        '".$data['21']."',
        '".$data['22']."',
        '".$data['23']."',
        '".$data['24']."',
        '".$data['25']."',
        '".$data['26']."',
        '".$data['27']."',
        '".$data['28']."',
        '".$data['29']."',
        '".$data['30']."',
        '".$data['31']."',
        '".$data['32']."',
        '".$data['33']."',
        '".$data['34']."',
        '".$data['35']."',
        '".$data['36']."',
        '".$data['37']."',
        '".$openfile."',
        '".$data['38']."')";
        //echo $sql_insert;        exit;
        mysql_query($sql_insert);
    }
}
mysql_close($dbhandle);

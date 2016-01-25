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

$servername = "localhost";
$username = "server84";
$password = "server84";
$dbname = "datavalidate";

$llimit=$_REQUEST['llimit'];
$ulimit=$_REQUEST['ulimit'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id,COL6 FROM data2 where COL37='' order by id DESC limit $llimit , $ulimit";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $email = $id = "";
        $email = $row["COL6"];
        $id = $row["id"];
        $explode_email=explode('@',$email);
        if(count($explode_email)>0){
            $ipaddress = $domain = "";
            $domain = $explode_email[1];
            $ipaddress = gethostbyname($domain);
            if(filter_var($ipaddress, FILTER_VALIDATE_IP))
            {   
                if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                    //$validemailids.= $id.",".$email.",\n";
                    $sql1 = "UPDATE data2 SET COL37='1' , COL39='".$ipaddress."'  WHERE id='".$id."'";
                    $result1 = $conn->query($sql1);
                } else {
                    //$invalidemailids.= $id.",".$email.",";
                    $sql2 = "UPDATE data2 SET COL37='2' WHERE id='".$id."'";
                    $result2 = $conn->query($sql2);
                }
            }  
            else {
                //$invalidemailids.= $id.",".$email.",";
                $sql2 = "UPDATE data2 SET COL37='2' WHERE id='".$id."'";
                $result2 = $conn->query($sql2);

            }
        } else {
            //$invalidemailids.= $id.",".$email.",";
            $sql2 = "UPDATE data2 SET COL37='2' WHERE id='".$id."'";
            $result2 = $conn->query($sql2);

        }
    }
} else {
    echo "0 results";
}
$conn->close();
ob_clean();
?> 
<!--SELECT id, COL6, COL37, COL39
FROM data2
WHERE COL37 != ''
LIMIT 0 , 100-->
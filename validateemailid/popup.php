<?php

for($i=0;$i<20;$i++)
{
    $j=$i*1000;
  ?>
  <script type="text/javascript">
    window.open("http://10.10.10.84/validateemailid/detectemail2.php?llimit=<?php echo $j;?>&ulimit=100");
    </script>
  <?  
}
?>
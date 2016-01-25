
<?php

preg_match_all("/TT([0-9]+)/x",
                "TTahsdas TT97789 TT87sdh", $phones);
          print_r($phones);
          exit;

// get author info and generate DocBook entry
//$auth = "(123) 1232 - 322";//file_get_contents('/var/www/html/re.htm');
preg_match_all("/\(?(\d{3})?\)?(?(1)[\-\s]) \d{3}-\d{4}/x",
                "Call 555-1212 or 1-800-555-1212 0r (800) 555-1212 0r 800 555 1212", $phones);
                print_r($phones);

/*$n = sscanf($auth, "%d-%d-%d", $id, $first, $last);
print_r($n);
echo "<author id='$id'>
    <firstname>$first</firstname>
    <surname>$last</surname>
</author>\n";*/
?>

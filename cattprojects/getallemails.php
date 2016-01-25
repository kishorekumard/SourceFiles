<?php


    $f="/var/www/html/SourceFiles/cattprojects/James/Bounce_James--2016-01-25.txt";
    //$f="/var/www/html/SourceFiles/cattprojects/James/James--2016-01-25.txt";
    //$f="/var/www/html/SourceFiles/cattprojects/Robert/Robert--2016-01-24.txt";
    $contents = file_get_contents($f);
    $email_text = $email = $email_text_sql = "";
    if ($email == "" || $email == "-" || $email == "--" || $email == "---") {
        $emailpattern = '/[A-Z_a-z0-9-]+(\.[A-Z_a-z0-9-]+)*@[A-Za-z0-9-]+(\.[A-Za-z0-9-]+)*(\.[A-Za-z]{2,3})/i'; //regex for pattern of e-mail address
        preg_match_all($emailpattern, $contents, $email_matches);
        if (count($email_matches) > 0) {
            for ($em = 0; $em < count($email_matches[0]); $em++) {
                $email_text .= trim(strtolower($email_matches[0][$em])) . ",";
               // $email_text_sql .= " vEmail like '%".trim(strtolower($email_matches[0][$em])) . "%' and ";

            }
        }
        echo $email = implode(' ,<br> ', array_unique(explode(",", rtrim(ltrim($email_text, ","), ","))));
         //print_r(array_unique(explode(",", rtrim(ltrim($email_text, ",")))));
    }
   // $db_email = "";
   // $db_email = rtrim(trim($email_text_sql),'and');

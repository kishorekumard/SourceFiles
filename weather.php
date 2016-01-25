<?php     /*
    $arrarr= array(
        array(
            'id' => '12',
            'configid' => '6',
            'optionname' => 'Symantec Antivirus',
            'sortorder' => '1',
            'hidden' => '0',
            'configtimelines' => '0',
            'sales_type' => '1'
        ),

        array( 'id' => '41',
            'configid' => '6',
            'optionname' => 'None',
            'sortorder' => '0',
            'hidden' => '0',
            'configtimelines' => "0",
            'sales_type' => '1'
        )

    );
    echo "<pre>";
    $option_string="";
    $id_string="";
    $configid_string="";
    foreach($arrarr as $key1 => $values1)
    {

        //print_r($key1);
        //print_r($values1);
        foreach($values1 as $key2 => $values2)
        {
            if($key2=="optionname")
            {
                $option_string .=  "'".$values2."',";
            }

            if($key2=="id")
            {
                $id_string .=  "'".$values2."',";
            }

            if($key2=="configid")
            {
                $configid_string .=  "'".$values2."',";
            }
        }
    }
    $option_string='{"option":['.rtrim($option_string,",").'],}';

    $id_string='{"id":['.rtrim($id_string,",").'],}';

    $configid_string='{"configid":['.rtrim($configid_string,",").'],}';

    echo $option_string;

    echo "<br/><br/><br/><br/>";
    echo $id_string;
    echo "<br/><br/><br/><br/>";

    echo $configid_string;

    exit;              */
        $url = 'http://www.webservicex.net/globalweather.asmx?WSDL';
        $client = new SoapClient($url);
        
        print_r($client);
        $CityName="Hyderabad";
        $CountryName="India";
        //$result = $client->GetWeather(array('CityName'=>$CityName, 'CountryName'=>$CountryName));
        $result = $client->GetCitiesByCountry(array('CountryName'=>$CountryName));
        echo "<pre>";
       // print_r($result);
        echo $result->GetCitiesByCountryResult;
        
?>
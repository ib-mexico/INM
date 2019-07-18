<?php

namespace App\Library;

class Utils {

    public static function splitSearch($value) {
        
        $arrValues = explode(",", $value);

        for($i=0; $i< sizeof($arrValues); $i++) {
            $tempValue = trim($arrValues[$i]);
            if($tempValue != "&" && $tempValue != "&&" && $tempValue != "|" && $tempValue != "||" && strtoupper($tempValue) != "AND" && strtoupper($tempValue) != "OR") {
                $arrValues[$i] = $tempValue;
            }
        }

        $arrValues = array_filter($arrValues);
        $arrValues = array_unique($arrValues);

        return $arrValues;
    }

    public static function whereConnector($value) {

        $whereConector = "|";

        $arrValues = explode(",", $value);

        for($i=0; $i< sizeof($arrValues); $i++) {
            $tempValue = trim($arrValues[$i]);
        }

        $arrValues = array_filter($arrValues);

        if(sizeof($arrValues) > 0 && 
            ($arrValues[0] == "&" || $arrValues[0] == "&&" || strtoupper($arrValues[0]) == "AND" )) {
                $whereConector = "&";
        }

        return $whereConector;
    }

}

?>
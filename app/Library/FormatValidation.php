<?php

namespace App\Library;

use App\Library\DateTimeBuilder;

class FormatValidation {

	//NUMBER
	public static function isUnsignedInteger($value, $maxValue = 99999999) {
		$maxValue = ($maxValue > 0)?$maxValue:99999999;
		$minValue = 0;

		return self::isInteger($value, $maxValue, $minValue);
	}

	public static function isInteger($value, $maxValue = 99999999, $minValue = -99999999) {
		$maxValue = ($maxValue > 0)?$maxValue:99999999;
		$minValue = ($minValue <= 0)?$minValue:-$minValue;

		$return = filter_var($value, FILTER_VALIDATE_INT);
		if($return != false) {
			if($value > $maxValue || $value < $minValue) {
				$return = false;
			}
		}
		return ($return != false);
	}

	public static function getUnsignedInteger($value, $orDefault = 0, $maxValue = 99999999) {
		$return = $value;
		if(!self::isUnsignedInteger($value, $maxValue)) {
			$return = $orDefault;
		}
		return $return;
	}

	public static function getInteger($value, $orDefault = 0, $maxValue = 99999999, $minValue = -99999999) {
		$return = $value;
		if(!self::isInteger($value, $maxValue)) {
			$return = $orDefault;
		}
		return $return;
	}

	//SQL
	public static function isPrimaryKey($value, $maxValue = 99999999999) {
		$maxValue = ($maxValue > 0)?$maxValue:99999999999;
		$minValue = 1;

		return self::isInteger($value, $maxValue, $minValue);
	}

	public static function getPrimaryKey($value, $orDefault = null, $maxValue = 99999999) {
		$return = $value;
		if(!self::isPrimaryKey($value, $maxValue)) {
			$return = $orDefault;
		}
		return $return;
	}

	//DECIMAL
	public static function isUnsignedDecimal($value, $maxValue = 99999999999999) {
		$maxValue = ($maxValue > 0)?$maxValue:99999999999999;
		$minValue = 0;
		return self::isDecimal($value, $maxValue, $minValue);
	}

	public static function getUnsignedDecimal($value, $orDefault = 0, $maxValue = 99999999999999) {
		$return = $value;
		if(!self::isUnsignedDecimal($value, $maxValue)) {
			$return = $orDefault;
		}
		return $return;
	}

	public static function isDecimal($value, $maxValue = 99999999999999, $minValue = -99999999999999) {
		$maxValue = ($maxValue > 0)?$maxValue:99999999;
		$minValue = ($minValue <= 0)?$minValue:-$minValue;

		$return = filter_var($value, FILTER_VALIDATE_FLOAT);
		if($return != false) {
			if($value > $maxValue || $value < $minValue) {
				$return = false;
			}
		}
		return ($return != false);
	}

	public static function getDecimal($value, $orDefault = 0, $maxValue = 99999999999999, $minValue = -99999999999999) {
		$return = $value;
		if(!self::isDecimal($value, $maxValue, $minValue)) {
			$return = $orDefault;
		}
		return $return;
	}


	//TIME
	public static function isHour($value) {
		return self::isUnsignedInteger($value, 23);
	}

	public static function getHour($value, $orDefault = 0) {
		$return = $value;
		$orDefault = ((!self::isHour($orDefault))?$orDefault:0);

		if(!self::isHour($value)) {
			$return = $orDefault;
		}
		return str_pad($return, 2, '0', STR_PAD_LEFT);
	}

	public static function isMinute($value) {
		return self::isUnsignedInteger($value, 59);
	}

	public static function getMinute($value, $orDefault = 0) {
		$return = $value;
		$orDefault = ((!self::isMInute($orDefault))?$orDefault:0);

		if(!self::isMInute($value)) {
			$return = $orDefault;
		}
		return str_pad($return, 2, '0', STR_PAD_LEFT);
	}

	public static function isSecond($value) {
		return self::isUnsignedInteger($value, 59);
	}

	public static function getSecond($value, $orDefault = 0) {
		$return = $value;
		$orDefault = ((!self::isSecond($orDefault))?$orDefault:0);

		if(!self::isSecond($value)) {
			$return = $orDefault;
		}
		return str_pad($return, 2, '0', STR_PAD_LEFT);
	}

	public static function isTime($value) {
		$return = false;
		$value = explode(':', $value);

		switch(sizeof($value)) {
			case 2:
				$return = (self::getHour($value[0]) && self::getMinute($value[1]));
			break;
			case 3:
				$return = (self::getHour($value[0]) && self::getMinute($value[1]) && self::getSecond($value[2]));
			break;
		} 
		return $return;
	}

	public static function getTime($value, $orDefault = '00:00') {
		$return = $value;
		if(!is_null($orDefault)) {
			$orDefault = ((!self::isTime($orDefault))?$orDefault:'00:00');
		} 

		if(!self::isTime($value)) {
			$return = $orDefault;
		}

		return $return;
	}


	//DATE
	public static function isDate($value) {
		$objDateTimeBuilder = DateTimeBuilder::create($value);
		return $objDateTimeBuilder->isDate;
	}

	public static function getDateAtom($value, $orDefault = '0000-00-00') {
		$return = $orDefault;
		$objDateTimeBuilder = DateTimeBuilder::create($value);

		if($objDateTimeBuilder->isDate) {
			$return = $objDateTimeBuilder->getDateAtom();
		}

		return $return;
	}



	//STRING
	public static function isValidString($value, $minLength = 0, $maxLength = null) {
		$return = false;
		$minLength = self::getUnsignedInteger($minLength, 0);
		$maxLength = ((!self::isUnsignedInteger($maxLength))?$maxLength:null);

		if(!is_null($value) && trim($value) != '' && strlen($value) >= $minLength) {
			if( $maxLength != null ) {
				if(strlen($value) <= $minLength) $return = true;
			} else {
				$return = true;
			}
		}
		return $return;
	}

	public static function getValidString($value, $orDefault = null, $minLength = 0, $maxLength = null) {
		$return = $value;
		return (self::isValidString($value, $minLength, $maxLength)?$value:$orDefault);
	}



	//BOOLEAN
	public static function getBoolean($value, $numericFormat = false) {
		$return = false;
		if(	$value != null && $value != 0 && $value != '0' && trim($value) != '' && $value != false) {
			$return = true;
		}

		if($numericFormat) {
			if($return) {
				$return = 1;
			} else {
				$return = 0;
			}
		}

		return $return;
	}

	public static function getBooleanString($value) {
		$return = 0;
		
		if($value == "true") {
			$return = 1;
		}

		return $return;
	}




}


?>
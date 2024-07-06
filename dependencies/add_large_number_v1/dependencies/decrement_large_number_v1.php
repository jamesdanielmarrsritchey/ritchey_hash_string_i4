<?php
#Name:Decrement Large Number v1
#Description:Decrement a large number (such as those exceeding PHP max interger) by 1. Returns the number as a string on success. Returns "FALSE" on failure.
#Notes:Optional arguments can be "NULL" to skip them in which case they will use default values.
#Arguments:'number' (required) is a string containing the number to decrement. 'display_errors' (optional) indicates if errors should be displayed.
#Arguments (Script Friendly):number:string:required,display_errors:bool:optional
#Content:
if (function_exists('decrement_large_number_v1') === FALSE){
function decrement_large_number_v1($number, $display_errors = NULL){
	$errors = array();
	$progress = '';
	##Arguments
	if ($number == '0'){
		#Do nothing to avoid ctype_digit thinking 0 === FALSE
	} else if (@ctype_digit($number) === FALSE){
		$errors[] = "number";
	}
	if ($display_errors === NULL){
		$display_errors = FALSE;
	}
	if ($display_errors === TRUE OR $display_errors === FALSE){
		#Do Nothing
	} else {
		$errors[] = "display_errors";
	}
	##Task [Reverse number string. Convert number string to an array. Convert each digit in the array to a quantity of '1's. Remove '1' from the first array value, unless it is ''. If it is '' then change it to '111111111' and do the same to each value until you find one that is greater than '' and remove '1' from that.]
	if (@empty($errors) === TRUE){
		###Reverse number string
		$number = @strrev($number);
		###Convert number string to an array.
		$number = @str_split($number, 1);
		###Convert each digit in the array to a quantity of '1's.
		foreach ($number as &$character){
			if ($character === "0"){
				$character = '';
			} else if ($character === "1"){
				$character = '1';
			} else if ($character === "2"){
				$character = '11';
			} else if ($character === "3"){
				$character = '111';
			} else if ($character === "4"){
				$character = '1111';
			} else if ($character === "5"){
				$character = '11111';
			} else if ($character === "6"){
				$character = '111111';
			} else if ($character === "7"){
				$character = '1111111';
			} else if ($character === "8"){
				$character = '11111111';
			} else if ($character === "9"){
				$character = '111111111';
			} else {
				$errors[] = "task - convert digits to sets of '1's";
				goto result;
			}
		}
		###Remove '1' from the first array value, unless it is ''. If it is '' then change it to '111111111' and do the same to each value until you find one that is greater than '' and remove '1' from that.
		$switch = FALSE;
		foreach ($number as &$string){
			if ($string === '' && $switch === FALSE){
				$string = '111111111';
			} else if ($switch === FALSE){
				$string = @substr($string, 0, -1);
				$switch = TRUE;
			}
		}
		###To ensure that a number comprised soley of ''s (eg: 0, 00, 000, etc) decrements properly, check if array starts with ''. If yes, remove 1 value, and change the rest all to '111111111', but don't do this if the array is only '' (eg: '0') or you can't decrement below '9'.
		if (preg_match("/1/i", implode($number)) === FALSE){
			if (array_key_exists('1', $number) === TRUE){
				array_pop($number);
				foreach ($number as &$value) {
					$value = '111111111';
				}
			}	
		}
		######Convert each set of '1's back to digits
		foreach ($number as &$character){
			if ($character === ""){
				$character = '0';	
			} else if ($character === "1"){
				$character = '1';
			} else if ($character === "11"){
				$character = '2';
			} else if ($character === "111"){
				$character = '3';
			} else if ($character === "1111"){
				$character = '4';
			} else if ($character === "11111"){
				$character = '5';
			} else if ($character === "111111"){
				$character = '6';
			} else if ($character === "1111111"){
				$character = '7';
			} else if ($character === "11111111"){
				$character = '8';	
			} else if ($character === "111111111"){
				$character = '9';	
			} else {
				$errors[] = "task - convert sets of '1's to digits";
				goto result;
			}
		}
		###Convert array back to string.
		$number = @implode($number);
		###Reverse number string
		$number = @strrev($number);
		###Ensure number doesn't start with '0'.
		if (@substr($number, 0, 1) === '0' and strlen($number) > 1){
			$number = @substr($number, 1);
		}
	}
	result:
	##Display Errors
	if ($display_errors === TRUE and @empty($errors === FALSE)){
		$message = @implode(", ", $errors);
		if (function_exists('decrement_large_number_v1_format_error') === FALSE){
			function decrement_large_number_v1_format_error($errno, $errstr){
				echo $errstr;
			}
		}
		set_error_handler("decrement_large_number_v1_format_error");
		trigger_error($message, E_USER_ERROR);
	}
	##Return
	if (@empty($errors) === TRUE){
		return $number;
	} else {
		return FALSE;
	}
}
}
?>
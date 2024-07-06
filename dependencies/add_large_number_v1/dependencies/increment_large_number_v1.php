<?php
#Name:Increment Large Number v1
#Description:Increment a large number (such as those exceeding PHP max interger) by 1. Returns the number as a string on success. Returns "FALSE" on failure.
#Notes:Optional arguments can be "NULL" to skip them in which case they will use default values.
#Arguments:'number' (required) is a string containing the number to increment. 'display_errors' (optional) indicates if errors should be displayed.
#Arguments (Script Friendly):number:string:required,display_errors:bool:optional
#Content:
if (function_exists('increment_large_number_v1') === FALSE){
function increment_large_number_v1($number, $display_errors = NULL){
	$errors = array();
	$progress = '';
	##Arguments
	if (@ctype_digit($number) === FALSE){
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
	##Task [Reverse number string. Convert number string to an array. Convert each digit in the array to a quantity of '1's. Add '1' to the first array value, unless it is '111111111'. If it is '111111111' then change it to '' and do the same to each value until you find one that is less than '111111111' and add '1' to that.]
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
		###Add '1' to the first array value, unless it is '111111111'. If it is '111111111' then change it to '' and do the same to each value until you find one that is less than '111111111' and add '1' to that.
		$switch = FALSE;
		foreach ($number as &$string){
			if ($string === '111111111' && $switch === FALSE){
				$string = '';
			} else if ($switch === FALSE){
				$string = "{$string}1";
				$switch = TRUE;
			}
		}
		###To ensure that a number comprised soley of '9's (eg: 9, 99, 999, etc) increments properly, check if array ends in ''. If yes, add '1' to the end.
		if (@end($number) === ''){
			$number[] = '1';
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
		######Convert array back to string.
		$number = @implode($number);
		###Reverse number string
		$number = @strrev($number);
	}
	result:
	##Display Errors
	if ($display_errors === TRUE and @empty($errors === FALSE)){
		$message = @implode(", ", $errors);
		if (function_exists('increment_large_number_v1_format_error') === FALSE){
			function increment_large_number_v1_format_error($errno, $errstr){
				echo $errstr;
			}
		}
		set_error_handler("increment_large_number_v1_format_error");
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
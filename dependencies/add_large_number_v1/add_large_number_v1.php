<?php
#Name:Add Large Number v1
#Description:Add a large number (such as those exceeding PHP max interger) to another large number. Returns the number as a string on success. Returns "FALSE" on failure.
#Notes:Optional arguments can be "NULL" to skip them in which case they will use default values.
#Arguments:'number1' (required) is a string containing the number. 'number2' (required) is a string containing the number to add to the first number. 'display_errors' (optional) indicates if errors should be displayed.
#Arguments (Script Friendly):number1:string:required,number2:string:required,display_errors:bool:optional
#Content:
if (function_exists('add_large_number_v1') === FALSE){
function add_large_number_v1($number1, $number2, $display_errors = NULL){
	$errors = array();
	$progress = '';
	##Arguments
	if ($number1 == '0'){
		#Do nothing to avoid ctype_digit thinking 0 === FALSE
	} else if (@ctype_digit($number1) === FALSE){
		$errors[] = "number1";
	}
	if ($number2 == '0'){
		#Do nothing to avoid ctype_digit thinking 0 === FALSE
	} else if (@ctype_digit($number2) === FALSE){
		$errors[] = "number2";
	}
	if ($display_errors === NULL){
		$display_errors = FALSE;
	}
	if ($display_errors === TRUE OR $display_errors === FALSE){
		#Do Nothing
	} else {
		$errors[] = "display_errors";
	}
	##Task [Increment $number1 $number2 times]
	if (@empty($errors) === TRUE){
		$location = realpath(dirname(__FILE__));
		do {
			require_once $location . '/dependencies/increment_large_number_v1.php';
			$number1 = @increment_large_number_v1($number1, FALSE);
			require_once $location . '/dependencies/decrement_large_number_v1.php';
			$number2 = @decrement_large_number_v1($number2, FALSE);
		} while ($number2 != '0');
	}
	result:
	##Display Errors
	if ($display_errors === TRUE and @empty($errors === FALSE)){
		$message = @implode(", ", $errors);
		if (function_exists('add_large_number_v1_format_error') === FALSE){
			function add_large_number_v1_format_error($errno, $errstr){
				echo $errstr;
			}
		}
		set_error_handler("add_large_number_v1_format_error");
		trigger_error($message, E_USER_ERROR);
	}
	##Return
	if (@empty($errors) === TRUE){
		return $number1;
	} else {
		return FALSE;
	}
}
}
?>
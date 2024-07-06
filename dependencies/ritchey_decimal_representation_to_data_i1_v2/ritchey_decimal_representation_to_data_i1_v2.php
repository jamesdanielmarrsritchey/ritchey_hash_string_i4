<?php
#Name:Ritchey Decimal Representation To Data i1 v2
#Description:Convert decimal representation (numbers 0-255) to data. Returns the data as a string on success. Returns "FALSE" on failure.
#Notes:Optional arguments can be "NULL" to skip them in which case they will use default values.
#Arguments:'array' (required) is an array containing the decimal representation to convert. 'display_errors' (optional) indicates if errors should be displayed.
#Arguments (Script Friendly):array:array:required,display_errors:bool:optional
#Content:
if (function_exists('ritchey_decimal_representation_to_data_i1_v2') === FALSE){
function ritchey_decimal_representation_to_data_i1_v2($array, $display_errors = NULL){
	$errors = array();
	##Arguments
	if (@is_array($array) === FALSE){
		$errors[] = "array";
	}
	if ($display_errors === NULL){
		$display_errors = FALSE;	
	}
	if ($display_errors === TRUE OR $display_errors === FALSE){
		#Do Nothing
	} else {
		$errors[] = "display_errors";
	}
	##Task
	if (@empty($errors) === TRUE){
		foreach ($array as &$value){
			$value = @dechex($value);
			//hex2bin will error if the value is 1 character instead of 2, because that's not valid hexidecimal. This can happen when the input is one byte such as a line ending portion. To solve this, pad the left side with a zero.
			$padded_value = @str_pad($value, 2, '0', STR_PAD_LEFT);
			$value = $padded_value;
			$value = @hex2bin($value);
		}
		unset($value);
		$array = @implode($array);
	}
	result:
	##Display Errors
	if ($display_errors === TRUE and @empty($errors === FALSE)){
		$message = @implode(", ", $errors);
		if (function_exists('ritchey_decimal_representation_to_data_i1_v2_format_error') === FALSE){
			function ritchey_decimal_representation_to_data_i1_v2_format_error($errno, $errstr){
				echo $errstr;
			}
		}
		set_error_handler("ritchey_decimal_representation_to_data_i1_v2_format_error");
		trigger_error($message, E_USER_ERROR);
	}
	##Return
	if (@empty($errors) === TRUE){
		return $array;
	} else {
		return FALSE;
	}
}
}
?>
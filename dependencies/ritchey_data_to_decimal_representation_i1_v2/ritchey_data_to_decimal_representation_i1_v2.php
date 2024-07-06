<?php
#Name:Ritchey Data To Decimal Representation i1 v2
#Description:Convert data to it's decimal representation (numbers 0-255). Returns the representation as an array on success. Returns "FALSE" on failure.
#Notes:Optional arguments can be "NULL" to skip them in which case they will use default values.
#Arguments:'string' (required) is a string containing the data to convert. 'display_errors' (optional) indicates if errors should be displayed.
#Arguments (Script Friendly):string:string:required,display_errors:bool:optional
#Content:
if (function_exists('ritchey_data_to_decimal_representation_i1_v2') === FALSE){
function ritchey_data_to_decimal_representation_i1_v2($string, $display_errors = NULL){
	$errors = array();
	##Arguments
	if (@is_string($string) === FALSE){
		$errors[] = "string";
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
		$string = @str_split($string, 1);
		foreach ($string as &$value){
			$value = @bin2hex($value);
			$value = @hexdec($value);
			//$value = @base_convert($value, 16, 2);
			//$value = @str_pad($value, 8, 0, STR_PAD_LEFT);
		}
	}
	result:
	##Display Errors
	if ($display_errors === TRUE and @empty($errors === FALSE)){
		$message = @implode(", ", $errors);
		if (function_exists('ritchey_data_to_decimal_representation_i1_v2_format_error') === FALSE){
			function ritchey_data_to_decimal_representation_i1_v2_format_error($errno, $errstr){
				echo $errstr;
			}
		}
		set_error_handler("ritchey_data_to_decimal_representation_i1_v2_format_error");
		trigger_error($message, E_USER_ERROR);
	}
	##Return
	if (@empty($errors) === TRUE){
		return $string;
	} else {
		return FALSE;
	}
}
}
?>
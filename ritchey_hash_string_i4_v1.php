<?php
//Name: Ritchey Hash String
//Description: Hash a string with Ritchey Hashing Algorithm 4. On success returns checksum as a string, or "TRUE" if no data is found. Returns "FALSE" on failure.
//Notes: Optional arguments can be "NULL" to skip them in which case they will use default values.
//Dependencies: 
//Arguments: 'string' (required) is the string to hash. 'loops' (optional) is a number of times to hash the input (default is '1'). 'display_errors' (optional) indicates if errors should be displayed.
//Arguments (Script Friendly):string:string:required,loops:number:optional,display_errors:bool:optional
//Content:
//<value>
if (function_exists('ritchey_hash_string_i4_v1') === FALSE){
function ritchey_hash_string_i4_v1($string, $loops = NULL, $display_errors = NULL){
	# Check Variables
	$errors = array();
	$location = realpath(dirname(__FILE__));
	if (@is_string($string) === FALSE){
		$errors[] = 'string';
	}
	if ($loops === NULL){
		$loops = 1;
	} else if (is_int($loops) === TRUE){
		#Do Nothing
	} else {
		$errors[] = "loops";
	}
	if ($display_errors === NULL){
		$display_errors = FALSE;
	} else if ($display_errors === TRUE){
		#Do Nothing
	} else if ($display_errors === FALSE){
		#Do Nothing
	} else {
		$errors[] = "display_errors";
	}
	# Task
	if (@empty($errors) === TRUE){
		$bytes = @str_split($string, 1);
		$n1 = 0;
		while ($n1 < $loops){
			$n1++;
			$n2 = 0;
			$sum = '0';
			## Create sum
			foreach ($bytes as &$byte){
				$n2++;
				### Convert to decimal
				require_once $location . '/dependencies/ritchey_data_to_decimal_representation_i1_v2/ritchey_data_to_decimal_representation_i1_v2.php';
				$byte = ritchey_data_to_decimal_representation_i1_v2($byte, FALSE);
				$byte = $byte[0];
				### Add position to it
				$byte = @intval($byte) + $n2;
				### Add the current byte number to the total number to finish calculating current byte (this decreases the likihood of the same bytes in different orders creating the same total sum)
				require_once $location . '/dependencies/add_large_number_v1/add_large_number_v1.php';
				$byte = add_large_number_v1(strval($byte), $sum, FALSE);
				### Add the current byte number to the total number to finish calculating current sum
				require_once $location . '/dependencies/add_large_number_v1/add_large_number_v1.php';
				$sum = add_large_number_v1(strval($byte), $sum, FALSE);
			}
			unset($byte);
			## Convert sum to base64 representation
			### Break sum into array of 2 digit values which can be treated as decimal representation
			$encoded_sum = @str_split($sum, 2);
			### Decode the decimal representation of the sum
			require_once $location . '/dependencies/ritchey_decimal_representation_to_data_i1_v2/ritchey_decimal_representation_to_data_i1_v2.php';
			$encoded_sum = ritchey_decimal_representation_to_data_i1_v2($encoded_sum, FALSE);
			### Encode as a base64 representation
			$encoded_sum = @base64_encode($encoded_sum);
			## Append ',1' to indicate 1 loop was completed
			$encoded_sum = $encoded_sum . ",{$n1}";
			$bytes = @str_split($encoded_sum, 1);
		}
		$result = $encoded_sum;
	}
	result:
	# Display Errors
	if ($display_errors === TRUE){
		if (@empty($errors) === FALSE){
			$message = @implode(", ", $errors);
			if (function_exists('ritchey_hash_string_i4_v1_format_error') === FALSE){
				function ritchey_hash_string_i4_v1_format_error($errno, $errstr){
					echo $errstr;
				}
			}
			set_error_handler("ritchey_hash_string_i4_v1_format_error");
			trigger_error($message, E_USER_ERROR);
		}
	}
	# Return
	if (@empty($errors) === TRUE){
		if (@empty($result) === TRUE){
			return TRUE;
		} else {
			return $result;
		}
	} else {
		return FALSE;
	}
}
}
//</value>
?>
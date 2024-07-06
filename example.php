<?php
$location = realpath(dirname(__FILE__));
require_once $location . '/ritchey_hash_string_i4_v1.php';
$string = 'String test';
//$string = 'string Test';
$return = ritchey_hash_string_i4_v1($string, 1, TRUE);
if (is_string($return) === TRUE){
	print_r($return) . PHP_EOL;
} else if ($return === TRUE) {
	echo "TRUE" . PHP_EOL;
} else {
	echo "FALSE" . PHP_EOL;
}
?>
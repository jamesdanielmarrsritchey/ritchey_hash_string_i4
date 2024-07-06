<?php
$location = realpath(dirname(__FILE__));
require_once $location . '/ritchey_decimal_representation_to_data_i1_v2.php';
$array = array('104', '105');
$return = ritchey_decimal_representation_to_data_i1_v2($array, TRUE);
if ($return === FALSE){
	echo "FALSE\n";
} else {
	print_r($return);
}
?>
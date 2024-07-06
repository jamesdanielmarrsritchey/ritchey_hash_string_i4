<?php
$location = realpath(dirname(__FILE__));
require_once $location . '/ritchey_data_to_decimal_representation_i1_v2.php';
$return = ritchey_data_to_decimal_representation_i1_v2('This is example data.', TRUE);
if ($return === FALSE){
	echo "FALSE\n";
} else {
	print_r($return);
}
?>
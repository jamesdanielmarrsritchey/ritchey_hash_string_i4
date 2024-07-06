<?php
$location = realpath(dirname(__FILE__));
require_once $location . '/add_large_number_v1.php';
$number1 = '2446';
$number2 = '2';
$i = 0;
do {
	$number1 = add_large_number_v1($number1, $number2, TRUE);
	echo "$number1\n";
	$i++;
} while ($i < 10);
?>
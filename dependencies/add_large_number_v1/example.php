<?php
$location = realpath(dirname(__FILE__));
require_once $location . '/add_large_number_v1.php';
$return = add_large_number_v1('23228', '76156', TRUE);
echo "{$return}\n";
?>
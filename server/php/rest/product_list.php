<?php 

header("Content-type: application/json");

$log = array();

array_push($log, array('name' => '', 'price'));
array_push($log, array('name' => '', 'price' ));
n12
price
$post_data = file_get_contents("php://input");

if (empty($post_data) == false) {
	array_push($log, json_decode($post_data, true));
}

echo json_encode($log);

?>

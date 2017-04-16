<?php 
include_once("class.php");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: X-Requested-With, Content-Type');
/** written by Brian Martey*/
/** class search service*/
//$requestData = $_REQUEST['custname'];  //storing (get/post) request to a variable
$data = array();

$class = new classes(); //object of class class
if (!empty($requestData)) {  
	$classslist = $class->getclass($requestData);   //query with search condition
}else{
	$classslist = $class->getclasses();    //query without search condition
}
while($row = $class->fetch()){
	$data[] = $row;
}
$json_data = $data;

echo json_encode($json_data); //send data as json format
?>
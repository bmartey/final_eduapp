<?php 
include_once("questions.php");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: X-Requested-With, Content-Type');
/** written by Brian Martey*/
/** question search service*/
$requestNumber = $_REQUEST['number'];  //storing (get/post) request to a variable

$data = array();

$questions = new questions(); //object of questions class
if (!empty($requestNumber)) {  
	$questionslist = $questions->getquestionstoanswer($requestNumber);  //query with search condition
}else{
	$questionslist = $questions->getquestions();    //query without search condition
}
while($row = $questions->fetch()){
	$data[] = $row;
}
$json_data = $data;

echo json_encode($json_data); //send data as json format
?>
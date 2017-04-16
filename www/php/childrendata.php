<?php 
include_once("users.php");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: X-Requested-With, Content-Type');
/** written by Brian Martey*/
/** messages service*/
       
/* Database connection start */
$servername = "35.166.18.143";
$username = "brian.martey";
$password = "73f10fb2216b97f4";
$dbname = "db__brian_martey";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());

/* Database connection end */
// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;

$columns = array( 
// datatable column index  => database column name	
	0 => 'sender',
	1 =>'title', 
	2 => 'content',
	3 => 'date_sent'
);

// getting total number records without any search
$sql = "select mid,title,content,date_sent,sender";
$sql.=" FROM messages";
$query=mysqli_query($conn, $sql) or die("messagesdata.php: get bookings");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

$sql = "select mid,title,content,date_sent,sender";
$sql.=" FROM messages";
if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
	$sql.=" WHERE ( title LIKE '".$requestData['search']['value']."%' ";    
	$sql.=" OR content LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR sender LIKE '".$requestData['search']['value']."%' )";
}
$query=mysqli_query($conn, $sql) or die("messagesdata.php: get bookings");
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]." ".$requestData['order'][0]['dir']." LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
/* $requestData['order'][0]['column'] contains column index, $requestData['order'][0]['dir'] contains order such as asc/desc  */	
$query=mysqli_query($conn, $sql) or die("messagesdata.php: get bookings3");

$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$nestedData=array();

	$date = $row['date_sent'];
	$newdate = date('j F Y',strtotime($date));
	$nestedData[] = $newdate;
	$nestedData[] = $row['sender'];
	$nestedData[] = $row['title'];
	$nestedData[] = $row['content'];

	$data[] = $nestedData;
}

$json_data = array(
			"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
			"recordsTotal"    => intval( $totalData ),  // total number of records
			"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => $data   // total data array
			);

echo json_encode($json_data);  // send data as json format

?>

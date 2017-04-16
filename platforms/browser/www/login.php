<?php
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, DELETE, PUT");
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Headers: X-Requested-With, Content-Type');
/** written by Brian Martey*/

  if(isset($_POST['Login'])){

    include_once('users.php');

    $user_default= new users();

    $username = $_POST['username'];
    $password = $_POST['password'];
    $result = $user_default->login($username,$password);

    if($result == false){
    echo 0;
    }else{
      if ($result['LEVEL'] == 4) {
        $user_data = array('uid' => $result['UID'],'uname' => $result['USERNAME'],'fname' => $result['FNAME'],'lname' => $result['LNAME'],'schoolid' => $result['SCHOOLID'],'level' => $result['LEVEL'],'photo' => $result['photo'],'children' => $result['children'],'phone' => $result['phone'],'email' => $result['email']);
      } elseif ($result['LEVEL'] == 3){
        $user_data = array('uid' => $result['UID'],'uname' => $result['USERNAME'],'fname' => $result['FNAME'],'lname' => $result['LNAME'],'schoolid' => $result['SCHOOLID'],'level' => $result['LEVEL'],'grade' => $result['grade'],'photo' => $result['photo'],'children' => $result['children'],'phone' => $result['phone'],'email' => $result['email']);
      } elseif ($result['LEVEL'] == 2) {
        $user_data = array('uid' => $result['UID'],'uname' => $result['USERNAME'],'fname' => $result['FNAME'],'lname' => $result['LNAME'],'schoolid' => $result['SCHOOLID'],'level' => $result['LEVEL'],'grade' => $result['grade'],'photo' => $result['photo'],'parents' => $result['parents'],'phone' => $result['phone'],'email' => $result['email']);
      } elseif ($result['LEVEL'] == 1) {
        $user_data = array('uid' => $result['UID'],'uname' => $result['USERNAME'],'fname' => $result['FNAME'],'lname' => $result['LNAME'],'schoolid' => $result['SCHOOLID'],'level' => $result['LEVEL'],'photo' => $result['photo'],'phone' => $result['phone'],'email' => $result['email']);
      }
      $json_data = $user_data;
      echo json_encode($json_data);
    }
    
  }
?>
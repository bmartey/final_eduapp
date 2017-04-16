<?php
/** written by Brian Martey
*/
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Headers: X-Requested-With, Content-Type');
include_once("adb.php");
/**
*Users  class
*/
class users extends adb{
	function users(){
	}
	/**
	*user log in
	*@param string username  
	*@param password login password
	*returns a boolean true if successful, else, false
	*/

	function login($username, $password){
			$strQuery="select * from users where USERNAME = '$username' && PASSWORD = MD5('$password')";
			
			$result = $this->query($strQuery);
			if ($result){
				return $this->fetch();
			}else{
				return $result;
			}
	}

	function adminlogin($username, $password){
			$strQuery="select * from users where LEVEL = '1' && USERNAME = '$username' && PASSWORD = MD5('$password')";
			
			$result = $this->query($strQuery);
			if ($result){
				return $this->fetch();
			}else{
				echo $result;
				return $result;
			}
	}
			
}
?>
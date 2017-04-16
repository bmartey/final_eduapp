<?php
/** written by Brian Martey
*/
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Headers: X-Requested-With, Content-Type');
include_once("adb.php");
/**
*classes  class
*/
class classes extends adb{
	function classes(){
	}
	/**
	*get class
	*returns a boolean true if successful, else, false
	*/

	function getclasses(){
		$strQuery="select cno,cname from class";
		$result = $this->query($strQuery);
		if ($result){
			return $result;
		}else{
			return $result;
		}
	}

	/**
	*get class
	*@param string info  
	*returns a boolean true if successful, else, false
	*/

	function getclass($info){
			$strQuery="select cno,cname from class where cno = '%$info%' or cname like '%$info%'";
			$result = $this->query($strQuery);
	}

	/**
	*add message
	*@param string cno
	*@param string cname  
	*@param date date_sent
	*returns a boolean true if successful, else, false
	*/

	function addclass($cno,$cname){
			$strQuery="insert into class set cno='$cno',cname='$cname'";
			$result = $this->query($strQuery);
	}
			
}
?>
<?php
/** written by Brian Martey
*/
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Headers: X-Requested-With, Content-Type');
include_once("adb.php");
/**
*Assignments  class
*/
class assignments extends adb{
	function assignments(){
	}
	/**
	*get assignments
	*returns a boolean true if successful, else, false
	*/

	function getassignments(){
		$strQuery="select aid,title,topic_area,grade,description from assignments";
		$result = $this->query($strQuery);
		if ($result){
			return $result;
		}else{
			return $result;
		}
	}

	/**
	*get assignments
	*@param string info  
	*returns a boolean true if successful, else, false
	*/

	function getassignment($info){
			$strQuery="select title,topic_area,grade,description from assignments where title like '%$info%' or topic_area like '%$info%'";
			$result = $this->query($strQuery);
	}

	/**
	*get assignmentquestions
	*@param string info  
	*@param string grade  
	*returns a boolean true if successful, else, false
	*/

	function getassignmentlist($school,$grade){
			$strQuery="select t.tname,a.description,a.questionnos, a.aid from assignments as a inner join topic_area as t on t.tno = a.topic_area where schoolid = '$school' and grade = '$grade'";
			$result = $this->query($strQuery);
	}

	/**
	*get assignmentquestions
	*@param string info  
	*@param string grade  
	*returns a boolean true if successful, else, false
	*/

	function getassignmentquestions($id){
			$strQuery="select t.tname,a.description,a.questionnos from assignments as a inner join topic_area as t on t.tno = a.topic_area where aid = '$id'";
			$result = $this->query($strQuery);
	}

	/**
	*add assignment
	*@param string title
	*@param string topic_area  
	*@param int grade
	*returns a boolean true if successful, else, false
	*/

	function addassignment($title,$topic_area,$grade,$description,$questionnos,$tid,$schid){
			$strQuery="insert into assignments set title='$title',topic_area='$topic_area',grade ='$grade',description = '$description',questionnos = '$questionnos', teacherid='$tid', schoolid = '$schid'";
			$result = $this->query($strQuery);
	}
			
}
?>
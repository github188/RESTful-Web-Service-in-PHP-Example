<?php
//include h files
require_once './functions.php';
$user_id = $_GET['user_id'];
$nickname = $_GET['nickname'];
$gender = $_GET['gender'];
$sign = $_GET['sign'];
$columns = array('nickname' => $nickname, 'gender' => $gender,'sign' => $sign);
//input limit
if(!isset($user_id))
{
	jsonOutput('FAIL','user_id cannot be NULL','');
	die();
}
if(!isset($nickname))
{
	jsonOutput('FAIL','nickname cannot be NULL','');
	die();
}
if(!isset($gender))
{
	jsonOutput('FAIL','gender cannot be NULL','');
	die();
}
if($gender != 'male'&&$gender != 'female')
{
	jsonOutput('FAIL','gender must be eithre male or female','');
	die();
}
if(!isset($sign))
{
	jsonOutput('FAIL','sign cannot be NULL','');
	die();
}


//SQL statement
$sqlQuery = "UPDATE user SET avatar = '".$avatar."',nickname = '".$nickname."',gender = '".$gender. "',sign = '".$sign."'WHERE user_id =  ".$user_id;

// run query
runSQLQuery($sqlQuery);
?>
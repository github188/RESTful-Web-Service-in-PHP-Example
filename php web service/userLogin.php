<?php
//include h files
require_once './functions.php';
$tele_number = $_GET['tele_number'];
$password = $_GET['password'];

//input limit
if(!isset($tele_number))
{
	jsonOutput('FAIL','tele_number cannot be NULL','');
	die();
}
//长度必须为11位
if(strlen($tele_number) != 11)
{
	jsonOutput('FAIL','the length of tele_number must be 11','');
	die();
}
if(!isset($password))
{
	jsonOutput('FAIL','password cannot be NULL','');
	die();
}
//长度为20以内
lengthCheck('password',$password,20);

//SQL statement
$sqlQuery = "SELECT password FROM user WHERE tele_number = '".$tele_number."'";


// run query
//connect database

$con = mysql_connect(SQLHOST,SQLACCOUNT,SQLPASSWORD);
if (!$con) die('Could not connect: ' . mysql_error());

//select table
$selectTableResult = mysql_select_db(SQLDATABASE, $con);
if(!$selectTableResult) sqlError();
$queryResult = mysql_query($sqlQuery);
if(!$queryResult) sqlError();

//返回查询标识符
while($row = mysql_fetch_assoc($queryResult))
{
	$result[] = $row;

}	
	

if(!isset($result[0]['password']))
{
	jsonOutput('FAIL','cannot find this tele_number','');
	die();
}
if($result[0]['password'] == $password)
{
	jsonOutput('OK','login succesfully','');
	die();

}
else
{
	jsonOutput('FAIL','tele_number or password is wrong','');
	die();
}

//close database
mysql_close($con);

?>
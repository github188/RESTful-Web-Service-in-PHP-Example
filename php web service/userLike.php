<?php
//include h files
require_once './functions.php';

$user_id = $_GET['user_id'];
$liked_user_id = $_GET['liked_user_id'];

//input limit
if(!isset($user_id))
{
	jsonOutput('FAIL','user_id cannot be NULL','');
	die();
}
if(!isset($liked_user_id))
{
	jsonOutput('FAIL','liked_user_id cannot be NULL','');
	die();
}
if(!isIdexistsInTable('user','user_id',$user_id))
{
	jsonOutput('FAIL','user does not exist','');
	die();
}

if(!isIdexistsInTable('user','user_id',$liked_user_id))
{
	jsonOutput('FAIL','user who you like does not exist','');
	die();
}

//SQL statement
$sqlQuery = "INSERT INTO map_like_liked (like_user_id, liked_user_id) VALUES (".$user_id.", ".$liked_user_id.")";

// run query
runSQLQuery($sqlQuery);
?>
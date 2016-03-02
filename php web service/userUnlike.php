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

//SQL statement
$sqlQuery = "DELETE FROM map_like_liked WHERE like_user_id = ".$user_id." and liked_user_id =".$liked_user_id;

// run query
runSQLQuery($sqlQuery);
?>
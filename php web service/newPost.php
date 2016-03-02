<?php
//include h files
require_once './functions.php';

$user_id = $_GET['user_id'];
$content = $_GET['content'];

//input limit
if(!isset($user_id))
{
	jsonOutput('FAIL','user_id cannot be NULL','');
	die();
}
if(!isset($content))
{
	jsonOutput('FAIL','content cannot be NULL','');
	die();
}

//SQL statement
$sqlQuery = "INSERT INTO post (user_id,post_content) values (".$user_id.",'".$content."')";

// run query
runSQLQuery($sqlQuery);
?>
<?php
//include h files
require_once './functions.php';

$user_id = $_GET['user_id'];
$post_id = $_GET['post_id'];

//input limit
if(!isset($user_id))
{
	jsonOutput('FAIL','user_id cannot be NULL','');
	die();
}
if(!isset($post_id))
{
	jsonOutput('FAIL','post_id cannot be NULL','');
	die();
}
//判断user_id存在 和 post_id 存在
if(!isIdexistsInTable('user','user_id',$user_id))
{
	jsonOutput('FAIL','user does not exist','');
	die();
}

if(!isIdexistsInTable('post','post_id',$post_id))
{
	jsonOutput('FAIL','post does not exist','');
	die();
}

//SQL statement
$sqlQuery = "INSERT INTO map_like_post (user_id,post_id) values (".$user_id.",".$post_id.")";

// run query
runSQLQuery($sqlQuery);
?>
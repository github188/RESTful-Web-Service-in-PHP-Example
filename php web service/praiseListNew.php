<?php
//include h files
require_once './functions.php';

$post_id = $_GET['post_id'];
$page_size = $_GET['page_size'];
$pre_create_milli = $_GET['pre_create_milli'];

//input limit
if(!isset($post_id))
{
	jsonOutput('FAIL','post_id cannot be NULL','');
	die();
}
if(!isset($page_size))
{
	jsonOutput('FAIL','page_size cannot be NULL','');
	die();
}
if(!isset($pre_create_milli))
{
	jsonOutput('FAIL','pre_create_milli cannot be NULL','');
	die();
}
//判断存在
if(!isIdexistsInTable('post','post_id',$post_id))
{
	jsonOutput('FAIL','post does not exist','');
	die();
}


//SQL statement
$sqlQuery = "SELECT praise.post_id,praise.user_id,praise.timestamp,user.nickname FROM praise INNER JOIN user ON user.user_id = praise.user_id WHERE post_id = ".$post_id." AND praise.timestamp > '".$pre_create_milli."';";

// run query
runSQLQuery($sqlQuery);

?>
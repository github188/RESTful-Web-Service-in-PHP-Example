<?php
//include h files
require_once './functions.php';

$user_id = $_GET['user_id'];
$page_size = $_GET['page_size'];
$pre_create_milli = $_GET['pre_create_milli'];

//input limit
if(!isset($user_id))
{
	jsonOutput('FAIL','user_id cannot be NULL','');
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
//判断user_id存在
if(!isIdexistsInTable('user','user_id',$user_id))
{
	jsonOutput('FAIL','user does not exist','');
	die();
}


//SQL statement
$sqlQuery = "SELECT user.user_id,user.nickname,post.post_id,post.post_content,post.timestamp FROM user INNER JOIN post on user.user_id = post.user_id WHERE user.user_id in
(
SELECT liked_user_id FROM map_like_liked WHERE like_user_id = ".$user_id."
)
AND post.timestamp > '".$pre_create_milli."' LIMIT 0,".$page_size;

// run query
runSQLQuery($sqlQuery);

?>
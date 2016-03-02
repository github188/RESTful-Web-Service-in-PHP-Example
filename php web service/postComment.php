<?php
//include h files
require_once './functions.php';

$comment_user_id = $_GET['comment_user_id'];
$post_id = $_GET['post_id'];
$content = $_GET['content'];


//input limit
if(!isset($comment_user_id))
{
	jsonOutput('FAIL','comment_user_id cannot be NULL','');
	die();
}
if(!isset($post_id))
{
	jsonOutput('FAIL','post_id cannot be NULL','');
	die();
}
if(!isset($content))
{
	jsonOutput('FAIL','content cannot be NULL','');
	die();
}
//判断commented_user_id存在 和 post_id 存在
if(!isIdexistsInTable('user','user_id',$comment_user_id))
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
$sqlQuery = "INSERT INTO comment (comment_user_id,post_id,comment_content) values (".$comment_user_id.",".$post_id.",'".$content."')";


// run query
runSQLQuery($sqlQuery);
?>
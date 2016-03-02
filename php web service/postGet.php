<?php
//include h files
require_once './functions.php';

$post_id = $_GET['post_id'];


//input limit
if(!isset($post_id))
{
	jsonOutput('FAIL','post_id cannot be NULL','');
	die();
}

//判断存在
if(!isIdexistsInTable('post','post_id',$post_id))
{
	jsonOutput('FAIL','post does not exist','');
	die();
}


//SQL statement
$Statement1 = "SELECT post.post_id,post.user_id,post.timestamp,post.post_content,user.nickname FROM post INNER JOIN user on post.user_id = user.user_id WHERE post_id = ".$post_id;
$Statement2 = "SELECT comment.comment_id,comment.comment_user_id,comment.comment_content,comment.post_id,comment.timestamp,user.nickname FROM comment INNER JOIN user ON comment.comment_user_id = user.user_id WHERE comment.post_id = ".$post_id." AND comment.timestamp > '1990-01-01 07:17' LIMIT 0,1000;";

// run query
//connect database
	$con = mysql_connect(SQLHOST,SQLACCOUNT,SQLPASSWORD);
	if (!$con) die('Could not connect: ' . mysql_error());

	//select table
	$selectTableResult = mysql_select_db(SQLDATABASE, $con);
	if(!$selectTableResult) sqlError();
	$queryResult1 = mysql_query($Statement1);
	if(!$queryResult1) sqlError();


	//返回查询标识符
	while($row = mysql_fetch_assoc($queryResult1))
	{
		 $result1[] = $row;
	}

	$queryResult2 = mysql_query($Statement2);
	if(!$queryResult2) sqlError();

	while($row = mysql_fetch_assoc($queryResult2))
	{
		 $result2[] = $row;
	}

	$result1[] = $result2;


	//close database
	mysql_close($con);

	jsonOutput('OK','',$result1);

?>
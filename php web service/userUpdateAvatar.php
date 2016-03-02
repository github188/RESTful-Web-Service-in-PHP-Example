<?php
//include h files
require_once './functions.php';

$user_id = $_GET['user_id'];
$avatar = $_GET['avatar'];

//input limitation
if(!isset($user_id))
{
	jsonOutput('FAIL','user_id cannot be NULL','');
	die();
}
if(!isset($avatar))
{
	jsonOutput('FAIL','avatar cannot be NULL','');
	die();
}


//SQL statement
$sqlQuery = "UPDATE user SET avatar = '".$avatar."' WHERE user_id =  ".$user_id;

// run query
runSQLQuery($sqlQuery);

?>
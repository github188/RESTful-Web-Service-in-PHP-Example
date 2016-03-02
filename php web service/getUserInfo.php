<?php
//include h files
require_once './functions.php';

$target_user_id = $_GET['target_user_id'];
$columns = array('target_user_id' => $target_user_id);

columnsFilter($columns);
//SQL statement
$sqlQuery = "SELECT * FROM user WHERE user_id = ".$target_user_id;

// run query
runSQLQuery($sqlQuery);

?>
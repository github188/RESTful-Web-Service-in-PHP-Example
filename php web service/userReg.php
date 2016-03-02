<?php
//include h files
require_once './functions.php';

$nickname = $_GET['nickname'];
$password = $_GET['password'];
$email = $_GET['email'];
$gender = $_GET['gender'];
$sign = $_GET['sign'];
$avatar = $_GET['avatar'];
$columns = array('nickname' => $nickname, 'password' => $password,'email' => $email,'gender' => $gender);
//input limit
columnsFilter($columns);

//SQL statement
$sqlQuery = "INSERT INTO user (nickName,password,email,gender,sign,avatar) VALUES ('".$nickName."','".$password."','".$email."','".$gender."','".$sign."','".$avatar."')";

// run query
runSQLQuery($sqlQuery);
?>
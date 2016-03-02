<?php
//MYSQL error output
require_once './const.php';

function sqlError()
{
	$errorMessgae = mysql_errno() . ": " . mysql_error(). " ";	
	jsonOutput('FAIL',$errorMessgae,'');
	//exit
	die();	

}
//return json
function jsonOutput($resultCode,$resultMessage,$resultData)
{
	//set response header
	header("Content-type: application/json");
	$successOutput = array('resultCode' => $resultCode,'resultMessage' => $resultMessage,'resultData' => $resultData );

	print_r(json_encode($successOutput));


}

//columns Filter
function columnsFilter($columns)
{
	foreach ($columns as $key => $value) {
			switch ($key) {
			case 'nickname':
				dieIfNotSet($key,$value);
				lengthCheck($key,$value,20);
				break;
			case 'password':
				dieIfNotSet($key,$value);
				lengthCheck($key,$value,20);
				break;
			case 'email':
				dieIfNotSet($key,$value);
				lengthCheck($key,$value,50);
				break;

				//不能为空且必须只能是male 或者 female
			case 'gender':
				dieIfNotSet($key,$value);

				if ($value != 'male'&&$value != 'female') 
				{
					jsonOutput('FAIL','gender must be either male or female','');
					die();
				}

				break;

			case 'user_id':
			case 'target_user_id':
				dieIfNotSet($key,$value);
				break;

			default:
				die('function columnsFilter,unknown column');
				break;
		}
	}
}

//check length limitation
function lengthCheck($paraName,$para,$number)
{
	if(strlen($para) > $number)
	{
		jsonOutput('FAIL',$paraName.'length cannot bigger than '.$number,'');
	}
}
//test if input parameter is not set,if YES,then die
function dieIfNotSet($key,$value)
{
	if(!isset($value)) 
	{
		jsonOutput('FAIL',$key.' cannot be NULL','');
		die();
	}

}

//run SQL query
function runSQLQuery($Statement)
{
	//connect database
	$con = mysql_connect(SQLHOST,SQLACCOUNT,SQLPASSWORD);
	if (!$con) die('Could not connect: ' . mysql_error());

	//select table
	$selectTableResult = mysql_select_db(SQLDATABASE, $con);
	if(!$selectTableResult) sqlError();
	$queryResult = mysql_query($Statement);
	if(!$queryResult) sqlError();


	//返回查询标识符
	while($row = mysql_fetch_assoc($queryResult))
	{
		 $result[] = $row;
	}


	//close database
	mysql_close($con);

	//success
	jsonOutput('OK','',$result);
}

// if id exists in table
function isIdexistsInTable($tableName,$idName,$idValue)
{
	$con = mysql_connect(SQLHOST,SQLACCOUNT,SQLPASSWORD);
	if (!$con) die('Could not connect: ' . mysql_error());

	//select table
	$selectTableResult = mysql_select_db(SQLDATABASE, $con);
	if(!$selectTableResult) sqlError();

	$statement = "SELECT * FROM ".$tableName." where ".$idName." = ".$idValue;
	$queryResult = mysql_query($statement);
	if(!$queryResult) sqlError();

	//返回查询标识符
	// if($queryResult != TRUE)
	// {
		while($row = mysql_fetch_assoc($queryResult))
		{
		  	$result[] = $row;
		}
	// }

	//close database
	mysql_close($con);

	if($result[0][$idName]) return TRUE;
	return FALSE;
}




?>
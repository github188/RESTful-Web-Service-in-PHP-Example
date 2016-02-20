<?PHP
header("Content-Type:application/json");
//if not null
if(!empty($_GET['name']))
{
	$name = $_GET['name'];
	deliver_response(400,$name,NULL);
}
//if null
else
{
	deliver_response(200,"no name found",NULL);
}

function deliver_response($status,$status_message,$data)
{
	header("HTTP/1.1 $status $status_message");	
	$response['status'] = $status;
	$response['status_message'] = $status_message;
	$response['data'] = $data;

	$json_response = json_encode($response);

	echo $json_response;

} 
?>
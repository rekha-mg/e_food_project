<?php

$entityBody = file_get_contents('php://input');
$requestObject=json_decode($entityBody,true);
header('Content-Type: application/json');
	// store request object to database...


$nm=$requestObject["Name"];
$loc=$requestObject["Location"];
$phn=$requestObject["Phone"];

$link=mysqli_connect("localhost","root","","e_food");
//Sign in form --------
$name=$nm;


$sql="SELECT * FROM user_details WHERE Phone=$phn ";
//check validation

$responseObj = new stdClass();

if($res=mysqli_query($link,$sql))
{
	$rowcount=mysqli_num_rows($res);
	if($rowcount ==1)
	{
		$responseObj->status = "U Already exist.. ".$nm;
		http_response_code(208);
		}
	}
	else
	{ // New user insertion
		$sqll="INSERT INTO user_details(Name,Location,Phone) VALUES ('$nm','$loc',$phn)";
		echo json_encode($sqll);
		if($ress=mysqli_query($link,$sqll))
		{ 
			$responseObj->status = "success";
			http_response_code(201);
		}
		else
		{
			$responseObj->status = "failed";
			http_response_code(500);
		}
	}
		$responseJSON = json_encode($responseObj); 
		echo $responseJSON;
}

				



				?>
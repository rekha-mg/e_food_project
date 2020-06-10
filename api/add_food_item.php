<?php

$entityBody = file_get_contents('php://input');
$requestObject=json_decode($entityBody,true);
header('Content-Type: application/json');
	// store request object to database...
 
$itm_id=$requestObject["Item_id"];
$itm_name=$requestObject["Item_name"];
$itm_typ=$requestObject["Item_type"];
$itm_cost=$requestObject["Item_cost"];

$link=mysqli_connect("localhost","root","","e_food");
//Sign in form --------


$sql="SELECT * FROM items WHERE Item_id='$itm_id' and Item_name='$itm_name' ";
//check validation

$responseObj = new stdClass();

if($res=mysqli_query($link,$sql))
{
	$rowcount=mysqli_num_rows($res);
	if($rowcount ==1)
	{
		$responseObj->status = "Item already entered.. ".$itm_name;

	}
	else
	{ // New user insertion
		$sqll="INSERT INTO Items(Item_id,Item_name,Item_type,Item_cost ) VALUES ('$itm_id','$itm_name','$itm_typ',$itm_cost)";
		//echo json_encode($sqll);
		if($ress=mysqli_query($link,$sqll))
		{ 
			$responseObj->status = "Added new food Item";
			http_response_code(201);
		}
		else
		{
			$responseObj->status = "couldnot insert new item";
			http_response_code(500);
		}
	}
		$responseJSON = json_encode($responseObj); 
		echo $responseJSON;
}

				



				?>
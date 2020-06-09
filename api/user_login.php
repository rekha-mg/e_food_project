<?php

  $entityBody = file_get_contents('php://input');
  $requestObject=json_decode($entityBody,true);
  header('Content-Type: application/json');
 	

	
	$nm=""; $phn="";
	
	if(isset($_GET['name']))
	{
		$nm=$_GET['name'];
	}

	if(isset($_GET['phone']))
	{
		$phn=$_GET['phone'];
	}
	$link=mysqli_connect("localhost","root","","e_food");

	$responseObj = new stdClass();
	
	if($nm != "")
	{
		$sql_user="SELECT * FROM user_details WHERE Name='$nm' and Phone=$phn";
		  echo $sql_user;
		if($result=mysqli_query($link,$sql_user))
		{
		$json_array=array();

		while($row=mysqli_fetch_assoc($result))
		{
			$json_array[]=$row;
		}
		$responseObj->row = $json_array;
		$responseObj->status = "Welcome ...";
		http_response_code(200);
		}
				
 		$responseJSON = json_encode($responseObj); 
		echo $responseJSON;		
	}
	else
		{
		
		$responseObj->status = "Not Registerd";
		http_response_code(500);	
 		$responseJSON = json_encode($responseObj); 
		echo $responseJSON;	
		}
 		
?>
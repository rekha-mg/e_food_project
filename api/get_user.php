<?php

  $entityBody = file_get_contents('php://input');
  $requestObject=json_decode($entityBody,true);
  header('Content-Type: application/json');
 	

	$page=2;
	$limit=2;
	$nm="";
	if(isset($_GET['limit']))
	{
		$limit=$_GET['limit'];
	}
	if(isset($_GET['name']))
	{
		$nm=$_GET['name'];
	}

	$link=mysqli_connect("localhost","root","","e_food");

	$responseObj = new stdClass();
	// display details from user from url
	if($nm != "")
	{
		$sql_user="SELECT * FROM user_details WHERE Name='$nm'";
		   //echo $sql_user;
		if($result=mysqli_query($link,$sql_user))
		{
		$json_array=array();

		while($row=mysqli_fetch_assoc($result))
		{
			$json_array[]=$row;
		}
		$responseObj->row = $json_array;
		$responseObj->status = "success";
		http_response_code(200);
		}
				
 		$responseJSON = json_encode($responseObj); 
		echo $responseJSON;		
	}
	else
		{   // gets all users details when url is not given depending on limit
			$sql_user="SELECT * FROM user_details LIMIT $limit";
		   
		if($result=mysqli_query($link,$sql_user))
		{
		$json_array=array();

		while($row=mysqli_fetch_assoc($result))
		{
			$json_array[]=$row;
		}
		$responseObj->row = $json_array;
		$responseObj->status = "all users";
		http_response_code(200);
		}
				
 		$responseJSON = json_encode($responseObj); 
		echo $responseJSON;	
	}
 		
?>
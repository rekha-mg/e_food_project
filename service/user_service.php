<?php

  $entityBody = file_get_contents('php://input');
  $requestObject=json_decode($entityBody,true);
  header('Content-Type: application/json');
  require_once('dbclass.php');

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

	Class DisplayUser{
    function getUserInfo($nme) {
        $Dbobj = new DbConnection(); 
        $responseObj = new stdClass();
        $res = mysqli_query($Dbobj->getdbconnect(), "SELECT * FROM user_details WHERE Name = '$nme'");
        echo $res;

		$json_array=array();

		while($row=mysqli_fetch_assoc($res))
		{
			$json_array[]=$row;
		}
		$responseObj->row = $json_array;
		$responseObj->status = "success";
		http_response_code(200);
		}
				
 		$responseJSON = json_encode($responseObj); 
		return $responseJSON;	
       // return mysqli_fetch_array($res,MYSQLI_ASSOC) or die("Error: " . mysqli_error($Dbobj->getdbconnect()));
    }
}
$data = new WorkingExamples();
echo "<pre/>";print_r($data->getUserInfo($nm));
?>
 		

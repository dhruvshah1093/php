<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
	$listing_id = $_POST['listing_id'];
	$user_id =  $_POST['user_id'];
	require_once('dbConnect.php');
	$sql="UPDATE likes
        SET favorite ='false'
        WHERE listing_id='$listing_id' AND user_id='$user_id';";
    if(mysqli_query($con,$sql)){
			
			echo "unlike";
		}
	else{
			echo "error hai";
	}	
}
else{
	echo "ERROR";
}
?>
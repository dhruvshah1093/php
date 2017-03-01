<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
	$listing_id = $_POST['listing_id'];
	$user_id =  $_POST['user_id'];
	require_once('dbConnect.php');
	$check="SELECT like_id FROM likes WHERE listing_id='$listing_id' AND user_id='$user_id';";
	$try = mysqli_fetch_array(mysqli_query($con,$check));
	if(isset($try)){
		$sql="UPDATE likes
        SET favorite ='true'
        WHERE listing_id='$listing_id' AND user_id='$user_id';";
        if(mysqli_query($con,$sql)){
        	echo "like";
        }
	}
	else{
	$sql ="INSERT INTO likes VALUES (null,'$listing_id','$user_id','true');";
		if(mysqli_query($con,$sql)){
			echo "like";
		}
		else{
			echo "error hai";
		}
mysqli_close($con);
	}	
}

else{
	echo "Error";
}
?>
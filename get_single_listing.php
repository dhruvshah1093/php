<?php 
	
	//Getting the requested id
	$id = $_GET['id'];
	$user_id=$_GET['user_id'];
	//Importing database
	require_once('dbConnect.php');
	
	//Creating sql query with where clause to get an specific list
	$sql = "SELECT homie.listings.*, homie.users.*
	FROM listings 
	INNER JOIN homie.users ON listings.creadted_by_id=homie.users.user_id 
	
	WHERE listings.id='$id'";
	
	//getting result 
	$r = mysqli_query($con,$sql);
	
	//pushing result to an array 
	$result = array();
	$row = mysqli_fetch_array($r);
	
			//displaying in json format 
/*	echo json_encode(array('result'=>$result),JSON_UNESCAPED_SLASHES);*/
	$like="SELECT * FROM likes WHERE listing_id='$id' AND likes.user_id='$user_id'";
	$get = mysqli_query($con,$like);
	$array_like=array();
	$array_null=array();
	$getlike=mysqli_fetch_array($get);
	if(isset($getlike)){
		array_push($result,array(
			"user_name"=>$row['username'],
			"user_dp"=>$row['user_dp'],
			"listing_address"=>$row['listing_address'],
			"listing_id"=>$row['id'],
			"listing_images"=>$row['listing_images'],
			"creadted_by_id"=>$row['creadted_by_id'],
			"images"=>$row['mul_images'],
			"listing_rent"=>$row['listing_rent'],
			"listing_filters"=>$row['listing_filters'],
			"like_id"=>$getlike['like_id'],
			"favorite"=>$getlike['favorite'],
			));
		echo json_encode(array('result'=>$result),JSON_UNESCAPED_SLASHES);

	}
	else {
		array_push($result,array(
			"user_name"=>$row['username'],
			"user_dp"=>$row['user_dp'],
			"listing_address"=>$row['listing_address'],
			"listing_id"=>$row['id'],
			"listing_images"=>$row['listing_images'],
			"mul_images"=>$row['mul_images'],
			"creadted_by_id"=>$row['creadted_by_id'],
			"listing_rent"=>$row['listing_rent'],
			"listing_filters"=>$row['listing_filters'],
			"like_id"=>$getlike['like_id'],
			"favorite"=>$getlike['favorite'],
			));
		echo json_encode(array('result'=>$result),JSON_UNESCAPED_SLASHES);
	}
	mysqli_close($con);
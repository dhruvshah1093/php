<?php 
		
		$user_id=$_GET['id'];
			//Importing Database Script 
	require_once('dbConnect.php');
	
	//Creating sql query
	$sql = "SELECT homie.listings.*, homie.users.*,homie.likes.*
	FROM listings
	INNER JOIN homie.users ON listings.creadted_by_id=homie.users.user_id 
	INNER JOIN homie.likes ON  listings.id= likes.listing_id
	WHERE likes.user_id='$user_id' AND likes.favorite='true';";
	//getting result 
	$r = mysqli_query($con,$sql);
	
	//creating a blank array 
	$result = array();
	
	//looping through all the records fetched
	while($row = mysqli_fetch_array($r)){
		
		//Pushing name and id in the blank array created 
		array_push($result,array(
			"id"=>$row['id'],
			"listing_address"=>$row['listing_address'],
			"listing_images"=>$row['listing_images'],
			"created_by_id"=>$row['creadted_by_id'],
			"listing_rent"=>$row['listing_rent'],
			"user_name"=>$row['username'],
			"user_dp"=>$row['user_dp']
		));
	}
	//Displaying the array in json format 
	echo json_encode(array('result'=>$result),JSON_UNESCAPED_SLASHES);
	mysqli_close($con);

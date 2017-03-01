<?php 
	//Importing Database Script 
	require_once('dbConnect.php');
	
	//Creating sql query
	$sql = "SELECT listings.*, home.users.*
	FROM listings
	INNER JOIN home.users
	ON listings.creadted_by_id=home.users.user_id WHERE listings.is_featured= 'true' ORDER BY listings.id ASC;";
	
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
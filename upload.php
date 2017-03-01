<?php
	if($_SERVER['REQUEST_METHOD']=='POST'){
	
		$image =$_POST['image'];
		$length=$_POST['length'];
		$many=array();
		for($i=0;$i<$length;$i++){
			$number="mul_images$i";
			array_push($many,$_POST["$number"]);
		}
		require_once('dbConnect.php');
		
		$sql ="SELECT id,creadted_by_id FROM listings ORDER BY id ASC";
		
		$res = mysqli_query($con,$sql);
		
		$id = 0;
		
		while($row = mysqli_fetch_array($res)){
				$id = $row['creadted_by_id']."-".$row['id'];
				$id2=$row['id']."-".$row['creadted_by_id'];
		}
		$path = "images/$id.png";
		$path2=array();
		$actualpath2=array();
		for($i=0;$i<count($many);$i++){
		$temp1="images/$id2/".$i.".png";

		$temp2= "http://localhost:8888/home/$temp1";
		array_push($path2,$temp1);
		array_push($actualpath2,$temp2);
		}
		$actualpath = "http://localhost:8888/home/$path";
		$actualpathDb=implode(",", $actualpath2);
	
		$sql = "INSERT INTO listings VALUES (null,'Malabar hill','13','$actualpath','$actualpathDb','RS.100000','gg,bb,aa,cc','true','false','true',NOW(),null,null)";
		
		if(mysqli_query($con,$sql)){
			//this puts the file onto the server in actual path directory converts bitmap string into image 
			file_put_contents($path,base64_decode($image));
			for($i=0;$i<count($path2);$i++){
				if (!is_dir("images/$id2")) {
  // dir doesn't exist, make it
  mkdir("images/$id2/");

				file_put_contents($path2[$i],base64_decode($many[$i]));
			}
			else{
				file_put_contents($path2[$i],base64_decode($many[$i]));
			} 
		}

			echo "Successfully Uploaded";
		}
		
		mysqli_close($con);
	}else{
		echo "Error";
	}
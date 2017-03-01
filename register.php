<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
		$name = $_POST['name'];
		$username=$_POST['username'];
		$password = $_POST['password'];
		$email = $_POST['email'];
		$dob = $_POST['dob'];
		$image=$_POST['image'];
		$gender=$_POST['gender'];

		
		if($name == '' || $password == '' || $email == ''){
			echo 'please fill all values';
		}else{
			require_once('dbConnect.php');
			$sql = "SELECT * FROM users WHERE email='$email'";
			$path = "images/$email.png";
			$actualpath = "http://localhost:8888/home/$path";
			$check = mysqli_fetch_array(mysqli_query($con,$sql));
			
			if(isset($check)){
				echo 'username or email already exist';
			}else{				
				$sql = "INSERT INTO users (name,username,gender,password,email,Dob,user_dp,date_registered_at) VALUES('$name','$username','$gender',MD5('$password'),'$email','$dob','$actualpath',NOW())";
				if(mysqli_query($con,$sql)){
					file_put_contents($path,base64_decode($image));
					echo "Successfully Uploaded";
					
				}else{
					echo 'oops! Please try again!';
				}
			}
			mysqli_close($con);
		}
}else{
echo 'error';
}
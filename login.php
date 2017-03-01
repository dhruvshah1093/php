<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
		$username=$_POST['username'];
		$password = $_POST['password'];
require_once('dbConnect.php');
$result = array();
$sql = "SELECT * FROM users WHERE username COLLATE latin1_general_cs='$username' AND password COLLATE latin1_general_cs =MD5('$password') ";
$res = mysqli_query($con,$sql);
if($row = mysqli_fetch_array($res)){

				array_push($result,array(
			"login"=>"sucess",
			"id"=>$row['user_id']
			));
				echo json_encode(array('result'=>$result),JSON_UNESCAPED_SLASHES);
}else{
	array_push($result,array('login'=>'failure'));
	echo json_encode(array('result'=>$result),JSON_UNESCAPED_SLASHES);
}

}
else{
	echo "CONNECTION FAILURE";
}
mysqli_close($con);
?>
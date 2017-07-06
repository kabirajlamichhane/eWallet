<?php 
	$conn =mysqli_connect("202.166.198.46","learner","learner","db_ewallet");
	require_once('vendor/autoload.php');
	use \Firebase\JWT\JWT; 
	define('SECRET_KEY','hellonepal'); 
	define('ALGORITHM','HS512');
	$secretKey = base64_decode(SECRET_KEY);
	$token =$_POST['token'];
	$newpassword =md5($_POST['newpassword']);
	$this->email = $_POST['email'];
	
	// $decodedataArray = JWT::decode(
	// $token,
	// $secretKey,
	// array(ALGORITHM)
	// );
	// $email = $decodedataArray->data->email;	
	
	// echo $email;

	$sql ="SELECT * FROM token where token = '$token' AND email ='$email'";
	$result =mysqli_query($conn,$sql);
	 if(mysqli_num_rows($result) > 0)
	{
		$sql ="UPDATE user set password ='$newpassword' WHERE email ='$email'";
		$result=mysqli_query($conn,$sql);

		if($result)
		{
			// header('location:dashboard.php');
			echo "ok";
		}
		else
		{
			echo "soory";
		}
	}
	else
	{
		echo "nop";
	}
	
?>
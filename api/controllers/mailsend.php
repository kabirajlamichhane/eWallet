<?php
  
	require_once('vendor/autoload.php');
	use \Firebase\JWT\JWT; 
	define('SECRET_KEY','hellonepal');  /// secret key can be a random string and keep in secret from anyone
	define('ALGORITHM','HS512');   // Algorithm used to sign the token, see
                               https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40#section-3
//// Suppose you have submitted your form data here with username and password
function token($email)
{
	
	  $tokenId    = base64_encode(mcrypt_create_iv(32));
    $issuedAt   = time();
    $notBefore  = $issuedAt + 10;  //Adding 10 seconds
    $expire     = $notBefore + 7200; // Adding 60 seconds
    $serverName = 'http://localhost/php-json/'; /// set your domain name 

		
    
    $data = [
        'iat'  => $issuedAt,         // Issued at: time when the token was generated
        'jti'  => $tokenId,          // Json Token Id: an unique identifier for the token
        'iss'  => $serverName,       // Issuer
        'nbf'  => $notBefore,        // Not before
        'exp'  => $expire,           // Expire
        'data' => [                  // Data related to the logged user you can set your required data
          'email' => $email
    
                  ]
    ];
  	$secretKey = base64_decode(SECRET_KEY);
  	/// Here we will transform this array into JWT:
  	$jwt = JWT::encode(
            $data, //Data to be encoded in the JWT
            $secretKey, // The signing key
             ALGORITHM 
           ); 
 	// $unencodedArray = ['jwt' => $jwt];
 	// return json_encode($unencodedArray);
    return $jwt;
  	// echo  "{'status' : 'success','resp':".json_encode($unencodedArray)."}";

}

		$email =$_POST["email"];
		$to=$email;
    $from="cloudkabiraj@gmail.com";
		$sub='thank you for subscribe us';
		$token =token($email);
		$message='';

    // $token = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 5);
		
		// $message.="EMAIL: $email"."\n"."<br>";
		// $message.="FROM: $from"."\n"."<br>";
		$message.="TOKEN : $token"."\n"."<br>";
		// $message.="To: $to"."\n"."<br>";
		$body=$message."\n"."<br>";
    
	   require 'phpmailer/PHPMailerAutoload.php';
    
  

    $mail = new PHPMailer;

    // $mail->SMTPDebug = 1;                               // Enable verbose debug output

    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'ssl://smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'cloudkabiraj@gmail.com';                 // SMTP username
    $mail->Password = 'cloudkabiraj123';  
                             // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;                                    // TCP port to connect to

    $mail->setFrom($from, 'Mailer');
    $mail->addAddress($to, 'email');     // Add a recipient
    $mail->addReplyTO($email);
    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = ' success';
    $mail->Body    = $body;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

      // if($firstname && $email && $message){
      //   $header = "From: $firstname <$email>";
   


    if(!$mail->send()) 
    {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } 
  
    else 
    {
       echo 'Message has been sent'.$token;
      // header("location:success.php");
      // echo $email;
        $conn =mysqli_connect("202.166.198.46","learner","learner","db_ewallet");

        $sql ="SELECT * FROM token where email ='$email'";
        $res =mysqli_query($conn,$sql);
        // print_r($res);
        if(mysqli_num_rows($res) > 0)
        {
            $sql ="UPDATE token SET token ='$token' WHERE email ='$email'";
            $resultsql = mysqli_query($conn,$sql);
            print_r($resultsql);
        }
        else
        {
           $sql ="INSERT INTO token (`email`,`token`) VALUES ('$email','$token')";
           $resultsql =mysqli_query($conn,$sql);
           print_r($resultsql);

        }
    }
    echo $email;

	
?>
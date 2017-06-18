<?php

require_once('vendor/autoload.php');
use \Firebase\JWT\JWT; 
define('SECRET_KEY','Your-Secret-Key');  /// secret key can be a random string and keep in secret from anyone
define('ALGORITHM','HS512');   // Algorithm used to sign the token, see
                               https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40#section-3
//// Suppose you have submitted your form data here with username and password
	require_once('database.php');

	$data = new database;
	$username =$_POST['username'];
	$email =$_POST['email'];
	$password=md5($_POST['password']);
	$sql = "INSERT INTO user(`username`,`email`,`password`)
			 VALUES('$username','$email','$password')";
	$result = mysqli_query($data->conn, $sql);
	if( $result )
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
			    
                              ]
                ];
              $secretKey = base64_decode(SECRET_KEY);
              /// Here we will transform this array into JWT:
              $jwt = JWT::encode(
                        $data, //Data to be encoded in the JWT
                        $secretKey, // The signing key
                         ALGORITHM 
                       ); 
             $unencodedArray = ['jwt' => $jwt];
             echo json_encode($unencodedArray);
              // echo  "{'status' : 'success','resp':".json_encode($unencodedArray)."}";
    } 
    
         
		 
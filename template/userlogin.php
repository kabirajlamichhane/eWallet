<?php

    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $conn = mysqli_connect("202.166.198.46","learner","learner","db_ewallet");
    $query= "SELECT * FROM user WHERE username='$username' AND password='$password'";
    $result =mysqli_query($conn,$query);
    if(mysqli_num_rows($result) > 0)
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
        $jwt = JWT::encode
        	(
                $data, //Data to be encoded in the JWT
                $secretKey, // The signing key
                 ALGORITHM 
            ); 
        $unencodedArray = ['jwt' => $jwt];
        echo "sucess";die;
        echo json_encode($unencodedArray);
        // echo  "{'status' : 'success','resp':".json_encode($unencodedArray)."}";
    } 
	

?>
<?php

	require_once('base-controller.php');
	require_once('../resources/vendor/autoload.php');
	require ('../resources/phpmailer/PHPMailerAutoload.php');

	use \Firebase\JWT\JWT; 
	    // define('SECRET_KEY','hellonepal');  /// secret key can be a random string and keep in secret from anyone
	    // define('ALGORITHM','HS512'); 

	class user extends API
		{
			public $conn;
			private $query, $sql, $id, $result, $email, $username, $password, $token,$json_val,$row;
		    public function __construct() 
		    {
		        
		        parent::__construct();
		        $this->conn = mysqli_connect("202.166.198.46","learner","learner","db_ewallet") ;
			
		        switch($this->method)
		        {
		        	case 'GET':

		        		if(isset($_GET['route']))
		        		{
		        			if(isset($this->params['param1']))
		        			{
		        				$this->id = $this->params['param1'];
		            			$this->query = "SELECT * FROM user WHERE id=$this->id";
		            		}
		            		else
		            		{ 
			            			$this->query = "SELECT * FROM user";
			            	}
			            	$this->runQuery();
		            	} 
		            break;

			        case 'POST': 
			        	//INSERT//
		               	switch($this->route)
		                {
		                    case 'register':
		                    	$this->json_val =json_decode(file_get_contents("php://input"), TRUE);
		                        $this->email =$this->json_val['email'];
		                        $this->username =$this->json_val['username'];
		                        $this->password =md5($this->json_val['password']);
		                        $this->query = "INSERT INTO user(`username`,`email`,`password`)
		                        				VALUES('$this->username','$this->email','$this->password')";
		                        $this->runQuery();
		                        break;

		                    case 'login':
		                    	$this->json_val = json_decode(file_get_contents("php://input"), true);
		                        $this->email =$this->json_val['email'];
		                        $this->password =$this->json_val['password'];

		                        $this->password = md5($this->password);
		        				$this->query ="SELECT * FROM user WHERE email='$this->email' AND password ='$this->password'";
		        				$this->runQuery();
		        				$var = mysqli_fetch_assoc($this->result);
		        				if($this->result->num_rows > 0)
		        				{
		        					
		        					$jwt = $this->token();
		        					echo $jwt;

		        				}
		        				else
		        				{
		        					echo 'false';
		        				}
		        				
		                        break;

		                    case 'sendmail':

		                    	$this->json_val =json_decode(file_get_contents("php://input"), TRUE);
	                    		$this->email = $this->json_val['email'];
	                    		$this->query ="SELECT * FROM user where email ='$this->email'";
						        $this->runQuery();

						   		if($this->result->num_rows > 0)
						   		{
		                    		$this->token = $this->token();
		                    		$this->sendMail("cloudkabiraj@gmail.com", $this->email, "Token", $this->token, "cloudkabiraj@gmail.com");

		                    		// Update the database.
		                    		$this->query = "SELECT * FROM token WHERE email = '$this->email'";
		                    		$this->runQuery();

		                    		if($this->result->num_rows > 0)
					        		{
							            $this->query ="UPDATE token SET token ='$this->token' WHERE email ='$this->email'";

					        		}
					        		else
					        		{
								        $this->query ="INSERT INTO token (`email`,`token`) VALUES ('$this->email','$this->token')";
								          
					        		}

					        		$this->runQuery();
	                        	}
	                        	else
	                        	{
	                        		echo "Invalid email";
	                        	}

	                        	break;
		                } 
		            	break;

		            case 'PUT':
		            	$this->json_val =json_decode(file_get_contents("php://input"), TRUE);
		            	print_r($this->json_val);
		            	$this->email = $this->json_val['email'];
		                $this->token = $this->json_val['token'];
		                $this->password = md5($this->json_val['newpassword']);
		                $this->query ="SELECT * FROM token where email ='$this->email' and token = '$this->token'";
		        		$this->runQuery();

		       	 		if($this->result->num_rows > 0)
		       	 		{
			       	 		$this->query = "UPDATE user set password ='$this->password' WHERE email ='$this->email'";
			       	 		$this->runQuery();
			       	 		echo "Success";       	             
		       	 		} 
		       	 		else
		       	 		{
		       	 			echo "Invalid token or password";
		       	 			exit;
		       	 		}
		                break; 

	            	case 'DELETE':
		                $sql =$this->DELETE($this->params['param1']);
		                echo "ok";
		                break;    
			    } 

	            if($this->method == 'GET')
	            {
	                while($this->row = mysqli_fetch_assoc($this->result))
	                {
	                    echo $this->row['email'] . $this->row['username'] .$this->row['password']."\n";
	                }
	            }

	                  
			}

		    protected function runQuery()
		    {
		    	$this->result = mysqli_query($this->conn, $this->query);
		    }

	    	public function DELETE($id)
	    	{
		        $sql ="DELETE FROM user WHERE id='$id'";
		        return $sql;
	   		}

	    	public function token()
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
		              'email' => $this->email
		        
		                      ]
		        ];
		        $secretKey = base64_decode(SECRET_KEY);
		        /// Here we will transform this array into JWT:
		        $jwt = JWT::encode(
		                $data, //Data to be encoded in the JWT
		                $secretKey, // The signing key,
		                 ALGORITHM 
		               ); 
		        // $unencodedArray = ['jwt' => $jwt];
		        // return json_encode($unencodedArray);
		        return $jwt;
	    	}

	    	public function sendMail($from, $to, $subject, $message, $replyTo)
	    	{

	    		$mail = new PHPMailer;

	    		// $mail->SMTPDebug = 1;                               // Enable verbose debug output

			    $mail->isSMTP();  
			                                      // Set mailer to use SMTP
			    $mail->Host = 'ssl://smtp.gmail.com';  // Specify main and backup SMTP servers
			    $mail->SMTPAuth = true;                               // Enable SMTP authentication
			    $mail->Username = 'cloudkabiraj@gmail.com';                 // SMTP username
			    $mail->Password = 'cloudkabiraj123';  
			                             // SMTP password
			    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
			    $mail->Port = 587;    
			                                // TCP port to connect to

			    $mail->setFrom($from, 'Mailer');
			    $mail->addAddress($to, 'email');     // Add a recipient
			    $mail->addReplyTo($replyTo);
			    $mail->isHTML(true);                                  // Set email format to HTML

			    $mail->Subject = $subject;
			    $mail->Body    = $message;
		   


			    if(!$mail->send()) 
			    {

			        echo 'Message could not be sent.';
			        echo 'Mailer Error: ' . $mail->ErrorInfo;
			    } 
	  
	    		else 
	    		{
	       			echo 'Message has been sent'.$this->token;
	      
	      			echo $this->email;
			        
	    		}
	    		// echo $email;
	    	}
	    	protected function verify_token()
	    	{

		
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
				// print_r($result);
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
	    }
		}

		$user = new user();

?>

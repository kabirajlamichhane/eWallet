<?php
	require_once('base-controller.php');
	require_once('../resources/vendor/autoload.php');
	require ('../resources/phpmailer/PHPMailerAutoload.php');
	use \Firebase\JWT\JWT; 


	class categories extends API
	{
		public $conn,$website_name,$query;
		public $params,$json_val, $result,$email;
		public function __construct()
		{
			parent::__construct();
	 		$this->conn = mysqli_connect("202.166.198.46","learner","learner","db_ewallet") ;
		
			$this->secretKey = base64_decode(SECRET_KEY);
		 	$this->token =$this->headers['access_token'];

			$this->decodedataArray = JWT::decode(
										$this->token,
										$this->secretKey,
										array(ALGORITHM)
										);
			

			$this->email = $this->decodedataArray->data->email;

			switch($this->method)
			{
				
					case 'GET' :
						$this->query ="SELECT website_name FROM settings WHERE id=3";
						$this->RunQuery();
						// print_r($this->result);
						
						$settings = array();

						$row=mysqli_fetch_assoc($this->result);
						$settings['website_name'] = $row['website_name'];
						$this->query ="SELECT favicon FROM settings WHERE id=4";
						$this->RunQuery();
						$row=mysqli_fetch_assoc($this->result);
						$settings['favicon'] =$row['favicon'];
						echo json_encode($settings);
						

						break;
					

					case 'POST':
						$this->json_val = json_decode(file_get_contents("php://input"),TRUE);
						$image=$_FILES['image']['name'];
						$tmp_name=$_FILES['image']['tmp_name'];
						$folder= $_SERVER["DOCUMENT_ROOT"]."/eWallet/favicon/";
						move_uploaded_file($tmp_name, $folder.$image);
						$this->query = "UPDATE settings SET favicon ='$image' WHERE id=4";
						print_r($this->query);
						$this->RunQuery();
						break;
						
					case 'PUT':
						$this->json_val = json_decode(file_get_contents("php://input"),TRUE);
						$this->website_name =$this->json_val['website_name'];
						$this->query ="UPDATE settings SET website_name='$this->website_name' WHERE id=3";
						print_r($this->query);
						$this->RunQuery();	
						break;


					case 'DELETE' :


			}
		 
		}

		public function RunQuery()
		{
			$this->result = mysqli_query($this->conn,$this->query);
			
		}
		
	}
	$categori = new categories();
?>
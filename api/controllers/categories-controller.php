<?php
	require_once('base-controller.php');
	require_once('../resources/vendor/autoload.php');
	require ('../resources/phpmailer/PHPMailerAutoload.php');
	use \Firebase\JWT\JWT; 


	class categories extends API
	{
		public $conn;
		public $query,$result,$var,$email,$json_val,$token,$secretKey,$decodedataArray,$row,$name,$field_name,$field_value;
		public $params;
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
				case'GET' :
				 	if(isset($this->params['param2']))
				 	{
				 
				 		$this->name = $this->params['param2'];
				 		$id=$this->user_id();
						$category_id = $this->category_id($this->name);

						$this->query = "SELECT category_data.field_name,wallet_data.field_value from wallet_data inner join category_data on category_data.id=wallet_data.category_data_id where user_id=$id and wallet_data.category_id=$category_id";
						$this->RunQuery();
						$category_data = array();
						while($row = mysqli_fetch_assoc($this->result))
						{
							$category_data[$row['field_name']] = $row['field_value'];
						}
						
						$data['categorydata'] = $category_data;
						$myjson = json_encode($data);

						echo $myjson;
						// $data = mysqli_fetch_all($this->result);
						// echo json_encode($row);

						
					}
					else
					{
					
						$id = $this->user_id();
						$this->query="SELECT name FROM category where user_id ='$id'";
						$this->RunQuery();
						$row = mysqli_fetch_all($this->result);
						echo json_encode($row);
					}	
					break;

					case 'POST':
						//INSERT CATEGORY DATA AND VALUE//
						if(isset($this->params['param2']))
						{
							$this->name = $this->params['param2'];
							$this->json_val = json_decode(file_get_contents("php://input"),TRUE);
							$this->field_name = $this->json_val['field_name'];
							$this->field_value = $this->json_val['field_value'];
							$user_id = $this->user_id();
							$category_id=$this->category_id($this->name);
							$this->query = "INSERT INTO category_data (`field_name`,`category_id`) VALUES ('$this->field_name',$category_id)";
							$this->RunQuery();
							$category_data_id=$this->category_data_id($this->name,$this->field_name);
							$this->query = "INSERT INTO wallet_data (`field_value`,`category_id`,`category_data_id`,`user_id`) VALUES ('$this->field_value',$category_id,$category_data_id,$user_id)";
							$this->RunQuery();
							echo "param2";
						}
						else
						{
							
							$this->json_val =json_decode(file_get_contents("php://input"), TRUE);
							$this->name = $this->json_val['name'];
							$id = $this->user_id();
							$this->query = "INSERT INTO category (`name`,`user_id`) VALUES ('$this->name','$id')";
							$this->RunQuery();
						
						}
					break;

					case 'PUT':
					
						// update category_name
						if((isset($this->params['param2'])) && isset($this->params['param3']))
						{
							$this->name = $this->params['param2'];
							$this->json_val = json_decode(file_get_contents("php://input"),TRUE);
							$this->fieldname =$this->params['param3'];
							$this->field_name =$this->json_val['field_name'];
							$this->field_value =$this->json_val['field_value'];
							$user_id = $this->user_id();
							$category_id=$this->category_id($this->name);
							$category_data_id=$this->category_data_id($this->name,$this->fieldname);
							$this->query ="UPDATE category_data SET field_name='$this->field_name' WHERE id=$category_data_id";
							$this->RunQuery();
							
							$wallet_data_id =$this->wallet_data_id($this->name,$this->fieldname);
							$this->query ="UPDATE wallet_data SET field_value= '$this->field_value' WHERE category_data_id='$category_data_id'";
							$this->RunQuery();
							// print_r($this->query);
							
						}
						else
						{
							$this->json_val = json_decode(file_get_contents("php://input"),TRUE);
							$this->name =$this->json_val['name'];
							$this->cat_name =$this->params['param2'];
							$category_id=$this->category_id($this->cat_name);
							echo $category_id;
							$this->query ="UPDATE category SET name='$this->name' WHERE id='$category_id'";
							print_r($this->query);
							$this->RunQuery();
							
						}			
					break;

					case 'DELETE' :

						if((isset($this->params['param2'])) && isset($this->params['param3'])){
							$user_id=$this->user_id();
							$this->name = $this->params['param2'];
							$category_id =$this->category_id($this->name);
							$data = $this->params['param3'];
							$this->query = "DELETE w FROM wallet_data AS w INNER JOIN category_data AS c ON w.category_data_id=c.id  WHERE user_id = $user_id AND w.category_id=$category_id AND field_name='$data'";
							$this->RunQuery();
							$this->query = "DELETE FROM category_data WHERE category_id = $category_id AND field_name = '$data'";
							$this->RunQuery();


						}else
						{
							// echo "param2";
							$this->name = $this->params['param2'];
							$id=$this->user_id();
							$category_id =$this->category_id($this->name);
							$this->query ="DELETE FROM wallet_data WHERE category_id =$category_id";
							$this->RunQuery();
							$this->query ="DELETE FROM category_data WHERE category_id =$category_id";
							$this->RunQuery();
							$this->query ="DELETE FROM category WHERE id =$category_id";
							$this->RunQuery();
						}
	
			}
		 
		}

		public function RunQuery()
		{
			$this->result = mysqli_query($this->conn,$this->query);
			
		}

		public function user_id()
		{
			$this->query ="SELECT id FROM user WHERE email ='$this->email'";
			$this->RunQuery();
			$user_id = mysqli_fetch_assoc($this->result);
			$id= $user_id['id'];
			return $id;
		}

		public function category_id($category_name)
		{
			$id =$this->user_id();
			$this->query ="SELECT id FROM category WHERE user_id='$id' and name = '$category_name'";
			$this->RunQuery();
			$category_id = mysqli_fetch_assoc($this->result);
			$id=$category_id['id'];
			return $id;	
		}

		public function category_data_id($category_name,$field_name)
		{
			
			$category_id=$this->category_id($category_name);
			$this->query ="SELECT id  FROM  category_data WHERE category_id ='$category_id' and field_name = '$field_name'";
			$this->RunQuery();
			$category_data_id =mysqli_fetch_assoc($this->result);
			$id=$category_data_id['id'];
			return$id;
		}

		public function wallet_data_id($category_name,$field_name)
		{
			
			$id =$this->category_data_id($category_name,$field_name);
			$this->query ="SELECT id FROM wallet_data WHERE category_data_id='$id'";
			$this->RunQuery();
			$wallet_data = mysqli_fetch_assoc($this->result);
			$id = $wallet_data['id'];
			return$id;
		}
		
	}
	$categori = new categories();
?>
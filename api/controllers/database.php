<?php
class database
	{
		public $host="202.166.198.46";
		public $user="learner";
		public $password="learner";
		public $databasename="db_ewallet";
		public $conn;

		public function __construct()
		{
			$this->conn=new mysqli($this->host,$this->user,$this->password,$this->databasename);
			if($this->conn->connect_error)
			{
				die("connect failed" .$conn->connect_error);
			}
			return $this->conn;
		}

		
	}
?>
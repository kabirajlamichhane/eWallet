<?php
    use \Firebase\JWT\JWT; 
    define('SECRET_KEY','hellonepal');  /// secret key can be a random string and keep in secret from anyone
    define('ALGORITHM','HS512'); 

    abstract class API
    {
        protected $method;
        protected $route;
        protected $params;
        protected $headers;
        
        public function __construct() 
        {
            // $this->$params = [];
           
            // header("Content-Type: application/json");
            // echo $this->url($request);

            $this->method = $_SERVER['REQUEST_METHOD'];
            $this->headers = getallheaders();
            
          

            if(isset($_GET['route']))
            {
                $this->route = $_GET['route'];

                if(isset($_GET{'param1'}))
                {
                    $this->params['param1'] = $_GET['param1'];
                }

                if(isset($_GET['param2']))
                {
                    $this->params['param2'] = $_GET['param2'];
                }
                if(isset($_GET['param3']))
                {
                    $this->params['param3'] = $_GET['param3'];
                }
            }

        }
        
        private function _response($data, $status = 200)
        {
            header("HTTP/1.1 " . $status . " " . $this->_requestStatus($status));
            // return json_encode($data);
            // echo $data;
        }
        private function _requestStatus($code)
        {
            $status = array(  
            200 => 'OK',
            404 => 'Not Found',   
            405 => 'Method Not Allowed',
            500 => 'Internal Server Error',
            401 => 'unauthorized',
            );
            return ($status[$code])?$status[$code]:$status[500]; 
        }
        public function checkRoute()
        {
            $routes = array("book","register","login","sendmail","updatepassword","category","category_name");
            return in_array($this->route, $routes);
        }

       
    }

?>

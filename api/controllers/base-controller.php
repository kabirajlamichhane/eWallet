<?php
    use \Firebase\JWT\JWT; 
    define('SECRET_KEY','hellonepal');  /// secret key can be a random string and keep in secret from anyone
    define('ALGORITHM','HS512'); 

abstract class API
{
    protected $method;
    protected $route;
    protected $params;
    
    public function __construct() 
    {
        // $this->$params = [];
       
        // header("Content-Type: application/json");
        // echo $this->url($request);

        $this->method = $_SERVER['REQUEST_METHOD'];
        $headers = getallheaders();

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
        }
      
        // if($this->checkRoute())
        // {
        //      // echo "success";
        //     $this->_response('Ok');
        // }
        // else
        // {
        //      // echo "page not found";
        //      $this->_response('data',404);
        // }
        // if(isset($headers['token']))
        // {
        //      $this->_response('data');
        // }
        // else
        // {
        //      $this->_response('data',401);
             
        // }
  
        // $this->id = explode("/", $_SERVER['REQUEST_URI'])[4];
        // print_r($this->id);

        switch($this->method)
        {
            // case 'DELETE':
            // break;
            
            // case 'POST':
            //     // $this->request = $this->_cleanInputs($_POST);
            //     // $data = json_decode($file_get_contents("php://input"),TRUE);
            //     // $this->$data;
            //     break;
            // case 'GET':
            //     // $this->request = $this->_cleanInputs($_GET);
            //     echo $this->route;
            //     break;
            // case 'PUT':
                
            //     // $this->file = file_get_contents("php://input");
            //     // $data = json_decode($file_get_contents("php://input"),TRUE);
            //     // $this->$data;
            //     break;
            // default:
            //     $this->_response('Invalid Method', 405);
            //     break;
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
        $routes = array("book","register","login","sendmail","updatepassword");
        return in_array($this->route, $routes);
    }
}

?>

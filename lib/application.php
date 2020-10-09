<?php
/* NEW added third argument "GET" */
function get($route,$callback){
    Application::register($route,$callback,"GET");
}

/* NEW added next three functions */
function post($route,$callback){
    Application::register($route,$callback,"POST");
}

function put($route,$callback){
    Application::register($route,$callback,"PUT");
}

function delete($route,$callback){
    Application::register($route,$callback,"DELETE");
}

/* New, if none of the above routes match, then we have a 404 error */
function resolve(){
	Application::resolve();
}

class Application{
   private static $instance;
   private static $route_found = false;
   private $route = "";

   /* Added properties */
   private $messages = array();
   private $method = "";
   private $route_segments = array();
   private $route_variables = array();
   
   public static function get_instance(){
      if(!isset(static::$instance)){
         static::$instance = new Application();
      }
      return static::$instance;
   }
    
    
   protected function __construct(){
      $this->route = $this->get_route();
      $this->method = $this->get_method();
      $this->route_segments = explode("/",trim($this->route,"/"));
   }
    
    public function accepts($accept="text/html"){
      $accept_header = "";
  
      if(!empty($_SERVER['HTTP_ACCEPT'])){
         $accept_header = strtolower($_SERVER['HTTP_ACCEPT']);
      }

      if(!empty($accept_header)){
        $accept = str_replace("/","\/",$accept);
        $accept = str_replace("+","\+",$accept);

        if(preg_match("/{$accept}/i",$accept_header)){
            return true;
        }
      }
      return false;
    }

    public function get_route(){
      return $_SERVER['REQUEST_URI'];  
    }
    
    public static function register($route,$callback, $method){
      if(!static::$route_found){
         $application = static::get_instance();
         $url_parts = explode("/",trim($route,"/"));
         $matched = null;
       
         if(count($application->route_segments) == count($url_parts)){
            foreach($url_parts as $key=>$part){
               if(strpos($part,":") !== false){    
                   //This means we have a route variable

                   //Reject if URI segment is empty? e.g. /admin/user/12. is /admin//12. Invalid URI.
                   if(empty($application->route_segments[$key])){
                       $matched = false;
                       break;
                   }

                  if(strpos($part,";") !== false){
                      //means we have a regex
                      $parts = explode(";",trim($part," "));

                     if(count($parts === 2)){                    
                        if(!preg_match("/^{$parts[1]}$/",$application->route_segments[$key])){
                            $matched = false;
                            break;
                        }
                     }
                     $part = $parts[0];
                   }
                   $application->route_variables[substr($part,1)] = $application->route_segments[$key];
                   $matched = true;
               }
               else{
                 //Means we do not have a route variable
                 if($part == $application->route_segments[$key]){  
                     if(!$matched){
                        $matched = true;                         
                     }
                 }
                 else{
                    //Means routes don't match
                    $matched = false;
                    break;
                 }           
               }
            }
         }
         else{
           //The routes have different sizes i.e. they don't match
            $matched = false;
         }

         if(!$matched || $application->method != $method){
           if(!$matched){
              $matcher = "NULL";
           }
           return false;
         }
         else{
           static::$route_found = true;
           echo $callback($application);
         }
      }     
   }
   
   public function route_var($key){
      return $this->route_variables[$key];
   }

    /* Application functions called by the controller code */
    public function render($layout, $content){

       foreach($this->messages As $key => $val){
            $$key = $val;
       }

       $flash = $this->get_flash();
       $note = $this->get_note();
       $error = $this->get_error();

       $content = VIEWS."/{$content}.php";

       if(!empty($layout)){
          
          require VIEWS."/{$layout}.layout.php";
       }
       else{
          // What is this part for? When would we not need a layout? Think about it.
       }
       exit();
    }

    public function get_request(){
      return $_SERVER['REQUEST_URI'];
    }

    public function force_to_http($path="/"){
        if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']==='on'){
           $host = $_SERVER['HTTP_HOST'];
           $redirect_to_path = "http://".$host.$path;
           $this->redirect_to($redirect_to_path);
           exit();
        }
    }

    public function get_method(){
       $request_method = "";
       
       if(!empty($_SERVER['REQUEST_METHOD'])){
             $request_method = strtoupper($_SERVER['REQUEST_METHOD']);
       }
              
       if($request_method === "POST"){
	       $method = strtoupper($this->form("_method"));
           if($method === "POST"){
              return "POST";
           }
           if($method === "PUT"){
              return "PUT";
           }
           if($method === "DELETE"){
              return "DELETE";
           }   
           return "POST";
       }
       if($request_method === "PUT"){
            return "PUT";
       }

       if($request_method === "DELETE"){
            return "DELETE";
       }
       return "GET";
    }

    public function redirect_to($path="/"){
      header("Location: {$path}");
      exit();
   }

    public function form($key){
      if(!empty($_POST[$key])){
         return $_POST[$key];
      }
      return false;
   }

    public function set_session_message($key,$message){
       if(!empty($key) && !empty($message)){
          session_start();
          $_SESSION[$key] = $message;
          session_write_close();
       }
    }

    public function get_session_message($key){
       $msg = "";
       if(!empty($key) && is_string($key)){
          session_start();
          if(!empty($_SESSION[$key])){
             $msg = $_SESSION[$key];
             unset($_SESSION[$key]);
          }
          session_write_close();
       }
       return $msg;
    }

    public function set_flash($msg){
          $this->set_session_message("flash",$msg);
    }

    public function get_flash(){
          return $this->get_session_message("flash");   
    }

    public function get_note(){
          return $this->get_session_message("note");   
    }
    
    public function get_error(){
          return $this->get_session_message("error");   
    }
    
    /* added to remove global message from procedural technique*/
    public function set_message($key,$value){
      $this->messages[$key] = $value;
    }
   
    
     //New to handle 404 error 
    public static function resolve(){
	  if(!static::$route_found){
		$application = static::get_instance();
		header("location: /signin");
	  }
    }
}
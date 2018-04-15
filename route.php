<?php

        $GLOBALS['Current_User'] = null;

                  $servername = "localhost";
                  $username = "nazvd";
                  $password = "";
                  $dbname = "MVC";
                  
                  $token = $_COOKIE["bearer_token"];
                  
                  // Create connection
                  $conn = new mysqli($servername, $username, $password, $dbname);
                  // Check connection
                  if ($conn->connect_error) {
                      die("Connection failed: " . $conn->connect_error);
                  } 
                  
                  $sql = "SELECT * FROM `users` 
                    INNER JOIN `Tokens` ON `users`.`Users_ID` = `Tokens`.`user` WHERE `Tokens`.`token` LIKE '$token'";
                  $result = $conn->query($sql);
                  
                  if ($result->num_rows == 1) 
                  {
                    $user = $result->fetch_assoc();
                    $expired_date = strtotime($user["expired"]);
                    $date_now = date("c");
                    
                    //if($expired_date > $date_now)
                    //{
                        $GLOBALS['Current_User'] = $user;
                    //}
                    //else
                    //{
                        //$sql = "DELETE FROM `Tokens` WHERE `Token_ID` = ".$user['Token_ID'];
                        //$conn->query($sql);
                        //setcookie("bearer_token", $token, time() - 3600, "/");
                    //}
                  }
    $request = mb_strtolower($_SERVER["REQUEST_URI"]);
    $request_params = explode("/",$request);
    
    $controller = "home";
    
    if($request_params[1] != "")
        $controller = $request_params[1];
    
    if(file_exists("controllers/".$controller.".php") === false)
    {
        require_once("error.php");
        exit();
    }
    
    require_once("controllers/".$controller.".php");
    
    $contr_class = new Controller();
    
    $action = "index";
    
    if($request_params[2] != "")
        $action = $request_params[2];
    
    if(method_exists($contr_class,$action) === false)
    {
        require_once("error.php");
        exit();
    }
    
    echo call_user_method($action,$contr_class);
    
?>
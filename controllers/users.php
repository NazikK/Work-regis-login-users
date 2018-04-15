<?php

require_once("core/result.php");

class Controller
{
    function Index()
    {
        return View("users/index.html");
    }
    
    function Register()
    {
        return View("users/register.html");
    }
    
    function RegisterAct()
    {
        $servername = "localhost";
        $username = "nazvd";
        $password = "";
        $dbname = "MVC";

        $email = $_POST["email"];
        $pass = hash("sha256",$_POST["password"]);
        
        
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) 
        {
            die("Connection failed: " . $conn->connect_error);
        } 
        
        
        
        $sql = "INSERT INTO `users`(`email`, `passwordHach`) VALUES ('$email','$pass')";
        
        if ($conn->query($sql) === TRUE) 
        {
            echo "New record created successfully";
            header('Location: /');
        } 
        else 
        {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        
        $conn->close();
    }
    
    function Login()
    {
        return View("users/login.html");
    }
    
    function LoginAct()
    {
        $servername = "localhost";
        $username = "nazvd";
        $password = "";
        $dbname = "MVC";
        
        $email = $_POST["email"];
        $pass = hash("sha256",$_POST["password"]);
        
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        
        $sql = "SELECT * FROM `users` WHERE `email` LIKE '$email'";
        $result = $conn->query($sql);
        
        if ($result->num_rows == 1) 
        {
            $user = $result->fetch_assoc();
            if($user["passwordHach"] == $pass)
            {
                $issued = date("c");
                $expired = date('c', strtotime($issued . ' +1 day'));
                $userID = $user["Users_ID"];
                
                $token = hash("sha256",$email."_".$issued);

                $sql = "INSERT INTO `Tokens`(`token`, `issued`, `expired`, `user`) 
                    VALUES ('$token','$issued','$expired','$userID')";
                $conn->query($sql);
                
                setcookie("bearer_token", $token, time() + (86400), "/");
                
                header('Location: /');
            }
            else
            {
                echo "INCORECT PASSWORD";
            }
        }
        else
        {
            echo "USER NOT FOUND";
        }
    }
    function Profile()
    {
        //Get current (authorized) user
        var_dump($GLOBALS['Current_User']);   
    }
}
?>
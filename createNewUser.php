<?php

session_start();    

    if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {

        require_once('db.class.php');
        
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);

        $mysql = new db();
        $connection = $mysql->Connect();

        //Verify user exists
        $sqlCommand = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";

        //Execute the command
        $result = mysqli_query($connection, $sqlCommand);

        if (!$result) {
            
            echo 'There is an error in the database. Try again later.'; 
            die();
        
        } else {
        
            $users = mysqli_fetch_array($result);
            
            if (isset($users['userid'])) {
                
                header('Location: signup.php?error=1');
                die();

            } else {

                //Command
                $sqlCommand = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
        
                //Execute
                if(mysqli_query($connection, $sqlCommand)) {
                    
                    $_SESSION['userid'] = $connection->insert_id;
                    $_SESSION['username'] = $username;
                    $_SESSION['email'] = $email;
    
                    header('Location: home.php');

                } else {
                    echo 'There is an error trying to register you. Try again later.';
                    die();
                }

            }
        }

    }

?>
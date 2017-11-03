<?php

    session_start();

    if (isset($_POST['username']) && isset($_POST['password'])) {

        require_once('db.class.php');

        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $mysql = new db();
        $connection = $mysql->Connect();
        
        //Command
        $sqlCommand = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";

        //Execute
        $result = mysqli_query($connection, $sqlCommand);

        if (!$result) {

           echo 'There is an error in the database. Try again later.'; 

        } else {

            //Only one line
            $users = mysqli_fetch_array($result);
            //$users = mysqli_fetch_array($result, MYSQLI_NUM);
            //$users = mysqli_fetch_array($result, MYSQLI_ASSOC);

            //Multiple register
            //$users = array();

            //while($row = mysqli_fetch_array($result)) {
            //    $users[] = $row;
            //}

            if (isset($users['userid'])) {

                $_SESSION['userid'] = $users['userid'];
                $_SESSION['username'] = $users['username'];
                $_SESSION['email'] = $users['email'];

                header('Location: home.php');

            } else {

               header('Location: index.php?error=1');

            }

        }

    }

?>
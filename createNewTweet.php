<?php

    session_start();    

    if (isset($_POST['tweetText'])) {

        require_once('db.class.php');
        
        $tweetText = $_POST['tweetText'];
        $userid = $_SESSION['userid'];

        if ($tweetText != ''&& $userid != '') {

            //Command
            $sqlCommand = "INSERT INTO tweets (userid, tweettext) VALUES ('$userid', '$tweetText')";
            
            $mysql = new db();
            $connection = $mysql->Connect();

            //Execute
            if(mysqli_query($connection, $sqlCommand)) {

                echo 'A new tweet has been created';

            } else {
                echo 'There is an error trying to tweet. Try again later.';
                die();
            }

        } else {

            die();

        }

    }


?>
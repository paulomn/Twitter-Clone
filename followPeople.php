<?php

    session_start();    

    if (isset($_POST['userfollowedid'])) {

        require_once('db.class.php');
        
        $userfollowedid = $_POST['userfollowedid'];
        $followerid = $_POST['followerid'];
        $userid = $_SESSION['userid'];

        if ($userfollowedid != ''&& $userid != '' & $followerid != '') {

            if ($followerid == '0') {
            
                //Command
                $sqlCommand = "INSERT INTO followers (userid, userfollowedid) VALUES ('$userid', '$userfollowedid')";
                
                $mysql = new db();
                $connection = $mysql->Connect();

                //Execute
                if(mysqli_query($connection, $sqlCommand)) {

                    echo '{"followerid": "'.$connection->insert_id.'"}';

                } else {
                    echo 'There is an error trying to tweet. Try again later.';
                    die();
                }

            } else {

                //Command
                $sqlCommand = "DELETE FROM followers WHERE followerid = $followerid";
                
                $mysql = new db();
                $connection = $mysql->Connect();

                //Execute
                if(mysqli_query($connection, $sqlCommand)) {

                    echo '{"followerid": "0"}';

                } else {
                    echo 'There is an error trying to tweet. Try again later.';
                    die();
                }

            }

        } else {

            die();

        }

    }

?>
<?php

    session_start();
    
    if (!isset($_SESSION['userid'])) {
        
        header('Location: index.php');

    }
        
    require_once('db.class.php');
    
    $username = $_POST['username'];
    $userid = $_SESSION['userid'];

    if ($username != '' && $userid != '') {

        //Command
        $sqlCommand =   "SELECT u.*, IFNULL(f.followerid, 0) as followerid FROM users u 
                        LEFT JOIN followers f ON u.userid = f.userfollowedid AND f.userid = $userid
                        WHERE u.username LIKE '%$username%' AND u.userid <> $userid";

        $mysql = new db();
        $connection = $mysql->Connect();

        $result = mysqli_query($connection, $sqlCommand);

        if ($result) {

            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                
                echo '<a href="#" class="list-group-item clearfix">';
                echo '<strong>'.$row['username'].'</strong> - '.$row['email'];
                echo '<p class="list-group-item-text pull-right">';

                if ($row['followerid'] == 0) {

                    echo '<button type="button" class="btn btn-default btnFollow" data-userid="'.$row['userid'].'" data-followerid="0">Follow</button>';

                } else {

                    echo '<button type="button" class="btn btn-default btnFollow" data-userid="'.$row['userid'].'" data-followerid="'.$row['followerid'].'">Unfollow</button>';
                }

                echo '</p>';
                echo '</a>';
            }

        } else {

            echo 'There is a problem recovering your tweets. Try again later.';

        }

    } else {

        die();

    }

?>
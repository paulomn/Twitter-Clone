<?php

    session_start();
    
    if (!isset($_SESSION['userid'])) {
        
        header('Location: index.php');

    }
        
    require_once('db.class.php');
    
    $userid = $_SESSION['userid'];

    if ($userid != '') {

        //Command
        $sqlCommand =   "SELECT u.username, t.tweettext, t.createdon FROM tweets as t 
                        INNER JOIN users as u ON t.userid = u.userid 
                        WHERE t.userid = $userid OR T.userid IN (SELECT userfollowedid FROM followers WHERE userid = $userid)
                        ORDER BY createdon DESC";
        
        $mysql = new db();
        $connection = $mysql->Connect();

        $result = mysqli_query($connection, $sqlCommand);

        if ($result) {

            //$tweets = array();
            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                //$tweets[] = $row;
                
                echo '<a href="#" class="list-group-item">';
                echo '<h4 class="list-group-item-heading">@'.$row['username'].' <small> - '.$row['createdon'].'</small></h4>';
                echo '<p class="list-group-item-text">'.$row['tweettext'].'</p>';
                echo '</a>';
            }

        } else {

            echo 'There is a problem recovering your tweets. Try again later.';

        }

    } else {

        die();

    }

?>
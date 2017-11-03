<?php

    require_once('db.class.php');

    $mysql = new db();
    $connection = $mysql->Connect();
    
    //Command
    $sqlCommand = "SELECT * FROM users";

    //Execute
    $result = mysqli_query($connection, $sqlCommand);

    if (!$result) {

        echo 'There is an error in the database. Try again later.'; 

    } else {

        //Only one line
        //$users = mysqli_fetch_array($result);
        //$users = mysqli_fetch_array($result, MYSQLI_NUM);
        //$users = mysqli_fetch_array($result, MYSQLI_ASSOC);

        //Multiple register
        $users = array();
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $users[] = $row;
        }

        /*
        foreach($users as $user) {
            
            var_dump($user);
            echo '<br>';
            echo '<br>';

        }
        */
        
        echo $users[0]['username'];
    }

?>
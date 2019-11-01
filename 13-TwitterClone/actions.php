<?php

    include("functions.php");

    if ($_GET['action'] == "loginSignup"){

        // validation of email and password
        $error = "";
        if (!$_POST['email']){

            $error = "An email address is required";
        }else if (!$_POST['password']){
            $error = "A password is required";

        }else if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) == false) {
            $error = "Please enter a valid email address."; 
        }

        if ($error != ""){
            echo $error;
            exit();
        }

        if ($_POST['loginActive'] == "0"){
            //sign up mode
            $query = "SELECT * FROM users WHERE email = '".mysqli_real_escape_string($link,$_POST['email'])."' LIMIT 1";
            $result = mysqli_query($link,$query);
            if (mysqli_num_rows($result) > 0){
                // email is already existing
                $error = "That email address is already taken.";
            }else{
                // create new users
                $query = "INSERT INTO users (`email`,`password`) VALUES ('".mysqli_real_escape_string($link,$_POST['email'])."','".mysqli_real_escape_string($link,$_POST['password'])."')";
                
                if (mysqli_query($link, $query)) {
                    
                    $_SESSION['id'] = mysqli_insert_id($link);
                    
                    $query = "UPDATE users SET password = '". md5(md5($_SESSION['id']).$_POST['password']) ."' WHERE id = ".$_SESSION['id']." LIMIT 1";
                    mysqli_query($link, $query);
                    
                    echo 1;
                    
                    
                    
                }else{
                    $error = "Couldn't create user - please try again later";

                }


            }

        }else{
            // log in mode
            $query = "SELECT * FROM users WHERE email = '".mysqli_real_escape_string($link,$_POST['email'])."' LIMIT 1";
            $result = mysqli_query($link,$query);
            $row = mysqli_fetch_assoc($result);
            
            if ($row['password'] == md5(md5($row['id']).$_POST['password'])){
                echo 1;
                $_SESSION['id'] = $row['id'];
                
            }else{
                $error = "Could not find that username/password combination. Please try again";

            }
            





        }

        if ($error != ""){
            echo $error;
            exit();
        }

    
    }



        if ($_GET['action'] == 'toggleFollow'){
            // current user is the follower, isFollowing is the id that you want to follow
            $query = "SELECT * FROM isFollowing WHERE follower = ".mysqli_real_escape_string($link,$_SESSION['id'])." AND isFollowing = ".mysqli_real_escape_string($link,$_POST['userId'])."  LIMIT 1";
            $result = mysqli_query($link,$query);
            if (mysqli_num_rows($result) > 0){
                // > 0 means you have already followed them, clicking this button is unfollowing
                $row = mysqli_fetch_assoc($result);
                // delete the relationship
                mysqli_query($link,"DELETE FROM isFollowing WHERE id=" .mysqli_real_escape_string($link,$row['id'])." LIMIT 1");
                // unfollow the user
                echo "1";
            }else{

                //******  a bug here is that you can't follow yourself
                // add the relationship
                mysqli_query($link,"INSERT INTO isFollowing (follower,isFollowing) VALUES(".mysqli_real_escape_string($link,$_SESSION['id']).", ".mysqli_real_escape_string($link,$_POST['userId']).")");
                // follow the user
                echo "2";
            }
        }

        if ($_GET['action'] == 'postTweet'){
            //print_r($_POST);
            if (!$_POST['tweetContent']){
                echo "Your tweet is empty!";
            }else if (strlen($_POST['tweetContent']) > 140){
                echo "Your tweet is too long!";
            }else{
                mysqli_query($link, "INSERT INTO tweets (`tweet`, `userid`, `datetime`) VALUES ('". mysqli_real_escape_string($link, $_POST['tweetContent'])."', ". mysqli_real_escape_string($link, $_SESSION['id']).", NOW())");
                echo "1";
            }
        }

?>
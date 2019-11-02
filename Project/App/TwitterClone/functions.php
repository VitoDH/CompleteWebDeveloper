<?php
    // connect to database
    session_start();
    $link = mysqli_connect("server name","user-name","password","databse name");

    
    if (mysqli_connect_errno()){
        print_r(mysqli_connect_error());
        exit();

    }

    if ($_GET['function'] == "logout"){

        session_unset();
    }

    function time_since($since) {
        $chunks = array(
            array(60 * 60 * 24 * 365 , 'year'),
            array(60 * 60 * 24 * 30 , 'month'),
            array(60 * 60 * 24 * 7, 'week'),
            array(60 * 60 * 24 , 'day'),
            array(60 * 60 , 'hr'),
            array(60 , 'min'),
            array(1 , 'sec')
        );
    
        for ($i = 0, $j = count($chunks); $i < $j; $i++) {
            $seconds = $chunks[$i][0];
            $name = $chunks[$i][1];
            if (($count = floor($since / $seconds)) != 0) {
                break;
            }
        }
    
        $print = ($count == 1) ? '1 '.$name : "$count {$name}s";
        return $print;
    }

    function displayTweets($type){
        global $link;

        if ($type == 'public'){
            //public tweets
            $whereClause = "";

        }else if ($type == 'isFollowing'){
            // following tweets
            $query = "SELECT * FROM isFollowing WHERE follower = ".mysqli_real_escape_string($link,$_SESSION['id']);
            $result = mysqli_query($link,$query);

            $whereClause = "";

            while ($row = mysqli_fetch_assoc($result)){
                if ($whereClause == ""){
                    $whereClause = "WHERE ";
                }else{
                    $whereClause.= " OR ";
                }
                $whereClause.= "userid = ".$row['isFollowing'];
            
            }
        }else if ($type == 'yourtweets'){
            // your tweets
            $whereClause = "WHERE userid = ".mysqli_real_escape_string($link,$_SESSION['id']);
        }else if ($type == 'search'){
            // your tweets
            echo "<p>Showing results for '".mysqli_real_escape_string($link, $_GET['query'])."':</p>";
            $whereClause = "WHERE tweet LIKE '%". mysqli_real_escape_string($link, $_GET['query'])."%'";
        }else if (is_numeric($type)){
            // query by user id
            // tell the user whose tweets are these
            $userQuery = "SELECT * FROM users WHERE id = ".mysqli_real_escape_string($link,$type)." LIMIT 1";
            $userQueryResult = mysqli_query($link,$userQuery);
            $user = mysqli_fetch_assoc($userQueryResult);
            echo "<h2>".mysqli_real_escape_string($link,$user['email'])."'s Tweets</h2>";
            $whereClause = "WHERE userid = ".mysqli_real_escape_string($link,$type);
        }

        $query = "SELECT * FROM tweets ".$whereClause." ORDER BY `datetime` DESC LIMIT 10";
        $result = mysqli_query($link,$query);

        if (mysqli_num_rows($result) == 0){

            echo "There are no tweets to display";
        }else{

            while ($row = mysqli_fetch_assoc($result)){
                // get the user information
                $userQuery = "SELECT * FROM users WHERE id = ".mysqli_real_escape_string($link,$row['userid'])." LIMIT 1";
                $userQueryResult = mysqli_query($link,$userQuery);
                $user = mysqli_fetch_assoc($userQueryResult);
                
                echo "<div class='tweet'> <p><a href='?page=publicprofiles&userid=".$user['id']."'>".$user['email']."</a> <span class='time'>".time_since(time() - strtotime($row['datetime']))." ago</span></p>";
                echo "<p>".$row['tweet']."</p>";

                echo "<p><a class='toggleFollow' style='color:#007BFF' data-userId='".$row['userid'] ."' >";
                // check the status of following in the tweet, if you have followed, it should display unfollow even if you refresh
                $isFollowingQuery = "SELECT * FROM isFollowing WHERE follower = ". mysqli_real_escape_string($link, $_SESSION['id'])." AND isFollowing = ". mysqli_real_escape_string($link, $row['userid'])." LIMIT 1";
                $isFollowingQueryResult = mysqli_query($link, $isFollowingQuery);
                if (mysqli_num_rows($isFollowingQueryResult) > 0) {
                    
                    echo "Unfollow";
                    
                } else {
                    
                    echo "Follow";
                    
                }
                echo "</a></p></div>";
            }

        }

    }


    function displaySearch(){
        echo '<form class="form-inline" method="get">
        <div class="form-group mx-sm-2 mb-1">
            <input type="hidden" name="page" value="search">
            <input type="text" name="query" class="form-control" id="search" placeholder="Search">
        </div>
        <button class="btn btn-primary mb-2">Search Tweets</button>
    </form>';
        
    }

    function displayTweetBox(){
        if ($_SESSION['id'] > 0){
            echo '<div id="tweetSuccess" class="alert alert-success">Your tweet was posted successfully.</div>
            <div id="tweetFail" class="alert alert-danger"></div>
            <div class="form">
        <div class="form-group mx-sm-2 mb-1">
            <textarea type="text" class="form-control" id="tweetContent"></textarea>
        </div>
        <button id="postTweetButton" class="btn btn-primary mb-2">Post Tweets</button>
    </div>';

        }

    }

    function displayUsers(){
        global $link;
        $query = "SELECT * FROM users  LIMIT 10";
        $result = mysqli_query($link,$query);
        
        while ($row = mysqli_fetch_assoc($result)){
            // list all the users and give hyperlink to their profiles
            echo "<p><a href='?page=publicprofiles&userid=".$row['id']."'>".$row['email']."</a></p>";
        
        }


    }




?>
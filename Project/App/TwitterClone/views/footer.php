<footer class="footer">
    <div class="container">
        <span class="text-muted">&copy;My Website 2019</span>
    </div>
</footer>


<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  


    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalTitle">Login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" id="loginAlert"></div>
                <form>
                    <input type="hidden" id="loginActive" name="loginActive" value="1">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Password">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <a id="toggleLogin" style="color:#007BFF">Sign up</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="loginSignupButton" class="btn btn-primary">Login</button>
            </div>
            </div>
        </div>
    </div>

    <script>

        $("#toggleLogin").click(function(){
            if($("#loginActive").val() == "1"){
                // in Log In mode
                $("#loginActive").val("0");
                $("#loginModalTitle").html("Sign Up");
                $("#loginSignupButton").html("Sign Up");
                $("#toggleLogin").html("Log In");
            }else{
                $("#loginActive").val("1");
                $("#loginModalTitle").html("Login");
                $("#loginSignupButton").html("Log In");
                $("#toggleLogin").html("Sign Up");
            }
        
        });
        
        $("#loginSignupButton").click(function(){

           $.ajax({
               type:"POST",
               url:"actions.php?action=loginSignup",
               data:"email=" + $("#email").val() + "&password=" + $("#password").val() + "&loginActive=" + $("#loginActive").val(),
               success:function(result){
                    if (result == "1"){
                        // log in successfully,redirect to the home page
                        window.location.replace('/');
                    }else{

                        $("#loginAlert").html(result).show();
                    }
               }
           })


        });


        $(".toggleFollow").click(function(){
            
            // the id of in the recent tweets
            var id = $(this).attr("data-userId")

            $.ajax({
               type:"POST",
               url:"actions.php?action=toggleFollow",
               data:"userId=" + id,
               success:function(result){
                    if (result == "1"){
                        // unfollow action
                        $("a[data-userId='" + id + "']").html("Follow");
                    }else if (result == "2"){
                        $("a[data-userId='" + id + "']").html("Unfollow");
                    }
               }
           })


        });



        $("#postTweetButton").click(function(){
            $.ajax({
               type:"POST",
               url:"actions.php?action=postTweet",
               data:"tweetContent=" + $("#tweetContent").val(),
               success:function(result){
                    if (result == "1"){

                        $("#tweetSuccess").show();
                        $("#tweetFail").hide();
                        setTimeout("location.reload(true);",500);
                    }else if(result != ""){
                        $("#tweetFail").html(result).show();
                        $("#tweetSuccess").hide();
                        
                    }
                    

               }
           })
        });
    
    </script>


    </body>
</html>
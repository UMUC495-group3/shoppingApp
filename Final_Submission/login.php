<style>
body  {
    background-image: url("background2.jpg");
    }
</style>




<center>
<link rel="stylesheet" type="text/css" href="login_style.css">
<br><br><br><br><br><br><br>
<div class="page">
	<div id="wrapper">
                <div class="loginBox">
                    <label id='appName'>The Shopping App</label>
                    <form action="login.php" method="post" align="center">
                        <div id="userPassCont">
                            <div id="userCont">
                                <label for="username"><img src='username_icon.png' width='50' height='50'></img></label>
                                <input type="text" name="username" id="username" required/>
                            </div>
                            <div id="passCont">
                                <label for="password"><img src='password_icon.png' width='50' height='50'></img></label>
                                <input type="password" name="password" id="password" required/>
                            </div>
                            <div id="buttons">
                                <button type="submit">Log In</button>
                                <label class='divider'></label>
                                <button type="button" onclick="location.href='http://umuccmsc495.x10host.com/newuser.php';">Sign Up</button>
                            </div>
                        </div>
                    </form>
                


  
    <?php
        require("databaseFunctions.php");
    // function processlogin(){
    //     $username = $_POST['username'];
    //     $password = $_POST['password'];
    //   $users = array('','HungDao');
    //     $pw = array('','CMSC495');
    //     $userindex = array_search($username,array_values($users));
    //     if($userindex <= 0) {
    //       $message = "Username is incorrect.\\n Please try again.";
    //  echo "<script type='text/javascript'>alert('$message'); window.location = 'http://umuccmsc495.x10host.com/login.php';</script>";
    //     }else{
    //         $pwindex = array_search($password, array_values($pw));
    //         if($pwindex <= 0){
    //             $message = "Password is incorrect.\\n Please try again.";
    //   echo "<script type='text/javascript'>alert('$message'); window.location = 'http://umuccmsc495.x10host.com/login.php';</script>";
    //         }elseif($pwindex == $userindex){
    //             session_start();
    //             $_SESSION['username'] = $username;
    //             header("Location: index.php");
    //         }else{
    //             header("Location: login.php");
    //         }

    //     }
    //}

    if (isset($_POST['username']) && isset($_POST['password'])) {

        $username = $_POST['username'];
        $password = $_POST['password'];

        tryLogIn($username, $password);
    }

    ?>
		</div>
            </div>
</div>
</center>
    </body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Ridget Zoo Adventures</title>
<?php
include("topbar.php")
?>
<div class="title">
<h1 style="font-size: 60px;">Ridget Zoo Adventures</h1>

</div>
  <meta charset="UTF-8">
  <title>Login Page</title>
</head>
<body>
    <?php 
        session_start();
        require('db.php');
        // If form submitted, insert values into the database.
        if (isset($_POST['username'])){
                // removes backslashes
            $username = stripslashes($_REQUEST['username']);
                //escapes special characters in a string
            $username = mysqli_real_escape_string($con,$username);
            $password = stripslashes($_REQUEST['password']);
            $password = mysqli_real_escape_string($con,$password);
            //Checking is user existing in the database or not
                $query = "SELECT * FROM `users` WHERE username='$username'
        and password='$password'";
            $result = mysqli_query($con,$query) or die(mysqli_error($con));
            $rows = mysqli_num_rows($result);
                if($rows==1){
                $_SESSION['username'] = $username;
                    // Redirect user to index.php
                header("Location: home.php");
                exit();
                }else{
            echo "<div class='form'>
        <h3>Username/password is incorrect.</h3>
        
Click here to <a href='login.php'>Login</a></div>";
            }
            }
            else {
        ?>
<div class="title">
<h2 style="font-size: 50px;">Login Here:</h2>
</div>
<div class="log">
  <form  action="<?php echo $_SERVER['PHP_SELF']?>"method="post" name="login">
  <div class="boo">
    <label style="font-size: 70px;">Username:</label><br>
    <input type="text" name="username" required size="28" placeholder="Username" style="font-size:20px;"><br><br>
</div>
    <label style="font-size: 70px;">Password:</label><br>
    <input type="password" name="password" required size="28" placeholder="Password" style="font-size:20px;"><br><br>

    <input name="submit" type="submit" value="Login" />
  </form>
</div>


<p style="color: white;" >Dont Have An Account Yet</p>
 <p style="color: yellow;" ><a href="signup.php" style="color: white;">Sign up now!</a></p>
 <?php } ?>
</body>
</html>

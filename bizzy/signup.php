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
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
</head>
<body>

<div class="ti">
<h2>Sign Up</h2>
</div>

<div class="bbl">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
    <label>
        Username:<br>
        <input type="text" name="username" required placeholder="Username">
    </label><br>
    <label>
        Email:<br>
        <input type="email" name="email" required  placeholder="Email">
    </label><br>

    <label>
        Password:<br>
        <input type="password" name="password" required placeholder="Password">
    </label><br><br>

    <input name="submit" type="submit" value="Sign Up" />
    <?php
    require('db.php');
if (isset($_POST['username'])) {

    // Remove backslashes and escape input
    $username = mysqli_real_escape_string($con, stripslashes($_POST['username']));
    $password = mysqli_real_escape_string($con, stripslashes($_POST['password']));
    $email = mysqli_real_escape_string($con, stripslashes($_POST['email']));
    // Check if username already exists
    $checkQuery = "SELECT * FROM users WHERE username='$username' LIMIT 1";
    $result = mysqli_query($con, $checkQuery);

    if (mysqli_num_rows($result) > 0) {
        // Username already exists
        echo "<div class='form'>
        <h3 class='center'>Username already exists. Please choose another.</h3>";


    } else {
        // Username is available — insert into database
        $trn_date = date("Y-m-d H:i:s");
        $query = $con->prepare("INSERT INTO users (username, email, password, trn_date)
                       VALUES (?, ?, ?, ?)");
        $query->bind_param("ssss", $username, $email, $password, $trn_date);


        if ($query->execute()) {
            echo "<div class='form'>
            <h3 class='center'>You are registered successfully.</h3>
            Click here to <a href='login.php'>Login</a></div>";

            
            
        } else {
            echo "<div class='form'><h3 class='center'>Registration failed. Please try again.</h3></div>";
        }
    }
}
    ?>
</form>
</div>
</body>
</html>
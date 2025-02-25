<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Sign Up</title>
    <link rel="stylesheet" href="/project1/styles/sign_style.css">
</head>
<body>
    <div class="container">
        <h1>Sign Up</h1>
        <p>Please fill out the form to create an account:</p>
        <form action="user_signup.php" method="POST" class="form">
            <input type="text" name="fname" placeholder="First Name" required>
            <input type="text" name="lname" placeholder="Last Name" required>
            <input type="text" name="position" placeholder="Jop title" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="tel" name="telno" placeholder="Phone Number" maxlength="9" required>
            <input type="password" name="pass" placeholder="Password" required>
            <div class="form-buttons">
                <input type="submit" name="submit" value="Sign Up" id="signup" class="btn submit">
                <input type="reset" value="Clear" class="btn reset">
            </div>
        </form>
        <div class="login-link">
            <a href="/project1/index.php" class="log">Go to Home Page</a>
        </div>
    </div>
</body>
</html>

<?php

if (isset($_POST['submit'])) {

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $posi = $_POST['position'];
    $email = $_POST['email'];
    $telno = $_POST['telno'];
    $pass = $_POST['pass'];

    $connection = mysqli_connect('localhost', 'root', '','student information management system');

    $add = mysqli_query($connection, "INSERT INTO users(first_name, last_name, job_title, email, phone_number, password)
                                      VALUES('$fname', '$lname', '$posi', '$email', '$telno', '$pass')");

    if ($add) {
        header("location:user_login.php");
    } else {
        echo "<div class='message'>An error occurred while transferring data</div>";
    }

    mysqli_close($connection);
}
?>
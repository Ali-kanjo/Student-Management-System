<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="stylesheet" href="/project1/styles/login_style.css"> 
</head>
<body>
    <div class="container">
        <h1>Log In</h1>
        <p>Please enter your credentials to log in:</p>
        <form action="user_login.php" method="POST" class="form">
            <input type="text" name="fname" placeholder="First Name" required>
            <input type="text" name="lname" placeholder="Last Name" required>
            <input type="password" name="pass" placeholder="Password" required>
            <div class="form-buttons">
                <input type="submit" name="submit" value="Log In" class="btn submit">
                <input type="reset" value="Clear" class="btn reset">
            </div>
        </form>
        <div class="home-link">
            <a href="/project1/index.php" class="log">Go to Home Page</a>
        </div>

        <?php
        if (isset($_POST['submit'])) {
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $pass = $_POST['pass'];

            $connection = mysqli_connect('localhost', 'root', '', 'student information management system');

            $result = mysqli_query($connection, "SELECT first_name, last_name, password FROM users 
                                WHERE first_name='$fname' AND last_name='$lname' AND password='$pass'");

            if (mysqli_num_rows($result) > 0) {
                header("Location:/project1/system/student_system.php");
                exit();
            } else {
                echo "<div class='message'>The information you entered is incorrect</div>";
            }

            mysqli_free_result($result);
            mysqli_close($connection);
        }
        ?>
    </div>
</body>
</html>
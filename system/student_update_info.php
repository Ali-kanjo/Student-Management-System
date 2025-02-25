<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STUDENT INFORMATION UPDATE</title>
    <link rel="stylesheet" href="/project1/styles/add_style.css"> 
</head>
<body>
<?php
session_start();
ob_start();

if (isset($_GET['student_id'])) {
    $_SESSION['student_id'] = $_GET['student_id'];
    $student_id = $_SESSION['student_id'];
} else if (isset($_SESSION['student_id'])) {
    $student_id = $_SESSION['student_id'];
}

$connection = mysqli_connect('localhost', 'root', '', 'student information management system');
$info = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM students WHERE student_id=$student_id"));
?>
<div class="container">
    <h1>Update Student Information</h1>
    <form action="student_update_info.php" name="update_form" method="POST">
        <div class="form-group">
            <input type="text" name="id" value="<?php echo htmlspecialchars($info[1]); ?>" placeholder="Student ID" maxlength="9" required>
            <input type="text" name="fname" value="<?php echo htmlspecialchars($info[2]); ?>" placeholder="First Name" required>
            <input type="text" name="lname" value="<?php echo htmlspecialchars($info[3]); ?>" placeholder="Last Name" required>
            <input type="email" name="email" value="<?php echo htmlspecialchars($info[4]); ?>" placeholder="Email" required>
            <input type="tel" name="phone" value="<?php echo htmlspecialchars($info[5]); ?>" placeholder="Phone Number" maxlength="11" minlength="11" required>
        </div>
      
        <div class="form-group">
            <input type="text" name="collge" value="<?php echo htmlspecialchars($info[6]); ?>" placeholder="College" required>
            <select name="year" required>
                <option>Select Academic Year</option>
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </select>
            <select name="state" required>
                <option value="">Gender</option>
                <?php
                $countries = array(
                    "Turkey", "Syria", "United States", "United Kingdom", "China",
                    "Germany", "South Korea", "Canada", "France", "Italy", "Austria",
                    "Singapore", "Netherlands", "Switzerland", "Sweden", "Belgium", "Japan",
                    "Norway", "Denmark", "Finland", "New Zealand", "Spain", "Russia",
                    "Brazil", "India", "Malaysia", "Ireland", "Hungary", "Czech Republic",
                    "Poland", "Portugal", "Mexico", "Chile", "Argentina", "South Africa",
                    "Thailand", "Philippines", "Indonesia", "Colombia", "Bulgaria",
                    "Romania", "Kazakhstan", "Ukraine", "Greece", "Slovakia", "Slovenia",
                    "Croatia", "Lithuania"
                );
                foreach ($countries as $key => $value) {
                    echo "<option value='$key'>$value</option>";
                }
                ?>
            </select>
        </div>
        <input type="hidden" name="student_id" value="<?php echo htmlspecialchars($student_id); ?>">
        <div class="form-buttons">
            <input type="submit" name="update" value="Update" class="btn submit">
            <input type="reset" value="Clear" class="btn reset">
            <a href="student_system.php" class="btn home">Back</a> 
            <a href="/project1/index.php" class="btn home">Go to Home Page</a>
        </div>
    </form>

    <?php
    if (isset($_POST['update'])) {
        $student_id = $_POST['student_id'];
        $id = $_POST['id'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $college = $_POST['collge'];
        $year = $_POST['year'];

        for ($i = 0; $i < count($countries); $i++) {
            if ($_POST['state'] == $i) {
                $country = $countries[$i];
                break;
            }
        }

        $check = mysqli_query($connection, "SELECT * FROM students WHERE student_id='$id'");
        if (mysqli_num_rows($check) > 0 && $id != $student_id) {
            echo "<div class='message'>This ID is already used. Please enter a different ID.</div>";
        } else {
            $query = "UPDATE students SET 
                      student_id='$id',
                      first_name='$fname',
                      last_name='$lname',
                      email='$email',
                      Phone_number='$phone',
                      College='$college',
                      year='$year',
                      state='$country' 
                      WHERE student_id=$student_id";

            $student_data = mysqli_query($connection, $query);

            if ($student_data) {
                header("location:student_system.php");
            } else {
                echo "<div class='message'>Error updating student information.</div>";
            }
        }

        mysqli_free_result($check);
        mysqli_close($connection);
        ob_end_flush();
    }
    ?>
</div>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <link rel="stylesheet" href="/project1/styles/add_style.css">
</head>
<body>
    <div class="container">
        <h1>Add Student</h1>
        <form action="student_add.php" name="add_form" method="POST">
            <div class="form-group">
                <input type="text" name="id" placeholder="Student ID" maxlength="9" required>
                <input type="text" name="fname" placeholder="First Name" required>
                <input type="text" name="lname" placeholder="Last Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="tel" name="phone" placeholder="Phone Number" minlength="11" maxlength="11" required>
            </div>
            <div class="form-group">
                <input type="text" name="collge" placeholder="College" required>
                <select name="year" required>
                    <option value="">Select Academic Year</option>
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
            <div class="form-buttons">
                <input type="submit" name="add" value="Add" class="btn submit">
                <input type="reset" value="Clear" class="btn reset">
                <a href="student_system.php" class="btn home">Back</a>
                <a href="/project1/index.php" class="btn home">Go to Home Page</a>
            </div>
        </form>

        <?php
        if (isset($_POST['add'])) {
            $connection = mysqli_connect('localhost', 'root', '', 'student information management system');

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
            if (mysqli_num_rows($check) > 0) {
                echo "<div class='message'>This ID is already used. Please enter a different ID.</div>";
            } else {
                $query = "INSERT INTO students (
                    student_id,
                    first_name,
                    last_name,
                    email,
                    Phone_number,
                    college,
                    year,
                    state
                ) VALUES (
                    '$id',
                    '$fname',
                    '$lname',
                    '$email',
                    '$phone',
                    '$college',
                    '$year',
                    '$country'
                )";

                $student_data = mysqli_query($connection, $query);

                if ($student_data) {
                    header("location:student_system.php");
                } else {
                    echo "<div class='message'>Error: " . mysqli_error($connection) . "</div>";
                }

                mysqli_free_result($check);
            }

            mysqli_close($connection);
        }
        ?>
    </div>
</body>
</html>
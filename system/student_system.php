<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student System</title>
    <link rel="stylesheet" href="/project1/styles/system_style.css"> 
</head>
<body>
    <div class="container">
        <h1>Student Management System</h1>
        <p>Manage the following student information:</p>
        <div class="form-buttons">
            <form action="student_add.php" method="GET">
                <input type="submit" value="Add Student" class="btn submit">
            </form>
            <a href="user_information.php" class="btn info">User Information</a>
            <a href="/project1/index.php" class="btn home">Go to Home Page</a> 
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>College</th>
                    <th>Academic Year</th>
                    <th>Country</th>
                    <th>DELETE</th>
                    <th>UPDATE</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $connection = mysqli_connect('localhost', 'root', '', 'student information management system');
                $data = mysqli_query($connection, "SELECT * FROM students");

                $row_color = 1;

                while ($row = mysqli_fetch_row($data)) {
                    $row_class = ($row_color % 2 == 0) ? 'tr1' : 'tr2';
                    echo '<tr class="' . $row_class . '">';

                    for ($i = 1; $i < count($row); $i++) {
                        echo '<td>' . htmlspecialchars($row[$i]) . '</td>';
                    }

                    echo '<td><a href="student_delete.php?student_id=' . htmlspecialchars($row[1]) . '" class="btn delete">Delete</a></td>';
                    echo '<td><a href="student_update_info.php?student_id=' . htmlspecialchars($row[1]) . '" class="btn update">Update</a></td>';

                    echo '</tr>';
                    $row_color++;
                }

                mysqli_free_result($data);
                mysqli_close($connection);
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
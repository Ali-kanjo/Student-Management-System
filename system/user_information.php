<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Information</title>
    <link rel="stylesheet" href="/project1/styles/user_style.css">
</head>
<body>
    <div class="container">
        <h1>User Information</h1>
        <table>
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>job title</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Password</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $connection = mysqli_connect('localhost', 'root', '', 'student information management system');

                $users_information = mysqli_query($connection, "SELECT * FROM users");

                if ($users_information) {
                    $row_color = 1;

                    while ($user = mysqli_fetch_row($users_information)) {
                   
                        $row_class = ($row_color % 2 == 0) ? 'tr1' : 'tr2';
                        echo '<tr class="' . $row_class . '">';

                        foreach ($user as $field) {
                            echo '<td>' . htmlspecialchars($field) . '</td>';
                        }

                        echo '</tr>';
                        $row_color++;
                    }
                }

                mysqli_free_result($users_information);
                mysqli_close($connection);
                ?>
            </tbody>
        </table>
        <div class="form-buttons">
            <a href="student_system.php" class="btn home">Back</a>
            <a href="/project1/index.php" class="btn home">Go to Home Page</a>
        </div>
    </div>
</body>
</html>
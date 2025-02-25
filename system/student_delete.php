<?php

if (isset($_GET['student_id'])) {
    $student_id = $_GET['student_id'];
    $connection = mysqli_connect('localhost', 'root', '','student information management system');
    $delete_data = mysqli_query($connection, "DELETE FROM students WHERE student_id=$student_id");
    if ($delete_data) {
        header("location:student_system.php");
    }
}

mysqli_free_result($delete_data);
mysqli_close($connection);
?>
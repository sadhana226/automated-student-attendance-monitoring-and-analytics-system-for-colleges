<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "config.php";

$date = date("Y-m-d");

if(isset($_POST['student_id']) && isset($_POST['status'])) {

    $student_ids = $_POST['student_id'];
    $statuses = $_POST['status'];

    for($i = 0; $i < count($student_ids); $i++) {

        $sid = $student_ids[$i];
        $status = $statuses[$i];

        $sql = "INSERT INTO attendance (student_id, status, attendance_date)
                VALUES ('$sid', '$status', '$date')";

        mysqli_query($conn, $sql);
    }

    echo "✅ Attendance Saved Successfully";

} else {
    echo "❌ No POST data received";
}
?>
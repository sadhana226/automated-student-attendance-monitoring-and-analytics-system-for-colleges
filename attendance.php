<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "config.php";

if(!$conn){
    die("Database connection failed");
}

$result = mysqli_query($conn, "SELECT * FROM students");

if(!$result){
    die("Query failed: " . mysqli_error($conn));
}
?>

<h2>Mark Attendance</h2>

<form action="save_attendance.php" method="POST">

<table border="1" cellpadding="10">

<tr>
    <th>Reg No</th>
    <th>Name</th>
    <th>Department</th>
    <th>Year</th>
    <th>Status</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)) { ?>

<tr>
    <td><?php echo $row['reg_no']; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['department']; ?></td>
    <td><?php echo $row['year']; ?></td>

    <td>
        <input type="hidden" name="student_id[]" value="<?php echo $row['student_id']; ?>">

        <select name="status[]">
            <option value="Present">Present</option>
            <option value="Absent">Absent</option>
        </select>
    </td>
</tr>

<?php } ?>

</table>

<br>

<button type="submit">Save Attendance</button>

</form>
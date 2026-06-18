<?php
include "config.php";

$result = mysqli_query($conn, "
SELECT a.*, s.name, s.reg_no 
FROM attendance a 
JOIN students s ON a.student_id = s.student_id
ORDER BY a.attendance_date DESC, s.student_id ASC
");
?>

<h2>Attendance Report</h2>

<table border="1" cellpadding="10">

<tr>
    <th>Reg No</th>
    <th>Name</th>
    <th>Status</th>
    <th>Date</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)) { ?>

<tr>
    <td><?php echo $row['reg_no']; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['status']; ?></td>
    <td><?php echo $row['attendance_date']; ?></td>
</tr>

<?php } ?>

</table>
<?php
include "config.php";

$result = mysqli_query($conn, "SELECT * FROM students");
?>

<h2>Students List</h2>

<div style="overflow-x:auto;">

<table border="1" style="width:100%;">
<tr>
    <th>Reg No</th>
    <th>Name</th>
    <th>Department</th>
    <th>Year</th>
</tr>

<?php
$count = 0;

while($row = mysqli_fetch_assoc($result)) {
    $count++;
?>

<tr>
    <td><?php echo $row['reg_no']; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['department']; ?></td>
    <td><?php echo $row['year']; ?></td>
</tr>

<?php } ?>

</table>

</div>

<p>Total Students: <?php echo $count; ?></p>
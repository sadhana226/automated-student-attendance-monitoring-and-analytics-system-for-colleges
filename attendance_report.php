<?php
include "config.php";

$where = "";

if(isset($_GET['month']) && $_GET['month'] != "") {
    $month = $_GET['month'];
    $where = "WHERE DATE_FORMAT(a.attendance_date, '%Y-%m') = '$month'";
}

$result = mysqli_query($conn, "
SELECT s.student_id, s.reg_no, s.name,
COUNT(a.student_id) AS total_days,
SUM(CASE WHEN a.status='Present' THEN 1 ELSE 0 END) AS present_days
FROM students s
LEFT JOIN attendance a ON s.student_id = a.student_id
$where
GROUP BY s.student_id, s.reg_no, s.name
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Attendance Report</title>

    <style>
        body{
            font-family: Arial;
            background:#f4f6f9;
            margin:0;
            padding:20px;
        }

        .container{
            background:white;
            padding:20px;
            border-radius:10px;
            box-shadow:0 0 10px rgba(0,0,0,0.1);
        }

        h2{
            text-align:center;
            color:#333;
        }

        .filter-box{
            text-align:center;
            margin-bottom:20px;
        }

        input[type="month"]{
            padding:8px;
            border:1px solid #ccc;
            border-radius:5px;
        }

        button{
            padding:8px 15px;
            border:none;
            background:#007bff;
            color:white;
            border-radius:5px;
            cursor:pointer;
        }

        button:hover{
            background:#0056b3;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        th, td{
            padding:12px;
            text-align:center;
            border:1px solid #ddd;
        }

        th{
            background:#007bff;
            color:white;
        }

        tr:nth-child(even){
            background:#f9f9f9;
        }

        .percent-high{
            color:green;
            font-weight:bold;
        }

        .percent-low{
            color:red;
            font-weight:bold;
        }
    </style>

</head>
<body>

<div class="container">

<h2>📊 Attendance Report Dashboard</h2>

<div class="filter-box">
<form method="GET">
    <label><b>Select Month:</b></label>
    <input type="month" name="month">
    <button type="submit">Filter</button>
</form>
</div>

<table>
<tr>
    <th>Reg No</th>
    <th>Name</th>
    <th>Total Days</th>
    <th>Present Days</th>
    <th>Percentage</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)) {

$total = $row['total_days'];
$present = $row['present_days'];
$percent = ($total > 0) ? ($present / $total) * 100 : 0;

$class = ($percent >= 75) ? "percent-high" : "percent-low";
?>

<tr>
    <td><?php echo $row['reg_no']; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $total; ?></td>
    <td><?php echo $present; ?></td>
    <td class="<?php echo $class; ?>">
        <?php echo round($percent, 2); ?>%
    </td>
</tr>

<?php } ?>

</table>

</div>

</body>
</html>
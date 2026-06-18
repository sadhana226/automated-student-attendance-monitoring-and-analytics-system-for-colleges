<?php
session_start();
include "config.php";

$today = date("Y-m-d");

/* TOTAL STUDENTS */
$totalStudents = 0;
$q = mysqli_query($conn, "SELECT COUNT(*) AS total FROM students");
if($q){
    $r = mysqli_fetch_assoc($q);
    $totalStudents = $r['total'];
}

/* PRESENT TODAY */
$presentToday = 0;
$q = mysqli_query($conn,"
SELECT COUNT(DISTINCT student_id) AS total
FROM attendance
WHERE attendance_date='$today'
AND status='Present'
");
if($q){
    $r = mysqli_fetch_assoc($q);
    $presentToday = $r['total'];
}

/* ABSENT TODAY */
$absentToday = 0;
$q = mysqli_query($conn,"
SELECT COUNT(DISTINCT student_id) AS total
FROM attendance
WHERE attendance_date='$today'
AND status='Absent'
");
if($q){
    $r = mysqli_fetch_assoc($q);
    $absentToday = $r['total'];
}

/* ATTENDANCE PERCENTAGE */
$attendancePercentage = 0;
if($totalStudents > 0){
    $attendancePercentage = round(($presentToday / $totalStudents) * 100, 2);
}

/* TOP PERFORMER */
$topName = "No Data";
$topRegNo = "-";
$topPresent = 0;

$q = mysqli_query($conn,"
SELECT
s.name,
s.reg_no,
SUM(CASE WHEN a.status='Present' THEN 1 ELSE 0 END) AS total_present
FROM students s
LEFT JOIN attendance a
ON s.student_id = a.student_id
GROUP BY s.student_id
ORDER BY total_present DESC
LIMIT 1
");

if($q && mysqli_num_rows($q)>0){
    $r = mysqli_fetch_assoc($q);
    $topName = $r['name'];
    $topRegNo = $r['reg_no'];
    $topPresent = $r['total_present'];
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>smart attendance dashboard</title>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
body{
    margin:0;
    font-family:Arial, sans-serif;
    background:#eef2f7;
}

.header{
    background:linear-gradient(135deg,#007bff,#0056b3);
    color:white;
    text-align:center;
    padding:25px;
    font-size:30px;
    font-weight:bold;
}

.top-box{
    width:90%;
    max-width:900px;
    margin:20px auto;
    background:white;
    border-radius:15px;
    padding:25px;
    text-align:center;
    box-shadow:0 4px 15px rgba(0,0,0,.1);
}

.top-box h1{
    color:#007bff;
    margin:10px 0;
}

.cards{
    display:flex;
    flex-wrap:wrap;
    justify-content:center;
}

.card{
    width:220px;
    margin:10px;
    background:white;
    border-radius:15px;
    padding:25px;
    text-align:center;
    box-shadow:0 4px 15px rgba(0,0,0,.1);
}

.card h2{
    margin:0;
    font-size:38px;
    color:#007bff;
}

.card p{
    margin-top:10px;
    color:#555;
}

.menu{
    text-align:center;
    margin:25px;
}

.menu a{
    text-decoration:none;
    background:#007bff;
    color:white;
    padding:12px 18px;
    border-radius:8px;
    margin:5px;
    display:inline-block;
}

.menu a:hover{
    background:#0056b3;
}

.chart-container{
    width:90%;
    max-width:600px;
    margin:20px auto;
    background:white;
    padding:20px;
    border-radius:15px;
    box-shadow:0 4px 15px rgba(0,0,0,.1);
}

.footer{
    text-align:center;
    color:#666;
    margin:20px;
}

@media(max-width:768px){
    .card{
        width:90%;
    }
}
</style>

</head>
<body>

<div class="header">
    📊 AUTOMATED  STUDENT ATTENDENCE MONITORING & ANALYTICS SYSTEM
</div>

<div class="top-box">
    <h2>🏆 Top Performer</h2>
    <h1><?php echo $topName; ?></h1>
    <p><strong>Reg No:</strong> <?php echo $topRegNo; ?></p>
    <p><strong>Total Presents:</strong> <?php echo $topPresent; ?></p>
</div>

<div class="cards">

    <div class="card">
        <h2><?php echo $totalStudents; ?></h2>
        <p>Total Students</p>
    </div>

    <div class="card">
        <h2><?php echo $presentToday; ?></h2>
        <p>Present Today</p>
    </div>

    <div class="card">
        <h2><?php echo $absentToday; ?></h2>
        <p>Absent Today</p>
    </div>

    <div class="card">
        <h2><?php echo $attendancePercentage; ?>%</h2>
        <p>Attendance Percentage</p>
    </div>

</div>

<div class="menu">
    <a href="attendance.php">Mark Attendance</a>
    <a href="view_attendance.php">View Attendance</a>
    <a href="attendance_report.php">Reports</a>
</div>

<div class="chart-container">
    <canvas id="attendanceChart"></canvas>
</div>

<script>
new Chart(document.getElementById('attendanceChart'),{
    type:'doughnut',
    data:{
        labels:['Present','Absent'],
        datasets:[{
            data:[
                <?php echo $presentToday; ?>,
                <?php echo $absentToday; ?>
            ]
        }]
    }
});
</script>

<div class="footer">
    Smart Attendance Monitoring & Analytics System
</div>

</body>
</html>
<?php
session_start();
include "config.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>

    <style>
        body{
            font-family:Arial;
            background:#f4f6f9;
            display:flex;
            justify-content:center;
            align-items:center;
            height:100vh;
            background: linear-gradient(120deg, #007bff, #00c6ff);
        }

        .box{
            background:white;
            padding:30px;
            border-radius:10px;
            box-shadow:0 0 10px rgba(0,0,0,0.1);
            width:300px;
            text-align:center;
            box-shadow:0 10px 25px rgba(0,0,0,0.2);
        }

        input{
            width:90%;
            padding:10px;
            margin:10px 0;
        }

        button{
            padding:10px;
            width:100%;
            background:#007bff;
            color:white;
            border:none;
            border-radius:5px;
        }
    </style>
</head>

<body>

<div class="box">

<h2>Admin Login</h2>

<form method="POST" action="login.php">

<input type="text" name="username" placeholder="Username" required>
<input type="password" name="password" placeholder="Password" required>

<button type="submit">Login</button>

</form>

<?php
if($_POST){

    $u = $_POST['username'];
    $p = $_POST['password'];

    $q = mysqli_query($conn, "SELECT * FROM admin WHERE username='$u' AND password='$p'");

    if(mysqli_num_rows($q) > 0){
        $_SESSION['admin'] = $u;
        header("Location: dashboard.php");
    } else {
        echo "<p style='color:red;'>Invalid Login</p>";
    }
}
?>

</div>

</body>
</html>
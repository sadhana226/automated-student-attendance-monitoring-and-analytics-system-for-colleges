<!DOCTYPE html>
<html>
<head>
    <title>Students</title>
</head>
<body>

<h2>Add Student</h2>

<form action="save_student.php" method="POST">

    Roll Number:
    <input type="text" name="reg_no" required>
    <br><br>

    Student Name:
    <input type="text" name="name" required>
    <br><br>

    Department:
    <input type="text" name="department" required>
    <br><br>

    Year:
    <input type="number" name="year" required>
    <br><br>

    <button type="submit">Save Student</button>

</form>

</body>
</html>
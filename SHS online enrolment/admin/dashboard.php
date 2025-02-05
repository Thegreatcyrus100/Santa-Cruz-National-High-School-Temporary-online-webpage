<?php
session_start();
require_once '../config/db.php';

// Check if user is admin
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch all student forms
$query = "SELECT * FROM student_forms ORDER BY submission_date DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard - Student Forms</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Student Enrollment Forms</h1>
        <table class="forms-table">
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Submission Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['student_name']; ?></td>
                        <td><?php echo $row['submission_date']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                        <td>
                            <a href="view_form.php?id=<?php echo $row['form_id']; ?>" class="btn">View Form</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>

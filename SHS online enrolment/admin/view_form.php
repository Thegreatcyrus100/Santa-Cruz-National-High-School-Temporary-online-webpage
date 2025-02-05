<?php
session_start();
require_once '../config/db.php';

// Check if user is admin
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Get form ID from URL
$form_id = $_GET['id'] ?? '';
if (!$form_id) {
    header("Location: dashboard.php");
    exit();
}

// Fetch form details
$query = "SELECT * FROM student_forms WHERE form_id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $form_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$form = mysqli_fetch_assoc($result);

if (!$form) {
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Student Form</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Student Enrollment Form Details</h1>
        <div class="form-view">
            <h2>Student Information</h2>
            <p><strong>Name:</strong> <?php echo $form['student_name']; ?></p>
            <p><strong>Email:</strong> <?php echo $form['email']; ?></p>
            <!-- Add other form fields here -->
            
            <div class="form-actions">
                <a href="dashboard.php" class="btn">Back to Dashboard</a>
                <button class="btn btn-approve" onclick="updateStatus(<?php echo $form_id; ?>, 'approved')">Approve</button>
                <button class="btn btn-reject" onclick="updateStatus(<?php echo $form_id; ?>, 'rejected')">Reject</button>
            </div>
        </div>
    </div>
    
    <script>
    function updateStatus(formId, status) {
        fetch('update_status.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                form_id: formId,
                status: status
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Status updated successfully');
                window.location.reload();
            }
        });
    }
    </script>
</body>
</html>

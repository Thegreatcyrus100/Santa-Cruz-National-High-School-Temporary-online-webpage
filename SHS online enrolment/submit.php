<?php
require_once 'config/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Start transaction
        $pdo->beginTransaction();

        // Insert into learners table
        $stmt = $pdo->prepare("INSERT INTO learners (name, lrn, dob, gender, indigenous, province, municipality, barangay, street) 
                              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        $name = $_POST['first_name'] . ' ' . $_POST['middle_name'] . ' ' . $_POST['last_name'];
        $stmt->execute([
            $name,
            $_POST['lrn'],
            $_POST['dob'],
            $_POST['gender'],
            $_POST['indigenous'],
            $_POST['province'],
            $_POST['municipality'],
            $_POST['barangay'],
            $_POST['street']
        ]);
        
        $learner_id = $pdo->lastInsertId();

        // Insert into parents_guardians table
        $stmt = $pdo->prepare("INSERT INTO parents_guardians (learner_id, father_name, mother_name, guardian_name, contact) 
                              VALUES (?, ?, ?, ?, ?)");
        
        $father_name = $_POST['father_first_name'] . ' ' . $_POST['father_last_name'];
        $mother_name = $_POST['mother_first_name'] . ' ' . $_POST['mother_last_name'];
        $guardian_name = $_POST['guardian_first_name'] . ' ' . $_POST['guardian_last_name'];
        
        $stmt->execute([
            $learner_id,
            $father_name,
            $mother_name,
            $guardian_name,
            $_POST['contact']
        ]);

        // Insert into shs_details table
        $stmt = $pdo->prepare("INSERT INTO shs_details (learner_id, grade, track, strand, learning_modality) 
                              VALUES (?, ?, ?, ?, ?)");
        
        $stmt->execute([
            $learner_id,
            $_POST['grade'],
            $_POST['track'],
            $_POST['strand'],
            $_POST['learning_modality']
        ]);

        // Insert into school_info table
        $stmt = $pdo->prepare("INSERT INTO school_info (learner_id, school_name, school_id, grade_level, section, school_year) 
                              VALUES (?, ?, ?, ?, ?, ?)");
        
        $stmt->execute([
            $learner_id,
            $_POST['school_name'],
            $_POST['school_id'],
            $_POST['grade_level'],
            $_POST['section'],
            $_POST['school_year']
        ]);

        // Commit transaction
        $pdo->commit();
        
        echo "Registration successful!";
        
    } catch(PDOException $e) {
        // Rollback transaction on error
        $pdo->rollBack();
        echo "Error: " . $e->getMessage();
    }
}
?>

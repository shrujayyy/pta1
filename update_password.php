<?php
session_start();
require 'db_connection.php'; // Replace with your database connection code

// Check if the user is logged in. You can use any authentication method you prefer.
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to the login page if not logged in
    exit();
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get input values
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];
    
    // Fetch the current user's password from the database
    $userId = $_SESSION['user_id'];
    $sql = "SELECT password FROM users WHERE id = $userId";
    $result = mysqli_query($connection, $sql);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $storedPassword = $row['password'];
        
        // Verify if the current password matches the stored password
        if (password_verify($currentPassword, $storedPassword)) {
            if ($newPassword === $confirmPassword) {
                // Hash the new password before storing it
                $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                
                // Update the user's password in the database
                $updateSql = "UPDATE users SET password = '$hashedNewPassword' WHERE id = $userId";
                $updateResult = mysqli_query($connection, $updateSql);
                
                if ($updateResult) {
                    echo "Password updated successfully.";
                } else {
                    echo "Error updating password.";
                }
            } else {
                echo "New password and confirm password do not match.";
            }
        } else {
            echo "Current password is incorrect.";
        }
    } else {
        echo "Error fetching the user's data.";
    }
}

// Close the database connection if you opened one
mysqli_close($connection);
?>

<!-- HTML form to change the password -->
<form method="POST">
    <input type="password" name="current_password" placeholder="Current Password" required><br>
    <input type="password" name="new_password" placeholder="New Password" required><br>
    <input type="password" name="confirm_password" placeholder="Confirm New Password" required><br>
    <button type="submit">Change Password</button>
</form>

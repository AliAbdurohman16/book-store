<?php
# include or import
session_start();
include "../config/connection.php";
include "../helper/form_validation.php";

if (isset($_POST['email']) && isset($_POST['password'])) { 
    // Get data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validation
    $text = "Email";
    $location = "../login.php";
    $ms = "error";
    is_empty($email, $text, $location, $ms, "");

    $text = "Password";
    $location = "../login.php";
    $ms = "error";
    is_empty($password, $text, $location, $ms, "");
    // End Validation
    
    // search for the email 
    $sql = "SELECT * FROM admin WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$email]);
    
    // if the email exist
    if ($stmt->rowCount() === 1) {
        $user = $stmt->fetch();

        $user_id = $user['id'];
        $user_email = $user['email'];
        $user_password = $user['password'];

        if ($email === $user_email) {
            if (password_verify($password, $user_password)) {
                $_SESSION['user_id'] = $user_id;
                $_SESSION['user_email'] = $user_email;

                header("Location: ../admin.php");
            } else {
                // Error message
                $em = "Incorrect email or password";
            }
        }
    } else {
        // Error message
        $em = "Incorrect email or password";
        header("Location: ../login.php?error=$em");
    }
} else {
    // redirect to login
    header("Location: ../login.php");
}

?>
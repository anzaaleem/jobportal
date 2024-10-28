<?php

// To Handle Session Variables on This Page
session_start();

// Including Database Connection From db.php file to avoid rewriting in all files
require_once("db.php");

// If the user actually clicked the login button
if (isset($_POST)) {

    // Escape special characters in the string to prevent SQL Injection
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Encrypt password (reverse MD5 + base64 encoding)
 //   $password = base64_encode(strrev(md5($password)));

    // SQL query to check user login
    $sql = "SELECT id_user, firstname, lastname, email, active FROM users WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    // If a matching record is found
    if ($result->num_rows > 0) {
        // Output data
        while ($row = $result->fetch_assoc()) {

            if ($row['active'] == '0') {
                // If the account is inactive, redirect with an error
                $_SESSION['loginActiveError'] = "Your Account Is Not Active. Check Your Email.";
                header("Location: 1.php");
                exit();
            } elseif ($row['active'] == '1') {
                // Redirect to candidate dashboard if 'active' is an empty string

                // Set session variables
                $_SESSION['name'] = $row['firstname'] . " " . $row['lastname'];
                $_SESSION['id_user'] = $row['id_user'];

                // Check if there's a custom redirect location set in the session
                if (isset($_SESSION['callFrom'])) {
                    $location = $_SESSION['callFrom'];
                    unset($_SESSION['callFrom']); // Clear the session variable
                    
                    header("Location: " . $location);
                    exit();
                } else {
                    // Redirect to the candidate dashboard by default
                    header("Location: page-profile.php");
                    exit();
                }
            } elseif ($row['active'] == '2') {
                // If the account is deactivated, redirect with an error
                $_SESSION['loginActiveError'] = "Your Account Is Deactivated. Contact Admin To Reactivate.";
                header("Location: 3.php");
                exit();
            }
        }
    } else {
        // If no matching record is found, redirect with an error
        $_SESSION['loginError'] = "Invalid Email or Password!";
        header("Location: dashboard_candidate.php");
        exit();
    }

    // Close database connection (good practice)
    $conn->close();

} else {
    // Redirect to login page if the user did not submit the form
    header("Location: 5.php");
    exit();
}

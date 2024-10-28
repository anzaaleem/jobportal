<?php
session_start();
require_once("db.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize input
    $companyname = $conn->real_escape_string($_POST['companyname']);
    $contactno   = $conn->real_escape_string($_POST['contactno']);
    $website     = $conn->real_escape_string($_POST['website']);
    $email       = $conn->real_escape_string($_POST['email']);
    $password    = base64_encode(strrev(md5($conn->real_escape_string($_POST['password']))));
    $country     = $conn->real_escape_string($_POST['country']);
    $state       = $conn->real_escape_string($_POST['state']);
    $city        = $conn->real_escape_string($_POST['city']);
    $aboutme     = $conn->real_escape_string($_POST['aboutme']);
    $name        = $conn->real_escape_string($_POST['name']);

    // Check if email already exists
    $checkEmail = $conn->query("SELECT email FROM company WHERE email='$email'");
    if ($checkEmail->num_rows > 0) {
        $_SESSION['registerError'] = true;
        header("Location: register-company.php");
        exit();
    }

    // Handle file upload
    $uploadOk = false;
    $folder_dir = "uploads/logo/";
    if (isset($_FILES['image']) && $_FILES['image']['tmp_name']) {
        $imageFileType = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $file = uniqid() . ".$imageFileType";
        $filename = $folder_dir . $file;

        // Validate image type and size
        if (in_array($imageFileType, ['jpg', 'png']) && $_FILES['image']['size'] < 500000) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $filename)) {
                $uploadOk = true;
            } else {
                $_SESSION['uploadError'] = "File upload failed.";
            }
        } else {
            $_SESSION['uploadError'] = "Invalid file. Only JPG and PNG under 5MB allowed.";
        }
    }

    if (!$uploadOk) {
        header("Location: register-company.php");
        exit();
    }

    // Insert company data into the database
    $sql = "INSERT INTO company (name, companyname, country, state, city, contactno, website, email, password, aboutme, logo) 
            VALUES ('$name', '$companyname', '$country', '$state', '$city', '$contactno', '$website', '$email', '$password', '$aboutme', '$file')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['registerCompleted'] = true;
        header("Location: page-login-company.php");
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    header("Location: register-company.php");
}
$conn->close();
?>

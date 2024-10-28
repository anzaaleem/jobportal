<?php
session_start();
require_once("db.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize input
    $fname = $conn->real_escape_string($_POST['fname']);
    $lname        = $conn->real_escape_string($_POST['lname']);
    $email       = $conn->real_escape_string($_POST['email']);
    $password    = base64_encode(strrev(md5($conn->real_escape_string($_POST['password']))));
    $city        = $conn->real_escape_string($_POST['city']);
    $state       = $conn->real_escape_string($_POST['state']);
    $address     = $conn->real_escape_string($_POST['address']);
    $contactno   = $conn->real_escape_string($_POST['contactno']);
    $qualification=$conn->real_escape_string($_POST['qualification']);
    $stream     = $conn->real_escape_string($_POST['stream']);
    $passingyear= $conn->real_escape_string($_POST['passingyear']);
    $dob= $conn->real_escape_string($_POST['dob']);
    $age= $conn->real_escape_string($_POST['age']);
    $designation=$conn->real_escape_string($_POST['designation']);
    $skills= $conn->real_escape_string($_POST['skills']);
    $aboutme     = $conn->real_escape_string($_POST['aboutme']);
    $resume     = $conn->real_escape_string($_POST['resume']);
    // Check if email already exists
    $checkEmail = $conn->query("SELECT email FROM users WHERE email='$email'");
    if ($checkEmail->num_rows > 0) {
        $_SESSION['registerError'] = true;
        header("Location: register-candidate.php");
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
        if (in_array($imageFileType, ['pdf', 'word']) && $_FILES['image']['size'] < 1000000) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $filename)) {
                $uploadOk = true;
            } else {
                $_SESSION['uploadError'] = "File upload failed.";
            }
        } else {
            $_SESSION['uploadError'] = "Invalid file. Only PDF and Word under 10MB allowed.";
        }
    }

    if (!$uploadOk) {
        header("Location: register-candidate.php");
        exit();
    }

    // Insert company data into the database
    $sql = "INSERT INTO users (firstname, lastname, email, password, address,city,state,  contactno, qualification,stream, passingyear,dob,age,designation, aboutme,skills, resume) 
            VALUES ('$fname', '$lname', '$email', '$password','$address', '$city', '$state', '$contactno','$qualification','$stream','$passingyear','$dob','$age','$designation', '$aboutme','$skills', '$resume')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['registerCompleted'] = true;
        header("Location: page-login.php");
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    header("Location: register-candidate.php");
}
$conn->close();
?>

<?php

require_once 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $availability = $_POST["availability"];
    $time = $_POST["time"];
    $services = $_POST["services"];

    // File upload handling
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check === false) {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["image"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow only certain file formats
    $allowedFormats = array("jpg", "jpeg", "png", "gif");
    if(!in_array($imageFileType, $allowedFormats)) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";

            // Insert data into the database using prepared statements
            $stmt = $conn->prepare("INSERT INTO reservations (name, email, number, availability, time, services, image) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssissss", $name, $email, $number, $availability, $time, $services, $target_file);

            if ($stmt->execute()) {
                header("Location: ../index.php");
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

// Close MySQL connection
$conn->close();
?>
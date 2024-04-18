<?php
require_once 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $number = $_POST["number"];
    $availability = $_POST["availability"];
    $time = $_POST["time"];
    $services = $_POST["services"];

    // File upload handling
    $image_name = $_FILES["image"]["name"];
    $image_tmp_name = $_FILES["image"]["tmp_name"];
    $image_type = $_FILES["image"]["type"];
    $image_size = $_FILES["image"]["size"];

    // Check if file is uploaded and no errors occurred
    if (isset($image_name) && !empty($image_name)) {
        $upload_dir = "uploads/";
        $allowed_extensions = array("jpg", "jpeg", "png", "gif");

        // Get file extension
        $image_extension = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));

        // Check if the file extension is valid
        if (in_array($image_extension, $allowed_extensions)) {
            // Generate a unique file name to avoid conflicts
            $new_image_name = uniqid() . '.' . $image_extension;

            // Move the uploaded file to the upload directory
            if (move_uploaded_file($image_tmp_name, $upload_dir . $new_image_name)) {
                // Prepare SQL statement to insert data into the reservations table
                $sql = "INSERT INTO reservations (name, email, number, availability, time, services, image)
                        VALUES ('$name', '$email', '$number', '$availability', '$time', '$services', '$new_image_name')";

                // Execute SQL statement
                if ($conn->query($sql) === TRUE) {
                    echo "Reservation successfully created.";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                echo "Error uploading image.";
            }
        } else {
            echo "Invalid image format. Allowed formats: jpg, jpeg, png, gif";
        }
    } else {
        echo "Please select an image to upload.";
    }
}
?>
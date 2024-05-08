<?php
include ("connect.php");
if (isset($_POST["submit"])) {
    // Prevent duplicate form submissions

        // Process form data
        $sender_id = $_POST["id"];
        $recipient_id = $_POST["recipient_id"];
        $message = $_POST["message"];

        // SQL query to insert the form data into the database
        $query1 = "INSERT INTO user (sender_id, recipient_id, messege) VALUES ('$sender_id', '$recipient_id', '$message')";

        // Execute the query
        if (mysqli_query($conn, $query1)) {
            // Redirect to a success page to avoid form resubmission
            header("Location: index1.php");
            exit(); // Terminate further script execution
        } else {
            echo "Error: " . $query1 . "<br>" . mysqli_error($conn);
        }

        // Close database connection
        mysqli_close($conn);
    
}
?>
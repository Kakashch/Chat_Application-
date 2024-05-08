<?php
include ("connect.php");
session_start();
if (isset($_POST["name"])) {
    $name = $_POST["name"];

    // SQL query to update the "message" column in the "user" table for a specific user ID
    $query = "select * from users where name='$name'";
    $data = mysqli_query($conn, $query);
    if (mysqli_num_rows($data) > 0) {
        $_SESSION["loggedin"] = true;
        $user = mysqli_fetch_assoc($data);
        $_SESSION["username"] = $user["name"];
        header("Location: index1.php");
        exit;

    }
    // Execute the query
    if (mysqli_query($conn, $query)) {
        //echo "message saved successfully.";
        //header("Location: index1.php");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }

    // Close database connection
    mysqli_close($conn);
} else {
    //echo "Message or user ID is missing.";
}
?>
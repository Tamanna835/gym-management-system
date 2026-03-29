<?php
include("database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape form values
    $original_email = $conn->real_escape_string($_POST['original_email']);
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $dob = $conn->real_escape_string($_POST['dob']);
    $goal = $conn->real_escape_string($_POST['goal']);
    $schedule_id = $conn->real_escape_string($_POST['schedule_id']); 

    
    $sql = "UPDATE registration SET 
                name='$name', 
                email='$email', 
                phone='$phone', 
                dob='$dob', 
                goal='$goal', 
                schedule_id='$schedule_id' 
            WHERE email='$original_email'";

    if ($conn->query($sql) === TRUE) {
        // Success message and redirect
        echo "<!DOCTYPE html>
        <html>
        <head>
        <title>Update Member</title>
        <style>
            body {
             font-family: 
             Arial; 
             background:#e6edf7; 
             text-align:center; 
             padding-top:50px; 
             }
            .msg { 
            background:#4a6cf7;
             color:white; 
             padding:20px;
              border-radius:10px; 
              display:inline-block; 
              }
            a { 
            color:white; 
            text-decoration:none; 
            font-weight:bold; 
            }
        </style>
        </head>
        <body>
            <div class='msg'>
                Member updated successfully!<br><br>
                <a href='view_members.php'>Back to Members List</a>
            </div>
        </body>
        </html>";
        exit();
    } else {
        echo "<p style='color:red; text-align:center;'>Error updating record: ".$conn->error."</p>";
    }
} else {
    echo "<p style='color:red; text-align:center;'>Invalid request.</p>";
}
?>
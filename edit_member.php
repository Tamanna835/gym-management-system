<?php
include("database.php");

if (!isset($_GET['email'])) {
    echo "<p style='color:red; text-align:center;'>Email not provided.</p>";
    exit;
}

$email = $conn->real_escape_string($_GET['email']);

// Fetch member from registration table
$sql = "SELECT * FROM registration WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    echo "<p style='color:red; text-align:center;'>Member not found.</p>";
    exit;
}

$row = $result->fetch_assoc();

// Define schedule options
$schedules = ['Morning', 'Afternoon', 'Evening', 'Night', 'Others'];

// Define goal options
$goals = ['Muscle Gain', 'Weight Loss', 'Fitness', 'Flexibility', 'Other'];

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Member</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #e6edf7;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 500px;
            margin: 50px auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 25px;
        }

        form label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #34495e;
        }

        form input, form select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 14px;
            transition: all 0.2s;
        }

        form input:focus, form select:focus {
            border-color: #4a6cf7;
            box-shadow: 0 0 5px rgba(74,108,247,0.3);
            outline: none;
        }

        input[type="submit"] {
            background: #4a6cf7;
            color: white;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            padding: 12px;
            cursor: pointer;
            transition: background 0.3s;
        }

        input[type="submit"]:hover {
            background: #3751c6;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Edit Member</h2>
    <form method="post" action="update_member.php">
        <input type="hidden" name="original_email" value="<?php echo $row['email']; ?>">

        <label>Name</label>
        <input type="text" name="name" value="<?php echo $row['name']; ?>" required>

        <label>Email</label>
        <input type="email" name="email" value="<?php echo $row['email']; ?>" required>

        <label>Phone</label>
        <input type="text" name="phone" value="<?php echo $row['phone']; ?>" required>

        <label>DOB</label>
        <input type="date" name="dob" value="<?php echo $row['dob']; ?>" required>

        <label>Goal</label>
        <select name="goal" required>
            <?php
            foreach($goals as $g){
                $selected = ($row['goal'] == $g) ? "selected" : "";
                echo "<option value='$g' $selected>$g</option>";
            }
            ?>
        </select>

        <label>Schedule / Time</label>
        <select name="schedule_id" required>
            <?php
            foreach($schedules as $index => $slot){
                // Assuming schedule_id in DB is 1-based index
                $selected = ($row['schedule_id'] == $index+1) ? "selected" : "";
                echo "<option value='".($index+1)."' $selected>$slot</option>";
            }
            ?>
        </select>

        <input type="submit" value="Update Member">
    </form>
</div>

</body>
</html>
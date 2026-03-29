<?php
include("database.php");

$sql = "SELECT * FROM registration";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Members</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #eef2f3, #dfe9f3);
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            margin: 40px auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 15px rgba(0,0,0,0.2);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th {
            background: #4facfe;
            color: white;
            padding: 12px;
        }

        table td {
            padding: 10px;
            text-align: center;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tr:hover {
            background-color: #ddd;
        }

        a {
            text-decoration: none;
            padding: 6px 10px;
            border-radius: 5px;
            color: white;
            font-size: 14px;
        }

        .edit-btn {
            background-color: #28a745;
        }

        .delete-btn {
            background-color: #dc3545;
        }

        .edit-btn:hover {
            background-color: #218838;
        }

        .delete-btn:hover {
            background-color: #c82333;
        }

        .no-data {
            text-align: center;
            padding: 15px;
            color: red;
        }
    </style>
</head>

<body>

<div class="container">
    <h2>🏋️ Registered Members</h2>

    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>DOB</th>
            <th>Goal</th>
            <th>Action</th>
        </tr>

        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row['name']."</td>";
                echo "<td>".$row['email']."</td>";
                echo "<td>".$row['phone']."</td>";
                echo "<td>".$row['dob']."</td>";
                echo "<td>".$row['goal']."</td>";
                echo "<td>
                        <a class='edit-btn' href='edit_member.php?email={$row['email']}'>Edit</a>
                        <a class='delete-btn' href='delete_member.php?email={$row['email']}' onclick='return confirm(\"Are you sure?\");'>Delete</a>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6' class='no-data'>No members found</td></tr>";
        }
        ?>
    </table>
</div>

</body>
</html>
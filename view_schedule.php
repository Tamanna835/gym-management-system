<?php
include 'database.php';

$sql = "SELECT r.name, r.email, r.phone, r.dob, r.goal, s.time_slot
        FROM registration r
        JOIN schedules s ON r.schedule_id = s.schedule_id
        ORDER BY s.schedule_id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Schedule</title>

    <style>
        /* Body background */
        body {
            font-family: Arial, sans-serif;
            background: #eff3f8; /* soft light blue */
            margin: 0;
        }

        /* Main container */
        .container {
            width: 90%;
            margin: 40px auto;
        }

        h1 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 30px;
        }

        /* Schedule card */
        .card {
            background: #ffffff;
            margin-bottom: 25px;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.06);
            border-left: 8px solid transparent; /* default */
        }

        /* Header inside card */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .title {
            font-size: 20px;
            font-weight: bold;
        }

        .count {
            background: #f0f0f0;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 14px;
        }

        /* Left border color per schedule */
        .morning { border-left-color: #27ae60; }      /* green */
        .afternoon { border-left-color: #f39c12; }    /* orange */
        .evening { border-left-color: #8e44ad; }      /* purple */
        .night { border-left-color: #34495e; }        /* dark grey */

        /* Table styles */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #dce6f2; /* soft header color */
            color: #2c3e50;
            padding: 12px;
            font-weight: 600;
            border-bottom: 2px solid #c1c8d4;
        }

        td {
            padding: 10px;
            text-align: center;
            color: #555;
        }

        td:first-child {
            font-weight: 600;
            color: #34495e;
        }

        tr:nth-child(even) {
            background: #f7f9fc;
        }

        tr:hover {
            background: #eaf1ff;
            transition: 0.2s;
        }

        .no-data {
            text-align: center;
            color: red;
            padding: 20px;
        }

    </style>
</head>

<body>

<div class="container">
    <h1>📊 Gym Schedule Overview</h1>

<?php
$current_slot = "";

// Group data by schedule
if ($result->num_rows > 0) {
    $rows = [];
    while ($row = $result->fetch_assoc()) {
        $rows[$row['time_slot']][] = $row;
    }

    foreach ($rows as $slot => $members) {

        // Class name
        $class = strtolower($slot);
        if (!in_array($class, ['morning','afternoon','evening','night'])) {
            $class = "";
        }

        echo "<div class='card $class'>";

        echo "<div class='header'>
                <div class='title'>$slot Members</div>
                <div class='count'>".count($members)." members</div>
              </div>";

        echo "<table>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>DOB</th>
                    <th>Goal</th>
                </tr>";

        foreach ($members as $m) {
            echo "<tr>
                    <td>{$m['name']}</td>
                    <td>{$m['email']}</td>
                    <td>{$m['phone']}</td>
                    <td>{$m['dob']}</td>
                    <td>{$m['goal']}</td>
                  </tr>";
        }

        echo "</table></div>";
    }

} else {
    echo "<p class='no-data'>No members found</p>";
}
?>

</div>

</body>
</html>
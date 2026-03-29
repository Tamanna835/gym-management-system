<?php
session_start();
include("database.php");

// Admin login check
if(!isset($_SESSION['admin_logged_in'])){
    header("Location: admin_login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Panel</title>
<style>
    body {
        margin: 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: #f0f4f7;
    }

    /* Top welcome bar */
    .top-bar {
        background-color: #003366;
        color: white;
        text-align: center;
        padding: 25px 0;
        font-size: 22px;
        font-weight: bold;
        letter-spacing: 1px;
        border-bottom: 6px solid #003366; /* Top border */
    }

    .container {
        display: flex;
        min-height: 90vh; /* Remaining space after top-bar */
    }

    /* Sidebar */
    .sidebar {
        width: 250px;
        background-color: #003366;
        color: white;
        display: flex;
        flex-direction: column;
        padding-top: 20px;
        border-right: 6px solid #0059b3;
    }

    /* Dashboard title / optional */
    .sidebar .dashboard-title {
        font-size: 20px;
        font-weight: bold;
        text-align: center;
        padding: 15px 0;
        border-bottom: 2px solid #0059b3;
        margin-bottom: 15px;
    }

    .sidebar a {
        display: block;
        padding: 12px 20px;
        margin: 8px 15px;
        background-color: #0059b3;
        color: white;
        text-decoration: none;
        border-radius: 6px;
        font-weight: bold;
        transition: 0.3s;
    }
    .sidebar a:hover {
        background-color: #0073e6;
    }

    /* Content area (empty) */
    .content {
        flex: 1;
        padding: 40px;
        background-color: #e6f2ff;
        text-align: center;
    }
</style>
</head>
<body>

<!-- Top Welcome Bar -->
<div class="top-bar">
    <!--top bar-->
</div>

<div class="container">
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="dashboard-title">Admin Dashboard</div>
        <a href="view_members.php">View Members</a>
        <a href="view_schedule.php">View Schedule</a>
        <a href="admin_logout.php">Logout</a>
    </div>

    <!-- Main Content -->
    <div class="content">
        <h2>Welcome Admin</h2>
        <p>Use the left menu to navigate to different pages.</p>
    </div>
</div>

</body>
</html>

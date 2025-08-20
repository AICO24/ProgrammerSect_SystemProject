<?php
session_start();
require 'db.php';

if (!isset($_SESSION["username"])) {
    header("Location: index.php");
    exit();
}

$username = $_SESSION["username"];

$query = $conn->prepare("SELECT firstname, lastname FROM users WHERE username = ?");
$query->bind_param("s", $username);
$query->execute();
$query->bind_result($firstName, $lastName);
$query->fetch();
$query->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
</head>
<body>

    <div class="dashboard" id="dashboard" style="display:block;">
        <aside class="sidebar">
            <h2><i class="fa-solid fa-landmark"></i> JAIL MANAGEMENT</h2>
            <ul>
                <li><i class="fa-solid fa-chart-line"></i> Dashboard</li>
                <li id="bookingLink"><i class="fa-solid fa-book"></i> Booking</li>
                <li><i class="fa-solid fa-user-shield"></i> Inmate Management</li>
                <li><i class="fa-solid fa-clock"></i> Sentence Tracking</li>
                <li><i class="fa-solid fa-door-closed"></i> Cell Management</li>
                <li><i class="fa-solid fa-users"></i> Visitor Management</li>
                <li><i class="fa-solid fa-calendar-days"></i> Event Management</li>
                <li><i class="fa-solid fa-user-tie"></i> Staff Management</li>
                <li><i class="fa-solid fa-chart-pie"></i> Analytics</li>
                <li><i class="fa-solid fa-right-from-bracket"></i> <a href="logout.php" style="text-decoration:none;color:inherit;">Logout</a></li>
            </ul>
        </aside>

        <main class="main-panel">
            <header class="topbar">
                <span><?php echo htmlspecialchars($firstName . ' ' . $lastName ?: $username); ?></span>
                <i class="fa-regular fa-user-circle"></i>
            </header>

            <section class="analytics-cards">
                <div class="card">Total Inmates <span>1</span></div>
                <div class="card">Total Cells <span>5</span></div>
                <div class="card">Today's Visitors <span>2</span></div>
                <div class="card">Events <span>5</span></div>
                <div class="card">Today's Bookings <span>4</span></div>
            </section>

            <h2 class="analytics-title">Analytics</h2>
            <div class="analytics-grid">
                <div class="analytics-box"><i class="fa-solid fa-chart-pie fa-4x"></i></div>
                <div class="analytics-box"><i class="fa-solid fa-chart-line fa-4x"></i></div>
                <div class="analytics-box"><i class="fa-solid fa-magnifying-glass-chart fa-4x"></i></div>
                <div class="analytics-box"><i class="fa-solid fa-chart-column fa-4x"></i></div>
            </div>
        </main>
    </div>
</body>
</html>

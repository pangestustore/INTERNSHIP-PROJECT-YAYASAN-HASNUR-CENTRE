<?php
session_start();
require "Database/database.php";

// Query untuk mendapatkan jumlah kursus dan materi
$queryKursus = "SELECT COUNT(*) as total FROM courses";
$resultKursus = mysqli_query($conn, $queryKursus);
$totalKursus = mysqli_fetch_assoc($resultKursus)['total'];

$queryMateri = "SELECT COUNT(*) as total FROM materials";
$resultMateri = mysqli_query($conn, $queryMateri);
$totalMateri = mysqli_fetch_assoc($resultMateri)['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Kursus Online</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .card-body {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .card-body p {
            color: white;
            margin: 0;
            padding-right: 10px;
            font-weight: bold;
            font-size: 50px;
            line-height: 1;
        }

        .card-body h3 {
            margin: 0;
            font-weight: normal;
            font-size: 20px;
            line-height: 1;
        }
    </style>
</head>
<body>
<header>
        <h1>Admin Kursus Online</h1>
    </header>
    <div style="display: flex; flex: 1;">
    <?php include 'sidebar.php'; ?>


        <div class="content">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h2>Selamat Datang Admin</h2>
                    <p>Semua sistem berjalan dengan baik!</p>
                </div>
            </div>
            <div class="row mt-4 d-flex justify-content-start">
    <div class="col-md-4 mb-4 stretch-card transparent">
        <div class="card card-tale">
            <div class="card-body">
                <p id="totalKursus"><?php echo $totalKursus; ?></p>
                <h3>Kursus</h3>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4 stretch-card transparent">
        <div class="card card-tale">
            <div class="card-body">
                <p id="totalMateri"><?php echo $totalMateri; ?></p>
                <h3>Materi</h3>
            </div>
        </div>
    </div>
</div>


        </div>
    </div>
    <footer>
        &copy; 2024 Kursus Online
    </footer>
    <div class="hamburger" onclick="toggleSidebar()">
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
    </div>

    <script src="script.js"></script>

    <script>
        function animateCount(element, start, end, duration) {
    if (end === 0) {
        element.textContent = 0; 
        return;
    }

    let range = end - start;
    let current = start;
    let increment = end > start ? 1 : -1;
    let stepTime = Math.abs(Math.floor(duration / range));
    
    let timer = setInterval(function() {
        current += increment;
        element.textContent = current;
        if (current === end) {
            clearInterval(timer);
        }
    }, stepTime);
}

window.onload = function() {
    let totalKursus = <?= $totalKursus ?>;
    let displayElementKursus = document.getElementById('totalKursus');
    animateCount(displayElementKursus, 0, totalKursus, 2000);

    let totalMateri = <?= $totalMateri ?>;
    let displayElementMateri = document.getElementById('totalMateri');
    animateCount(displayElementMateri, 0, totalMateri, 2000);
};

    </script>
</body>
</html>


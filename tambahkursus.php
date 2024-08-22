<?php
session_start();
require "Database/database.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari formulir
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $duration = mysqli_real_escape_string($conn, $_POST['duration']);

    // Query untuk menambahkan kursus
    $query = "INSERT INTO courses (title, description, duration) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'sss', $title, $description, $duration);

    if (mysqli_stmt_execute($stmt)) {
        // Jika berhasil, redirect ke halaman kursus
        header("Location: kursus.php");
        exit();
    } else {
        // Jika gagal, tampilkan pesan error
        $error = "Gagal menambahkan kursus. Silakan coba lagi.";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
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
        .main-content {
            display: flex;
            margin: 0;
        }
    
        .content-table {
            flex: 1;
            padding: 20px;
            background-color: #ffffff;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }
        .form-wrapper {
            width: 100%;
            display: flex;
            justify-content: center;
        }
        .form-container {
            max-width: 1100px;
            width: 100%;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .form-container h2 {
            margin: 0;
            font-size: 23px;
        }
        .form-container p {
            margin-top: 5px;
            font-size: 15px;
            color: #333;
        }
        .form-container label {
            margin-top: 10px;
            display: block;
        }
        .form-container input, .form-container textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-top: 5px;
            box-sizing: border-box;
        }
        .form-container textarea {
            resize: vertical;
        }
        .form-container button {
            background-color: #5050B2;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 15px;
            cursor: pointer;
            margin-top: 20px;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        .form-container button:hover {
            background-color: #0056b3;
        }

        .btn {
        display: inline-block;
        font-weight: 400;
        color: #007bff;
        text-align: center;
        vertical-align: middle;
        user-select: none;
        background-color: transparent;
        border: 1px solid transparent;
        border-radius: 15px;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        line-height: 1.5;
        transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        cursor: pointer;
        text-decoration: none;
    }

    .btn-light {
        color: #212529;
        background-color: #f8f9fa;
        border-color: #f8f9fa;
    }

    .btn-light:hover {
        color: #0056b3;
        background-color: #e2e6ea;
        border-color: #dae0e5;
    }

    .btn-light:focus, .btn-light.focus {
        box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.5);
    }

    .btn-light:active, .btn-light.active {
        color: #0056b3;
        background-color: #e2e6ea;
        border-color: #dae0e5;
    }

    .btn-light.disabled, .btn-light:disabled {
        color: #6c757d;
        background-color: #f8f9fa;
        border-color: #f8f9fa;
        cursor: not-allowed;
    }
    </style>
</head>
<body>
    <header>
        <h1>Admin Kursus Online</h1>
    </header>
    <div class="main-content">
    <?php include 'sidebar.php'; ?>
        <div class="content-table">
            <div class="form-container">
                <h2>Tambah Kursus</h2>
                <p>Pastikan data yang diinput sudah benar!</p>
                <form method="post" action="">
                    <label for="title">Judul</label>
                    <input type="text" id="title" name="title" required>

                    <label for="description">Deskripsi</label>
                    <textarea id="description" name="description" rows="4" required></textarea>

                    <label for="duration">Durasi</label>
                    <input type="text" id="duration" name="duration" required>

                    <button type="submit">Submit</button>
                    <a href="kursus.php" class="btn btn-light">Batal</a>
                </form>
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
        function toggleSidebar() {
            var sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('open');
        }
    </script>
</body>
</html>

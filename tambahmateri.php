<?php
session_start();
require "Database/database.php";

// Query untuk mendapatkan ID dan judul kursus
$queryCourses = "SELECT id, title FROM courses";
$resultCourses = mysqli_query($conn, $queryCourses);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari formulir
    $course_id = mysqli_real_escape_string($conn, $_POST['course_id']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $embed_link = mysqli_real_escape_string($conn, $_POST['embed_link']);

    // Query untuk menambahkan materi
    $query = "INSERT INTO materials (course_id, title, description, embed_link) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'isss', $course_id, $title, $description, $embed_link);

    if (mysqli_stmt_execute($stmt)) {
        // Jika berhasil, redirect ke halaman kursus
        header("Location: materi.php");
        exit();
    } else {
        // Jika gagal, tampilkan pesan error
        $error = "Gagal menambahkan materi. Silakan coba lagi.";
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

        .form-container input, .form-container textarea, .form-container select {
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
            padding: 10px 12px;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            margin-top: 20px;
            font-size: 15px;
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
            font-size: 17px;
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
    </style>
</head>
<body>
    <header>
        <h1>Admin Course Online</h1>
    </header>
    <div class="main-content">
        <div id="sidebar">
            <!-- Dashboard -->
            <div class="nav-item">
                <i class="fas fa-tachometer-alt"></i>
                <a href="index.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">Dashboard</a>
            </div>

            <!-- Kursus -->
            <div class="nav-item">
                <i class="fas fa-book"></i>
                <a href="kursus.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'kursus.php' ? 'active' : ''; ?>">Kursus</a>
            </div>

            <!-- Materi -->
            <div class="nav-item">
                <i class="fas fa-file-alt"></i>
                <a href="materi.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'materi.php' ? 'active' : ''; ?>">Materi</a>
            </div>
        </div>

        <div class="content-table">
            <div class="form-container">
                <h2>Tambah Materi</h2>
                <p>Pastikan data yang diinput sudah benar!</p>
                <form method="post" action="">
                    <label for="course_id">Kursus</label>
                    <select id="course_id" name="course_id" required>
    <option value="" disabled selected>Pilih Kursus</option>
    <?php while ($row = mysqli_fetch_assoc($resultCourses)): ?>
        <option value="<?= $row['id']; ?>"><?= $row['title']; ?></option>
    <?php endwhile; ?>
</select>


                    <label for="title">Judul</label>
                    <input type="text" id="title" name="title" required>

                    <label for="description">Deskripsi</label>
                    <textarea id="description" name="description" rows="4" required></textarea>

                    <label for="embed_link">Link Embed</label>
                    <input type="text" id="embed_link" name="embed_link" required>

                    <button type="submit">Submit</button>
                    <a href="materi.php" class="btn btn-light">Batal</a>
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

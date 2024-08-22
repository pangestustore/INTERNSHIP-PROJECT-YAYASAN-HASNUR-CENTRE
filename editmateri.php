<?php
session_start();
require "Database/database.php";

// Ambil ID materi dari URL
$material_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Query untuk mendapatkan ID dan judul kursus
$queryCourses = "SELECT id, title FROM courses";
$resultCourses = mysqli_query($conn, $queryCourses);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Proses pembaharuan data materi
    $course_id = $conn->real_escape_string($_POST['course_id']);
    $title = $conn->real_escape_string($_POST['title']);
    $description = $conn->real_escape_string($_POST['description']);
    $embed_link = $conn->real_escape_string($_POST['embed_link']);

    $sql = "UPDATE materials SET course_id='$course_id', title='$title', description='$description', embed_link='$embed_link' WHERE id=$material_id";
    if ($conn->query($sql) === TRUE) {
        header("Location: materi.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    // Ambil data materi
    $sql = "SELECT course_id, title, description, embed_link FROM materials WHERE id=$material_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $material = $result->fetch_assoc();
    } else {
        echo "Material not found.";
        exit();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Materi</title>
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
        <h1>Admin Materi Online</h1>
    </header>
    <div class="main-content">
    <?php include 'sidebar.php'; ?>

        <div class="content-table">
            <div class="form-container">
                <h2>Edit Materi</h2>
                <p>Pastikan data yang diinput sudah benar!</p>
                <form method="post" action="">
                    <label for="course_id">Kursus</label>
                    <select id="course_id" name="course_id" required>
                        <option value="" disabled selected>Pilih Kursus</option>
                        <?php while ($row = mysqli_fetch_assoc($resultCourses)): ?>
                            <option value="<?= $row['id']; ?>" <?= $row['id'] == $material['course_id'] ? 'selected' : ''; ?>>
                                <?= $row['title']; ?>
                            </option>
                        <?php endwhile; ?>
                    </select>

                    <label for="title">Judul</label>
                    <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($material['title']); ?>" required>

                    <label for="description">Deskripsi</label>
                    <textarea id="description" name="description" rows="4" required><?php echo htmlspecialchars($material['description']); ?></textarea>

                    <label for="embed_link">Embed Link</label>
                    <input type="text" id="embed_link" name="embed_link" value="<?php echo htmlspecialchars($material['embed_link']); ?>" required>

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

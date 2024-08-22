<?php
session_start();
require "Database/database.php";

$perPage = 5;
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($currentPage - 1) * $perPage;

// Cek apakah ada kata kunci pencarian
$search = isset($_GET['search']) ? $_GET['search'] : '';

$queryTotalCourses = "SELECT COUNT(*) AS total FROM courses WHERE title LIKE '%$search%'";
$resultTotalCourses = mysqli_query($conn, $queryTotalCourses);
$totalCourses = mysqli_fetch_assoc($resultTotalCourses)['total'];

$totalPages = ceil($totalCourses / $perPage);

$queryAllCourses = "SELECT * FROM courses WHERE title LIKE '%$search%' LIMIT $perPage OFFSET $offset";
$resultAllCourses = mysqli_query($conn, $queryAllCourses);
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
        /* Styles for table and cards */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 0; 
    border-radius: 5px;
    overflow: hidden; 
}

th, td {
    padding: 10px;
    text-align: left;
}

th {
    background-color: #EEEEEE;
    white-space: nowrap;
}

.card-container {
    display: flex;
    flex-direction: column;
    gap: 10px;
    padding: 20px;
    background-color: #f8f9fa;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.content h2 {
    font-size: 24px;
}

.content p {
    margin-top: 5px;
    font-size: 16px;
}

.content {
    padding: 20px;
    overflow: auto;
}

.search-container {
    margin-bottom: 15px;
    display: flex;
    justify-content: flex-end; 
}

.top-container {
    display: flex;
    justify-content: space-between;
    align-items: center; 
    margin-bottom: 15px;
}

.button-container a {
    padding: 10px 20px;
    font-size: 16px;
    color: white;
    background-color: #5050B2;
    border: none;
    border-radius: 5px;
    text-decoration: none;
    cursor: pointer;
}

.button-container a:hover {
    background-color: #40409C;
}

.search-container input[type="text"] {
    padding: 8px;
    font-size: 16px;
    width: 250px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.search-container button {
    padding: 8px 20px;
    font-size: 16px;
    color: white;
    background-color: #5050B2;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.search-container button:hover {
    background-color: #40409C;
}

/* Responsive Styles */
@media only screen and (max-width: 768px) {
    .card-container {
        width: 100%;
    }

    table {
        display: block;
        overflow-x: auto;
        white-space: nowrap;
    }

    th, td {
        padding: 8px;
        font-size: 14px;
    }

    .top-container {
        flex-direction: column;
        align-items: flex-start;
    }

    .search-container {
        flex-direction: column;
        width: 100%;
        margin-bottom: 20px;
    }

    .search-container input[type="text"], 
    .search-container button {
        width: 100%;
        margin-bottom: 10px;
    }

    .search-container button {
        margin-bottom: 0;
    }

    .button-container a {
        width: 100%;
        text-align: center;
    }

    .zoom-icons {
        bottom: 20px;
        right: 20px;
    }
}

@media only screen and (max-width: 480px) {
    .content h2 {
        font-size: 20px;
    }

    .content p {
        font-size: 14px;
    }

    .search-container input[type="text"], 
    .search-container button {
        padding: 6px;
        font-size: 14px;
    }

    .button-container a {
        padding: 5px 10px;
        font-size: 14px;
    }
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
            <h2>Kelola Data Kursus</h2>
            <p>Anda dapat menambah, mengubah dan menghapus data</p>
            <div class="top-container">
    <div class="button-container">
        <a href="tambahkursus.php">Tambah Kursus</a>
    </div>
    <div class="search-container">
        <form action="" method="GET">
            <input type="text" name="search" placeholder="Cari kursus..." value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit">Cari</button>
        </form>
    </div>
</div>

    <?php if (mysqli_num_rows($resultAllCourses) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Durasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($course = mysqli_fetch_assoc($resultAllCourses)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($course['title']); ?></td>
                        <td><?php echo htmlspecialchars($course['description']); ?></td>
                        <td><?php echo htmlspecialchars($course['duration']); ?></td>
                        <td class="action-buttons">
                            <a href="editkursus.php?id=<?php echo $course['id']; ?>">Edit</a>
                            <a href="#" class="delete" onclick="openConfirmModal('hapus-kursus.php?id=<?php echo $course['id']; ?>')">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="no-data">Tidak ada data kursus yang tersedia.</p>
    <?php endif; ?>
    <!-- Pagination Links -->
<ul class="pagination">
                <?php if ($currentPage > 1): ?>
                    <li><a href="?page=<?php echo $currentPage - 1; ?>">&laquo; Previous</a></li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li><a href="?page=<?php echo $i; ?>" class="<?php echo $i == $currentPage ? 'active' : ''; ?>"><?php echo $i; ?></a></li>
                <?php endfor; ?>

                <?php if ($currentPage < $totalPages): ?>
                    <li><a href="?page=<?php echo $currentPage + 1; ?>">Next &raquo;</a></li>
                <?php endif; ?>
            </ul>
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

    <!-- Modal Konfirmasi Hapus -->
    <div id="confirmModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeConfirmModal()">&times;</span>
            <h2>Konfirmasi Hapus</h2>
            <p>Apakah Anda yakin ingin menghapus kursus ini?</p>
            <div class="modal-buttons">
                <button class="cancel" onclick="closeConfirmModal()">Batal</button>
                <button class="delete" id="confirmDeleteButton">Hapus</button>
            </div>
        </div>
    </div>

    <!-- Modal Notifikasi -->
    <div id="notificationModal" class="modal">
        <div class="modal-content">
            <p id="notificationMessage"></p>
        </div>
    </div>

    <script src="script.js"></script>
    <script>
        // Display notification based on query parameters
        <?php if (isset($_GET['status'])): ?>
            var status = "<?php echo $_GET['status']; ?>";
            if (status === 'success') {
                openNotificationModal('Kursus telah berhasil dihapus.');
            } else {
                openNotificationModal('Terjadi kesalahan saat menghapus kursus.');
            }
        <?php endif; ?>
    </script>
</body>
</html>
